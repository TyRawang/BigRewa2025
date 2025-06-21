<?php


namespace App\Common;


use App\Models\GoogleSMTP;
use Auth;
use Config;


class AccessTokenManager
{

     public function checkAndUpdateAccessToken(){
        $googlesmtp = GoogleSMTP::where('user_id', Auth::id())->first();

        if(!$googlesmtp){
            return false;
        }
        if($googlesmtp){
            $g_cong = Config::get('gmail');
            $current_time = time();
            $expired_time = $googlesmtp->expires_in;
            if($current_time >= $expired_time){
                $response =  $this->GetRefreshedAccessToken($g_cong['client_id'], $googlesmtp['refresh_token'], $g_cong['client_secret']);
               // print_R($response);die;
                if($response['status'] == 200){
                    $googlesmtp->access_token =  $response['data']['access_token'];
                    $googlesmtp->expires_in =  time() + $response['data']['expires_in'];
                    $googlesmtp->update();
                }
            }
        }

        return true;
    }

     private function GetRefreshedAccessToken($client_id, $refresh_token, $client_secret) {
    	$url_token = 'https://www.googleapis.com/oauth2/v4/token';

    	$curlPost = 'client_id=' . $client_id . '&client_secret=' . $client_secret . '&refresh_token='. $refresh_token . '&grant_type=refresh_token';
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url_token);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    	$data = json_decode(curl_exec($ch), true);
    	$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
     	if($http_code != 200){
     	    $response['status'] = 503;
     	    $response['message'] = 'Error : Failed to refresh access token';

        }else{
            $response['status'] = 200;
     	    $response['data'] = $data;
        }
    	return $response;
    }

}
