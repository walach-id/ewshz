<?php

	$title = "Ini judul";
	$message = "Yo Bikri";
	$icon = "https://yourwebsite.com/icon.png";
	$url = "https://yourwebsite.com/";
	
	$apiKey = "3bcac3786531e574a284f49c78807bbc";

	$curlUrl = "https://api.pushalert.co/rest/v1/send";

	//POST variables
	$post_vars = array(
		"icon" => $icon,
		"title" => $title,
		"message" => $message,
		"url" => $url
	);

	$headers = Array();
	$headers[] = "Authorization: api_key=".$apiKey;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $curlUrl);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_vars));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);

	$output = json_decode($result, true);
	if($output["success"]) {
		echo $output["id"]; //Sent Notification ID
	}
	else {
		//Others like bad request
	}
?>