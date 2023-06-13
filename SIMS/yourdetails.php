<?php
session_start();

if ( $_SESSION[ "fidx" ] == "" || $_SESSION[ "fidx" ] == NULL ) {
	header( 'Location:facultylogin' );
}

$userid = $_SESSION[ "fidx" ];
$fname = $_SESSION[ "fname" ];
?>
<?php include('fhead.php');  ?>
<div class="container">
	<div class="row">

	</div>
	<div class="row">
		<div class="col-md-8">
			<h3><b> Welcome Teacher : <a href="welcomefaculty.php" ><span style="color:#FF0004"> <?php echo $fname; ?></span></b></a> </h3>
			
            <?php 

include('database.php');
$sql = "SELECT * FROM facutlytable WHERE FID=$userid";
$res=mysqli_query($connect,$sql);
$row = mysqli_fetch_array($res);

echo "<h2 class='page-header'><b>Personal Information</b></h2>";
echo "<h2><b>{$row['course']}</b></h2>";

//table
echo "<table class='table table-striped' style='width:50%'>
    <tr>
        <td>ID</td>
        <td>{$row['FID']}</td>
    </tr>";

	echo "<tr>
        <td>Joined Date</td>
        <td>{$row['JDate']}</td>
    </tr>";
	echo "<tr>
        <td>Phone Number</td>
        <td>{$row['PhNo']}</td>
    </tr>";

	echo "<tr>
        <td>Password</td>
        <td>{$row['Pass']}</td>
    </tr>";

	echo "</table>";
	

?>
		</div>

</div>

<?php include('allfoot.php');  ?>