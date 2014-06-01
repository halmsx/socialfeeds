<?php
require 'facebook-php-sdk-master/src/facebook.php';


$facebook = new Facebook(array(
    'appId' => '229499593927570',
    'secret' => '999fd6e5b3cf00ab97c9954121a60964',
        ));

// Get User ID
$user = $facebook->getUser();

if (isset($_GET['logout'])) {
  $facebook->destroySession();
  
  header("Location: fb_logout.html");
}

$access_token = $facebook->getAccessToken();

if ($user) {
  try {
//    $user_response = $facebook->api('/me/permissions?access_token=' . $access_token);
    $user_response = $facebook->api('/me/home');

    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $params = array('next' => 'http://localhost/twitterjaya/socialfeeds/trunk/fb/newhtml1.html');

  $logoutUrl = $facebook->getLogoutUrl($params);
} else {
  $loginUrl = $facebook->getLoginUrl();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>

  </head>
  <body>
    <h1>Sample web app using facebook php SDK </h1>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
      <br>
      <a href="?logout=1">Logout Local</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a><br>
      </div>
    <?php endif ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION); ?></pre>

    <?php if ($user): ?>
      <h3> Welcome <?php echo $user_profile['name']; ?> !!! </h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your friend list Object is as follows (/me/friends?token=<?php echo $access_token; ?>)</h3>
      <pre><?php print_r($user_response); ?></pre>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>
  </body>
</html>
