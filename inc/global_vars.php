<?php

// site vars
$site['url']					= 'https://whittinghamj.com/projects/template_admin_metro/';
$site['title']					= 'WhatsApp Pro Mailer';
$site['copyright']				= 'Written by Jamie Whittingham.';

$config['url']					= $site['url'];
$config['title']				= $site['title'];
$config['copyright']			= $site['copyright'];

// logo name vars
$site['name_long']				= 'WhatsApp<b>Pro</b>Mailer';
$site['name_short']				= '<b>WPM</b>';

$whmcs['url'] 					= "https://genexnetworks.net/billing/includes/api.php"; # URL to WHMCS API file
$whmcs["username"] 				= "apiuser"; # Admin username goes here
$whmcs["password"] 				= md5("dje773jeidkdje773jeidk"); # Admin password goes here  
$whmcs['accesskey']				= 'admin1372';
// product details
$product_ids = array(
					60, // 1 sender
					61, // 3 senders
					62, // 10 senders
					);