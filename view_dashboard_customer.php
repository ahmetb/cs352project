<?php
// Query airports.
$cities = array();
$results = mysql_query('SELECT c.id,c.name FROM city c ORDER BY c.name', $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results)) {
	$res = null;
	$cities[] = $row;
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
						<?php foreach($cities as $city){?>
							<option
							<?php if($_POST['departure']==$city['id']) echo ' selected="selected" ';?>
							value='<?=$city['id']?>'> <?=$city['name']?> </option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>To</div>
				<div class='field'>
					<select name='destination' id='destination'>
						<?php foreach($cities as $city){?>
							<option
							<?php if($_POST['destination']==$city['id']) echo ' selected="selected" ';?>
							value='<?=$city['id']?>'> <?=$city['name']?> </option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Departure between </div>
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
					<?php for($i=intval(date("Y"));$i<intval(date("Y"))+3;$i++){
						echo "<option ";
						if(intval(date("Y"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>and </div>
				<div class='field'>
					<select name='month2' id='add_month2'>
					<?php for($i=1;$i<=12;$i++){
						echo "<option ";
						if(intval(date("m", time()+3*24*60*60))==$i) echo "selected='selected' ";
						echo "value='$i'>".date("M", mktime(0,0,0,$i))."</option>\n";}?>
					</select> / 
					<select name='day2' id='add_day2'>
					<?php for($i=1;$i<=31;$i++){
						echo "<option ";
						if(intval(date("d", time()+3*24*60*60))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select> /
					<select name='year2' id='add_year2'>
					<?php for($i=intval(date("Y", time()+3*24*60*60));$i<intval(date("Y", time()+3*24*60*60))+3;$i++){
						echo "<option ";
						if(intval(date("Y", time()+3*24*60*60))==$i) echo "selected='selected' ";
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
