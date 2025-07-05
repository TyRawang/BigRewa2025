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

class SMTPConfigureController extends Controller
{
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
                
                $query = 'in:inbox after:' . $fltr_date . ' subject:"New lead from Leads"';
                $messages = $gmail->users_messages->listUsersMessages('me', ['q' => $query]);
                
                $messageList = [];
                if ($messages->getMessages()) {
                    foreach ($messages->getMessages() as $message) {
                        $messageDetail = $gmail->users_messages->get('me', $message->getId());
                        // $messageList[] = $messageDetail;
                        $messageList[] = new GmailMessageWrapper($messageDetail);
                    }
                }
                
                return view('google-mail-list')->with(['messages' => $messageList]);
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
                
                if ($message) {
                    // Mark as read
                    $gmail->users_messages->modify('me', $id, new \Google\Service\Gmail\ModifyMessageRequest([
                        'removeLabelIds' => ['UNREAD']
                    ]));
                    
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
