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

//getting teacher name
$sql = "SELECT * FROM facutlytable WHERE course='$course'";
$res=mysqli_query( $connect, $sql );

echo "<h2 class='page-header'><b>Teacher List</b></h2>";

//Creating table for tacher list
echo "<table class='table table-striped' style='width:100%'>
				<tr>
					<th>Teacher ID</th>
                    <th>Name</th>
                    <th>Phone No.</th>
					
				<tr>";
                while ( $row = mysqli_fetch_array( $res ) ) {
                    ?>
<form action="rating.php?rid=<?PHP echo $row['FID'];?>&seno=<?PHP echo $seno;?>" method="POST" name="rate">
    <tr>
        <td><?PHP echo $row['FID'];?></td>
        <td><?PHP echo $row['FName'];?></td>
        <td><?PHP echo $row['PhNo'];?></td>
    
    </tr>
</form>

             <?php 
			 }
              ?>
			</table>



</div>
</div>
 
<?php include('allfoot.php'); ?>