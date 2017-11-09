<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Feed the Snake v 1.1 beta</title>
<link rel="stylesheet" href="style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="snakegame.js"></script>
</head>
<body>

<canvas width="800" height="500" id="canvas" style="border:1px solid #333;" onclick="snake.game.begin();">
</canvas>

<!--<div id="highscore">
	<div style="font-size:24px;">
	Global highscore
	</div>
	<div style="font-size:24px;">
	<br>
	player45 : 110
	<br>
	anotherplayer : 40
	<br>
	crap_player : 10
	<br>
	</div>
</div>-->
<div id="controls">
	<input type="button" id="pause" value="Play" onClick="snake.game.pause(this);" accesskey="p">
	<input type="button" id="restart" value="Restart" onClick="snake.game.restart();">
	<input type="button" id="post" value="Submit" onClick="snake.game.post();">
	<div id ="result">
	<?php
		//require_once ("test.php");
	?>
	</div>
	<br/><br/>
	<div style="font-size:24px;">
	Score :
	<span id="scoreboard">0</span>
	</div>
</div>

</body>
</html>
