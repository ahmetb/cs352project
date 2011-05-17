<?php
include 'inc.php';
include 'view_top.php';
?>

<h2>Fullness Report of Upcoming Flights</h2>
<?php

$res = array();
$sql = "SELECT fs.flight_number, fs.departure_date, fs.sold as sold, p.capacity, fs.sold/p.capacity*100 as fullness  FROM (SELECT f.flight_number, f.departure_date, f.plane, tmp.count as sold FROM flight f LEFT OUTER JOIN ( (SELECT flight_id, COUNT(*) as count from booking GROUP BY flight_id) tmp) ON (tmp.flight_id=f.id) WHERE f.departure_date>NOW() ORDER BY f.departure_date ASC LIMIT 30) fs, plane p where p.id=fs.plane;";
    
$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $res[] = $row;
?>
<table class='data'>
	<tr class='legend'>
		<td width='30%'>Flight Number</td>
		<td witdth='35%'>Departure</td>
		<td witdth='10%'>Capacity</td>
		<td witdth='10%'>Sold</td>
		<td witdth='15%'>Fullness</td>
	</tr>
	<?php foreach($res as $r){?>
	<tr>
		<td width='30%'><?=$r['flight_number']?></td>
		<td width='35%'><?=date("M d Y, H:i", strtotime($r['departure_date']))?></td>
		<td witdth='10%'><?=number_format(intval($r['capacity']))?></td>
		<td witdth='10%'><?=number_format(intval($r['sold']))?></td>
		<td witdth='15%'><?=number_format(intval($r['fullness']))?>%</td>
	</tr>
	<?php }?>
	<?php if (!count($res)){?>
		<tr><td width="100%" colspan='5'>No flights found.</td></tr>
	<?php }?>
</table>

<input type='button' value='&laquo; Back' onclick='window.location="index.php"'/>
<input type='button' onclick='window.print()' value='Print report &raquo;'/>			

<?php include 'view_bottom.php'?>
