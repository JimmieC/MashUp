<?php


//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
$apiRequest3 = file_get_contents("https://api.spotify.com/v1/search?query=" . urlencode($q) . "&offset=0&limit=5&type=track");
	
	$spotifyObj = json_decode($apiRequest3);

			$count = count($spotifyObj->tracks->items);
			for($i=0; $i<($count); $i++) {
				$trackname = $spotifyObj->tracks->items[$i]->name;
				$artistname = urlencode($spotifyObj->tracks->items[$i]->artists[0]->name);
				

				echo '<a href=/bootstrap/index.php?song=' . urldecode($spotifyObj->tracks->items[$i]->id) . '>' . $spotifyObj->tracks->items[$i]->name . " - " . $spotifyObj->tracks->items[$i]->artists[0]->name . "<br/>"; 
		}


	

?>