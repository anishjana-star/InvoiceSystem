<?php
	session_start();
	
	$conn = new mysqli('localhost','root','','simpleinvoicephp');
	
	$unsuccessfulmsg = '';

	if(isset($_POST['submit'])){
		$users_email 			= $_POST['users_email'];
		$users_password 		= $_POST['users_password'];
		$passwordmd5 	= md5($users_password);
		
		if(empty($users_email)){
			$emailmsg = 'Enter an email.';
		}else{
			$emailmsg = '';
		}
		
		if(empty($users_password)){
			$passmsg = 'Enter your password.';
		}else{
			$passmsg = '';
		}
		
		if(!empty($users_email) && !empty($users_password)){
			$sql = "SELECT * FROM users WHERE users_email='$users_email' AND users_password = '$passwordmd5'";
			$query = $conn->query($sql);
			
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
				$users_first_name = $row['users_first_name'];
				$users_last_name = $row['users_last_name'];
				
				$_SESSION['users_last_name'] = $users_last_name;
				$_SESSION['users_first_name'] = $users_first_name;
				header('location:dashboard.php');
			}else{
				$unsuccessfulmsg = 'Wrong email or Password!';
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
	</head>
	
    <body>
    <h2>Create Account</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>