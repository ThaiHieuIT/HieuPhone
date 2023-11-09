<?php
    require './config/config.php';


    if(isset($_POST['pid'])) {
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];
        $pcode = $_POST['pcode'];
        $pqty = 1;

        $stmt = $conn->prepare("SELECT product_code FROM $database.cart WHERE product_code = ?");
        $stmt->bind_param("s", $pcode);
        $stmt->execute();
        $res = $stmt->get_result();
        $code = $res->fetch_assoc();

        if(!$code) {
            $query = $conn->prepare("INSERT INTO $database.cart (product_name,product_price,product_image,quantity,total_price,product_code) VALUE (?,?,?,?,?,?)");
            $query->bind_param("sssiss", $pname, $pprice, $pimage,$pqty,$pprice,$pcode);
            $query->execute();

            echo '<div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
              Đã thêm vào giỏ hàng!
            </div>';
        } else {
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Sản phẩm đã tồn tại !
            </div>';
        }
    }

    if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
      $stmt = $conn->prepare('SELECT * FROM cart');
      $stmt->execute();
      $stmt->store_result();
      $row = $stmt->num_rows();

      echo $row;
    }

    
	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:./model/cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:./model/cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}
?>