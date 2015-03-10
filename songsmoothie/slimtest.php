

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SongSmoothie</title>
</head>
<body>
<h1><a href="/">Song Smoothie</a></h1>
<form action="" method="GET">
    <input type="text" name="song" placeholder="Movie title...">
    <input type="submit" value="Show me some tunes">    
</form>

<?php
/*require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->get('/hello/:name', function ($name) {
    echo "Hello, there  $name";
});
$app->run();
*/
/*

*/

require "apis.php";
include("simplehtml/simple_html_dom.php");
if(isset($_GET['song'])){
	$newSong = htmlspecialchars($_GET["song"]);
    $song = getSongs($newSong); 
	$video = getVideo($newSong);
    echo "<p>" . "Artist: " . $song->artist . "</p>";
	echo "<p>" . "Title: " . $song->song . "</p>";
	
	$url = $song->url;
	$html = file_get_html($url);
	
	$items = $html->find('div[class=lyricbox]');
	$items = $items[0]->outertext;
	echo "<p>" . $items . "</p>";
	
}
?>

<iframe id="ytplayer" type="text/html" width="640" height="390"
  src="http://www.youtube.com/embed/<?php echo $video->items[0]->id->videoId; ?>?autoplay=1&origin=http://example.com"
  frameborder="0"/>

</body>
</html>


