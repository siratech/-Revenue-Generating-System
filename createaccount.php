<?php 
	ob_start();
	include 'database/conn.php';  
	
	
	
	
	if(isset($_POST['submit'])){

		$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
		$phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		$hometwon = mysqli_real_escape_string($conn, $_POST['hometwon']);
        $homeaddr = mysqli_real_escape_string($conn, $_POST['homeaddr']);

		$vehiclemake = mysqli_real_escape_string($conn, $_POST['vehiclemake']);
		$vehicletype = mysqli_real_escape_string($conn, $_POST['vehicletype']);
		$regtype = mysqli_real_escape_string($conn, $_POST['regtype']);
        $amount_to_pay = mysqli_real_escape_string($conn, $_POST['amount_to_pay']);
		
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
		$realusername = $email;
		$sq=mysqli_query($conn,"select * from `user` where user_email='".$email."'");
		$srow=mysqli_fetch_array($sq);
	
	$useremail=$srow['user_email'];
	
	//echo $useremail;
	//exit();
		
		
	if($useremail != $email){
		if($cpassword == $password){	
		echo "is this";
			//Check if user already exists
			$u_check =  mysqli_query($conn, "SELECT username FROM user WHERE username = '$realusername'");
	
					
			//Count the amount of rows where username = $username
			$check_user = mysqli_num_rows($u_check);
			ob_end_clean();	
			if ($check_user == 0) {

				$password = md5($password);
				$ministry = "USER";
				$query = mysqli_query($conn, "INSERT INTO user (`username`,`password`, `access`, `user_email`, `emp_name`) VALUES ('$realusername','$password', '$ministry', '$email', '$fullname')");
				//$querycount = mysqli_num_rows($conn, $query);
              
						$pid=mysqli_insert_id($conn);
              
					mysqli_query($conn, "INSERT INTO `vehicleusertbl` (`user_login_id`, `fullname`, `phoneno`, `email`, `gender`, `hometwon`, `homeaddr`, `vehiclemake`, `vehicletype`, `regtype`, `amount_to_pay`, `reg_date`, `payment_ref`, `payment_status`, `reg_status`) VALUES ('$pid', '$fullname', '$phoneno', '$email', '$gender', '$hometwon', '$homeaddr', '$vehiclemake', '$vehicletype', '$regtype', '$amount_to_pay', current_timestamp(), '', '0', 'Reg')");

  					//mysqli_query($conn, "INSERT INTO vehicleusertbl (`user_login_id`, `fullname`, `phoneno`, `email`, `gender`, `hometwon`, `homeaddr`, `vehiclemake`, `vehicletype`, `regtype`, `amount_to_pay`, `reg_date``, `payment_ref`, `payment_status`, `reg_status`)   VALUES ('$pid','$fullname', '$phoneno','$email','$gender', '$hometwon','$homeaddr','$vehiclemake','$vehicletype','$regtype', '$amount_to_pay', '', '', '0', 'Reg'");            
              
              //echo $pid;
              //exit();
              
       

				ob_end_clean();			
				if($query){

					//echo json_encode(array("status" => "Success"));
							echo "<script>
			window.alert('Account Createted successfully!');
			window.open('index.php','_self');
		</script>";
					
					exit();			
				} else {
					
					//echo json_encode(array("status" => "failed"));
							echo "<script>
			window.alert('Account Creation Failed...');
			window.history.back();
		</script>";
					exit();
				}

			} else {
				//echo json_encode(array("status" => "exists"));
						echo "<script>
			window.alert('Username or Email Already Exists...');
			window.history.back();
		</script>";
				exit();
			}
		}else {
					
					//echo json_encode(array("status" => "failed"));
							echo "<script>
			window.alert('Confirm Password Failed...');
			window.history.back();
		</script>";
					exit();
				}		
				}else {
					
					//echo json_encode(array("status" => "failed"));
							echo "<script>
			window.alert('Username or Email Already Exists...');
			window.history.back();
		</script>";
					exit();
				}
	}



?>