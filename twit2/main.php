<?php

session_start();

if (isset($_SESSION['twitter_id'])) {
  $screen_name = $_SESSION['screen_name'];
  echo '<p>@' . $screen_name . ' |  <a href="http://1939.site90.net/socialfeeds/twit2/logout.php" title="Click here to logout">Logout</a></p>';
} else {
  echo '<a href="http://1939.site90.net/socialfeeds/twit2/login_to_twitter.php"><img src="http://1939.site90.net/socialfeeds/twit2/img/sign-in-with-twitter-gray.png" title="Click here to sign in with Twitter!" /></a>';
}
