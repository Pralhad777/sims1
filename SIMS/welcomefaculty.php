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
		<div class="col-md-8">
			<!--Welcome page for faculty-->
			<h3> <b>Welcome Teacher : <a href="welcomefaculty.php" ><span style="color:#FF0004"> <?php echo $fname; ?></span></b></a> </h3>

			<a href=""><button  href="" type="submit" class="btn btn-primary">Exam Details</button></a>
			<a href="ResultDetails.php"><button  href="" type="submit" class="btn btn-primary">Result</button></a>
			<a href="yourdetails.php"> <button  href="" type="submit" class="btn btn-primary">Your Details</button>
			<a href="qureydetails.php"> <button  href="" type="submit" class="btn btn-primary">Query</button>
			   
			<a href="logoutfaculty"><button  href="" type="submit" class="btn btn-danger">Logout</button></a>

		</div>
		<?php 

include('database.php');
$sql = "SELECT course FROM facutlytable WHERE FID=$userid";
$res=mysqli_query($connect,$sql);
$row = mysqli_fetch_array($res);
$course = $row[0];

$sql="SELECT * FROM $course";
$rs=mysqli_query($connect,$sql);

echo "<br><br><br><br><br><br><h2 ><b>Result Overview</b></h2>";
echo "<h2><b>$course</b></h2>";
echo "<table class='table table-striped' style='width:50%'>
<tr>
<th>Enrollment Number</th>
<th>Student Name</th>
<th>Status</th>
	
</tr>";
while($row=mysqli_fetch_array($rs))
{
?>
			<tr>
				<td>
					<?PHP echo $row['Eno'];?>
				</td>
				<td>
					<?PHP echo $row['Sname'];?>
				</td>
				<td>
					<?PHP echo $row['status'];?>
				</td>
			</tr>

			<?php
			
			}
			?>



			</table>
		
		</div>

	</div>

	</div>
	<?php include('allfoot.php');  ?>

