<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   

   $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND pass = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = '!این نام کاربری قبلا استفاده شده است';
   }else{
      if($pass != $cpass){
         $message[] = '!رمزعبور اشتباه می باشد';
      }else{
         mysqli_query($conn, "INSERT INTO `user`(name, email, pass) VALUES('$name', '$email', '$cpass')") or die('query failed');
         $message[] = '!ثبت نام با موفقیت انجام شد';
         header('location:login.php');
      }
   }

}

?>
<!DOCTYPE html>
<html lang="en" >
<head>

  <meta charset="UTF-8">
  <title>ثبت نام</title>
  <link rel="shortcut icon" href="./images/logo.PNG">

  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
<style>


@import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

* {
	direction:rtl ;
	box-sizing: border-box;
	margin: 0;
	padding: 0;	
	font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

body {
	
	background: #c8b393;	
}

.container {
	
	display: flex;
    flex-direction: row-reverse;
    margin-top: 50px;
	
}

.screen {		
	background: linear-gradient(90deg, #472b02, #c8b393);		
	position: relative;	
	height: 650px;
	width: 500px;	
	box-shadow: 0px 0px 24px #472b02;
	
}

.screen__content {
	z-index: 1;
	position: relative;	
	height: 100%;
}

.screen__background {		
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
	-webkit-clip-path: inset(0 0 0 0);
	clip-path: inset(0 0 0 0);	
}

.screen__background__shape {
	transform: rotate(45deg);
	position: absolute;
}

.screen__background__shape1 {
	height: 580px;
	width: 620px;
	background: #FFF;	
	top: 2px;
	left: 130px;	
	border-radius: 0 0 0 72px;
}

.login {
	width: 320px;
	padding: 30px;
	padding-top: 156px;
}

.login__field {
	padding: 20px 0px;	
	position: relative;	
	width: 100%;
}

.login__icon {
	position: absolute;
	top: 30px;
	color: #0eae4d;
}

.login__input {
	border: none;
	border-bottom: 2px solid #D1D1D4;
	background: none;
	padding: 10px;
	padding-right: 24px;
	font-weight: 700;
	width: 75%;
	transition: .2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
	outline: none;
	border-bottom-color: #835107;
}

.login__submit {
	background: #fff;
	font-size: 14px;
	margin-top: 30px;
	margin-bottom: 30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 100%;
	color: #472b02;
	box-shadow: 0px 2px 2px #835107;
	cursor: pointer;
	transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
	border-color: #835107;
	outline: none;
}

.button__icon {
	font-size: 24px;
	margin-right: auto;
	color: #875408;
}


.signin__submit {
	background: #fff;
	font-size: 14px;
	margin-top: 30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 55%;
	color: #472b02;
	box-shadow: 0px 2px 2px #835107;
	cursor: pointer;
	transition: .2s;
}

.signin__submit:active,
.signin__submit:focus,
.signin__submit:hover {
	border-color: #835107;
	outline: none;
}

.social-login {	
	position: absolute;
	height: 140px;
	width: 160px;
	text-align: center;
	bottom: 0px;
	left: 0px;
	color: #0eae4d;
}

.social-icons {
	display: flex;
	align-items: center;
	justify-content: center;
}

.social-login__icon {
	padding: 20px 10px;
	color: #fff;
	text-decoration: none;	
	text-shadow: 0px 0px 8px #835107;
}

.social-login__icon:hover {
	transform: scale(1.5);	
}

  
  .img-restaurant {
    margin-right: 10px;
    width: 80%;
    height: 400px;
margin-top: 100px;
    overflow: hidden;
    position: relative;
	border-radius: 12px;
  }
  .row {
	display: flex;
  }
  #vorod
  {
	color: #078138;
  }
 
</style>
</head>
<body>
	<?php
	if(isset($message)){
	   foreach($message as $message){
		  echo '
		  <div class="message">
			 <span>'.$message.'</span>
			 <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
		  </div>
		  ';
	   }
	}
	?>



	 
<div class="container">
	<div class="row">
		<div class="img-restaurant">
		  <img src="./images/aboutus/aboutus.PNG" alt="Restaurant">
		</div>
  </div>
  
	<div class="screen">
		<div class="screen__content">
			<form class="login" action="" method="post" >
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="name" class="login__input" placeholder="نام کاربری موردنظر را وارد کنید">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-envelope"></i>
					<input type="email" name="email" class="login__input" placeholder="ایمیل خود را وارد کنید" required>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" class="login__input" placeholder="رمز عبور موردنظر خود را وارد کنید" required>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="cpassword" class="login__input" placeholder="رمز عبور خود را دوباره وارد کنید" required>	
				</div>
				<!-- <div class="login_submit">
					<span class="button__text">تایید و ثبت نام</span>
					<i class="button__icon fas fa-chevron-left"></i>
					<a href="./login.html">
						<button class="submit">
							<span>قبلا ثبت نام کرده ام </span>
					</button></a> -->
				
			
					<input type="submit" name="submit"  class="login__submit" value="تایید و ثبت نام">
				
					<p> قبلا ثبت نام کرده اید؟<a href="login.php" id="vorod">ورود</a></p>

				
			</form>


			<div class="social-login">
				<h3>سفارش از سایر راه ها</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"><i class="fa fa-instagram" style="font-size:36px"></i></a>
					<a href="#" class="social-login__icon fab fa-whatsapp"><i class="fa fa-whatsapp" style="font-size:36px"></i> </a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>
	</div>
	

</body>
</html>
