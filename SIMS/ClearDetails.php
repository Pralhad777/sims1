<?php
include('database.php');
$clearid=$_GET['clearid'];
$courseid = $_GET['courseid'];

//clear student history from  studenttable and bit
//UPDATE students SET address = NULL WHERE age = 18;
//UPDATE studenttable SET G1 = 90, G2 = 85, G3 = 95 WHERE eno = 123;

$sql = "UPDATE studenttable SET G1=NULL, G2=NULL, G3=NULL WHERE eno = $clearid";
mysqli_query( $connect, $sql );

if($courseid=='bit'){
    $sql = "UPDATE $courseid SET `Math`=NULL, `C`=NULL,`status`=NULL,`Digital_logic`=NULL,`Sociology`=NULL,`IIT`=NULL,`absences`=NULL WHERE `eno` = $clearid";
    mysqli_query( $connect, $sql );
}

if($courseid=='csit'){
    $sql = "UPDATE $courseid SET `Math`=NULL, `C`=NULL,`status`=NULL,`Digital_logic`=NULL,`Physics`=NULL,`IIT`=NULL, `absences`=NULL WHERE `eno` = $clearid";
    mysqli_query( $connect, $sql );
}
//closing connection and redirecting to original page
mysqli_close($connect);
header( 'Location:ResultDetails.php' );

?>