<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="<?php echo base_url();?>styles/myStyle.css" TYPE="text/css" MEDIA=screen>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<title>Insert title here</title>
<style type="text/css">

.remove {
	display: none; 
}

</style>
	
<script>	
	$(document).ready(function() {
		$("#more").click(function(){
			$(".remove").show();
			$("#more").hide();
		});
	});
</script>
</head>

<body class="user-body">
	
<div>
	<div id="top">
		<p class="title">Memory Game</p>
	</div>
	
	
	<div class="ranking-top">
		<span class="button">
			<a title="Start Game" href="<?php echo base_url();?>index.php/user/main/">
			Back
			</a>
		</span>
		<p class="ranking-title">Memory Game Ranking</p>
	</div>
	<div class="ranking-body">
		<table id="user-ranking">
		<thead>
		<tr>			
			<th>ranking</th>		
			<th>user_name</th>
			<th>game time</th>	
			<th>click_count</th>				
		</tr>
		</thead>
		<tbody>
		<?php 
		$ranking = 1;
		foreach ($rankings as $row)
		{		
				
			if ($ranking <= 50){
				if($ranking%2){echo '<tr>';}
				else{echo '<tr class="odd">';}				
				echo '<td>'.$ranking.'</td>';
				echo '<td>'.$row->user_name.'</td>';
				echo '<td>'.$row->game_time.'</td>';		
				echo '<td>'.$row->click_count.'</td>';						
				echo '</tr>';	
			}
			else{			
				if($ranking%2){echo '<tr class="remove">';}
				else{echo '<tr class="odd remove">';}		
				echo '<td>'.$ranking.'</td>';
				echo '<td>'.$row->user_name.'</td>';
				echo '<td>'.$row->game_time.'</td>';		
				echo '<td>'.$row->click_count.'</td>';						
				echo '</tr>';	
			}
			$ranking ++;
		}
		
		?>
		</tbody>
		</table>
		
		
	</div>
	<div class="ranking-bottom">
		<?php 
		if ($ranking>50){		
			echo '<span class="button">
			<a title="Start Game" href="javascript:" id="more">
			More
			</a>
			</span>';		
		}
		?>
	</div>
</div>



</body>
</html>