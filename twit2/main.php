<?php

session_start();

//The user has logged in
if (isset($_SESSION['twitter_id'])) {
  $screen_name = $_SESSION['screen_name'];
  echo '<p>@' . $screen_name . ' |  <a href="http://1939.site90.net/socialfeeds/twit/logout.php" title="Click here to logout">Logout</a></p>';
}

//The user has not logged in
else {
  echo '<a href="http://1939.site90.net/socialfeeds/twit/login_to_twitter.php"><img src="http://1939.site90.net/socialfeeds/twit/img/sign-in-with-twitter-gray.png" title="Click here to sign in with Twitter!" /></a>';
}
