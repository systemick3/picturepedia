<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class FacebookController extends Controller
{
  public function index(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb, Request $request)
  {
    $loginUrl = $fb->getLoginUrl(['publish_actions']);
    return redirect()->to($loginUrl);
  }

  public function callback(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb, Request $request)
  {
    try {
        $token = $fb
          ->getRedirectLoginHelper()
          ->getAccessToken();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // Failed to obtain access token
        dd($e->getMessage());
    }

    $lastPost = session()->get('lastPost');
    //$file = File::findOrFail($lastPost['file_id']);
    foreach ($lastPost['file_ids'] as $file_id) {
      $file = File::findOrFail($file_id);
      $data = [
        'message' => $lastPost['caption'],
        'source' => $fb->fileToUpload(public_path($file->path640)),
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
      if (!empty($graphNode)) {
        session()->push('lastPost.status', 'The picture has been added to your Facebook feed.');
      }
      else {
        session()->push('lastPost.error', 'There was a problem adding the picture to your Facebook feed.');
      }
    }

    //$lastPost = session()->get('lastPost');
    if ($lastPost['twitter']) {
      return redirect()->route('twitter.index');
    }
    else {
      return redirect()->route('upload.complete');
    }
  }
}
