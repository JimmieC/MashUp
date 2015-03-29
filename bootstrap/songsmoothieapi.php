<?php


  	//Vårt API som använda sig
  	require "apis.php";
  	include("simplehtml/simple_html_dom.php");

  	//Hämta parameter från URL
    $newsong = htmlspecialchars($_GET["song"]);
   		
	//Kör spotify API med newSong variabel
 	$query = file_get_contents("https://api.spotify.com/v1/search?query=" . urlencode($newsong) . "&offset=0&limit=1&type=track");
 	$Result = json_decode($query);
	 			
	//Få ut låt namn och artist
	$songname = $Result->tracks->items[0]->name;
	$songArtist = $Result->tracks->items[0]->artists[0]->name;
				
	 //Kör apis funktion getVideo med inparameter från resultat, gör songvideoID till songvideos ID
	$songvideo = getVideo($Result->tracks->items[0]->name, $Result->tracks->items[0]->artists[0]->name);
	$songvideoID = $songvideo->items[0]->id->videoId;
	
	//Hämta länken från lyricsWikia genom deras API. Inparameter fån Result
	$song = getSongs($Result->tracks->items[0]->name, $Result->tracks->items[0]->artists[0]->name); 

	//Bygga en array med det vi vill ger i vårt API, sen retunera en JSON fromat av arrayn
	$arr = array('songname' => $songname, 'artist' => $songArtist, 'youtubeID' => $songvideoID, 'lyrics' =>$song->url);
 	echo json_encode($arr);

?>