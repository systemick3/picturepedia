<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class FacebookController extends Controller
{
  public function index(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
  {
    var_dump($fb);

    // $fb = new Facebook\Facebook([
    //   'app_id' => config('laravel-facebook-sdk.app_id'), // Replace {app-id} with your app id
    //   'app_secret' => config('laravel-facebook-sdk.app_secret'),
    //   'default_graph_version' => 'v2.2',
    // ]);

    $loginUrl = $fb->getLoginUrl(['publish_actions']);
    //die($loginUrl);
    return redirect()->to($loginUrl);

    // try {
    //     $token = $fb
    //         ->getRedirectLoginHelper()
    //         ->getAccessToken();
    // } catch (Facebook\Exceptions\FacebookSDKException $e) {
    //     // Failed to obtain access token
    //     dd($e->getMessage());
    // }

    //$helper = $fb->getRedirectLoginHelper();

    //$permissions = ['email']; // Optional permissions
    //$loginUrl = $helper->getLoginUrl('https://systemick.co.uk', $permissions);

    return 'Hello Facebook ' . $loginUrl;
  }

  public function callback(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
  {
    try {
        $token = $fb
            ->getRedirectLoginHelper()
            ->getAccessToken();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // Failed to obtain access token
        dd($e->getMessage());
    }

    $file = File::findOrFail(session()->get('last_upload_id'));
    //die(public_path('storage/images/' . $file->filename));
    $data = [
      'message' => 'My awesome photo upload example.',
      'source' => $fb->fileToUpload(public_path($file->filepath)),
    ];

    try {
      // Returns a `Facebook\FacebookResponse` object
      $response = $fb->post('/me/photos', $data, $token);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    $graphNode = $response->getGraphNode();

    echo 'Photo ID: ' . $graphNode['id'] . '<br/>';

    return 'Testing 2 ' . session()->get('last_upload_id') . ' ' . $token;
  }
}
