<?php
session_start();

if ( $_SESSION[ "umail" ] == "" || $_SESSION[ "umail" ] == NULL ) {
	header( 'Location:AdminLogin.php' );
}
$userid = $_SESSION[ "umail" ];
?>
<!DOCTYPE  HTML>
<?php include('adminhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<!--Welcome page for admin-->
			<h3><b> Welcome <a href="welcomeadmin">Admin</a><b></h3>

			<a href="RegestrationDetails"> <button type="submit"  class="btn btn-primary">Registration Details</button></a>

			<a href="StudentDetails"><button  href="" type="submit" class="btn btn-primary">Student Details</button></a>

			<a href="FacultyDetails"><button  href="" type="submit" class="btn btn-primary">Teachers Details</button></a>


			<a href="logoutadmin"><button  href="" type="submit" class="btn btn-danger">Logout</button></a>

		</div>
	</div>
	<?php include('allfoot.php'); ?>