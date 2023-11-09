$(".subnav-login").hide();
$(document).ready(function () {
  $(".danhmuc-content").click(function () {
    $(".danhmuc-list").toggle();
  });
  $(".nav-login").click(function () {
    $(".subnav-login").toggle();
  });

  $(".addItemBtn").click(function (e) {
    e.preventDefault();
    var $form = $(this).closest(".form-submit");
    var pid = $form.find(".pid").val();
    var pname = $form.find(".pname").val();
    var pprice = $form.find(".pprice").val();
    var pimage = $form.find(".pimage").val();
    var pcode = $form.find(".pcode").val();
    $.ajax({
      url: './action.php',
      method: 'POST',
      data: { pid: pid, pname: pname, pprice: pprice, pimage: pimage, pcode: pcode },
      success: function (response) {
        $("#message").html(response);
        window.scrollTo(0, 0);
        load_cart_item_number();
      }
    });

    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: './action.php',
        method: 'GET',
        data: { cartItem: "cart_item" },
        success: function (response) {
          $("#cart-item").html(response);
        }
      });
    }

  });

  //Check Login
  $(".addItemBtnErro").click(function (e) {
    e.preventDefault();
    alert("Đăng nhập rồi thử lại");
    });


  // Change the item quantity
  $(".itemQty").on('change', function () {
    var $el = $(this).closest('tr');

    var pid = $el.find(".pid").val();
    var pprice = $el.find(".pprice").val();
    var qty = $el.find(".itemQty").val();
    location.reload(true);
    $.ajax({
      url: 'action.php',
      method: 'post',
      cache: false,
      data: {
        qty: qty,
        pid: pid,
        pprice: pprice
      },
      success: function (response) {
        console.log(response);
      }
    });
  });

  // Load total no.of items added in the cart and display in the navbar
  load_cart_item_number();

  function load_cart_item_number() {
    $.ajax({
      url: 'action.php',
      method: 'get',
      data: {
        cartItem: "cart_item"
      },
      success: function (response) {
        $("#cart-item").html(response);
      }
    });
  }
});

