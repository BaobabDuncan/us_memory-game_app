<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="<?php echo base_url();?>styles/myStyle.css" TYPE="text/css" MEDIA=screen>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<title>Created</title>
</head>

<body>
<?
include "layout/top_menu.php";
?>
<br><br>
<div>
<form method="post" id="memory_game_form" action="<?php echo base_url();?>index.php/admin/game/edit">
	<fieldset>
	<legend>Game Infomation</legend>

	<?php 
	foreach ($games as $row)
	{	
		echo '<input type="hidden" name="game_id" value="'.$row->game_id.'">';		
		
		echo '<div class="fm-req">';
		echo '<label>Title</label>';
		echo '<input type="text" maxlength="25" name="title" value="'.$row->title.'">';
		echo '</div>';
		
		echo '<div class="fm-req">';
		echo '<label>Detail</label>';
		echo '<textarea name="detail" cols="10" rows="5" maxlength="500">'.$row->detail.'</textarea>';
		echo '</div>';
		
		echo '<div class="">';
		echo '<label>Message</label>';
		echo '<input type="text" name="feed_message" maxlength="50" value="'.$row->feed_message.'">';
		echo '</div>';
		
		echo '<div class="">';
		echo '<label>Count</label>';
		echo '<p>'.$row->join_count.'</p>';
		echo '</div>';
		
		echo '<div class="">';
		echo '<label>Level</label>';
		echo '<p>'.$row->level.'</p>';
		echo '</div>';
		
		
			
		
		echo '<div class="">';
		echo '<label>Page</label>';
		if(!$row->page_id){			
			if($page_data){
				echo '<select name="page_id">';
				foreach ($page_data as $row){
					echo '<option value="'.$row->page_id.'">'.$row->page_title.'</option>';	
				}
				echo '</select>'; 
			}
		}
		else{
			echo '<p>'.$row->page_id.'</p>';	
			echo '<input type="hidden" name="page_id" value="'.$row->page_id.'">';
		}
		echo '</div>';
	}
	?> 
	</fieldset>
	<div id="fm-submit" class="fm-req">
		<input type="submit" value="Edit">
	</div>	
</div>

</body>
<script>	
    $(document).ready(function() {
    	$("#menu li:nth-child(3) a").addClass("current");
    });    
</script>
</html>
