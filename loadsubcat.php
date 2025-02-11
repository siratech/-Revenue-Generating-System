<?php 
include('database/conn.php'); 

 		if(isset($_GET['parent_cat'])){
$parent_cat = $_GET['parent_cat'];

$query = mysqli_query($conn,"SELECT * FROM vehicletyle WHERE RegType_idRegType = {$parent_cat}");
	echo "<option selected='selected' disabled='disabled' value=''>Select Vehicle Type</option>";

while($row = mysqli_fetch_array($query)) {
	
	echo "<option value='$row[id]'>$row[type]</option>";
	
}	
		}


		if(isset($_GET['asdf_cat'])){
$asdf_cat = $_GET['asdf_cat'];

$query = mysqli_query($conn,"SELECT amount,value FROM vehicletyle WHERE id = {$asdf_cat}");
while($row = mysqli_fetch_array($query)) {
	
	echo "<option value='$row[value]'>$row[amount]</option>";
	
}
		}

?>