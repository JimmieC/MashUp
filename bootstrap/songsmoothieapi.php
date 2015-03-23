  <?php

  				require "apis.php";
  				include("simplehtml/simple_html_dom.php");

               	$newsong = htmlspecialchars($_GET["song"]);
   		
				
 				$query = file_get_contents("https://api.spotify.com/v1/search?query=" . urlencode($newsong) . "&offset=0&limit=1&type=track");
 				$Result = json_decode($query);
	 			
	 			$songname = $Result->tracks->items[0]->name;

	 			$songArtist = $Result->tracks->items[0]->artists[0]->name;
				
				$songvideo = getVideo($Result->tracks->items[0]->name, $Result->tracks->items[0]->artists[0]->name);
				
				$songvideoID = $songvideo->items[0]->id->videoId;
				echo $songvideoID;

				$song = getSongs($Result->tracks->items[0]->name, $Result->tracks->items[0]->artists[0]->name); 
				$url = $song->url;
						$html = file_get_html($url);
	
						$items = $html->find('div[class=lyricbox]');
						$items = $items[0]->outertext;
					

				$arr = array('songname' => $songname, 'artist' => $songArtist, 'youtubeID' => $songvideoID, 'lyrics' => $items);
 				echo json_encode($arr);
 				echo $arr;

                ?>