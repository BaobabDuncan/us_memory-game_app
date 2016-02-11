<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="<?php echo base_url();?>styles/myStyle.css" TYPE="text/css" MEDIA=screen>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<title>Insert title here</title>
</head>

<body>
<?
	include "layout/top_menu.php";
?>
<div>
<br>
<?php 
	if(!$games){
		echo "You Don't have game";
	} 
	else{
		echo '<table id="game_list">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col">id</th>';
		echo '<th>active</th>';
		echo '<th>title</th>';		
		echo '<th>level</th>';
		echo '<th>Ranking</th>';
		echo '<th>Detail</th>';
		echo '<th>Delete</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		$count = 0;
		foreach ($games as $row)
		{
			if($count%2){echo '<tr>';}
			else{echo '<tr class="odd">';}			
			echo '<td>'.$row->game_id.'</td>';
			echo '<td>'.$row->active.'</td>';
			echo '<td>'.$row->title.'</td>';			
			echo '<td>'.$row->level.'</td>';
			echo '<td><a href="'.base_url().'index.php/admin/ranking?game_id='.$row->game_id.'">Ranking</a></td>';
			echo '<td><a href="'.base_url().'index.php/admin/game/edit?game_id='.$row->game_id.'">Detail</a></td>';
			echo '<td><a href="'.base_url().'index.php/admin/game/delete?game_id='.$row->game_id.'">Delete</a></td>';
			echo '</tr>';
			$count++;
		}
		echo '</tbody>';
		echo '</table>';
	}
	?>
</div>


</body>
<script>	
    $(document).ready(function() {
    	$("#menu li:nth-child(3) a").addClass("current");
    });    
</script>
</html>