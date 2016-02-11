<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>JQuery Memory Game</title>
<LINK REL=StyleSheet HREF="<?php echo base_url();?>styles/game.css"
	TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="<?php echo base_url();?>styles/myStyle.css"
	TYPE="text/css" MEDIA=screen>
<script type="text/javascript"
	src="<?php echo base_url();?>js/jquery-1.5.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url();?>js/game/memory_game.js"></script>
<script type="text/javascript"
	src="<?php echo base_url();?>js/player/jquery.jmp3.js"></script>
<script type="text/javascript">
            $(document).ready(function() {
                $('#memeory_game').memory({
                    
                });                              
            });        
        </script>
</head>
<body class="user-body">
	<div>
		<div id="top">
			<p class="title">Memory Game</p>
		</div>		
		
		
		
		<div id="boxbutton">
			<span class="button">
				<a title="Start Game" href="<?php echo base_url();?>index.php/user/main/">
				Back
				</a>
			</span>			
			<span id="sound" class="mp3" ></span>
			<span class="link"> 
				<span id="count">0</span> Click 
			</span> &nbsp; 
			
			<input type='text' id='disp' /> 
			<a href="javascript:" class="link" id="reset">Reset</a>
		</div>
			
		<div id="memeory_game">
			<div id="boxcard">
			<?php
			$count = 0;
			foreach ($images_data as $row)
			{
				//if($count==1) break;
				echo '<div id="card1_'.$row->image_id.'"><img src="'.$row->src.'" /></div>';
				echo '<div id="card2_'.$row->image_id.'"><img src="'.$row->src.'" /></div>';
				$count++;
			}
			?>
			</div>
		</div>
		
		<div id="page_info">
			<input type="hidden" id="game_id" value="<?php echo $game_id; ?>"> <input
				type="hidden" id="found_count" value="<?php echo $found_count; ?>">
			<input type="hidden" id="game_real_time" value=""> <input
				type="hidden" id="game_time" value=""> <input type="hidden"
				id="user_id" value="<?php echo $user_data['user_id']; ?>"> <input
				type="hidden" id="user_fb_id"
				value="<?php echo $user_data['user_fb_id']; ?>"> <input
				type="hidden" id="user_name"
				value="<?php echo $user_data['user_name']; ?>">
		</div>
		<form style="display: none" id="result_form" method="post"
			action="<?php echo base_url();?>index.php/user/ranking/end">
			<input type="text" name="count" value="test"> <input type="text"
				name="game_id" value="<?php echo $game_id; ?>"> <input type="text"
				name="game_time" value="test"> <input type="text"
				name="game_real_time" value="test"> <input type="submit" value="go">
		</form>
	</div>
</body>
</html>
