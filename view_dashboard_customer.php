<?php
// Query airports.
$airports = array();
$results = mysql_query('SELECT a.id,a.name,a.code,c.name as city FROM airport a,city c WHERE a.city=c.id ORDER BY c.name', $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results)) {
	$res = null;
	$airports[] = $row;
}
?>
<div id='create'>
	<form method='post' action='search.php?act=form'>
		<fieldset>
			<legend>Online Ticket Reservation</legend>
			<?php if($error){?><div class='line error'><?=$error?></div><?php }?>
			<div class='line'>
				<div class='label'>From</div>
				<div class='field'>
					<select name='departure' id='departure'>
						<?php foreach($airports as $airport){?>
							<option
							<?php if($_POST['departure']==$airport['id']) echo ' selected="selected" ';?>
							value='<?=$airport['id']?>'><?=$airport['city']?> <?=$airport['name']?> (<?=$airport['code']?>)</option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>To</div>
				<div class='field'>
					<select name='destination' id='destination'>
						<?php foreach($airports as $airport){?>
							<option
							<?php if($_POST['destination']==$airport['id']) echo ' selected="selected" ';?> value='<?=$airport['id']?>'><?=$airport['city']?> <?=$airport['name']?> (<?=$airport['code']?>)</option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Departure Date </div>
				<div class='field'>
					<select name='month' id='add_month'>
					<?php for($i=1;$i<=12;$i++){
						echo "<option ";
						if(intval(date("m")==$i)) echo "selected='selected' ";
						echo "value='$i'>".date("M", mktime(0,0,0,$i))."</option>\n";}?>
					</select> / 
					<select name='day' id='add_day'>
					<?php for($i=1;$i<=31;$i++){
						echo "<option ";
						if(intval(date("d"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select> /
					<select name='year' id='add_year'>
					<?php for($i=intval(date("Y"));$i>1990;$i--){
						echo "<option ";
						if(intval(date("Y"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>
					&nbsp;
				</div>
				<div class='field'><input type='submit' value='Continue &raquo;'/></div>			
			</div>
			
			<div class='line'>
				<div class='label'>
					&nbsp;
				</div>
				<div class='field'><a href='search.php?act=upcoming'>Upcoming flights</a></div>			
			</div>
	</fieldset>
</div>