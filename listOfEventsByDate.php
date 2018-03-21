<center>
<div class="container">

    <form method="POST" class="form-horizontal">
        <label class="control-label">Event Date:</label>
        <div class="form-group">
        <input type="date"  id="eventDate" name="eventDate">
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
    echo "<b>Events on Date:</b>" . date_format($date,"d-M-Y") . "<br>\n";
    echo " <select name='eventSelected' class='form-control'><option value=''>Select Event</option>";
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
    oci_fetch_all($stid, $res);

    foreach ($res['SEI_EVENT_NAME'] as $c ) {
            echo "<option value='". $c."'>".$c."</option>";
         }
    echo "</select>";
    echo "</div>";
    echo "<div class='control-group'><div class='controls'>
    <button type='submit' name='event' class='btn btn-success'>Start Event Registration</button>
    </div>
</div>";
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
