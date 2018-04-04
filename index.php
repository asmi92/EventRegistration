<?php 
include('header.php');
?>
<style>
    .alert{
        display: none;
    }
</style>
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
 <form class="form-horizontal" method="POST" action="">
    
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
    <input type="checkbox" class="form-check-input" name="is_reg_student" value="Yes">
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
     <div class="alert alert-warning">
  <strong>Warning!</strong> <?php if(isset($_POST['submit']) && isset($error))
{echo $error;} ?>
</div>    
    </div>
	
	
 <div class="form-group">
    <label class="control-label" for="inputEmail">End Time</label>
    <div class="controls">
	<input type="time" name="etime" class="form-control" > 
    </div>
    </div>
 
   <button type="submit" name="submit" class="btn btn-primary pull-right"><i class="icon-save icon-large"></i>&nbsp;Submit</button>
    </form>
	</div>
	<br><br>
    <div class="alert alert-success" id="success">
        <strong>Success!</strong>
	<?php
	if (isset($_POST['submit'])){
        $ThatTime ="14:08:10";
        if (strtotime($_POST['etime']) >= strtotime($_POST['stime'])) {
        $event=$_POST['event'];
        $loc=$_POST['loc'];
        if(isset($_POST['is_reg_student']) && $_POST['is_reg_student'] == 'Yes')
        {
            $is_reg_stud=1;
        }
        else
        {
             $is_reg_stud=0;
        }
        $guests=$_POST['guests'];
        $org=$_POST['org'];
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $stime=$_POST['stime'];
        $etime=$_POST['etime'];

        $query=mysql_query("insert into event (name,location,is_reg_student_only,no_of_guests,organization,start_date,end_date,start_time,end_time)
        values('$event','$loc','$is_reg_stud','$guests','$org','$sdate','$edate','$stime','$etime')");
        if($query){
        header('index.php');
        ?>
        <script type="text/javascript">
           document.getElementById('success').style.display = "block";
            </script>
        <?php
        echo 'You are Successfully Register Thank You';
        }
            else{
            echo mysql_error();
        }
    }
    else{
        $error = "Start time should be lesser than end time";
    }
    }
        
    mysql_close($db);
	?>
    </div>
    </div>
    </div>
</body>
</html>
