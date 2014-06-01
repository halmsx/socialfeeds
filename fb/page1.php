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
  exit();
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
//  $loginUrl = $facebook->getLoginUrl();
  header('Location: fb_login.html');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>FB Feeds</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      a {
        text-decoration: none;
        color: #3b5998;
      }
      a:hover {
        text-decoration: underline;
      }

      #fb-root .post {
        padding: 4px;
        margin-top: 10px;

        border: 1px solid lightgray;
        
        max-width: 500px;
      }
      #fb-root .post .content {
        font-size: 12px;
      }
      #fb-root .post .content img {
        float: left; 
        padding: 0px 5px 0px 0px;
      }
      #fb-root .post .bottom {
        /*margin: 0 4px;*/
        clear: both;
      }
      #fb-root .post #name img {
        padding: 0px 6px 0px 0px;
      }
      #fb-root .post #name {
        padding-bottom: 6px;
        font-weight: bold;
      }
    </style>

  </head>
  <body>
    <h1>Sample web app using facebook php SDK </h1>

    <?php if ($user): ?>
      <a href="?logout=1">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a><br>
      </div>
    <?php endif ?>

    <?php if ($user): ?>
      <h3> Welcome <?php echo $user_profile['name']; ?> !!! </h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <div id="fb-root" style="margin-top: 20px">
        <!--<pre><?php print_r($user_response); ?></pre>-->
        <?php
        foreach ($user_response['data'] as $i => $v) {

          echo '<div id="' . $v['id'] . ' " class="post">';

          print ('<div id="name"><a href="https://www.facebook.com/app_scoped_user_id/' . $v['from']['id'] . '" target="_blank"><img src="http://graph.facebook.com/' . $v['from']['id'] . '/picture" / style="vertical-align: top;">' . $v['from']['name'] . '</a></div>');

          switch ($v['type']) {
            case 'photo':
              $photo = $v['picture'];
              break;

            case 'status':
              break;

            case 'video':
              $photo = $v['picture'];
              break;
          }

          echo '<div class="content">';

          if (isset($v['picture']))
            print ("<img src=\"$photo\" >");

          if (isset($v['message']))
            print (nl2br($v['message']) . '<br>');
          else if (isset($v['story']))
            print (nl2br($v['story']) . '<br>');

          echo '</div>';

          echo '<div class="bottom"></div>';

          echo "</div>";
        }
        ?>
      <?php else: ?>
        <strong><em>You are not Connected.</em></strong>
      <?php endif ?>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  </body>
</html>
