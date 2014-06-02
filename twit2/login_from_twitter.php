<?php

session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/_include/login/EpiCurl.php');
include($_SERVER['DOCUMENT_ROOT'] . '/_include/login/EpiOAuth.php');
include($_SERVER['DOCUMENT_ROOT'] . '/_include/login/EpiTwitter.php');
include($_SERVER['DOCUMENT_ROOT'] . '/../data/twittersecret.php');

if (isset($_GET['oauth_token'])) {

  $twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

  $twitterObj->setToken($_GET['oauth_token']);
  $token = $twitterObj->getAccessToken();
  $twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);

  $userdata = $twitterObj->get_accountVerify_credentials();

  $twitter_id = $userdata->id;
  $screen_name = $userdata->screen_name;


  $_SESSION['twitter_id'] = $twitter_id;
  $_SESSION['screen_name'] = $screen_name; //This is the @name
} else {
  header('Location: http://1939.site90.net/socialfeeds/twit2/');
}
