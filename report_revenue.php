<?php
include 'inc.php';
include 'view_top.php';
?>

<h2>Monthly Revenue of Company Report</h2>
<?php

$res = array();
$sql = "SELECT sell.year, sell.month, sell.sold as sellings, gs.total+fs.total as salaries,
sell.sold-gs.total-fs.total as revenue FROM (SELECT SUM(amount) as sold, MONTH(date) as month, YEAR(date) as year FROM payment GROUP BY MONTH(date), YEAR(date)) sell,  (SELECT SUM(salary) AS total FROM ground_staff) gs, (SELECT SUM(salary) AS total FROM flight_staff) fs ORDER BY sell.year DESC, sell.month ASC;";

$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $res[] = $row;
?>
<table class='data'>
	<tr class='legend'>
		<td width='25%'>Month</td>
		<td witdth='25%'>Salaries</td>
		<td witdth='25%'>Sellings</td>
		<td witdth='25%'>Revenue</td>
	</tr>
	<?php foreach($res as $r){?>
	<tr>
		<td width='25%'><?=date("M Y",
		mktime(1,1,1,intval($r['month']), 1, intval($r['year']) )
		);?></td>
		<td witdth='25%'>$<?=number_format($r['salaries'])?></td>
		<td witdth='25%'>$<?=number_format($r['sellings'])?></td>
		<td witdth='25%'>$<?=number_format($r['revenue'])?></td>
	</tr>
	<?php }?>
	<?php if (!count($res)){?>
		<tr><td width="100%" colspan='6'>No tickets sold, therefore no revenue summary are shown.</td></tr>
	<?php }?>
</table>

<input type='button' value='&laquo; Back' onclick='window.location="index.php"'/>
<input type='button' onclick='window.print()' value='Print report &raquo;'/>			

<?php include 'view_bottom.php'?>