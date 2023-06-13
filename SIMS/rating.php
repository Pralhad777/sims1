<?php
$seno = $_GET['seno'];

if(isset($_POST['rate'])){
$rate = $_POST['rate'];}
$rid=$_GET['rid'];

if($rate=='a'){
    $en_rate =5;
}
if($rate=='b'){
    $en_rate =4;
}
if($rate=='c'){
    $en_rate =3;
}
if($rate=='d'){
    $en_rate =2;
}
if($rate=='e'){
    $en_rate =1;
}
include('database.php');

//retriving original data
$sql = "SELECT rating FROM facutlytable WHERE FID=$rid";
$res=mysqli_query($connect,$sql);
$row = mysqli_fetch_array($res);
$rating = $row[0];

//generating average and updating rating
$new_rating = ($rating+$en_rate)/2;
$sql = "UPDATE facutlytable SET rating=$new_rating WHERE FID=$rid";
$res=mysqli_query($connect,$sql);

//closing the database redirecting to original page
mysqli_close( $connect );  
header( "Location:yourteacher.php?seno={$seno}" ); 

?>
