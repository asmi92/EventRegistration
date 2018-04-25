<center>
<div class="container">
    <h2 class="section-heading">To look for events for a particular date, pick the date from the Datepicker.</h2>
    <br><br>
    <form method="POST" class="form-horizontal">
        <div class="form-group">
        <input type="date"  id="eventDate" name="eventDate" value="<?php echo isset($_POST['eventDate']) ? $_POST['eventDate'] : '' ?>" >
        </div>
        <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success">&nbsp;List Events</button>
        </div>
    </form>
    </div>
</center>
<div class="container">
	 <form class="form-horizontal" method="POST">
    <div class="form-group">
<?php
include('header.php');
  session_start();
if(isset($_POST['eventDate'])){
    
//    $conn = oci_connect($db_username, $db_password, $tns);
    $stid = oci_parse($conn, 'SELECT * FROM SWIPE_EVENT_INSTANCES where SEI_EVENT_DATE like :bv');
//    $eventDate = date('d/M/Y', strtotime($_POST['eventDate'])) .'%';
    $date=date_create($_POST['eventDate']);
    $eventDate=strtoupper(date_format($date,"d-M-y")).'%';
    
    oci_bind_by_name($stid, ":bv", $eventDate);
    
    if (!$stid) {
        $e = oci_error($conn);
        throw new Exception($e['message']);
    }
    // Perform the logic of the query
    $r = oci_execute($stid);
    if (!$r) {
        $e = oci_error($stid);
        throw new Exception($e['message']);
    }
    // Fetch the results of the query
    $nrows = oci_fetch_all($stid, $res);
    if($nrows!=0){
        echo "<b>Events on Date:</b>" . date_format($date,"d-M-Y") . "<br>\n";
        echo " <select name='eventSelected' class='form-control'><option value=''>Select Event</option>";
        foreach ($res['SEI_EVENT_NAME'] as $c ) {
            echo "<option value='". $c."'>".$c."</option>";
         }
        echo "</select>";
        echo "</div>";
        echo "<div class='control-group'><div class='controls'>
        <button type='submit' name='event' class='btn btn-success'>Start Event Registration</button>
        </div>
    </div>";
    }else{
        echo '<center><span style="border: 1px solid red;padding:10px;"><span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span><span class="sr-only">Error:</span>&nbsp;&nbsp;It seems that this date doesn\'t have any events. Look for some other date</center></span>';
    }
    
     // Close statement
    oci_free_statement($stid);
    }
    
   

if(isset($_POST['eventSelected'])){
    $stid = oci_parse($conn, 'SELECT * FROM SWIPE_EVENT_INSTANCES where SEI_EVENT_NAME like :bv');
    $eventName=$_POST['eventSelected'];
    oci_bind_by_name($stid, ":bv", $eventName);
    
    if (!$stid) {
        $e = oci_error($conn);
        throw new Exception($e['message']);
    }
    // Perform the logic of the query
    $r = oci_execute($stid);
    if (!$r) {
        $e = oci_error($stid);
        throw new Exception($e['message']);
    }
    
    // Fetch the results of the query
    oci_fetch_all($stid, $res);

    foreach ($res['SEI_EVENT_CODE'] as $c ) {
         $_SESSION['eventCodeSelected']=$c;
    }
    $_SESSION['eventSelected']=$_POST['eventSelected'];
    header('event-registration.php');
    ?>  
    
    	<script type="text/javascript">
	//alert('You are Successfully Register Thank You');
	window.location="event-registration.php";
	</script>
     <?php
//    Disconnect
    oci_close($conn);
}
        
        
?>
