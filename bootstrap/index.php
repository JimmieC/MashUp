<!DOCTYPE html>
<html lang="en">

<head>



	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



	<script>
		function showResult(str) {
		// code for the live-search drop-down function
  		if (str.length==0) { 
    		document.getElementById("livesearch").innerHTML="";
    		document.getElementById("livesearch").style.border="0px";
    	return;
  		}
  		if (window.XMLHttpRequest) {
    	// code for IE7+, Firefox, Chrome, Opera, Safari
    	xmlhttp=new XMLHttpRequest();
  		} else {  // code for IE6, IE5
    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
  			xmlhttp.onreadystatechange=function() {
    	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      		document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
      		document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    		}
  		}
  			xmlhttp.open("GET","livesearch.php?q="+str,true);
  			xmlhttp.send();
		}
	</script>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Songsmoothie</title>

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

    <!-- Search section -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                	<h1 class="brand-heading">SongSmoothie</h1>
                    	<div class="col-md-8 col-md-offset-2">
                        	<div id="searchForm">
                                <form>
									<input type="text"  size="30" onkeyup="showResult(this.value)" placeholder="Search for song or artist here">
										<div id="livesearch">
										</div>

                                    		<script type="text/javascript"> 
                                    			// code for starting live-search
												function stopRKey(evt) { 
                                      				var evt = (evt) ? evt : ((event) ? event : null); 
                                     				var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
                                 				if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
                                    			} 

                            						document.onkeypress = stopRKey; 

                                			</script>
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
                		// code for retriving YouTube video and showing error message if not available
                		if(isset($_GET['song'])){
                    		$newSong = htmlspecialchars($_GET["song"]);
							$Result = getArtist($newSong);
 						if ($Result != "error"){
							$video = getVideo($Result->name, $Result->artists[0]->name);
							$song = getSongs($Result->name, $Result->artists[0]->name); 
						echo '<iframe id="ytplayer" type="text/html" width="640" height="390"
 						src="http://www.youtube.com/embed/' . $video->items[0]->id->videoId . '?autoplay=1&origin=http://example.com"
 						frameborder="0"></iframe>';

 					
 						if($song != "error"){
							$url = $song->url;
							$html = file_get_html($url);
	
							$items = $html->find('div[class=lyricbox]');
							$items = $items[0]->outertext;
 						}

   					
						}
						else {
							$song = "error";
						echo "ERRORS : SONG NOT FOUND";
						}
	
						}
	
                ?>
				
			<div style="height:250px;
				width:695px;
				font-size:26px;
				overflow:auto;
				font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;" class="lyricsbox" value="lyricsbox" id="lyricsbox">

				<?php 
                    //Code for putting in the lyrics of the song. Check if there is an error otherwise echo them
					if(isset($_GET['song'])){
					if($song != "error"){
						echo $items;
					}
					elseif ($Result != "error"){
 						echo "Video found but no lyrics for it";
 					}
 					else
 					{
 					}	
					}	
				 ?>
			</div>
      			
   
	

            </div>
        </div>
    </section>

    <!-- Download/buy link Section -->
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

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>


</body>

</html>
