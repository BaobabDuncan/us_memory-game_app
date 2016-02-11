<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

</style>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/player/jquery.jmp3.js"></script>


 <style>
      #jquery_jplayer {
         display:none; /* Kills jPlayer when using Flash */
      }
   </style>
<script>


$(document).ready(function() {
//$(".test").jmp3();
	// custom options
	$("#sound").jmp3({
		autoplay:true,
		filename:'start.mp3'
	});
	//$("#sound").hide();
	//alert(1);
	/*var audioElement = document.getElementById('audioPlay');
	audioElement.setAttribute('src', 'http://192.168.0.4/memory_game/midia/start.mp3');
	audioElement.play();*/
});
/*var audioElement = document.getElementById('audioPlay');
		audioElement.setAttribute('src', './sounds/'+fileName+'');
		audioElement.play();*/
</script>


</head>
<body>
<span id="sound" class="mp3"></span>

<div id="mysong"></div>

<audio preload="auto" id="audioPlay">
			<!-- autoplay="autoplay" -->
			Your browser does not support the audio element.
</audio>
<h1>Welcome to CodeIgniter!</h1>

<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

<p>If you would like to edit this page you'll find it located at:</p>
<code>application/views/welcome_message.php</code>

<p>The corresponding controller for this page is found at:</p>
<code>application/controllers/welcome.php</code>

<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>


<p><br />Page rendered in {elapsed_time} seconds</p>
<a href="index.php/admin/index">Admin</a>
<a href="index.php/user/main">User</a>
</body>
</html>