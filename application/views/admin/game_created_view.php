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
<form method="post" id="memory_game_form" action="<?php echo base_url();?>index.php/admin/game/created">
	<fieldset>
	<legend>Game Infomation</legend>
	<div class="fm-req">
		<label>Title</label>
		<input type="text" maxlength="25" name="title" value="event title">
	</div>
	<div class="fm-req">
		<label>Detail</label>
		<textarea name="detail" cols="10" rows="5" maxlength="500"></textarea>
		
	</div>
	<div class="">
		<label>Message</label>
		<input type="text" maxlength="50" name="feed_message" value="feed_message"> 
	</div>
	<div class="fm-req">
	<label>Level</label>
	<?php 	
	if($level_data){
		echo '<select name="level">';
		foreach ($level_data as $k=>$v){
			echo '<option value="'.$k.'">'.$v.'</option>';	
		}
		echo '</select>'; 
	}
	?>
	</div>
	<div class="">
	
	<?php 
	if($page_data){
		echo '<label>Page</label>';
		echo '<select name="page_id">';
		foreach ($page_data as $row){
			echo '<option value="'.$row->page_id.'">'.$row->page_id.'</option>';	
		}
		echo '</select>'; 
	}
	?>
	</div>
	</fieldset>
	<div id="fm-submit" class="fm-req">
		<input type="submit" value="created">
	</div>
</form>
</div>

</body>
<script>	
    $(document).ready(function() {
    	$("#menu li:nth-child(2) a").addClass("current");
    });    
</script>
</html>
