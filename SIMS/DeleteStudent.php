<?php
include( "database.php" );
$eno = $_GET['eno'];

// extracting curse of student
$sql = "SELECT Course FROM studenttable WHERE Eno=$eno";
$res=mysqli_query( $connect, $sql );
$row = mysqli_fetch_array($res);
$course = $row[0];


//Delete from main table
$sql = "DELETE FROM studenttable WHERE Eno = $eno;";
mysqli_query( $connect, $sql );

//delete from course
$sql = "DELETE FROM $course WHERE Eno = $eno;";
mysqli_query( $connect, $sql );

//close the connection and redirect
mysqli_close( $connect );
header('Location:StudentDetails.php');



?>