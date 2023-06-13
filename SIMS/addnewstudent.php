<?php
session_start();

// start output buffering
ob_start();

if ( $_SESSION[ "umail" ] == "" || $_SESSION[ "umail" ] == NULL ) {
	header( 'Location:AdminLogin.php' );
}

$userid = $_SESSION[ "umail" ];
?>
<?php include('adminhead.php'); ?>

<div class="container">

	<div class="row">
		<?php
		include( "database.php" );
		if ( isset( $_POST[ 'addnews' ] ) ) {
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

			//max enrollment no
			$sql = "SELECT MAX(Eno) FROM studenttable";
			$res=mysqli_query( $connect, $sql );
			$row = mysqli_fetch_array($res);
			$max_eno = $row[0];

			//max reg no from registration table
			$sql = "SELECT MAX(RegID) FROM registrationtable";
			$res=mysqli_query( $connect, $sql );
			$row = mysqli_fetch_array($res);
			$max_regid_reg = $row[0];

			//max reg no from student table
			$sql = "SELECT MAX(SregID) FROM studenttable";
			$res=mysqli_query( $connect, $sql );
			$row = mysqli_fetch_array($res);
			$max_regid_admit = $row[0];

			//max reg number from both table
			if($max_regid_admit > $max_regid_reg){
				$max_reg = $max_regid_admit;
			}
			else{
				$max_reg = $max_regid_reg;
			}
			
			
			
			//admit student
			//give unique registration and enrollment value
			$sql = "Insert into studenttable (Eno,SRegID,FName, LName, FaName, DOB, Addrs, Gender, Course, PhNo , Eid, Pass) values ($max_eno+1,$max_reg+1,'$tempfname', '$templname', '$tempfaname', '$tempdob', '$tempaddrs' , '$tempgender', '$tempcourse' , $tempphno, '$tempeid' , '$temppass')";
			if ( mysqli_query( $connect, $sql ) ) {
				$sql ="Insert into $tempcourse (Eno,SName) values ($max_eno+1,'$tempfname')";
				mysqli_query( $connect, $sql ) ;

				//cleaning the buffer to redirect process
				ob_end_clean(); 
				header('Location:StudentDetails.php');

				exit;
			} else {
				//if sql error comes
				echo "<br><Strong>Admission Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $connect );
			}
			//close the connection flushing the buffer
			mysqli_close( $connect );
			ob_end_flush(); 
		}
		?>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h3 class="page-header">Welcome <a href="welcomeadmin">Admin</a> </h3>
			<h4 class="page-header">Add New Student Details</h4>
			<form action="" method="POST" name="updateform">
				<div class="form-group">
					<label for="First Name">First Name : </label>
					<input type="text" class="form-control" id="fname" name="fname" required>
				</div>

				<div class="form-group">
					<label for="Last Name">Last Name : </label>
					<input type="text" class="form-control" id="lname" name="lname" required>
				</div>

				<div class="form-group">
					<label for="Father Name">Father Name : </label>
					<input type="text" class="form-control" id="faname" name="faname" required>
				</div>

				<div class="form-group">
					<label for="DOB">D.O.B. : </label>
					<input type="text" class="form-control" id="dob" name="DOB" placeholder="YYYY-MM-DD" required>
				</div>

				<div class="form-group">
					<label for="Address">Address : </label>
					<input type="text" class="form-control" name="addrs" id="addrs" required>
				</div>

				<div class="form-group">
					<label for="Gender">Gender : &nbsp;</label>
					<input type="radio" name="gender" value="Male" id="Gender_0" checked> Male
					<input type="radio" name="gender" value="Female" id="Gender_1"> Female
				</div>

				<div class="form-group">
					<label for="Course">Course : </label>
					<input type="text" class="form-control" id="course" name="course" placeholder="Assign Course" required>
				</div>

				<div class="form-group">
					<label for="Phone Number">Phone Number : </label>
					<input type="tel" class="form-control" id="phno" name="phno" maxlength="10" required>
				</div>

				<div class="form-group">
					<label for="email">Email address:</label>
					<input type="email" class="form-control" name="email" placeholder="John@example.com" id="email" required>
				</div>

				<div class="form-group">
					<label for="Password">Password : </label>
					<input type="password" class="form-control" id="pass" name="pass" placeholder="Type Strong Password" required>
				</div>

				<div class="form-group">
					<input type="submit" value="Admission Confirm!" name="addnews" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	<?php include('allfoot.php'); ?>