<?php require_once dirname( __FILE__ ) . '/header.php'; ?>

<div style="text-align:center"><h3 class="booking_h3">Manage Flight Bookings</h3></div>
<table class="gridtable">
<tr>
	<th>Flight Name</th><th>Instructor</th><th>Date</th><th>Time From</th><th>Time To</th><th>Amount</th><th>Actions</th>
</tr>
<?php 
$rows = $wpdb -> get_results("select booking_flight_exp.*,booking_flight_instructors.instructor_name,booking_flights.flight_name from booking_flight_exp INNER JOIN booking_flights ON booking_flights.id = booking_flight_exp.flight INNER JOIN booking_flight_instructors ON booking_flight_instructors.id = booking_flight_exp.instructor");
foreach($rows as $key=>$row){
?>
<tr>
	<td><?php echo $row->flight_name;?></td><td><?php echo $row->instructor_name;?></td><td><?php echo $row->booking_date;?></td><td><?php echo $row->time_from;?></td><td><?php echo $row->time_to;?></td><td><?php echo $row->price;?></td><td><a class="booking_button" href="">Delete</a></td>
</tr>
<?php } ?>
</table>

<?php require_once dirname( __FILE__ ) . '/footer.php'; ?>
