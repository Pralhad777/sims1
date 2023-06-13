<?php
session_start();

if ( $_SESSION[ "sidx" ] == "" || $_SESSION[ "sidx" ] == NULL ) {
	header( 'Location:studentlogin' );
}
$userid = $_SESSION[ "sidx" ];
$userfname = $_SESSION[ "fname" ];
$userlname = $_SESSION[ "lname" ];
?>
<?php
// place to retrive the data
// data is given here
include('database.php');
$eno=$_GET['seno'];
echo $eno;
//getting course,G1,G2,failures
$sql = "SELECT * FROM studenttable WHERE Eno=$eno";
$res=mysqli_query( $connect, $sql );
$row = mysqli_fetch_array($res);
$course = $row['Course'];
$G1 = $row['G1'];
$G2 = $row['G2'];
$G2_c = $G2;
$failures = $row['failures'];
//to get advice
if ($G2 === NULL) { // test if $G2 is NULL
	$G2 = $G1; // assign $G1 to $G2
  }

//getting absences
$sql = "SELECT * FROM $course WHERE Eno=$eno";
$res=mysqli_query( $connect, $sql );
$row = mysqli_fetch_array($res);

$absences = $row['absences'];

?>


<?php include('studenthead.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
		<h3><b>Welcome <a href="welcomestudent.php" <?php echo "<span style='color:red'>".$userfname." ".$userlname."</span>";?></b></a></h3>

<?php	
echo "<h2 class='page-header'><b>Student Advice</b></h2>";
//echo $failures;
//echo $absences;
?>
<style>
td:first-child {
  width: 150px;
  padding-right: 20px;
}
</style>
<table style="font-size: 16px;">
	<tr>
		<td><b>First Term</b></td>
		<td><?php echo $G1; ?></td>
	</tr>
	<tr>
		<td><b>Second Term</b></td>
		<td><?php echo $G2_c; ?></td>
	</tr>
	<tr>
		<td><b>Failure</b></td>
		<td><?php echo $failures; ?></td>
	</tr>
	<tr>
		<td><b>Absences</b></td>
		<td><?php echo $absences; ?></td>
	</tr>
</table>
<br><p style="font-size: 16px;"></p>
	<div id="pre" style="font-size: 16px;"></div>

    <br><p style="font-size: 16px;"></p>
	<div id="advice" style="font-size: 16px;"></div>

	<script>
	  // request from php page to api 
    //api at local server
	  fetch('http://localhost:5000/predict', {
	    method: 'POST',
      headers: {
	      'Content-Type': 'application/json'
	    },
	    body: JSON.stringify({
	      G1: <?php echo $G1/5; ?>,
	      G2: <?php echo $G2/5; ?>,
		  failures: <?php echo $failures/5; ?>,
	      absences: <?php echo $absences/5; ?>
	    }),
	    
	  })
	  .then(response => response.json())
	  .then(data => {
	    // responce is written to page
		var pre = data.pre;
		pre = pre*5;
		var advice = data.advice;
		var advice_lines = advice.split(/[.,]\s*/);
		var formatted_advice = "<ul style='list-style-type:none;'>";
		for (var i = 0; i < advice_lines.length; i++) {
			var capitalized = advice_lines[i].charAt(0).toUpperCase() + advice_lines[i].slice(1);

			if (i < advice_lines.length - 1) {
				var capitalized = advice_lines[i].charAt(0).toUpperCase() + advice_lines[i].slice(1);
 				 formatted_advice += '<li style="padding-left:1.2em;">&bull; ' + capitalized + '.</li>';
}
			else {
				formatted_advice += capitalized + ".";
			}
		}
		formatted_advice += "</ul>";
		document.getElementById('pre').innerHTML ="Predicted Marks :\n"+ pre;
		document.getElementById('advice').innerHTML ="Advice:\n" +formatted_advice;
	  });
	</script>

</div>
	</div>

	<?php include('allfoot.php'); ?>



