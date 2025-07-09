<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\CustomData;
use App\Models\GoogleSMTP;
use Auth;
use App\Models\ExtraField;
use Config;
use Exception;
use Google\Client;
use Google\Service\Gmail;

/**
 * SMTP Configuration Controller
 * 
 * GMAIL PAGINATION CONFIGURATION:
 * ================================
 * To change the number of emails shown per page, modify ONLY the constants below.
 * 
 * QUICK SETUP EXAMPLES:
 * ---------------------
 * For 5 emails per page:    GMAIL_INBOX_PER_PAGE = 5,  GMAIL_BATCH_SIZE = 5
 * For 10 emails per page:   GMAIL_INBOX_PER_PAGE = 10, GMAIL_BATCH_SIZE = 5
 * For 20 emails per page:   GMAIL_INBOX_PER_PAGE = 20, GMAIL_BATCH_SIZE = 10
 * For 50 emails per page:   GMAIL_INBOX_PER_PAGE = 50, GMAIL_BATCH_SIZE = 25
 * 
 * RULES:
 * ------
 * - GMAIL_BATCH_SIZE should be <= GMAIL_INBOX_PER_PAGE
 * - Smaller batch sizes = more API calls but less memory usage
 * - Larger batch sizes = fewer API calls but more memory usage
 * - Recommended: Keep batch size at 50% of page size or less
 * 
 * PERFORMANCE TIPS:
 * -----------------
 * - For slow connections: Use smaller page sizes (5-10)
 * - For fast connections: Use larger page sizes (20-50)
 * - For mobile users: Use smaller page sizes (5-10)
 * 
 * No other file changes needed - all pagination logic automatically adjusts!
 */
class SMTPConfigureController extends Controller
{
    /**
     * Gmail inbox pagination settings
     * 
     * CHANGE THESE VALUES TO MODIFY PAGE SIZE:
     */
    const GMAIL_INBOX_PER_PAGE = 3;  // ← CHANGE THIS to modify emails per page
    const GMAIL_BATCH_SIZE = 3;       // ← CHANGE THIS to modify batch processing size
    
    /**
     * Get Gmail pagination settings
     * This method allows for future expansion to database or config-based settings
     * 
     * @return array
     */
    private function getGmailPaginationSettings()
    {
        // Validate configuration
        if (self::GMAIL_BATCH_SIZE > self::GMAIL_INBOX_PER_PAGE) {
            throw new \InvalidArgumentException(
                'GMAIL_BATCH_SIZE (' . self::GMAIL_BATCH_SIZE . ') cannot be greater than GMAIL_INBOX_PER_PAGE (' . self::GMAIL_INBOX_PER_PAGE . ')'
            );
        }
        
        return [
            'perPage' => self::GMAIL_INBOX_PER_PAGE,
            'batchSize' => self::GMAIL_BATCH_SIZE,
            'maxResults' => self::GMAIL_INBOX_PER_PAGE, // Gmail API parameter
        ];
    }

    /**
     * Create a new controller instance.
     *dfs
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */

    function save_smpt_settings(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'driver' => 'required',
            'host' => 'required',
            'pwd' => 'required',
            'username' => 'required|email',
            'port' => 'required|integer|min:1',
            'encryption' => 'required',
            'fromname' => 'required'
        );
        $customObj = new CustomData();
        $userId = Auth::user()->id;
        $data = $obj = $customObj->where('user_id', $userId)->first();
        $newnames = array();
        $messages = array();
        $v = \Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            if (empty($data)) {
                $obj = new CustomData();
                $obj->user_id = Auth::id();
            }
            $obj->driver = $input['driver'];
            $obj->host = $input['host'];
            $obj->username = $input['username'];
            $obj->pwd = $input['pwd'];
            $obj->port = $input['port'];
            $obj->encryption = $input['encryption'];
            $obj->fromname = $input['fromname'];
            $obj->save();
            if (empty($data)) {
                return redirect('/smtp-configure')->with('success_message', 'Saved successfully');
            } else {
                return redirect('/smtp-configure')->with('success_message', 'Updated successfully');
            }
        }
        return Redirect::back()->withErrors($v)->withInput();
    }

    public function index()
    {
        $customData = CustomData::where('user_id', \Auth::id())->first();
        $googleData = GoogleSMTP::where('user_id', \Auth::id())->first();
        return view('smtp-configure')->with(['customData' => $customData, 'googleData' => $googleData]);
    }

    function gmail_login()
    {
        $data = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($data) {
            return redirect('/smtp-configure')->with('success_message', 'Google SMTP already configured');
        }
        
        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI', url('/oauth/gmail/callback')));
        $client->addScope(Gmail::GMAIL_READONLY);
        $client->addScope(Gmail::GMAIL_SEND);
        $client->addScope(Gmail::GMAIL_MODIFY);
        $client->addScope('email');
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        
        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }

    function save_googlesmtp_settings(Request $request)
    {
        $code = $request->get('code');
        if (!$code) {
            return redirect('/smtp-configure')->with('error_message', 'Authorization code not received');
        }

        try {
            $client = new Client();
            $client->setClientId(env('GOOGLE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
            $client->setRedirectUri(env('GOOGLE_REDIRECT_URI', url('/oauth/gmail/callback')));
            $client->addScope(Gmail::GMAIL_READONLY);
            $client->addScope(Gmail::GMAIL_SEND);
            $client->addScope(Gmail::GMAIL_MODIFY);
            $client->addScope('email');
            $client->setAccessType('offline');

            $token = $client->fetchAccessTokenWithAuthCode($code);
            
            if (isset($token['error'])) {
                return redirect('/smtp-configure')->with('error_message', 'Error getting access token: ' . $token['error']);
            }

            // Get user email
            $client->setAccessToken($token);
            $gmail = new Gmail($client);
            $profile = $gmail->users->getProfile('me');
            
            $data = GoogleSMTP::where('user_id', Auth::id())->first();
            if (!$data) {
                $obj = new GoogleSMTP();
                $obj->user_id = Auth::id();
            } else {
                $obj = $data;
            }
            
            $obj->access_token = $token['access_token'];
            $obj->expires_in = time() + $token['expires_in'];
            $obj->scope = $token['scope'] ?? '';
            $obj->token_type = $token['token_type'] ?? 'Bearer';
            $obj->created = time();
            $obj->refresh_token = $token['refresh_token'] ?? $obj->refresh_token;
            $obj->email = $profile->getEmailAddress();
            $obj->save();
            
            return redirect('/smtp-configure')->with('success_message', 'Google SMTP added successfully');
        } catch (Exception $e) {
            return redirect('/smtp-configure')->with('error_message', 'Error configuring Google SMTP: ' . $e->getMessage());
        }
    }

    function google_inbox(Request $request)
    {
        $checkGmail = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($checkGmail) {
            try {
                $client = new Client();
                $client->setClientId(env('GOOGLE_CLIENT_ID'));
                $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
                $client->setAccessToken([
                    'access_token' => $checkGmail->access_token,
                    'refresh_token' => $checkGmail->refresh_token,
                    'expires_in' => $checkGmail->expires_in - time(),
                    'token_type' => $checkGmail->token_type,
                    'created' => $checkGmail->created
                ]);

                if ($client->isAccessTokenExpired()) {
                    $client->fetchAccessTokenWithRefreshToken($checkGmail->refresh_token);
                    $token = $client->getAccessToken();
                    $checkGmail->access_token = $token['access_token'];
                    $checkGmail->expires_in = time() + $token['expires_in'];
                    $checkGmail->save();
                }

                $gmail = new Gmail($client);
                $current_date = date('Y-m-d');
                $month = 1;
                $fltr_date = date("Y-m-d", strtotime("-" . $month . " months", strtotime($current_date)));
                
                $query = 'in:inbox after:' . $fltr_date . ' subject:"New lead from"';
                
                // Get pagination settings from centralized method
                $paginationSettings = $this->getGmailPaginationSettings();
                $pageToken = $request->get('pageToken', null); // Get page token from request
                
                $queryParams = [
                    'q' => $query,
                    'maxResults' => $paginationSettings['maxResults']
                ];
                
                if ($pageToken) {
                    $queryParams['pageToken'] = $pageToken;
                }
                
                $messages = $gmail->users_messages->listUsersMessages('me', $queryParams);
                
                $messageList = [];
                if ($messages->getMessages()) {
                    // Batch process messages for better performance
                    $messageBatches = array_chunk($messages->getMessages(), $paginationSettings['batchSize']);
                    
                    foreach ($messageBatches as $batch) {
                        foreach ($batch as $message) {
                            try {
                                $messageDetail = $gmail->users_messages->get('me', $message->getId());
                                $messageList[] = new GmailMessageWrapper($messageDetail);
                            } catch (Exception $e) {
                                // Log error and continue with next message
                                \Log::warning('Failed to load email: ' . $message->getId() . ' - ' . $e->getMessage());
                                continue;
                            }
                        }
                        
                        // Small delay between batches to prevent rate limiting
                        if (count($messageBatches) > 1) {
                            usleep(100000); // 0.1 second delay
                        }
                    }
                }
                
                // Pagination data
                $paginationData = [
                    'messages' => $messageList,
                    'nextPageToken' => $messages->getNextPageToken(),
                    'resultSizeEstimate' => $messages->getResultSizeEstimate(),
                    'currentPageToken' => $pageToken,
                    'perPage' => $paginationSettings['perPage']
                ];
                
                return view('google-mail-list')->with($paginationData);
            } catch (Exception $e) {
                return view('google-mail-list')->with(['messages' => [], 'error' => $e->getMessage()]);
            }
        }

        return view('google-mail-list')->with(['messages' => []]);
    }

    function gmail_mail_detail($id)
    {
        $checkGmail = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($checkGmail) {
            try {
                $client = new Client();
                $client->setClientId(env('GOOGLE_CLIENT_ID'));
                $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
                $client->setAccessToken([
                    'access_token' => $checkGmail->access_token,
                    'refresh_token' => $checkGmail->refresh_token,
                    'expires_in' => $checkGmail->expires_in - time(),
                    'token_type' => $checkGmail->token_type,
                    'created' => $checkGmail->created
                ]);

                if ($client->isAccessTokenExpired()) {
                    $client->fetchAccessTokenWithRefreshToken($checkGmail->refresh_token);
                    $token = $client->getAccessToken();
                    $checkGmail->access_token = $token['access_token'];
                    $checkGmail->expires_in = time() + $token['expires_in'];
                    $checkGmail->save();
                }

                $gmail = new Gmail($client);
                $message = $gmail->users_messages->get('me', $id);
                $message = new GmailMessageWrapper($message);
                
                if ($message) {
                    // Try to mark as read, but don't fail if it doesn't work
                    try {
                        $gmail->users_messages->modify('me', $id, new \Google\Service\Gmail\ModifyMessageRequest([
                            'removeLabelIds' => ['UNREAD']
                        ]));
                    } catch (Exception $e) {
                        // Log the error but continue - marking as read is not critical
                        \Log::warning('Could not mark email as read: ' . $e->getMessage());
                    }
                    
                    $extra_fields = ExtraField::where('user_id', Auth::id())->orderBy('sorted', 'ASC')->get();
                    return view('single-mail')->with(['message' => $message, 'extra_fields' => $extra_fields]);
                }
            } catch (Exception $e) {
                return redirect('home')->with('error_message', 'Error retrieving email: ' . $e->getMessage());
            }
        }
        return redirect('home');
    }

    function remove_google_account()
    {
        $googlesmtp = GoogleSMTP::where('user_id', Auth::id())->first();
        if ($googlesmtp) {
            $googlesmtp->delete();
            return redirect('/smtp-configure')->with('success_message', 'Removed successfully');
        } else {
            return redirect('/smtp-configure')->with('error_message', 'Sorry!, something went wrong');
        }
    }
}


class GmailMessageWrapper {
    private $id;
    private $subject;
    private $from;
    private $fromName;
    private $fromEmail;
    private $date;
    private $labelIds;
    private $htmlBody;

    public function __construct($message) {
        $this->id = $message->getId();
        $this->labelIds = $message->getLabelIds();
        $headers = $message->getPayload()->getHeaders();

        foreach ($headers as $header) {
            switch ($header->getName()) {
                case 'Subject':
                    $this->subject = $header->getValue();
                    break;
                case 'From':
                    $this->from = $header->getValue();
                    $this->parseFrom($this->from);
                    break;
                case 'Date':
                    $this->date = $header->getValue();
                    break;
            }
        }

        $this->htmlBody = $this->extractHtmlBody($message->getPayload());
    }

    private function parseFrom($fromHeader) {
        if (preg_match('/^(.*)<(.+)>$/', $fromHeader, $matches)) {
            $this->fromName = trim($matches[1], "\" ");
            $this->fromEmail = trim($matches[2]);
        } else {
            $this->fromName = '';
            $this->fromEmail = trim($fromHeader);
        }
    }

    private function extractHtmlBody($payload) {
        // If HTML is directly in the payload
        if ($payload->getMimeType() === 'text/html' && $payload->getBody()->getData()) {
            return $this->decodeBody($payload->getBody()->getData());
        }

        // Check parts
        if ($payload->getParts()) {
            foreach ($payload->getParts() as $part) {
                if ($part->getMimeType() === 'text/html') {
                    return $this->decodeBody($part->getBody()->getData());
                }

                // Nested multipart
                if ($part->getParts()) {
                    foreach ($part->getParts() as $subpart) {
                        if ($subpart->getMimeType() === 'text/html') {
                            return $this->decodeBody($subpart->getBody()->getData());
                        }
                    }
                }
            }
        }

        return '';
    }

    private function decodeBody($bodyData) {
        // Gmail API base64 encodes with URL-safe characters
        $bodyData = str_replace(['-', '_'], ['+', '/'], $bodyData);
        return base64_decode($bodyData);
    }

    // Getters
    public function getId() { return $this->id; }
    public function getSubject() { return $this->subject; }
    public function getFrom() { return $this->from; }
    public function getFromName() { return $this->fromName; }
    public function getFromEmail() { return $this->fromEmail; }
    public function getDate() { return $this->date; }
    public function getLabelIds() { return $this->labelIds; }
    public function getHtmlBody() { return $this->htmlBody; }
}
