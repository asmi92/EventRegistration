<?php 
include('header.php');
?>
<html>
<body>
<div class="container">
    <div class="row">
         <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Add your event details</h2>
            <hr class="primary">
          </div>
        </div>
      </div>
      <div class="container">
           <div class="navbar  navbar-fixed-top">
    <div class="navbar-inner1">

    </div>
    </div>
 <form class="form-horizontal" method="POST" action="../index.php">
    
    <div class="form-group">
    <label class="control-label" for="inputName">Event Name</label>
    <input type="text" class="form-control" name="event"  placeholder="what is your event name?" required>
    </div>
    <div class="form-group">
    <label class="control-label" for="inputLoc">Location</label>
    <input type="text" class="form-control" name="loc" placeholder="where it is going to be?" required>
    </div>
	
      <div class="form-group">
    <label class="control-label" for="inputEmail">Organisation</label>
    <input type="text" class="form-control" name="org" placeholder="who is organising?" required>
    </div>
    
	 <div class="form-check">
    <label class="form-check-label" for="inputEmail">
    <input type="checkbox" class="form-check-input" name="is_reg_student">
    Registered Students Only</label>
    </div>
         
	<fieldset class="form-group"> 
    <div class="form-check">
     <label class="form-check-label"># of guests</label>
      <label class="form-check-label" for="inputGuests" style="
    margin-left: 35px;"><input type="radio" class="form-check-input" name="guests" value="0" checked> 0</label>
      <label class="form-check-label" for="inputGuests" style="
    margin-left: 35px;">
          <input type="radio"  class="form-check-input" name="guests" value="10"> 10</label>
      <label class="form-check-label" for="inputGuests" style="
    margin-left: 35px;">
          <input type="radio" class="form-check-input" name="guests" value="20">20</label>
    </div>
   </fieldset>
         
 <div class="form-group">
    <label class="control-label" for="inputEmail">Start Date</label>
    <div class="controls">
	<input type="date" name="sdate" class="form-control" > 
    </div>
    </div>
	
	 <div class="form-group">
    <label class="control-label" for="inputEmail">End Date</label>
    <div class="controls">
	<input type="date" name="edate" class="form-control" > 
    </div>
    </div>
	
	 <div class="form-group">
    <label class="control-label" for="inputEmail">Start Time</label>
    <div class="controls">
	<input type="time" name="stime" class="form-control" > 
    </div>
    </div>
	
	
 <div class="form-group">
    <label class="control-label" for="inputEmail">End Time</label>
    <div class="controls">
	<input type="time" name="etime" class="form-control" > 
    </div>
    </div>
 
   <button type="submit" name="submit" class="btn btn-primary"><i class="icon-save icon-large"></i>&nbsp;Submit</button>
    </form>
	</div>
	
	<?php
	if (isset($_POST['submit'])){
	$event=$_POST['event'];
    $loc=$_POST['loc'];
	$is_reg_student=$_POST['is_reg_student'];
	$guests=$_POST['guests'];
	$org=$_POST['org'];
	$sdate=$_POST['sdate'];
	$edate=$_POST['edate'];
    $stime=$_POST['stime'];
    $etime=$_POST['etime'];
	
	mysql_query("insert into event (name,location,is_reg_student_only,no_of_guests,organization,start_date,end_date,start_time,end_time)
	values('$event','$loc','$is_reg_student','$guests','$org','$sdate','$edate','$stime','$etime')
	")or die(mysql_error());
	?>
	<script type="text/javascript">
	alert('You are Successfully Register Thank You');
	window.location="Start%20Bootstrap/index.php";
	</script>

	<?php
	}
	?>
    </div>	
</body>
</html>