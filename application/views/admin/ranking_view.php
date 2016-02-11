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
<br>
<div>
	<?php 
	if (!$rankings){
		echo 'Not yet';
	}
	else{
		echo '<table id="game_list">';
		echo '<thead>';
		echo '<tr>';		
		echo '<th>ranking</th>';		
		echo '<th>user_name</th>';
		echo '<th>game time</th>';
		echo '<th>click_count</th>';		
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';

		$ranking = 1;
		foreach ($rankings as $row)
		{
			if($ranking%2){echo '<tr>';}
			else{echo '<tr class="odd">';}			
			echo '<tr>';		
			echo '<td>'.$ranking.'</td>';	
			echo '<td>'.$row->user_name.'</td>';
			echo '<td>'.$row->game_time.'</td>';
			echo '<td>'.$row->click_count.'</td>';			
			echo '</tr>';
			$ranking ++;
		}

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