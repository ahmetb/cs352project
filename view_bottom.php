</div>
	<div id="logout"><?php
	if ($_SESSION['login']){
	?><?=$_SESSION['username']?><br/><small><a href='logout.php'>Logout &raquo;</a></small>
	<?php } else {?>
		<a href='index.php'>Login</a>
	<?php }?>
	</div>
</div>
</body>
</html>
<?if($mysql) mysql_close($mysql)?>