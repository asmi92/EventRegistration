<?php 
include('header.php');
?>
<html>
<body>
 <div class="navbar  navbar-fixed-top">
    <div class="navbar-inner1">

    </div>
    </div>
<div class="container">
  <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Quick start your checkin</h2>
            <hr class="primary">
          </div>
        </div>
      </div>
      <div class="container">
           <div class="navbar  navbar-fixed-top">
    <div class="navbar-inner1">

    </div>
    </div>
<div class="container">
	 <form class="form-horizontal" method="POST">
    <div class="form-group">
    <label class="control-label">Choose a Event </label>
  <select name="eventSelected" class="form-control">
 <option value="">Select Event</option>
    <?php 
include('dbcon.php');
?>
	<?php
//	if (isset($_POST['submit'])){
//	$sdate=$_POST['sdate'];
    $event = array();
    $sdate=date("Y-m-d");
	$query=mysql_query("select * from event where start_date='$sdate'")or die(mysql_error());
    $numrows=mysql_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysql_fetch_assoc($query))
	{
	array_push($event,$row['name']);
	$location=$row['location'];
    $is_reg_stud=$row['is_reg_student_only'];
    $guests=$row['no_of_guests'];
    $org=$row['organization'];
    $sdate=$row['start_date'];  
    $edate=$row['end_date'];   
    $stime=$row['start_time']; 
    $stime=$row['end_time'];
	}
//	} else {
//	echo "Invalid username or password!";
//	}

        
	?>
<!--
	<script type="text/javascript">
	alert('You are Successfully Register Thank You');
	window.location="index.php";
	</script>
-->

	<?php
	}
          foreach($event as $key => $value):
   echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
endforeach;
    session_start();
	?>
</select> 
</div>
    <div class="control-group">
    <div class="controls">

    <button type="submit" name="submit" class="btn btn-success">&nbsp;Get Started</button>
    </div>
    </div>
    </form>
	</div>
	</div>
             <?php
	if (isset($_POST['submit'])){
        session_start();
        $_SESSION['eventSelected']=$_POST['eventSelected'];
        ?>  
    
    	<script type="text/javascript">
	//alert('You are Successfully Register Thank You');
	window.location="event-registration.php";
	</script>
     <?php
         header('event-registration.php');
    }
    mysql_close($db);
	?>    
         
	
</div>
</body>
</html>