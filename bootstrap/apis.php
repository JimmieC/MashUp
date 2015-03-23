<?php

function getSongs($title, $artist){
	$apiRequest = ("http://lyrics.wikia.com/api.php?artist=" . urlencode($artist) . "&song=" . urlencode($title) . "&fmt=json");
	$json = file_get_contents($apiRequest);
	$newJson = preg_replace("/\'/",'"',$json);
	$newJson = preg_replace("/song \= /", "", $newJson);
	$lyricsObj = json_decode($newJson);

	if ($lyricsObj->lyrics != "Not found")
		{
			
			return $lyricsObj;
		}
	else
	{
		$lyricsObj = "error";
		return $lyricsObj;
	}
	}
	
	function getVideo($title, $artist){
		
		$artist = str_replace(array('!','@', '$'), '', $artist);
		$title = str_replace(array('!','@', '$'), '', $title);
		echo "https://www.googleapis.com/youtube/v3/search?part=id%20&q=" . urlencode($artist)  . "+" . urlencode($title) . "+music+video%20&type=video%20&maxResults=1&key=AIzaSyD8bBn9-BXDY1Eror03nIg4xBciTfc34yM";
		$apiRequest2 = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=id%20&q=" . urlencode($artist)  . "+" . urlencode($title) . "+music+video%20&type=video%20&maxResults=1&key=AIzaSyD8bBn9-BXDY1Eror03nIg4xBciTfc34yM");
		$videoObj = json_decode($apiRequest2);
		if (!$apiRequest2)
		{
			echo('Error processing query: ');
			exit();
		}
	else
	{
		return $videoObj;
	}
	}
	
	function getArtist($search) {

	$apiRequest3 = file_get_contents("https://api.spotify.com/v1/tracks/" . urlencode($search));
	
	$spotifyObj = json_decode($apiRequest3);


			return $spotifyObj;

	}
?>