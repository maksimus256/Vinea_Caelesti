<?php
include_once '/var/www/html/shop/session.php';


if(isset($_REQUEST['change_id']) && isset($_REQUEST['change_count'])){
  $session_array = $_SESSION['data_canistro'];
  foreach($session_array as $key => $value) {
    if($value[0] == $_REQUEST['change_id'])
    {
      $_SESSION['data_canistro'][$key][2] = abs(trim($_REQUEST['change_count']));
      if($_SESSION['data_canistro'][$key][2] <= 0)
        unset($_SESSION['data_canistro'][$key][2]);
    }
  }
die(); 
}
if(isset($_REQUEST['delitems'])){
  $session_array = $_SESSION['data_canistro'];
  foreach($session_array as $key => $value) {
    if($value[0] == $_REQUEST['delitems'])
    {
      unset($_SESSION['data_canistro'][$key]);
      die('Успех'); 
    }
  }
die(); 
}
elseif(isset($_REQUEST['id_bonis']) && isset($_REQUEST['id_category']) && isset($_REQUEST['id_count'])){
  if(isset($_SESSION['data_canistro']))
  {
    $session_array = $_SESSION['data_canistro'];
    $is_set_array = false;
    foreach($session_array as $key => $value) {
      if( $value[0] == $_REQUEST['id_bonis'] )
      {
        $is_set_array = true;
        $_SESSION['data_canistro'][$key][2] = $_SESSION['data_canistro'][$key][2] + trim(abs($_REQUEST['id_count']));
      }
    }
    if(!$is_set_array)
    $_SESSION['data_canistro'][] = array(trim($_REQUEST['id_bonis']),trim($_REQUEST['id_category']),trim(abs($_REQUEST['id_count'])),trim($_REQUEST['id_summa']));
  }else
  {
    $_SESSION['data_canistro'] = array();
    $_SESSION['data_canistro'][] = array(trim($_REQUEST['id_bonis']),trim($_REQUEST['id_category']),trim(abs($_REQUEST['id_count'])),trim($_REQUEST['id_summa']));
  }
die("Товар добавлен в корзину");
}elseif(!isset($_REQUEST['review']))
die();




include_once '/var/www/html/shop/header.php';
?>
<div class="page-content">
  <div class="breadcrumb-wrapper">
  <ul class="breadcrumb">
    <li class="breadcrumb-item home">
      <a class="breadcrumb-link" title="Главная" href="/"><i class="fa fa-home"></i></a>
    </li>
    <li class="breadcrumb-item">
     <span class="breadcrumb-link current-page">Корзина</span>
    </li>
  </ul>
</div>
  <div class="decorated-title-wrapper">
    <div class="decorated-title">    
<div class="page-header-wrapper">
  <h1 class="page-header">
      Корзина
  </h1>
</div><!-- /.page_header -->
    </div>
  </div>

      <div class="cart-body" style="">
      
        <div class="cart-list cell-12" style="display: table;width: 100%;">
 
<?php
if(isset($_SESSION['data_canistro']))
{
$session_array = $_SESSION['data_canistro']; 
foreach($session_array as $key => $value) {
 $id_bonis = trim($value[0]);
 $id_name_category = trim($value[1]);
 $id_count = trim($value[2]);
 $sql= "SELECT `id`, `name`, `price`, `image`, `discount` FROM `products` where id='$id_bonis'";
 $result=mysqli_query($conn_db, $sql) or die(mysqli_error($conn_db));
 $arr = mysqli_fetch_assoc($result);
 $item_id = $arr['id'];
 $item_name = $arr['name'];
 $item_price = $arr['price'];
 $item_discount = $arr['discount'];
 if($item_discount > 0)
 {
	$item_price = $item_price-($item_price*$item_discount/100);
	$item_price = round($item_price,1);
 }
 $item_image = $arr['image'];
 if(strripos($item_image,';') !== false)
    $item_image =  explode(";", $item_image )[0];

$temp_summ = $item_price*$id_count;
echo <<<ITEM
<div class="cart-item" data-product-id="74140137" data-item-id="127355267" style="display: table-row;">
      <div style="display: table-cell;vertical-align: middle;width: 150px;">
        <a href="/product/planshet-apple-ipad-mini-with-retina-display" title="$item_name">
          <img title="$item_name" alt="$item_name" src="$item_image" style="width: 100%;">
        </a>
    </div>
    <div class="cell-2" style="
    display: table-cell;
    vertical-align: middle;">
      <div class="">
        <a href="/product/planshet-apple-ipad-mini-with-retina-display">$item_name</a>
      </div>
        <div class="item-article hide-xs">ID товара: $item_id</div>
    </div>
    <div class="item-prices cell-2" style="display: table-cell;vertical-align: middle;">
      <div class="item-price js-item-price">$item_price &nbsp;руб</div>
    </div>
    <div class="item-counter cell-2" data-quantity="" style=" display: table-cell;vertical-align: middle;">
      <div class="counter">
        <button type="button" class="counter-button button button-number count-down icon fa fa-minus minus">
        </button>
        <input type="text" value="$id_count" min="1" max="1000" data-idsumm="$item_id" data-pretium="$item_price" class="counter-input input-number input-field" readonly>
        <button type="button" class="icon fa fa-plus plus counter-button button button-number count-up">
        </button>
      </div>
    </div>
    <div class="item-total cell-2" style="display: table-cell;vertical-align: middle;"><span class="items_summ" id="sum-$item_id">{$temp_summ}</span> руб</div>
    <div class="cell-2-md" style="display: table-cell;vertical-align: middle;">
       <i class="fa fa-remove" onclick="itemdel('$id_bonis')"></i>
    </div>


</div>
ITEM;
}
}

echo '<!-- /.cart-item -->';
$summ = summ_cart();
echo <<<fot
</div>
      </div>
<div class="cart-footer row top js-shopcart-area flex-between">
<div class="cell-4 cell-12-sm">
<!--    <div id="js-coupon-wrapper" class="">
      <div class="discount-wrapper">
          <div class="discount-form">
            <input type="text" placeholder="Есть промо-код?" class="discount-input input-field" name="cart[coupon]" value="">
            <button type="submit" class="button is-primary discount-button button-primary" data-coupon-submit="">OK</button>
          </div>
        <div class="discount-comment-list js-discount-comment-list"></div>
    </div>
</div>-->

</div>
        <div class="cart-control cell-6 cell-12-sm flex-first-xs flex-end flex-center-sm">
          <div class="total-summ">
            <span class="summ-caption">Итого:</span>
            <span class="summ-number js-shopcart-total-summ"><span id="allsumm">$summ</span>&nbsp;руб</span>
          </div>
          <button type="submit" onclick="pay('$summ');" class="cart-checkout button is-primary" data-cart-submit="">Оформить заказ</button>
        </div>
      </div>
      <input type="hidden" name="_method" value="put">
      <input type="hidden" name="make_order" value="">
      <input type="hidden" name="lang" value="ru">

  <div class="notice notice-info text-center js-cart-empty hide">
    Ваша корзина пуста
  </div>
</div>
fot;
include_once '/var/www/html/shop/footer.php';
?>
<script type="text/javascript" >
$(document).ready(function() {
  $('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    var idsumm = $input.data('idsumm');
    $('#sum-'+idsumm).text($input.data('pretium')*$input.val());
    all_summ();
    change_count(idsumm,$input.val());
    return false;
  });
  $('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    var idsumm = $input.data('idsumm');
    $('#sum-'+idsumm).text($input.data('pretium')*$input.val());
    all_summ();
    change_count(idsumm,$input.val());
    return false;
  });
  function all_summ(){
    var summ = 0;
    $(".items_summ").each(function(){
      summ += parseInt($(this).html(), 10);
      $("#allsumm").text(summ);
      $("#summ_cart").text(summ);
    }); 
  }
});
</script>
<script>
function change_count(id,count){
  $.ajax({
       type: "POST",
       url: "cartallum.php",
       data:  {'change_id':id,'change_count':count},
       cache: false,                                 
       success: function(response){
      }
     });
}
function itemdel(id){
  $.ajax({
       type: "POST",
       url: "cartallum.php",
       data:  {'delitems':id},
       cache: false,                                 
       success: function(response){
       alertify.set('notifier','position', 'top-right');
       alertify.success(response);
       cartallumRefresh();
       cartallum_upd();
      }
     });
}
function cartallum_upd(){
  $.ajax({
       url: "/shop/cartallum.php",
       type: 'post',
       data: {'review':'review'},
       success: function(data){  
       jQuery(".page-content").html($('.page-content', data).html());
       }  
    });
}
</script>
</body></html>