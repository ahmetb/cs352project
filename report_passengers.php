<?php
include 'inc.php';
include 'view_top.php';
?>

<h1>Flight Report</h1>
<?php
$flight_id = intval($_POST['flight_id']);
$fd = mysql_query("SELECT r.route_name as name, f.departure_date as date, f.flight_number FROM flight f, route_listing r where f.route=r.id AND f.id=$flight_id", $mysql) or die(mysql_error());
$flight_route = mysql_result($fd, 0, 'name');
$flight_number = mysql_result($fd, 0, 'flight_number');
$flight_date = date("M d Y, H:ia", strtotime(mysql_result($fd, 0, 'date')));

$passengers = array();
$sql = "SELECT b.seat as seat, c.name as customer, b.booking_date as booked_at FROM booking b, customer c WHERE b.customer_id=c.id AND b.flight_id=$flight_id ORDER by b.seat ASC;";
$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $passengers[] = $row;

// Query flight_staff 
$crew = array();
$sql = "SELECT s.name as name, c.role as role FROM flight_crew c, flight_staff s where c.flight_id=$flight_id AND c.staff_id=s.id";
$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $crew[] = $row;

?>
FLIGHT: <?=$flight_number?><br/>
ROUTE: <?=$flight_route?><br/>
DEPARTURE ON: <?=$flight_date?><br/>
<?php foreach($crew as $c){
	echo $c['role'].': '.$c['name'].'<br/>';
}?>
<table class='data'>
	<tr class='legend'>
		<td width='30%'>Seat</td>
		<td witdth='40%'>Passenger</td>
		<td width='30%'>Booking Date</td>
	<?php foreach($passengers as $p){?>
	</tr>
		<td width='30%'><?=$p['seat']?></td>
		<td witdth='40%'><?=$p['customer']?></td>
		<td witdth='30%'><?=date("M d Y,H:ia", strtotime($p['booked_at']))?></td>
	<tr>
	<?php }?>
	<?php if (!count($passengers)){?>
		<tr><td width="100%" colspan='3'>No passengers exist in this flight.</td></tr>
	<?php }?>
</table>

<div class='line'>
	<div class='label'><input type='button' value='&laquo; Back' onclick='history.back(-1)'/></div>
	<div class='field'><input type='button' onclick='window.print()' value='Print report &raquo;'/></div>			
</div>

{}
<?php include 'view_bottom.php'?>