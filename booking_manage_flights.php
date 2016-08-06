<?php require_once dirname( __FILE__ ) . '/header.php'; ?>

<?php 
if($_POST['add_flight'] == "Add Flight"){ 
$wpdb->insert('booking_flights',array('flight_name' => $_POST['name'],'about'=>$_POST['description']),array('%s','%s'));
}
if($_POST['update_flight'] == "Update Flight"){
$wpdb->update( 'booking_flights', array('flight_name' => $_POST['name'],'about'=>$_POST['description']), array('id' => $_GET['edit']) ); 
}
if($_GET['delete']){
$wpdb->delete('booking_flights',array('id'=> $_GET['delete'])); 
}
?>






<?php
if($_GET['edit']){
$edited = $wpdb -> get_results("select * from booking_flights where id =".$_GET['edit']);
?>
<h3 class="booking_h3">Edit Flight</h3>
<a href="?page=booking-manage-flights">Add new</a>
<span>(You can add flights here, the flights added here will be displyed on the frontend form)</span>
<form action="" method="post">
	<table class="gridtable">
	<tr><th>Name</th><td><input type="text" name="name" value="<?php echo $edited[0]->flight_name;?>"/></td></tr>
	<tr><th>Description</th><td><textarea name="description" rows="5" cols="50"><?php echo $edited[0]->about;?></textarea></td></tr>
	</table>
<input type="submit" name="update_flight" value="Update Flight"/>
</form>
<?php } else { ?>
<h3 class="booking_h3">Add Flight</h3>
<span>(You can add flights here, the flights added here will be displyed on the frontend form)</span>
<form action="" method="post">
	<table class="gridtable">
	<tr><th>Name</th><td><input type="text" name="name" /></td></tr>
	<tr><th>Description</th><td><textarea name="description" rows="5" cols="50"></textarea></td></tr>
	</table>
<input type="submit" name="add_flight" value="Add Flight"/>
</form>
<?php } ?>
<div style="text-align:center"><h3 class="booking_h3">Flights List</h3></div>

<table class="gridtable" >
<tr>
	<th>Name</th><th>Description</th><th>Actions</th>
</tr>
<?php 
$rows = $wpdb -> get_results("select * from booking_flights");
foreach($rows as $key=>$row){
?>
<tr>
	<td><?php echo $row->flight_name;?></td><td><?php echo $row->about;?></td><td><a class="booking_button" href="?page=booking-manage-flights&edit=<?php echo $row->id;?>">Edit</a>&nbsp;&nbsp;<a class="booking_button" href="?page=booking-manage-flights&delete=<?php echo $row->id;?>" onclick="javascript:return confirm('Are you sure to delete it?')">Delete</a></td>
</tr>
<?php } ?>
</table>





<?php require_once dirname( __FILE__ ) . '/footer.php'; ?>
