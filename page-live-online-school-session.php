<?php
global $wpdb;
	if(isset($_POST['submit'])){
				print_r($_POST);die;
				$flight = $_POST['flight'];
			    $flight_price = $wpdb -> get_results("select * from booking_school_session_flights where id =".$flight);
			    $price_per_hour = $flight_price[0]->price;
			    $time1 = $_POST['date']." ".$_POST['time_from'];
			    $time2 = $_POST['date']." ".$_POST['time_to'];
			    $ts1 = strtotime(str_replace('/', '-', $time1));
			    $ts2 = strtotime(str_replace('/', '-', $time2));
			    $diff = abs($ts1 - $ts2) / 3600;
			    $diff_hours = round($diff/60);
			    $price =  $diff_hours *$price_per_hour;
			
			   if(!empty($_POST['flight']) && !empty($_POST['instructor']) && !empty($_POST['date']) && !empty($_POST['time_from']) && !empty($_POST['time_to']) && !empty($price) ){
					    $wpdb->insert('booking_school_session',array('flight'=>$_POST['flight'],'instructor'=>$_POST['instructor'],'lesson_type'=> $_POST['lesson_select_radio'],'j_lesson'=> $_POST['jeppesen_lesson'],'subject'=>$_POST['subject'],'additional_area1'=>$_POST['additional_area1'],'additional_area2'=>$_POST['additional_area2'],'additional_area3'=>$_POST['additional_area3'],'date'=>$_POST['date'],'time_from'=>$_POST['time_from'],'time_to'=>$_POST['time_to'],'price'=>$price),array('%s','%s','%s','%s','%s','%s'));
					    $query = array();
					    $query['notify_url'] = 'http://collab-o-nation.com/zulutime/check-out/';
					    $query['cmd'] = '_cart';
					    $query['upload'] = '1';
					    $query['business'] = 'poriapardeep@gmail.com';
					    $query['address_override'] = '1';
					    $query['item_name_1'] = $flight_price[0]->flight_name;
					    $query['quantity_1'] = 1;
					    $query['amount_1'] = $price;
					    $query_string = http_build_query($query);
					    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
			      }
		}
		?>

<?php get_header(); ?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
<div class="booking-form">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <div class="book">
      	<h2>Book Your Live Online Ground school Session</h2>
      </div>
        <div class="live">
        
          <form id="msform1" class="msform2" method="post">
              <div class="form-group"> 
              	<label>Select your current training Course:</label> 
                <div class="styleSelect">  
                <select class="form-control" name="flight" id="flight_selectbox" onchange="display();">
                   <option>Select Flight</option>

		<?php 
		$rows = $wpdb -> get_results("select * from booking_school_session_flights");
		foreach($rows as $key=>$row){
		?>
		<option value="<?php echo $row->id;?>" data-id="<?php echo $row->description;?>"><?php echo $row->flight_name;?></option>
		<?php } ?>
       </select>
                </div>
              </div>      
              <div class="form-group">  
              		<label>Select an Instructor:</label>  
                    <div class="styleSelect">   
                    <select class="form-control"  name="instructor" id="instructor_selectbox" onchange="display();">
			<option>Select Instructor</option>
                         <?php 
			$rows_instructors = $wpdb -> get_results("select * from booking_school_session_instructors");
			foreach($rows_instructors as $key1=>$row1){
			?>
			<option value="<?php echo $row1->id;?>" <?php if($row1->id == $edited[0]->instructor_id){echo "selected=selected";}?>><?php echo $row1->instructor_name;?></option>
			<?php } ?>
                    </select>
                    </div>
              </div> 
                <div class="form-group rb">
                <label>Cover a lesson from Jeppesen sylabus</label>				
                  <input type="radio" id="jeppesen_sylabus" name="lesson_select_radio" value="jeppesen_sylabus" checked>                  
                </div>
                <span>OR</span> 				 
                <div class="form-group rb">                 
				<label>Built a custom lesson </label>					
                  <input type="radio" id="custom_lesson" name="lesson_select_radio" value="custom_lesson" >    
                 </div>
					
                <div class="form-group" id="jeppeson"> 
                	<label>Select the Jeppesen lesson you want to:</label>  
                    <div class="styleSelect"> 
                    <select class="form-control" onchange="display();" name="jeppesen_lesson">
						<option>Select Lesson</option>
                          <?php 
							$lessons = $wpdb -> get_results("select * from booking_jepession_lessons");
							foreach($lessons as $key1=>$row1){
							?>
							<option value="<?php echo $row1->id;?>"><?php echo $row1->name;?></option>
							<?php } ?>
                    </select>
                    </div>
              </div> 
              <div class="form-group" id="main_sub" style="display:none;">
              		<label>Select the main subject you want your instructor to:</label>  
                    <div class="styleSelect">     
                    <select class="form-control" onchange="display();" name="subject">
                          <option>Select Subject</option>
                          
                          <?php 
							$lessons = $wpdb -> get_results("select * from booking_subjects");
							foreach($lessons as $key11=>$row11){
							?>
							<option value="<?php echo $row11->id;?>"><?php echo $row11->name;?></option>
							<?php } ?>
                    </select>
                    </div>
              </div> 
              <div class="form-group additional"> 
                  <label>Select upto three(3) additional area you want</label>
                	<div class="styleSelect"> 
					<select class="form-control" onchange="display();" name="additional_area1">
						<option>Select </option>
                          
                    </select>
					 </div>
                    <div class="styleSelect"> 
                    <select class="form-control" onchange="display();" name="additional_area2">
						<option>Select </option>
                         
                    </select>
                    </div>
                    <div class="styleSelect"> 
                	<select class="form-control" onchange="display();" name="additional_area3">
						<option>Select </option>
                          
                    </select>
                     </div>
              </div>
              <div class="form-group timing">
			  <input id="datepicker12" placeholder="Select Date" onchange="display();get_availability();" name="date"/>
               <input name="time_from"/><input name="time_to"/>
                </div>      
              
			  
              <div class="form-group ck-btn"> 
      <input class="bg-ckout" type="submit" name="bg-checkout" class="submit action-button" value="Begin Checkout" />     
		</div>
        <div class="popu">
        	<ul>
            	<li>Extend Your Flight 30 mins....</li>
                <li>HD vedios</li>
            </ul>
        </div>         
</form>
            <div class="popup-info-wrap">
                <div class="popup-info">
                    <h3>Booking Information</h3>
                    <div class="crse-info">
                        <h4>Your Course</h4>
                        <p id="flight_name">Discovery Flight</p>
						<p id="instrcutor_name">Discovery Flight</p>
                    </div>
                    <div class="crse-date">
                        <h4 >Date & Time</h4>   
						<p id="booking_date_time"></p>
                    </div>
                    <div class="crse-info">
                        <h4 id="information">Information</h4>            
                    </div>
                   <!-- <div class="total-info">-->
                    <h4 class="ttl">Total:<span class="total">$551</span></h4>
                    <!--</div>-->
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
 		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>  
             
<script>
$(document).ready(function() { 
	$("#datepicker12").datepicker();
	$("input[name=lesson_select_radio]").click(function(){ 
		var lesson_select_radio = $("input[name=lesson_select_radio]:checked").val();
		if(lesson_select_radio == "jeppesen_sylabus"){
			$("#jeppeson").show(0);
			$("#main_sub").hide(0);
			
		}
		if(lesson_select_radio == "custom_lesson"){
			$("#main_sub").show(0);
			$("#jeppeson").hide(0);
			
		}
	});
}); 

function display(){
var flight = $('#flight_selectbox').find(":selected").text();
var info = $('#flight_selectbox').find(":selected").attr('data-id');
var inst = $('#instructor_selectbox').find(":selected").text();
var date = $("#datepicker").val();
$("#flight_name").html(flight);
$("#instrcutor_name").html(inst);
$("#information").html(info);
$("#booking_date_time").html(date);
}
function get_availability(){
	 var date_check = $("#datepicker12").val();
	  $.ajax({
			url :'<?php echo "http://".$_SERVER["HTTP_HOST"];?>/zulutime/wp-admin/admin-ajax.php?action=get_available_timings&date='+date_check,
			type :'get',
			success : function(){

			}
		});
}
</script>
<?php get_footer(); ?>
