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
		
		<?php
		if ($ranking_data->save_status){
			echo '<p>You are get the new record</p>';
		}
		else {
			echo '<p>You are Record</p>';
		}		
		
		?>
		<div class="rankingend-body">
			<table>
			<thead>
				<tr>		
					<th>Name</th>					
					<th>Time</th>
					<th>Click Count</th>								
				</tr>
			</thead>
			
			<tbody>
				<tr>							
					<th><?php echo $ranking_data->user_name;?></th>					
					<th><?php echo $ranking_data->game_time;?></th>
					<th><?php echo $ranking_data->click_count;?></th>								
				</tr>
			</tbody>
			</table>
		</div>
		<div class="main_bottom">
			<span class="button">
				<a title="ReTry Game" href="<?php echo base_url();?>index.php/user/game">
				ReTry
				</a>
			</span>
			<span class="button">
				<a title="Main" href="<?php echo base_url();?>index.php/user/main">
				Main
				</a>
			</span>	
		</div>
	</div>
</body>
</html>
