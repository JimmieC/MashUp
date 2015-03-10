<?php

function getSongs($title){

	$apiRequest = ("http://lyrics.wikia.com/api.php?artist=queen&song=" . urlencode($title) . "&fmt=json");
	$json = file_get_contents($apiRequest);
	$newJson = preg_replace("/\'/",'"',$json);
	$newJson = preg_replace("/song \= /", "", $newJson);
	$lyricsObj = json_decode($newJson);
	return $lyricsObj;
	}
	
	function getVideo($video){
		$apiRequest2 = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=id%20&q=queen+" . urlencode($video) . "+music+video%20&type=video%20&maxResults=1&key=AIzaSyD8bBn9-BXDY1Eror03nIg4xBciTfc34yM");
		$videoObj = json_decode($apiRequest2);
		return $videoObj;
	}
	
?>