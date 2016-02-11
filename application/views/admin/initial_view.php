<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<title>Insert title here</title>
</head>

<style type="text/css">


	#init{
		background: #eee;
		width : 550px;
		height: 550px;
	}
	form{
		text-align: center;
	}
	input[type="submit"] {
		font-family: 'Yanone Kaffeesatz', arial, serif;
		font-size: 24px;				
		display: block;
		width: auto;
		padding: 5px;
		border: 1px solid #DDD;
		text-align: center;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-o-border-radius: 5px;
		border-radius: 5px;
		background: white;
		background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(white),
			to(#EEE) );
		background: -moz-linear-gradient(0% 90% 90deg, #EEE, white);
		-webkit-transition: all .4s ease-in-out;
		-moz-transition: all .4s ease-in-out;
		-o-transition: all .4s ease-in-out;
		transition: all .4s ease-in-out;
	}
</style>

<body>
<div id="init">
	<h2>Initial this page</h2>
	<form method="post" id="memory_game_form" action="<?php echo base_url();?>index.php/admin/game/initial">
		<input type="hidden" name="initial" value="true">	
		<input type="hidden" name="page_id" value=<?php echo "$page_id" ?>>	
		<input type="submit" value="initial">
	</form>
</div>

</body>
</html>