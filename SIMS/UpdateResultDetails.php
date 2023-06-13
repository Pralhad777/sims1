<?php
session_start();
// start output buffering
ob_start();

if ( $_SESSION[ "fidx" ] == "" || $_SESSION[ "fidx" ] == NULL ) {
	header( 'Location:facultylogin' );
}

$userid = $_SESSION[ "fidx" ];
$fname = $_SESSION[ "fname" ];
?>
<?php include('fhead.php');  ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">


			<h3> <b> Welcome Teacher : <a href="welcomefaculty.php" ><span style="color:#FF0004"><?php echo $fname; ?></b></span></a> </h3>

			<?php 

include('database.php');
$editid=$_GET['editid'];
$courseid = $_GET['courseid'];

//fetching original data
$sql = "select * from  $courseid where Eno=$editid";
$result = mysqli_query( $connect, $sql );
$row = mysqli_fetch_array( $result );
$ori_sta = $row['status']

echo "<h2 class='page-header'><b>Update Result Details</b></h2>";
?>
<?php 
if($courseid == 'csit')
{
?>
			<form action="" method="POST" name="csit">
				<fieldset>
					<div class="form-group">
						Math:<br><br>
						<input type="number" name="Math" style="width: 300px; height: 40px;" value="<?php echo $row['Math']; ?>">

					</div>
					<div class="form-group">
						C:<br><br>
						<input type="number" name="C" style="width: 300px; height: 40px;" value="<?php echo $row['C']; ?>">

					</div>
					<div class="form-group">
						IIT:<br><br>
						<input type="number" name="IIT" style="width: 300px; height: 40px;"  value="<?php echo $row['IIT']; ?>">
						</div>
					<div class="form-group">
						Physics: <br><br>
						<input type="number" name="Physics" style="width: 300px; height: 40px;" value="<?php echo $row['Physics']; ?>">
					</div>
					<div class="form-group">
						Digital Logic: <br><br>
						<input type="number" name="dl" style="width: 300px; height: 40px;" value="<?php echo $row['Digital_logic']; ?>">
					</div>
					<div class="form-group">
						Absences: <br><br>
						<input type="number" name="abs" style="width: 300px; height: 40px;" value="<?php echo $row['absences']; ?>" >
					</div>
					<div class="form-group">
						<input type="submit" value="Update Result!" name="csit" class="btn btn-primary">
					</div>
	
				</fieldset>
			</form>
			<?php
			
			
		}
		?>
<?php 
if($courseid == 'bit')
{ 
?>
			<form action="" method="POST" name="bit">
				<fieldset>
					
					<div class="form-group">
						Math:<br><br>
						<input type="number" name="Math" style="width: 300px; height: 40px;" value="<?php echo $row['Math']; ?>">

					</div>
					<div class="form-group">
						C:<br><br>
						<input type="number" name="C" style="width: 300px; height: 40px;" value="<?php echo $row['C']; ?>">

					</div>
					<div class="form-group">
						IIT:<br><br>
						<input type="number" name="IIT" style="width: 300px; height: 40px;" value="<?php echo $row['IIT']; ?>">
						</div>
					<div class="form-group">
						Sociology: <br><br>
						<input type="number" name="Socio" style="width: 300px; height: 40px;" value="<?php echo $row['Sociology']; ?>">
					</div>
					<div class="form-group">
						Digital Logic: <br><br>
						<input type="number" name="dl" style="width: 300px; height: 40px;" value="<?php echo $row['Digital_logic']; ?>" >
					</div>
					<div class="form-group">
						Absences: <br><br>
						<input type="number" name="abs" style="width: 300px; height: 40px;" value="<?php echo $row['absences']; ?>" >
					</div>
					<div class="form-group">
						<input type="submit" value="Update Result!" name="bit" class="btn btn-primary">
					</div>
	
				</fieldset>
			</form>
			<?php
			
			
		}
		?>

			<?php 
			
if(isset($_POST['csit']))		
{
$tempmath=$_POST['Math'];	
$tempc=$_POST['C'];
$tempphy=$_POST['Physics'];
$tempdl=$_POST['dl'];
$tempiit=$_POST['IIT'];
$tempabs=$_POST['abs'];

//for terminal average
$avg=($tempiit+$tempmath+$tempc+$tempphy+$tempdl)/5;

//for status
if($tempmath >40 && $tempc >40 && $tempphy >40 && $tempdl >40 && $tempiit >40){
	if($avg > 60){
		$status = 'First';
	}
	else if ($avg >80){
		$status = 'Distiction';
	}
	else{
		$status = 'Second';
	}
}
else{
	$status = 'Fail';
}

//fetching failure value
$sql = "SELECT failures FROM studenttable WHERE Eno=$editid";
$res=mysqli_query( $connect, $sql );
$row = mysqli_fetch_array($res);
$failures = $row[0];

if($status == 'Fail'){
	if($status != $ori_sta){
		$failures = $failures + 1;}
}
 
$sql = "UPDATE studenttable SET failures = $failures WHERE Eno = $editid";
mysqli_query( $connect, $sql );


$sql="UPDATE `csit`
SET `IIT` = $tempiit,`status`='$status', `C` = $tempc, `Digital_logic` = $tempdl, `Math` = $tempmath, `Physics` = $tempphy,`absences`=$tempabs
WHERE `Eno` = $editid
"; 


if (mysqli_query($connect, $sql)) {

//changing the terminal exam data also
$sql = "select * from  studenttable where Eno=$editid";
$result = mysqli_query( $connect, $sql );
$row = mysqli_fetch_array( $result );

//changing terminal average marks also
if(!empty($row['G2'])) {
	// 'G2' column has data for the specific student
	$sql = "UPDATE studenttable SET G2 = $avg WHERE Eno = $editid";
	mysqli_query( $connect, $sql );

  } else {
	// 'G2' column does not have data for the specific student
	$sql = "UPDATE studenttable SET G1 = $avg WHERE Eno = $editid";
	mysqli_query( $connect, $sql );
  }
  

//cleaning the buffer to redirect process
ob_end_clean(); 
header('Location:ResultDetails.php');
exit;
} else {
//below statement will print error if SQL query fail.
echo "<br><Strong>Result Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
}
}

//for bit 
if(isset($_POST['bit']))		
{
$tempmath=$_POST['Math'];	
$tempc=$_POST['C'];
$tempsoc=$_POST['Socio'];
$tempdl=$_POST['dl'];
$tempiit=$_POST['IIT'];
$tempabs=$_POST['abs'];

//for terminal average
$avg=($tempiit+$tempmath+$tempc+$tempsoc+$tempdl)/5;

//for status
if($tempmath >40 && $tempc >40 && $tempsoc >40 && $tempdl >40 && $tempiit >40){
	if($avg > 60){
		$status = 'First';
	}
	else if ($avg >80){
		$status = 'Distiction';
	}
	else{
		$status = 'Second';
	}
}
else{
	$status = 'Fail';
}

//fetching failure value
$sql = "SELECT failures FROM studenttable WHERE Eno=$editid";
$res=mysqli_query( $connect, $sql );
$row = mysqli_fetch_array($res);
$failures = $row[0];

if($status == 'Fail'){
	if($status != $ori_sta){
		$failures = $failures + 1;}
}
 
$sql = "UPDATE studenttable SET failures = $failures WHERE Eno = $editid";
mysqli_query( $connect, $sql );


$sql="UPDATE `bit`
SET `IIT` = $tempiit,`status`='$status', `C` = $tempc, `Digital_logic` = $tempdl, `Math` = $tempmath, `Sociology` = $tempsoc,`absences`=$tempabs
WHERE `Eno` = $editid
";  

if (mysqli_query($connect, $sql)) {

	//changing the terminal exam data also
$sql = "select * from  studenttable where Eno=$editid";
$result = mysqli_query( $connect, $sql );
$row = mysqli_fetch_array( $result );

//changing terminal average marks also
if(!empty($row['G2'])) {
	// 'G2' column has data for the specific student
	$sql = "UPDATE studenttable SET G2 = $avg WHERE Eno = $editid";
	mysqli_query( $connect, $sql );

  } else {
	// 'G2' column does not have data for the specific student
	$sql = "UPDATE studenttable SET G1 = $avg WHERE Eno = $editid";
	mysqli_query( $connect, $sql );
  }

	//cleaning the buffer to redirect process
	ob_end_clean(); 
	header('Location:ResultDetails.php');
	exit;
		


} else {
//below statement will print error if SQL query fail.
echo "<br><Strong>Result Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
}
}

//close the connection flushing the buffer
mysqli_close( $connect );
ob_end_flush(); 


?>

		</div>

	</div>
	<?php include('allfoot.php');  ?>