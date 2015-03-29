<?php

//Funktion att hämta lyrics från LyricsWikia API, den har en imparameter av title och artist
function getSongs($title, $artist){
	//Gör apiRequest variabel till länken och sätter in values från metod parameter.
	$apiRequest = ("http://lyrics.wikia.com/api.php?artist=" . urlencode($artist) . "&song=" . urlencode($title) . "&fmt=json");
	
	//Gör variabel json till det man få tillbaks från metoden file_get_contents med input av apiRequest
	$json = file_get_contents($apiRequest);
	
	//Lite pregreplace att fixa till det svaret man får ifrån lyricsWikia eftersom den behövdes '' istället för "". Sen tar bor song = som är i början
	$newJson = preg_replace("/\'/",'"',$json);
	$newJson = preg_replace("/song \= /", "", $newJson);
	
	//N när den är giltig kör json Decode att kunna komma ått informationen i den nya objekten 
	$lyricsObj = json_decode($newJson);

	//If sats för felhantering, sen returnera objekten från API:et
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
	


	//Funktion att hämta video id från YouTubes API, den har en imparameter av title och artist
	function getVideo($title, $artist){
		
	//Replace ogiltiga symboler från resultatet artist och title. 	
	$artist = str_replace(array('!','@', '$'), '', $artist);
	$title = str_replace(array('!','@', '$'), '', $title);
	
	//Skapa länk i variabel och kör file getcontents på det
	$apiRequest2 = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=id%20&q=" . urlencode($artist)  . "+" . urlencode($title) . "+music+video%20&type=video%20&maxResults=1&key=AIzaSyD8bBn9-BXDY1Eror03nIg4xBciTfc34yM");
	$videoObj = json_decode($apiRequest2);

	//Fel hantering och sen retura objecten videoObj
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
	
	//Funktion att hämta en låt från Spoitfys API, inparameter är en trackID
	function getArtist($search) {

	$apiRequest3 = file_get_contents("https://api.spotify.com/v1/tracks/" . urlencode($search));
	
	$spotifyObj = json_decode($apiRequest3);

	//Returnera objeckten från getcontents som är decodad. 
	return $spotifyObj;

	}
?>