<?php require_once dirname( __FILE__ ) . '/header.php'; ?>

<?php 
if($_POST['add'] == "Add Lesson"){ 
$wpdb->insert('booking_jepession_lessons',array('name' => $_POST['name'],'description'=>$_POST['description']),array('%s','%s'));
}
if($_POST['update'] == "Update Lesson"){
$wpdb->update( 'booking_jepession_lessons', array('name' => $_POST['name'],'description'=>$_POST['description']), array('id' => $_GET['edit']) ); 
}
if($_GET['delete']){
$wpdb->delete('booking_jepession_lessons',array('id'=> $_GET['delete'])); 
}
?>






<?php
if($_GET['edit']){
$edited = $wpdb -> get_results("select * from booking_jepession_lessons where id =".$_GET['edit']);
?>
<h3 class="booking_h3">Edit Jeppesen Lesson</h3>
<a href="?page=bookings-jeppeson">Add new</a>
<span>(You can add lessons here, the lessons added here will be displyed on the frontend form)</span>
<form action="" method="post">
	<table class="gridtable">
	<tr><th>Name</th><td><input type="text" name="name" value="<?php echo $edited[0]->name;?>"/></td></tr>
	<tr><th>Description</th><td><textarea name="description" rows="5" cols="50"><?php echo $edited[0]->description;?></textarea></td></tr>
	</table>
<input type="submit" name="update" value="Update Lesson"/>
</form>
<?php } else { ?>
<h3 class="booking_h3">Add Jeppesen Lesson</h3>
<span>(You can add lessons here, the lessons added here will be displyed on the frontend form)</span>
<form action="" method="post">
	<table class="gridtable">
	<tr><th>Name</th><td><input type="text" name="name" /></td></tr>
	<tr><th>Description</th><td><textarea name="description" rows="5" cols="50"></textarea></td></tr>
	</table>
<input type="submit" name="add" value="Add Lesson"/>
</form>
<?php } ?>
<div style="text-align:center"><h3 class="booking_h3">Jeppesen Lesson List</h3></div>

<table class="gridtable" >
<tr>
	<th>Name</th><th>Description</th><th>Actions</th>
</tr>
<?php 
$rows = $wpdb -> get_results("select * from booking_jepession_lessons");
foreach($rows as $key=>$row){
?>
<tr>
	<td><?php echo $row->name;?></td><td><?php echo $row->description;?></td><td><a class="booking_button" href="?page=bookings-jeppeson&edit=<?php echo $row->id;?>">Edit</a>&nbsp;&nbsp;<a class="booking_button" href="?page=bookings-jeppeson&delete=<?php echo $row->id;?>" onclick="javascript:return confirm('Are you sure to delete it?')">Delete</a></td>
</tr>
<?php } ?>
</table>





<?php require_once dirname( __FILE__ ) . '/footer.php'; ?>
