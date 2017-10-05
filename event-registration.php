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
<?php
     session_start();
//	if (isset($_POST['submit'])){
//	$sdate=$_POST['sdate'];
    $event = array();
    $eventSelect=$_SESSION['eventSelected'];
	$query=mysql_query("select * from event where name='$eventSelect'")or die(mysql_error());
    $numrows=mysql_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysql_fetch_assoc($query))
	{
	$name=$row['name'];
	$location=$row['location'];
    $is_reg_stud=$row['is_reg_student_only'];
    $guests=$row['no_of_guests'];
    $org=$row['organization'];
    $sdate=$row['start_date'];  
    $edate=$row['end_date'];   
    $stime=$row['start_time']; 
    $stime=$row['end_time'];
//    foreach($event as $key => $value):
//   echo '<option value="'.$key.'">'.$value.'</option>'; //close your tags!!
//endforeach;

	}
    }
    $sdate=date("Y-m-d");
    $sdate=str_replace("-","", $sdate);
    $eventMod=str_replace(" ","", $_SESSION['eventSelected']);
    $tablename=$eventMod . $sdate;
    $result = mysql_query("SHOW TABLES LIKE '$tablename'");
    $tableExists = mysql_num_rows($result);
    $link = mysql_connect('localhost','root','');
    mysql_select_db('event_mgmt');
    // sql to create table
  //  echo "CREATE TABLE $tablename (uin int(10), guests_count int(4))";
    $sql =  mysql_query("CREATE TABLE $tablename (uin int(10), guests_count int(4))",$link);
    if($sql){
    //    echo "Table created successfully.";
    } else{
   // echo "ERROR: Could not able to execute $sql. ". mysql_error($link);
}
    
//	} else {
//	echo "Invalid username or password!";
//	}

        
	?>
<center>
<div class="container">
    <h2 class="section-heading">You can  start checkin for event <?php echo $_SESSION['eventSelected'] ?></h2>
    <br><br>
	 <form class="form-horizontal" method="POST">
    <div class="form-group">
    <label class="control-label" for="inputUIN">UIN</label>
    <input type="text" class="form-control" name="uin"  id="uin" placeholder="Before swiping a card, have a cursor on this field" style="width: 29%;">
      <script>
          document.getElementsByName("uin")[0].addEventListener('change', doThing);
          function doThing(){
          if(document.getElementById("uin").value){
                document.getElementById("uin").value=document.getElementById("uin").value.slice(2,10);
          }
          }
        </script>
    </div>
    
	  <div class="form-group">
    <label class="control-label">Guests</label>
          <div class="input-group" style="width: 29%;">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                  <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
    </div>
  <div class="control-group">
    <div class="controls">

    <button type="submit" name="submit" class="btn btn-success">&nbsp;Get Started</button>
    </div>
    </div>
    </form>
    </div> </center>
 <?php
    echo isset($_POST['uin']);
	if (isset($_POST['uin'])){
	$uin1=$_POST['uin'];
    $guest1=$_POST['guest'];
	$tablename=$_SESSION['eventSelected'] . $sdate;
	$insert=mysql_query("insert into ". $tablename . " (uin,guests_count) values('$uin1','$guest1')");
    if($insert){
       echo "Registered!!!"; 
    }
	}
	?>       
	
</div>
</body>
</html>