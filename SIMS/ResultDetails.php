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
$sql = "SELECT course FROM facutlytable WHERE FID=$userid";
$res=mysqli_query($connect,$sql);
$row = mysqli_fetch_array($res);
$course = $row[0];

$sql="SELECT * FROM studenttable WHERE course='$course'";
$rs=mysqli_query($connect,$sql);


echo "<h2 class='page-header'><b>Result Details</b></h2>";
echo "<h2><b>$course</b></h2>";
echo "<table class='table table-striped' style='width:100%'>
<tr>
<th>Reg. ID</th>
<th>Enrollment Number</th>
<th>Student Name</th>
<th>First Term</th>
<th>Second Term</th>
<th>Third Term</th>
<th>Edit</th>
<th>Clear Data</th>
<th>New Result</th>		
</tr>";
while($row=mysqli_fetch_array($rs))
{
?>
			<tr>
				<td>
					<?PHP echo $row['SRegID'];?>
				</td>
				<td>
					<?PHP echo $row['Eno'];?>
				</td>
				<td>
					<?PHP echo $row['FName'];?>
				</td>
				<td>
					<?PHP echo $row['G1'];?>
				</td>
				<td>
					<?PHP echo $row['G2'];?>
				</td>
				<td>
					<?PHP echo $row['G3'];?>
				</td>
				<td>
					<a href="UpdateResultDetails.php?editid=<?php echo $row['Eno']; ?>&courseid=<?php echo $course; ?>"><input type="button" Value="Edit" class="btn btn-info btn-sm"></a>
				</td>
				<td>
					<a href="ClearDetails.php?clearid=<?php echo $row['Eno']; ?>&courseid=<?php echo $course; ?>"><input type="button" Value="Clear" class="btn btn-info btn-sm"></a>
				</td>
				<td>
					<a href="NewResult.php?resid=<?php echo $row['Eno']; ?>&courseid=<?php echo $course; ?>"><input type="button" Value="Result" class="btn btn-info btn-sm"></a>
				</td>
			</tr>

			<?php
			
			}
			?>



			</table>
		
		</div>

	</div>

	<?php include('allfoot.php');  ?>