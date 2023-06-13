<?php
session_start();
// start output buffering
ob_start(); 

if ( $_SESSION[ "umail" ] == "" || $_SESSION[ "umail" ] == NULL ) {
	header( 'Location:RegestrationDetails.php' );
}

$userid = $_SESSION[ "umail" ];
?> 
<?php include('adminhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 class="page-header">Welcome <a href="welcomeadmin">Admin</a> </h3>
			<h4 class="page-header">Edit any details if require</h4>
			<?php
			include( "database.php" );
			$new4 = $_GET[ 'addnewRegId' ];

			$sql = "select * from  registrationtable where RegID=$new4";
			$result = mysqli_query( $connect, $sql );

			while ( $row = mysqli_fetch_array( $result ) ) {
				?>
			<form action="" method="POST" name="updateform">
				<div class="form-group">
					Reg ID : <br><br><input type="text" name="regid" value="<?php echo $row['RegID']; ?>" readonly>
				</div>
				<div class="form-group">
					First Name :<br><br><input type="text" name="fname" value="<?php echo $row['FName']; ?>">
				</div>
				<div class="form-group">
					Last Name : <br><br><input type="text" name="lname" value="<?php echo $row['LName']; ?>"><br>
				</div>
				<div class="form-group">
					Father Name :<br><br> <input type="text" name="faname" value="<?PHP echo $row['FaName'];?>"><br>
				</div>
				<div class="form-group">
					Course :<br><br> <input type="text" name="course" value="<?PHP echo $row['Course'];?>"><br>
				</div>
				<div class="form-group">
					D.O.B. : <br><br><input type="text" name="DOB" value="<?PHP echo $row['DOB'];?>"><br>
				</div>
				<div class="form-group">
					Addres : <br><br><input type="text" name="addrs" value="<?PHP echo $row['Addrs'];?>"><br>
				</div>
				<div class="form-group">
					Gender : <br><br><input type="text" name="gender" value="<?PHP echo $row['Gender'];?>"><br>
				</div>

				<div class="form-group">
					Phone Number :<br><br> <input type="tel" name="phno" value="<?PHP echo $row['PhNo'];?>" maxlength="10"><br>
				</div>
				<div class="form-group">
					Email :<br><br><input type="text" name="email" value="<?PHP echo $row['Eid'];?>"><br>
				</div>
				<div class="form-group">
					Password :<br><br> <input type="text" name="pass" value="<?PHP echo $row['Pass'];?>"><br>
				</div><br>
				<div class="form-group">
					<input type="submit" value="Admission Confirm!" name="addnew" class="btn btn-primary">

			</form>
			<?php
			}
			?>

			<?php
			
			if ( isset( $_POST[ 'addnew' ] ) ) {
				$tempregid = $_POST[ 'regid' ];
				$tempfname = $_POST[ 'fname' ];
				$templname = $_POST[ 'lname' ];
				$tempfaname = $_POST[ 'faname' ];
				$tempdob = $_POST[ 'DOB' ];
				$tempaddrs = $_POST[ 'addrs' ];
				$tempgender = $_POST[ 'gender' ];
				$tempcourse = $_POST[ 'course' ];
				$tempphno = $_POST[ 'phno' ];
				$tempeid = $_POST[ 'email' ];
				$temppass = $_POST[ 'pass' ];
				//insert data to student table in database
				$sql = "Insert into studenttable (FName, LName, FaName, DOB, Addrs, Gender, Course, PhNo , Eid, Pass, SRegID) values ('$tempfname', '$templname', '$tempfaname', '$tempdob', '$tempaddrs' , '$tempgender', '$tempcourse' , $tempphno, '$tempeid' , '$temppass', $tempregid)";
				if ( mysqli_query( $connect, $sql ) ) {
					ob_end_clean(); // clear the output buffer
					$sql="DELETE FROM `registrationtable` WHERE RegID = $tempregid";
					mysqli_query( $connect, $sql );

					//getting course type
					$sql = "SELECT Eno FROM studenttable WHERE SRegID=$tempregid";
					$res=mysqli_query( $connect, $sql );
					$row = mysqli_fetch_array($res);
					$eno = $row[0];
					echo $eno;

					//inserting the data in course table
					$sql = "INSERT INTO $tempcourse (`Eno`, `Sname`, `Math`, `C`, `IIT`,`Physics`,`Digital_logic`,`status`,`absences`) VALUES ($eno, '$tempfname', NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
					mysqli_query( $connect, $sql );

					header("Location:RegestrationDetails.php?eno=$eno");
				
					echo "
					<br><br>
					<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Success!</strong> Admission Confirm.
					</div>
					";
					exit;
					
				} else {
					ob_end_clean(); // clear the output buffer
					// print error mmessege if SQL query fail.
					echo "Error: " . $sql . "<br>" . mysqli_error( $connect );
				}
				//use for close the conection
				mysqli_close( $connect );
				ob_end_flush(); // flush the output buffer

			}

			?>
			</div>
		</div>

		<?php include('allfoot.php'); ?>