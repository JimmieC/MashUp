<?php


//Hämtar q parameter från URL:et
	$q=$_GET["q"];

	//Bygga API request länken med parameter q insatt och get contents
	$apiRequest3 = file_get_contents("https://api.spotify.com/v1/search?query=" . urlencode($q) . "&offset=0&limit=5&type=track");
	
	//Json decode på den objekten
	$spotifyObj = json_decode($apiRequest3);

	//Variabel att innehålla antalet returade resultatet i spotifyObj
	$count = count($spotifyObj->tracks->items);
		
		//For loop för antalet count, få ut en trackname och artist, sen bygga en href med trackID, och visa låtnamn och artist. 
		for($i=0; $i<($count); $i++) {
			$trackname = $spotifyObj->tracks->items[$i]->name;
			$artistname = urlencode($spotifyObj->tracks->items[$i]->artists[0]->name);
				
			echo '<a href=index.php?song=' . urldecode($spotifyObj->tracks->items[$i]->id) . '>' . $spotifyObj->tracks->items[$i]->name . " - " . $spotifyObj->tracks->items[$i]->artists[0]->name . "<br/>"; 
		}


	

?>