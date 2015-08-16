<?php

require "GetRSS.php";

$irss = new GetRSS;
$irss->LoadRSS('http://www.aftonbladet.se/rss.xml');
$rss=$irss->GetAll();

print_r($rss);

$irss->LoadRSS('http://www.expressen.se/Pages/OutboundFeedsPage.aspx?id=3642159&viewstyle=rss');
$rss=$irss->GetAll();

print_r($rss);
?>
