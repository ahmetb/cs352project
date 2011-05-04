<h2>Search Results</h2>
<p><?=$search_str?></p>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>
<form method='POST' action='book.php?action=form'>
	<table class='data'>
		<tr class='legend'>
			<td width='20%'>Flight No.</td>	
			<td width='30%'>Date</td>
			<td width='15%'>Departure</td>
			<td width='15%'>Arrival</td>	
			<td width='10%'>Fee</td>		
			<td width='20%'>Operations</td>		
		</tr>	
	<?php 
	foreach($flights as $result){?>
		<tr>
			<td width='20%'><?=$result['flight_number']?></td>
			<td width='30%'><?=date("M d,Y H:ia", strtotime($result['departure_date']))?></td>
			<td width='15%'><?=$result['dcode']?></td>
			<td width='15%'><?=$result['acode']?></td>
			<td width='10%'>$<?=number_format($result['fare'])?></td>
			<td width='20%'>
				<input type="radio" name="flight_id" value="<?=$result['id']?>" /> Buy
			</td>
		</tr>
	<?php }?>
	</table>

	<div class='line' style='text-align:right;'>
		<input type='submit' value='Continue &raquo;'/>
	</div>
</form>

<ul>
<?php foreach($airports as $abbr=>$ext){?>
	<li><?=$abbr?>: <?=$ext?></li>
<?php }?>
<ul>