<?php
include('connection.php');

if(isset($_POST['checkbox'])){
	foreach($_POST['checkbox'] as $list){
		$id=mysqli_real_escape_string($con,$list);

		$kk = "UPDATE `attendancee` SET `isattendance`='0' WHERE `id` = '$id';";
     

		if(mysqli_query($con, $kk)){
			$result = mysqli_query($con, $kk);
		} else{
			echo "Error: ".mysqli_error($con);  
		} 
	} 
	echo "<script>" . "window.location.href='trash_attendance.php';" . "</script>"; 
}
?>
