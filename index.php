<?php 
session_start();
include('header.php');
$loginError = '';
if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
	include 'Invoice.php';
	$invoice = new Invoice();
	$user = $invoice->loginUsers($_POST['email'], $_POST['pwd']); 
	if(!empty($user)) {
		$_SESSION['user'] = $user[0]['first_name']."".$user[0]['last_name'];
		$_SESSION['userid'] = $user[0]['id'];
		$_SESSION['email'] = $user[0]['email'];		
		$_SESSION['address'] = $user[0]['address'];
		$_SESSION['mobile'] = $user[0]['mobile'];
		header("Location:invoice_list.php");
	} else {
		$loginError = "Invalid email or password!";
	}
}
?>
<title>SMR Invoice System</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<style type="text/css">
	.form-control {
    height: 46px;
    border-radius: 46px;
    border: none;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    margin-top: 1.5rem;
    background: rgb(213, 211, 222);
}
</style>
<div class="row" style="background: #0C0908;">	
	<div class="demo-heading">
		<h2 class="text-white text-center">SMR Invoice System</h2>
	</div>
	<div class="login-form text-center">		
		<h4>User Login</h4>		
		<form method="post" action="">
			<div class="form-group">
			<?php if ($loginError ) { ?>
				<div class="alert alert-warning"><?php echo $loginError; ?></div>
			<?php } ?>
			</div>
			<div class="form-group">
				<input name="email" id="email" type="email" class="form-control" placeholder="Email"  required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="pwd" placeholder="Password"  required>
			</div>  
			<div class="form-group">
				<button type="submit" name="login" class="btn btn-success">Login</button>
			</div>
			
		</form>
		<br>
		 <!-- <p><b>Email</b> : demo@demo.com<br><b>Password</b> : pass</p>		 -->
		 <div class="form-group">
			<form action="signup.php" method="GET">
			    <button type="submit" name="register" class="btn btn-primary">Create Account</button>
			</form>
			</div>
	</div>		
</div>		
</div>
<?php include('footer.php');?>