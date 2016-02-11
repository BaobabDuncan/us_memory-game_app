<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="<?php echo base_url();?>styles/myStyle.css" TYPE="text/css" MEDIA=screen>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<title>Insert title here</title>
</head>

<body class="user-body">	
	<div>
		<div id="top">
			<p class="title">Memory Game</p>
		</div>
	
		<div id="main-body">
			<p class="game-title"><?php echo $game_data->title ?></p>
			<p class="game-detail"><?php echo $game_data->detail ?></p>
			<img src="<?php echo base_url();?>styles/images/game_main.png">
		</div>
		
		
		
		
		
		
		
		

		<div class="main_bottom">
			<span class="button">
				<a title="Start Game" href="<?php echo base_url();?>index.php/user/game">
				Start
				</a>
			</span>
			<span class="button">
				<a title="Ranking" href="<?php echo base_url();?>index.php/user/ranking">
				Ranking
				</a>
			</span>	
		</div>

	
	</div> 

</body>
</html>