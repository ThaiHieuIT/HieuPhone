<?php 
    session_start(); 
    $servername = "localhost:3306";
    $database = "hieuphone";
    $username = "root";
    $password = "180803";
    $charset = "utf8mb4";
    $connect = mysqli_connect($servername,$username,$password,$database);
    mysqli_set_charset($connect, $charset);
    function redirect($message,$url) {
        $_SESSION['message'] =$message;
        header('Location: ' . $url);
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../bootstrap-5.3.1/css/bootstrap.min.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>
    
    <?php

        // LOGIN CODE
        if(isset($_POST["signin"])){
			$email = $_POST["email_user"];
			$pass = $_POST["pass"];

            $user = mysqli_query( $connect ,"SELECT * FROM $database.user WHERE email = '$email' AND pass = '$pass'");
            $user_info = mysqli_fetch_array( $user);
            $count = mysqli_num_rows($user); 
			if($count > 0){
                $_SESSION["user"]["id"] = $user_info['id'];
                $_SESSION["user"]["name"] = $user_info['name'];
                $_SESSION["user"]["email"] = $user_info['email'];
                header("Location: ../index.php");
			}
			else{
                redirect("Sai Mật Khẩu Hoặc Email", "login.php");
			}
		}

        // SIGN UP CODE

        if(isset($_POST["signup"])){
			$user_name = $_POST["name"];
			$pass1 = $_POST["pass1"];
			$pass2 = $_POST["pass2"];
			$email = $_POST["email"];
            $check_email = mysqli_query($connect, "SELECT email FROM $database.user where email = '$email'");
            $count = mysqli_num_rows($check_email); 
            
			if($pass1 != $pass2 || $count > 0){
				header("location: login.php");
                redirect("Đăng kí không thành công!", "login.php");
			}
			else{
				mysqli_query($connect,"insert into $database.user (name,pass,email) values ('$user_name','$pass1','$email')");

				header("location: login.php");
                redirect("Đăng kí thành công!", "login.php");
			}
        }

    ?>

    <?php 
        if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
    <?php
        unset($_SESSION['message']);
        }
    ?>

    <div class="container" id="container" style="height: 700px">

        <!-- SIGN UP -->
        <div class="form-container sign-up">
            <form action="" method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="pass1" placeholder="Mật Khẩu">
                <input type="password" name="pass2" placeholder="Nhập Lại Mật Khẩu">
                <button type="submit" name="signup">Sign Up</button>
                <a href="../index.php">Trang Chủ</a>

            </form>
            <?php
				if(isset($_COOKIE["error"])){
			?>
				<div class="alert alert-danger">
				  	<strong>Có lỗi!</strong> <?php echo $_COOKIE["error"]; ?>
				</div>
			<?php } ?>
        </div>
        <!-- LOGIN -->
        <div class="form-container sign-in">
            <form action="" method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email_user" placeholder="Email">
                <input type="password" name="pass" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="signin">Sign In</button>
                <a href="../index.php">Trang Chủ</a>
            </form>
        </div>


        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/login.js"></script>
    <script src="../bootstrap-5.3.1/js/bootstrap.min.js"></script>
</body>

</html>


