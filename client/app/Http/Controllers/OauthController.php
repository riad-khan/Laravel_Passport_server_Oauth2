<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class OauthController extends Controller
{
    public function redirect(Request $request){


        $query = http_build_query([
            'client_id' => '4',
            'redirect_uri' => 'http://client.test/oauth/callback',
            'response_type' => 'code',
            'scope' => 'view-post user-login',

        ]);

        return redirect('http://127.0.0.1:8000/oauth/authorize?'.$query);
    }

    public function callback(Request $request){

     //   $http = new Client();

        $response =Http::asForm()->post('http://127.0.0.1:8000/oauth/token', [
                'grant_type' => 'authorization_code',
                'client_id' => '4',
                'client_secret' => 'KHdUzWEoUAMgSe88DYp3jTkvvALnSZu2mIxaq7on',
                'redirect_uri' => 'http://client.test/oauth/callback',
                'code' => $request->code,
        ]);
        $response = $response->json();

          if(!auth()->user()){
              return redirect('login');
          }else{
            $request->user()->token()->delete();
            $request->user()->token()->create([
                'access_token' =>$response['access_token']
            ]);

            return redirect('/home');
          }

    }
}
