<?php require_once dirname( __FILE__ ) . '/header.php'; ?>
<link rel='stylesheet' href='//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css' type='text/css'/>
<div style="text-align:center"><h3 class="booking_h3">Manage Live Session class Bookings</h3></div>
<table class="gridtable" id="live_lesson_bookings">
<tr>
	<th>Flight</th><th>Instructor</th><th>Lesson Type</th><th>Date</th><th>Time from</th><th>Time to</th><th>Price</th><th>Actions</th>
</tr>
<?php 
$rows = $wpdb -> get_results("select booking_school_session.*,booking_school_session_instructors.instructor_name,booking_school_session_flights.flight_name from booking_school_session INNER JOIN booking_school_session_flights ON booking_school_session_flights.id = booking_school_session.flight INNER JOIN booking_school_session_instructors ON booking_school_session_instructors.id = booking_school_session.instructor");
foreach($rows as $key=>$row){
?>
<tr>
	<td><?php echo $row->flight_name;?></td><td><?php echo $row->instructor_name;?></td><td><?php echo $row->lesson_type;?></td><td><?php echo $row->date;?></td><td><?php echo $row->time_from;?></td><td><?php echo $row->time_to;?></td><td><?php echo $row->price;?></td><td>&nbsp;<a class="booking_button" href="">Delete</a></td></tr>
<?php } ?>
</table>

<?php require_once dirname( __FILE__ ) . '/footer.php'; ?>
  
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script>
var j = $.noConflict(true);
j(document).ready(function(){
    j('#live_lesson_bookings').DataTable();
});
</script>
