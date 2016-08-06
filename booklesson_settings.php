<?php require_once dirname( __FILE__ ) . '/header.php';
if($_POST['submit'] == "Update"){
$wpdb->update( 'booking_settings', array('paypal_id' => $_POST['paypal_id'],'currency' => $_POST['currency'],'notify_url'=>$_POST['notify_url']), array('id' =>'1')); 
}

$edited = $wpdb -> get_results("select * from booking_settings where id = 1"); ?>
<div style="text-align:center"><h3 class="booking_h3">Paypal Settings</h3></div>
<form method="post" action="" enctype="multipart/form-data">
<table class="gridtable" >
<tr><th>Paypal Email</th><td><input type="text" name="paypal_id" value="<?php echo $edited[0]->paypal_id;?>" /></td></tr>
<tr><th>Currency</th><td><input type="text" name="currency" value="<?php echo $edited[0]->currency;?>" /></td></tr>
<tr><th>Notify Url</th><td><input type="text" name="notify_url" value="<?php echo $edited[0]->notify_url;?>" /></td></tr>
</table>
<input type="submit" name="submit" value="Update"/>

<?php require_once dirname( __FILE__ ) . '/footer.php'; ?>
