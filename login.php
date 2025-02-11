<?php
	include('database/conn.php');
	session_start();
   $_SESSION["login_time_stamp"] = time();	
   
	function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username=check_input($_POST['username']);
		
			
		$fusername=$username;
		
		$password = check_input($_POST["password"]);
		$fpassword=md5($password);
		
		$query=mysqli_query($conn,"select * from `user` where username='$fusername' and password='$fpassword'");

		if(mysqli_num_rows($query)==0){
			$_SESSION['msg'] = "Login Failed, Invalid Input!";
			header('location: index.php');
		}
		else{
			
			$row=mysqli_fetch_array($query);
			if ($row['access']=="ADMIN"){
				$_SESSION['id']=$row['userid'];
				header('location: admin/index.php');
			}
			elseif ($row['access']=="USER"){
				$_SESSION['id']=$row['userid'];
				header('location: user/index.php');
			}
			elseif ($row['access']=="DATAENTRY"){
				$_SESSION['id']=$row['userid'];
				header('location: dataentry/index.php');
			}
			else{
				?>
				<script>
					window.alert('Login Failed, User is Invalid!');
					window.location.href='index.php';
				</script>
				<?php
			}
		}
		
	}
?>