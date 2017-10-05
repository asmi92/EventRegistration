<?php 
include('header.php');
?>
<html>
<body>
<script>
    //plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/  
$('.btn-number').click(function(e){
    e.preventDefault();
    console.log('Yaayy!!');
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    </script>
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
    //$eventSelect=str_replace(" ","_","$eventSelect");
	$query=mysql_query("select * from event where name='$eventSelect'")or die(mysql_error());
    $numrows=mysql_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysql_fetch_assoc($query))
	{
    $eventid=$row['id'];
	$ename=$row['name'];
	$location=$row['location'];
    $is_reg_stud=$row['is_reg_student_only'];
    $guests=$row['no_of_guests'];
    $org=$row['organization'];
    $sdate=$row['start_date'];  
    $edate=$row['end_date'];   
    $stime=$row['start_time']; 
    $etime=$row['end_time'];

	}
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
  <div class="center">
<div class="input-group" style="width: 29%;">
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="guest">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" name="guest" class="form-control input-number" value="0" min="0" max="100">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="guest">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
	<p></p>
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
	if (isset($_POST['uin'])){
	$uin1=$_POST['uin'];
    $guest1=$_POST['guest'];
	$tablename=$_SESSION['eventSelected'] . $sdate;
	$insert=mysql_query("insert into checkin (event_id,location,sdate,edate,stime,etime,uin,guests,checkinDateTime,ename,is_reg_stud) values('$eventid','$location','$sdate','$edate','$stime','$etime','$uin1','$guest1',NOW(),'$ename','$is_reg_stud')");
    
    if($insert){
       echo "Registered!!!"; 
    }
        else{
             echo "Failed".$insert;
        }
           
    }
	?>       
	
</div>
</body>
</html>