<?php
include 'inc.php';
include 'view_top.php';
?>

<h2>Average Staff Salary Report</h2>
<?php

$res = array();
$sql = "SELECT * from ((SELECT type AS type, AVG(salary) as salary FROM ground_staff g GROUP BY type) UNION (SELECT type AS type, AVG(salary) as salary FROM flight_staff f GROUP BY type)) r ORDER BY r.salary DESC";

$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $res[] = $row;
?>
<table class='data'>
	<tr class='legend'>
		<td width='40%'>Staff Type</td>
		<td witdth='60%'>Salary</td>
	</tr>
	<?php foreach($res as $r){?>
	<tr>
		<td width='40%'><?=$r['type']?></td>
		<td witdth='60%'>$ <?=number_format($r['salary'])?></td>
	</tr>
	<?php }?>
</table>

<input type='button' value='&laquo; Back' onclick='window.location="index.php"'/>
<input type='button' onclick='window.print()' value='Print report &raquo;'/>			

<?php include 'view_bottom.php'?>