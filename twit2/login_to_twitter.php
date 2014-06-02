<?php

include('twitter-async-master/EpiCurl.php');
include('twitter-async-master/EpiOAuth.php');
include('twitter-async-master/EpiTwitter.php');
include('twittersecret.php');

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

$authenticateUrl = $twitterObj->getAuthenticateUrl();

/* Redirect to the Twitter login page */
header('Location: ' . $authenticateUrl . '');
