<?php require_once dirname( __FILE__ ) . '/header.php'; ?>

<?php 

if($_POST['add_instructor'] == "Add Instructor"){ 
$wpdb->insert('booking_school_session_instructors',array('instructor_name' => $_POST['name'],'flight_id'=> $_POST['flight_id']),array('%s','%d'));
}
if($_POST['update_instructor'] == "Update Instructor"){
$wpdb->update( 'booking_school_session_instructors', array('instructor_name' => $_POST['name'],'flight_id'=> $_POST['flight_id']), array('id' => $_GET['edit']) ); 
}
if($_GET['delete']){
$wpdb->delete('booking_school_session_instructors',array('id'=> $_GET['delete'])); 
}
?>







<?php
if($_GET['edit']){
$edited = $wpdb -> get_results("select * from booking_school_session_instructors where id =".$_GET['edit']);
?>
<h3 class="booking_h3">Edit Instructor</h3>
<a href="?page=booking-manage-live-session-instructors">Add new</a>
<span>(You can add Instructors here, the flights added here will be displyed on the frontend form)</span>

<form action="" method="post">
	<table class="gridtable">
	<tr><th>Name</th><td><input type="text" name="name" value="<?php echo $edited[0]->instructor_name;?>"/></td></tr>
	<tr><th>Flight</th><td>

<select name="flight_id" />

<?php 
$rows = $wpdb -> get_results("select * from booking_school_session_flights");
foreach($rows as $key=>$row){
?>
<option value="<?php echo $row->id;?>" <?php if($row->id == $edited[0]->flight_id){echo "selected=selected";}?>><?php echo $row->flight_name;?></option>
<?php } ?>
</select></td></tr>
	</table>
<input type="submit" name="update_instructor" value="Update Instructor"/>
</form>

<?php } else { ?>
<h3 class="booking_h3">Add Instructor</h3>
<span>(You can add Instructors here, the flights added here will be displyed on the frontend form)</span>

<form action="" method="post">
	<table class="gridtable">
	<tr><th>Name</th><td><input type="text" name="name" /></td></tr>
	<tr><th>Flight</th><td>

<select name="flight_id" />
<option>Choose Flight</option>
<?php 
$rows = $wpdb -> get_results("select * from booking_school_session_flights");
foreach($rows as $key=>$row){
?>
<option value="<?php echo $row->id;?>"><?php echo $row->flight_name;?></option>
<?php } ?>
</select></td></tr>
	</table>
<input type="submit" name="add_instructor" value="Add Instructor"/>
</form>

<?php } ?>


<div style="text-align:center"><h3 class="booking_h3">Instructors List</h3></div>

<table class="gridtable" >
<tr>
	<th>Name</th><th>Actions</th>
</tr>
<?php 
$rows_instructors = $wpdb -> get_results("select * from booking_school_session_instructors");
foreach($rows_instructors as $key1=>$row1){
?>
<tr>
	<td><?php echo $row1->instructor_name;?></td><td><a class="booking_button" href="?page=booking-manage-live-session-instructors&edit=<?php echo $row1->id;?>">Edit</a>&nbsp;&nbsp;<a class="booking_button" href="?page=booking-manage-live-session-instructors&delete=<?php echo $row1->id;?>" onclick="javascript:return confirm('Are you sure to delete it?')">Delete</a></td>
</tr>
<?php } ?>
</table>


<?php require_once dirname( __FILE__ ) . '/footer.php'; ?>
