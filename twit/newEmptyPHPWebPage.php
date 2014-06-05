<?php
require_once('twitter-api-php-master/TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ * */
$settings = array(
    'oauth_access_token' => "195776371-DfFXwn0AyadA7Pr21m1lKsXCZ76u1MoDnwTIGuHl",
    'oauth_access_token_secret' => "JdUGW3ihE4ckzeUZYc77QIhtrqrLpHHqcraNLJQOwkLDw",
    'consumer_key' => "su7RwuZmd5g1owp5LEOCr0xTY",
    'consumer_secret' => "I455Fg5TlWdcaQ7JsGnvgjxzMeqGqEZKpC4ppmBmmRyIiZMms8"
);

//$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
//$getfield = '?screen_name=itoreh';

$url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
$getfield = '?exclude_replies=FALSE&count=50';

$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();

$timeline = json_decode($response);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>

    <style type="text/css">
      span.sm-lock {
        background-image: url("https://abs.twimg.com/a/1401909795/img/t1/twitter_web_sprite_icons.png");
        background-position: -140px -220px;
      }
    </style>
  </head>
  <body>
    <?php
    foreach ($timeline as $i => $v) {
      print('<div style="padding: 4px 4px; max-width: 500px;">');

      if ($i == 0)
        print('<hr>');
//  print_r ($v);


      print('<img src="' . $v->user->profile_image_url_https . '" style="float: left; vertical-align: top; padding-right: 4px">');

      print($v->user->name . '&nbsp' . '@' . $v->user->screen_name . '&nbsp;');

//      if ($v->user->protected == 1)
//        print('<span class="sm-lock"></span><br>');

      print('<br>' . $v->text . '<br>');

      print('<div style="clear: both; "></div>');
      print('</div>');
      print('<div style="border-bottom: 1px solid #ccc"></div>');
    }
    ?>
  </body>
</html>
