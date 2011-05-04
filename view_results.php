<h2>Search Results</h2>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

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
			Select
		</td>
	</tr>
<?php }?>
</table>
<div class='line'>
	<div class='label'><input type='button' id='cancel' onclick="history.back(-1)" value='&laquo; Go Back'/></div>
	<div class='field'><input type='submit' value='Continue &raquo;'/></div>			
</div>

<ul>
<?php foreach($airports as $abbr=>$ext){?>
	<li><?=$abbr?>: <?=$ext?></li>
<?php }?>
<ul>