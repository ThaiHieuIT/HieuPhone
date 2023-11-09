<?php 
session_start();

include './config/config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiếu Phone</title>
    <link rel="stylesheet" href="bootstrap-5.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/85fe95e2ec.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="header">
        <div class="container h-100">
            <div class="row header--box">
                <div class="col-md-3">
                    <img src="././image/header/doitra.png" class="header--img" alt="">
                </div>
                <div class="col-md-3">
                    <img src="././image/header/chinhhang.png" class="header--img" alt="">
                </div>
                <div class="col-md-3">
                    <img src="././image/header/giaohang.png" class="header--img" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="navbar">
        <div class="container h-100">
            <div class="navbar-logo">
                <img src="././image/header/logo.png" class="navbar-logo--img" alt="">
            </div>
            <div class="navbar-danhmuc">
                <button class="danhmuc-content"><i class="fa-solid fa-bars danhmuc--icon"></i> Danh mục</button>
                <div class="danhmuc-list">
                    <?php
                        $cate = $conn->prepare("SELECT * FROM category");
                        $cate->execute();
                        $result = $cate->get_result();
                        while ($c = $result->fetch_assoc()) {
                            echo '<a href="" class="danhmuc-list--link"><b class="">'. $c['name'] .'</b></a>';
                        }
                    ?>          
                </div>
            </div>
            <div class="nav-search">
                <form action="" method="post" class="nav-search">
                    <button type="submit" class="nav-search--icons"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" name="search" class="search--input" placeholder="Bạn cần tìm gì?">
                </form>
            </div>
            <div class="navbar-merge navbar-phonecall">
                <a href="" class="navbar-merge--link navbar-call">
                    <div class="nav-call--boxicon"><i class="fa-solid fa-phone navbar-merge--icon nav-call--icon"></i>
                    </div>
                    <span class="navbar-merge--content nav-call--number">Gọi mua hàng <br> 1900 1808</span>
                </a>
            </div>
            <div class="navbar-merge navbar-ship">
                <a href="" class="navbar-merge--link">
                    <i class="fa-solid fa-truck-fast navbar-merge--icon"></i>
                    <span class="navbar-merge--content nav-ship--content">Tra cứu đơn hàng</span>
                </a>
            </div>
            <div class="nav-cart">
                <a href="./model/cart.php" class="nav-cart--box">
                    <div class="cart-icon">
                        <i class="fa-solid fa-cart-shopping nav-cart--icon"><span id="cart-item" class="nav-cart--number"></span></i>
                    </div>
                    <span class="cart-content">Giỏ hàng</span>
                </a>
            </div>

            <?php 
                if (isset($_SESSION["user"]["name"]) && isset($_SESSION["user"])) {
                    echo '
                        <div class="nav-login">
                            <span class="nav-login--link">
                                <span class="nav-login--content"><i class="fa-regular fa-circle-user"></i>'.$_SESSION["user"]["name"].'</span>
                            </span>
                            <div class="subnav-login">
                                <span class="user-email">'.$_SESSION["user"]["email"].'</span>
                                <button class="logout-user"><a href="./model/logout.php" class="logout-user logout-user--link">Log Out</a></button>
                            </div>
                        </div>';
                } else {
                    echo '
                        <div class="nav-login">
                            <a href="./model/login.php" class="nav-login--link">
                                <span class="nav-login--content"><i class="fa-regular fa-circle-user"></i> Login</span>
                            </a>
                        </div>';
                }
                if(isset($_SESSION["user"]["name"]) && $_SESSION["user"]["name"] == 'admin') {
                    echo '
                        <div class="nav-login-admin">
                            <a href="" class="nav-login--link">
                                <span class="nav-login--content"><i class="fa-regular fa-circle-user"></i>'.$_SESSION["user"]["name"].' Edit</span>
                            </a>
                        </div>';
                }
            ?>
        </div>
    </div>