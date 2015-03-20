<!DOCTYPE html>
<html lang="en">

<head>


<link type="text/css" href="style/jquery.jscrollpane.css" rel="stylesheet" media="all" />

<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript" src="script/jquery.mousewheel.js"></script>

<!-- the jScrollPane script -->
<script type="text/javascript" src="script/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>


	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Grayscale - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">



    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">Search</span> SongSmoothie
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Result</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="#download">Download/buy</a>
                    </li>

                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">SongSmoothie</h1>
                            <div id="searchForm">
									<form action="" method="GET">
                                <input type="text" name="song" placeholder="Song title or artist"/>
                                    
                                <input id="sendinfo" type="submit" class="btn btn-default" value="Search" />
                                  </form>
								<script type="text/javascript">
						$(document).ready(function () {
						if(window.location.href.indexOf("song") > -1) {
							$('html, body').animate({
							scrollTop: $("#about").offset().top
							}, 2000);
						}
						});
</script>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Result Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <?php

                require "apis.php";
                include("simplehtml/simple_html_dom.php");
                if(isset($_GET['song'])){
                    $newSong = htmlspecialchars($_GET["song"]);
   
				$video = getVideo($newSong);
 
	
				}
	$Result = getArtist($newSong);
	 $song = getSongs($Result->tracks->items[0]->name, $Result->tracks->items[0]->artists[0]->name); 
	echo '<iframe id="ytplayer" type="text/html" width="640" height="390"
  src="http://www.youtube.com/embed/' . $video->items[0]->id->videoId . '?autoplay=1&origin=http://example.com"
  frameborder="0"></iframe>';

    echo "<p>" . "Artist: " . $song->artist . "</p>";
	echo "<p>" . "Title: " . $song->song . "</p>";
	
	$url = $song->url;
	$html = file_get_html($url);
	
	$items = $html->find('div[class=lyricbox]');
	$items = $items[0]->outertext;

                ?>
				<script> $(function() { $('.scroll-pane').jScrollPane(); });</script>
				<div class="scroll-pane jspScrollable" style="overflow: hidden; padding: 0px; width: 760px;" tabindex="0">
					<div class="jspContainer" style="width: 760px; height: 200px;">
						<div class="jspPane" style="padding: 0px; width: 740px; top: 0px;">
				<?php echo $items ?>
				</div>
				<div class="jspVerticalBar">
				<div class="jspCap jspCapTop"></div>
				<div class="jspTrack" style="height: 200px;"><div class="jspDrag" style="height: 73px; top: 0px;"><div class="jspDragTop"></div><div class="jspDragBottom"></div></div></div>
				<div class="jspCap jspCapBottom"></div>
				</div>
				</div>
				</div>
				

            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Buy song on CDON</h2>
                    <p>You can download the song or get your own copy on CDON.</p>
                    <a href="http://www.cdon.se/musik" class="btn btn-default btn-lg">Visit store</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact SongSmoothie</h2>
                <p>Feel free to email us to provide some feedback on our mash-up, give us suggestions for new designs and API:s, or to just say hello!</p>
                <p><a href="mailto:songsmoothie@gmail.com">songsmoothie@gmail.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    
                    <li>
                        <a href="https://github.com/jimmiec/mashup" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </section>

  
    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; SongSmoothie 2015</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
