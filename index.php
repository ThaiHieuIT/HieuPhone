

<?php include 'components/header.php'; ?>



<div class="container-fluid banner">
  <div class="row">
    <div class="col-10">
      <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./image/banner/banner1.avif" class="d-block w-100 banner__img" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./image/banner/banner2.avif" class="d-block w-100 banner__img" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./image/banner/banner3.avif" class="d-block w-100 banner__img" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</div>
<div id="message"></div>
<div class="container product">
  <div class="row product__box">
    <?php
                $cate = $conn->prepare("SELECT * FROM category");
                $cate->execute();
                $result = $cate->get_result();

                while ($c = $result->fetch_assoc()) {
                    echo "<h1 class='title-category'>" . $c['name'] . "</h1>";
                    
                    $prod = $conn->prepare("SELECT * FROM product WHERE idcategory = $c[id]");
                    $prod->execute();
                    $resultp = $prod->get_result();

                    while ($p = $resultp->fetch_assoc()) {
                      ?>
                        <div class='col-5 col-lg-3 productitem'>
                          <img src='./image/product/<?= $p['image']?>' class='product__img'>
                          <h5 class='product__name'><?= $p['name']?></h5>
                          <span class='product__price'><?= number_format($p['price'])?> VNĐ</span>
                          <form action="" class="form-submit">
                            <input type="hidden" class="pid" value="<?= $p['idproduct'] ?>">
                            <input type="hidden" class="pname" value="<?= $p['name'] ?>">
                            <input type="hidden" class="pprice" value="<?= $p['price'] ?>">
                            <input type="hidden" class="pimage" value="<?= $p['image'] ?>">
                            <input type="hidden" class="pcode" value="<?= $p['product_code'] ?>">
                            <?php 
                              if(isset($_SESSION["user"]["id"])) {
                                echo '<button class="btn btn-primary addItemBtn">Add To Card</button>';
                              }else {
                                echo '<button class="btn btn-primary addItemBtnErro">Add To Card</button>';
                              }
                            ?>
                            
                          </form>
                        </div>;
                    <?php 
                    }
                  }
            ?>
  </div>
</div>
<?php include 'components/footer.php'; ?>
