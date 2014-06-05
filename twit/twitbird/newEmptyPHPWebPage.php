<?php
require_once ('codebird.php');
\Codebird\Codebird::setConsumerKey('su7RwuZmd5g1owp5LEOCr0xTY', 'I455Fg5TlWdcaQ7JsGnvgjxzMeqGqEZKpC4ppmBmmRyIiZMms8'); // static, see 'Using multiple Codebird instances'

$cb = \Codebird\Codebird::getInstance();

$cb->setToken('195776371-DfFXwn0AyadA7Pr21m1lKsXCZ76u1MoDnwTIGuHl', 'JdUGW3ihE4ckzeUZYc77QIhtrqrLpHHqcraNLJQOwkLDw');

//$reply = (array) $cb->statuses_homeTimeline();
//print_r($reply);

$params = array(
    'screen_name' => 'jublonet'
);
$reply = $cb->users_show($params);
