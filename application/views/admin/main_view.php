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
<br><br><br>
<div>
1. Create game
2. add page
3. edit game
4. saw ranking
</div>



</body>
<script>	
    $(document).ready(function() {
    	$("#menu li:nth-child(1) a").addClass("current");
    });    
</script>
</html>