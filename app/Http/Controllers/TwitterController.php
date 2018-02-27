<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class TwitterController extends Controller
{
  public function index(\Abraham\TwitterOAuth\TwitterOAuth $twitteroauth, Request $request) {
    $request_token = $twitteroauth->oauth(
      'oauth/request_token', [
        'oauth_callback' => route('twitter.callback'),
      ]
    );

    session()->put('oauth_token', $request_token['oauth_token']);
    session()->put('oauth_token_secret', $request_token['oauth_token_secret']);

    $url = $twitteroauth->url(
      'oauth/authorize', [
        'oauth_token' => $request_token['oauth_token']
      ]
    );

    $request->session()->reflash();

    return redirect()->to($url);
  }

  public function callback(Request $request)
  {
    $connection = new \Abraham\TwitterOAuth\TwitterOAuth(
      config('twitteroauth.CONSUMER_KEY'),
      config('twitteroauth.CONSUMER_SECRET'),
      session()->get('oauth_token'),
      session()->get('oauth_token_secret')
    );

    // request user token
    $token = $connection->oauth(
      'oauth/access_token', [
        'oauth_verifier' => $request->input('oauth_verifier')
      ]
    );

    $twitter = new \Abraham\TwitterOAuth\TwitterOAuth(
      config('twitteroauth.CONSUMER_KEY'),
      config('twitteroauth.CONSUMER_SECRET'),
      $token['oauth_token'],
      $token['oauth_token_secret']
    );

    $lastPost = session()->get('lastPost');
    $media_id_string = '';
    foreach ($lastPost['file_ids'] as $file_id) {
      $file = File::findOrFail($file_id);
      $media = $twitter->upload('media/upload', ['media' => public_path($file->path640)]);
      $media_id_string .= $media->media_id_string . ',';
    }

    $parameters = [
      'status' => $lastPost['caption'],
      'media_ids' => trim($media_id_string, ','),
    ];

    $status = $twitter->post('statuses/update', $parameters);
    if (!empty($status)) {
      session()->push('lastPost.status', 'The picture has been added to your Twitter feed.');
    }
    else {
      session()->push('lastPost.error', 'There was a problem adding the picture to your Facebook feed.');
    }

    return redirect()->route('upload.complete');
  }
}
