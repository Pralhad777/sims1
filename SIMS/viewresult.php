<?php
session_start();

if ( $_SESSION[ "sidx" ] == "" || $_SESSION[ "sidx" ] == NULL ) {
	header( 'Location:studentlogin' );
}
$userid = $_SESSION[ "sidx" ];
$userfname = $_SESSION[ "fname" ];
$userlname = $_SESSION[ "lname" ];
?>
<?php include('studenthead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h3><b>Welcome <a href="welcomestudent.php" <?php echo "<span style='color:red'>".$userfname." ".$userlname."</span>";?></b></a></h3>
			<?php 

include('database.php');
$seno=$_GET['seno'];
//getting course type
$sql = "SELECT Course FROM studenttable WHERE Eno=$seno";
$res=mysqli_query( $connect, $sql );
$row = mysqli_fetch_array($res);
$course = $row[0];


//gettting marks of student
$sql = "SELECT * FROM $course WHERE Eno=$seno";
$res=mysqli_query( $connect, $sql );
$row = mysqli_fetch_array($res);
echo "<h2 class='page-header'><b>Result View</b></h2>";
echo "   <p>Enrollment No: $seno</p>";
$a = strtoupper($course);
echo "   <p>Course: $a</p>";
if($course=='bit'){

	$total= ($row['IIT']+$row['C']+$row['Math']+$row['Sociology']+$row['Digital_logic']);
	
	//table
	echo "<table class='table table-striped' style='width:50%'>
	<tr>
	<th><b>Subject</b></th>
	<th><b>Full Marks</b></th>
	<th><b>Pass Marks</b></th>
	<th><b>Marks</b></th>
	</tr>";
//creating rows manually
    echo "<tr>
        <td>Math</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['Math']}</td>
    </tr>";

	echo "<tr>
        <td>C</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['C']}</td>
    </tr>";
	echo "<tr>
        <td>IIT</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['IIT']}</td>
    </tr>";

	echo "<tr>
        <td>Digital Logic</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['Digital_logic']}</td>
    </tr>";

	echo "<tr>
        <td>Sociology</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['Sociology']}</td>
    </tr>";

	echo "</table>";
	
}
if($course=='csit'){
	
	$total=($row['IIT']+$row['C']+$row['Math']+$row['Physics']+$row['Digital_logic']);
	
	//table
	echo "<table class='table table-striped' style='width:50%'>
	<tr>
	<th><b>Subject</b></th>
	<th><b>Full Marks</b></th>
	<th><b>Pass Marks</b></th>
	<th><b>Marks</b></th>
	</tr>";
//creating rows manually
    echo "<tr>
        <td>Math</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['Math']}</td>
    </tr>";

	echo "<tr>
        <td>C</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['C']}</td>
    </tr>";
	echo "<tr>
        <td>IIT</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['IIT']}</td>
    </tr>";

	echo "<tr>
        <td>Digital Logic</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['Digital_logic']}</td>
    </tr>";

	echo "<tr>
        <td>Physics</td>
		<td>100</td>
		<td>32</td>
        <td>{$row['Physics']}</td>
    </tr>";

	echo "<tr>
        <td>Total</td>
		<td>500</td>
		<td>32</td>
        <td>{$row['Physics']}</td>
    </tr>";

	echo "</table>";
	
}
$percentage = (($total / 500) * 100);
echo "Percentage: " . number_format($percentage, 2) . "%";
echo "<br><br>";
echo "Division: {$row['status']}";
?>
		</div>
	</div>
	<?php include('allfoot.php'); ?>