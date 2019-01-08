<?php

// if($_GET['dev'] == 'yes'){
  	error_reporting(E_ALL);
  	ini_set('error_reporting', E_ALL);
  	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
// }

include("inc/global_vars.php");
include('inc/functions.php');

$ip 							= $_SERVER['REMOTE_ADDR'];
$user_agent     				= $_SERVER['HTTP_USER_AGENT'];

$now = time();

$email 							= post('email');
$password 						= post('password');

$postfields["username"] 		= $whmcs['username']; 
$postfields["password"] 		= $whmcs['password'];
$postfields["action"] 			= "validatelogin";
$postfields["email"] 			= $email;
$postfields["password2"] 		= $password;
$postfields["responsetype"] 	= 'json';
$postfields['accesskey']		= $whmcs['accesskey'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $whmcs['url']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSLVERSION,3);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
$data = curl_exec($ch);

curl_close($ch);

$results = json_decode($data, true);

echo '<h3>$whmcs</h3>';
debug($whmcs);

echo '<h3>$data</h3>';
debug($data);

echo '<h3>$results</h3>';
debug($results);

if($results["result"]=="success")
{
    // login confirmed
	
	$_SESSION['account']['id'] 		= $results['userid'];
	$_SESSION['account']['email'] 	= $email;
	$user_id 						= $results['userid'];

	// lets get client details
	$postfields["username"] 			= $whmcs['username'];
	$postfields["password"] 			= $whmcs['password'];
	$postfields["responsetype"] 		= "json";
	$postfields["action"] 				= "getclientsdetails";
	$postfields["clientid"] 			= $user_id;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $whmcs['url']);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSLVERSION,3);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	$client_data = curl_exec($ch);
	curl_close($ch);

	$client_data = json_decode($client_data, true);

	// lets check their product status for late / non payment
	$postfields["username"] 			= $whmcs['username'];
	$postfields["password"] 			= $whmcs['password'];
	$postfields["responsetype"] 		= "json";
	$postfields["action"] 				= "getclientsproducts";
	$postfields["clientid"] 			= $user_id;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $whmcs['url']);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSLVERSION,3);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	$data = curl_exec($ch);
	curl_close($ch);

	$data = json_decode($data, true);

	debug($data);

	die();

	foreach($data['products']['product'] as $product)
	{
		if (in_array($product['pid'], $product_ids)) {
		    // product match for this platform

		    if($product['status'] != 'Active'){
				// forward to billing area
				$whmcsurl 			= "https://clients.deltacolo.com/dologin.php";
				$autoauthkey 		= "admin1372";
				$email 				= $email;
				
				$timestamp 			= time(); 
				$goto 				= "clientarea.php";
				
				$hash 				= sha1($email.$timestamp.$autoauthkey);
				
				$url 				= $whmcsurl."?email=$email&timestamp=$timestamp&hash=$hash&goto=".urlencode($goto);
				go($url);
			}else{	
				$query = "SELECT * FROM `user_data` WHERE `user_id` = '".$user_id."' " ;
				$result = mysql_query($query) or die(mysql_error());
				$total_rows = mysql_num_rows($result);
				
				status_message('success', 'Login successful');
				
				if($total_rows == 0){

					$insert_query = "INSERT INTO `user_id` 
					(`added`, `user_id`)
					VALUE
					('".time()."', '".$user_id."')";
					
					$input = mysql_query($insert_query) or die(mysql_error());
					
				}else{
					
				}

				go($site['url'].'/dashboard');
			}
		}
	}
}else{
	// login rejected
	status_message('danger', 'Incorrect Login details');
	go($site['url'].'/index');
}