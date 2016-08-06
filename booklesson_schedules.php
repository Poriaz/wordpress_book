<?php require_once dirname( __FILE__ ) . '/header.php'; ?>

<?php 
if($_POST['saveschedule'] == "Save"){ 
	$check = $wpdb -> get_results("select count(*) as counting from booking_flight_instructor_schedule where date ='".$_POST['date']."' and instructor_id = '".$_POST['instructor_id']."' and flight_id = '".$_POST['flight_id']."'");
	if($check[0]->counting < 1){
		$count = count($_POST['time_from']);
		for($i=0;$i < $count;$i++){
			$wpdb->insert('booking_flight_instructor_schedule',array('instructor_id' => $_POST['instructor_id'],'flight_id' => $_POST['flight_id'],'title'=>$_POST['title'],'time_from'=>$_POST['time_from'][$i],'time_to'=>$_POST['time_to'][$i],'date'=>$_POST['date']),array('%d','%d','%s','%s','%s','%s'));
		}
	}
}
if($_POST['updateschedule'] == "Save"){
$wpdb->update( 'booking_flight_instructor_schedule', array('instructor_id' => $_POST['instructor_id'],'flight_id' => $_POST['flight_id'],'title'=>$_POST['title'],'time'=>$_POST['time'],'date'=>$_POST['date']), array('id' => $_GET['edit']) ); 
}
if($_GET['delete']){
$wpdb->delete('booking_flight_instructor_schedule',array('id'=> $_GET['delete'])); 
}?>
<div style="text-align:center"><h3 class="booking_h3">Manage Instructor Schedules</h3></div>
<?php
if($_GET['edit']){
$edited = $wpdb -> get_results("select * from booking_flight_instructor_schedule where id =".$_GET['edit']);
?>
<h3 class="booking_h3">Edit Schedule</h3>
<a href="?page=booking-schedules">Add new</a>
<form id="form"  name="form"method="post" action="" enctype="multipart/form-data">
    <div class="booking_detail">
        <table class="gridtable">
            <tr >
                <th width="30%"><strong>Instructor</strong>:</th>
                <td>
<select name="instructor_id">

<?php 
$rows_instructors = $wpdb -> get_results("select * from booking_flight_instructors");
foreach($rows_instructors as $key1=>$row1){
?>
<option value="<?php echo $row1->id;?>" <?php if($row1->id == $edited[0]->instructor_id){echo "selected=selected";}?>><?php echo $row1->instructor_name;?></option>
<?php } ?>
</select>
</td>
            </tr>
	   <tr >
                <th width="30%"><strong>Flight</strong>:</th>
                <td>
<select name="flight_id" >

<?php 
$rows = $wpdb -> get_results("select * from booking_flights");
foreach($rows as $key=>$row){
?>
<option value="<?php echo $row->id;?>" <?php if($row->id == $edited[0]->flight_id){echo "selected=selected";}?>><?php echo $row->flight_name;?></option>
<?php } ?>
</select>
</td>
            </tr>
            <tr >
                <th width="30%"><strong>Title</strong>:</th>
                <td><input type="text" name="title" value="<?php echo $edited[0]->title;?>"/></td>
            </tr>
	   
           <tr id="time_tr">
                <th width="30%"><strong>Time </strong>:</th>
                <td>From 
<select name="time_from[]">
<?php for($i=1;$i <= 24;$i++){ ?>
<?php if($i <= 9) {?>
<option value="0<?php echo $i;?>:00">0<?php echo $i;?>:00</option>
<?php } else { ?>
<option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
<?php } }?>
</select> To 
<select name="time_to[]">
<?php for($i=1;$i <= 24;$i++){ ?>
<?php if($i <= 9) {?>
<option value="0<?php echo $i;?>:00">0<?php echo $i;?>:00</option>
<?php } else { ?>
<option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
<?php } }?>
</select>&nbsp;<span class="button" onclick="add_more();">Add More</span></td>
            </tr>
            
            <tr >
                <th width="30%"><strong>Date</strong>:</th>
                <td><input type="text" name="date"  value="<?php echo $edited[0]->date;?>" id="datepicker2"/></td>
            </tr>
            <tr >
                <td width="30%">&nbsp;</td>
                <td><input type="submit" class="button" name="updateschedule" value="Save"/></td>
            </tr>
        </table>
    </div>
</form>

<?php } else {  ?>
<h3 class="booking_h3">Add Schedule</h3>
<form id="form"  name="form"method="post" action="" enctype="multipart/form-data">
    <div class="booking_detail">
        <table class="gridtable">
            <tr >
                <th width="30%"><strong>Instructor</strong>:</th>
                <td>
<select name="instructor_id" id="title" >
<option>Choose Instructor</option>
<?php 
$rows_instructors = $wpdb -> get_results("select * from booking_flight_instructors");
foreach($rows_instructors as $key1=>$row1){
?>
<option value="<?php echo $row1->id;?>"><?php echo $row1->instructor_name;?></option>
<?php } ?>
</select>
</td>
            </tr>
	   <tr >
                <th width="30%"><strong>Flight</strong>:</th>
                <td>
<select name="flight_id" id="title" >
<option>Choose Flight</option>
<?php 
$rows = $wpdb -> get_results("select * from booking_flights");
foreach($rows as $key=>$row){
?>
<option value="<?php echo $row->id;?>"><?php echo $row->flight_name;?></option>
<?php } ?>
</select>
</td>
            </tr>
            <tr >
                <th width="30%"><strong>Title</strong>:</th>
                <td><input type="text" name="title" id="title" /></td>
            </tr>
             <tr id="time_tr">
                <th width="30%"><strong>Time </strong>:</th>
               <td>From 
<select name="time_from[]">
<?php for($i=1;$i <= 24;$i++){ ?>
<?php if($i <= 9) {?>
<option value="0<?php echo $i;?>:00">0<?php echo $i;?>:00</option>
<?php } else { ?>
<option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
<?php } }?>
</select> To 
<select name="time_to[]">
<?php for($i=1;$i <= 24;$i++){ ?>
<?php if($i <= 9) {?>
<option value="0<?php echo $i;?>:00">0<?php echo $i;?>:00</option>
<?php } else { ?>
<option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option>
<?php } }?>
</select>&nbsp;&nbsp;<span onclick="add_more();" class="button">Add More</span></td>
            </tr>
            
            
            <tr >
                <th width="30%"><strong>Date</strong>:</th>
                <td><input type="text" name="date"  value="" id="datepicker2"/></td>
            </tr>
            <tr >
                <td width="30%">&nbsp;</td>
                <td><input type="submit" class="button" name="saveschedule" value="Save"/></td>
            </tr>
        </table>
    </div>
</form>

<?php } ?>



<h3 class="booking_h3"> Instructor Schedules</h3>
<table class="gridtable" >
        
            <tr >
                <th  width="5%">S.No. </th>
		 <th> Instructor </th>
		 <th> Flight </th>
                <th> Title </th>
                <th> Time From</th>
                <th> Time To</th>
                <th> Date </th>
                <th width="20%">Action </th>
            </tr>
        
        <?php  $i=1;
	$rows1 = $wpdb -> get_results("select * from booking_flight_instructor_schedule");
	foreach($rows1 as $key=>$row1){		
	
				$rows_inst = $wpdb -> get_results("select * from booking_flight_instructors where id =".$row1->instructor_id);
				$rows_flight = $wpdb -> get_results("select * from booking_flights where id = ".$row1->flight_id);
				
				$Get_id = $row1->id;
				$title = $row1->title;
				$time_from = $row1->time_from;
				$time_to = $row1->time_to;
				$occurance = $row1->occurance;
				$date = $row1->date;
			
			?>
        <tr>
            <td ><?php echo $i;?></td>
	    <td ><?php echo $rows_inst[0]->instructor_name; ?></td>
	    <td ><?php echo $rows_flight[0]->flight_name; ?></td>
            <td ><?php echo $title; ?></td>
            <td ><?php echo $time_from; ?></td>
            <td ><?php echo $time_to; ?></td>
            <td ><?php echo $date; ?></td>
            <td><!--<a class="booking_button" href="?page=booking-schedules&edit=<?php echo $Get_id; ?>">Edit</a>--> &nbsp;&nbsp; <a class="booking_button" href="?page=booking-schedules&delete=<?php echo $Get_id; ?>" onclick="javascript:return confirm('Are you sure to delete it?')">Delete</a></td>
        </tr>
        <?php $i++; 
			}
			?>
    </table>
<?php require_once dirname( __FILE__ ) . '/footer.php'; ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script> 
$(document).ready(function() {
 $("#datepicker1").datepicker(); 
 $("#datepicker2").datepicker(); 
}); 

function add_more(){
	var html = '<tr><th width="30%"></th><td>From <select name="time_from[]"><?php for($i=1;$i <= 24;$i++){ ?><?php if($i <= 9) {?><option value="0<?php echo $i;?>:00">0<?php echo $i;?>:00</option><?php } else { ?><option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option><?php } }?></select> To <select name="time_to[]"><?php for($i=1;$i <= 24;$i++){ ?><?php if($i <= 9) {?><option value="0<?php echo $i;?>:00">0<?php echo $i;?>:00</option><?php } else { ?><option value="<?php echo $i;?>:00"><?php echo $i;?>:00</option><?php } }?></select>&nbsp;&nbsp;<span onclick="$(this).parent(&quot;td&quot;).parent(&quot;tr&quot;).remove(0);" class="button">Remove</span></td></tr>';
	$('#time_tr').after(html);
}
</script>

