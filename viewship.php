<?php
/*include_once '/var/www/html/shop/session.php';
$conn_db = mysqli_connect('127.0.0.1', 'test_shop', 'test_shop', 'test_shop') or die(mysqli_error());
mysqli_set_charset($conn_db, "utf8");
$category_num_to_name = array( 1 =>'product_sound_systems');
$category = NULL;
if(isset($_REQUEST['category']))
{
	$category = $category_num_to_name[$_REQUEST['category']];
}*/

include_once '/var/www/html/shop/header.php';
$sql = "SELECT `name`,`description`,`category_id` FROM `collections` WHERE `id` = '$category_id'";
$result=mysqli_query($conn_db, $sql) or die(mysqli_error($conn_db));
$arr = mysqli_fetch_assoc($result);
$category_bd_name = $arr['name'];


$price_id = 0;

if(isset($_REQUEST['id']))
{
	$price_id = quotemeta($_REQUEST['id']);
	$price_id = (int)mysqli_real_escape_string($conn_db,$price_id);
}

$sql = "SELECT `name`, `price`, `image`, `description`, `сharacteristics`, `discount`, id FROM `products` WHERE `id` = '$price_id'";
$result=mysqli_query($conn_db, $sql) or die(mysqli_error($conn_db));
$row = mysqli_fetch_assoc($result);
$product_name = $row['name'];
$product_id = $row['id'];
$product_description = $row['description'];
$product_price = $row['price'];
$product_discount = $row['discount'];
$no_sale_product_price = 0;
$label_discount = '';
if($product_discount > 0)
{
	$no_sale_product_price = $product_price;
	$product_price = $product_price-($product_price*$product_discount/100);
	$product_price = round($product_price,1);
	$label_discount = '<div class="product-labels labels-list"><span class="label label-discount">20%</span> </div>';
}
$product_сharacteristics_temp = $row['сharacteristics'];
$product_сharacteristics_items = explode("|", $product_сharacteristics_temp);
$product_сharacteristics = '<table class="table table-bordered table-striped table-hover"><tbody>';
for($i=0; $i < count($product_сharacteristics_items); $i++){
	$product_сharacteristics .= '<tr>';
	$product_сharacteristics_temp =  explode(":", $product_сharacteristics_items[$i]);
	for($q=0; $q < count($product_сharacteristics_temp); $q++){
		$product_сharacteristics .= '<td>' . $product_сharacteristics_temp[$q] . '</td>';
	}
	$product_сharacteristics .= '</tr>';
}
$product_сharacteristics .= '</tbody></table>';
if(strripos($row['image'],';') !== false)
{
	$product_image_temp = explode(";", $row['image'] );
	$product_image = '<a class="MagicZoom" id="zoom" title="' . $product_name . '" href="' . $product_image_temp[0] . '"><img src="' . $product_image_temp[0] .'"/></a>';
	$product_image_select = '<div class="gallery-thumbs-wrapper ">
    <div class="gallery-thumbs swiper-container js-gallery-thumbs swiper-container-horizontal swiper-container-autoheight" id="product-gallery-thumbs">
      <div class="swiper-wrapper" style="height: 107px;">';
	for($w=0; $w < count($product_image_temp); $w++){
		$product_image_select .=  '<a data-zoom-id="zoom" href="' . $product_image_temp[$w] . '" data-image="' . $product_image_temp[$w] . '" ><img src="' . $product_image_temp[$w] . '" style="height: 104px;" /></a>';
	}
	$product_image_select .= '</div>
    </div>
  </div>';
}else{
	$product_image = '<a class="MagicZoom" id="zoom" title="' . $product_name . '" href="' . $row['image'] . '"><img src="' . $row['image'] .'"/></a>';
	$product_image_select = '';
}
?>

<style>
.cell-7 {
    margin-top: 15px;
}
</style>

<!-- <div class="page-content"> -->
<div>
  <div class="breadcrumb-wrapper">
  <ul class="breadcrumb">
    <li class="home breadcrumb-item">
		<a class="breadcrumb-link" title="Главная" href="https://nightbot.ru/shop"><i class="fa fa-home"></i></a>
    </li>          
    <li class="fa breadcrumb-item fa-angle-right" aria-hidden="true">
		<a class="breadcrumb-link" title="Каталог" href="/shop/collection?category=all">Каталог</a>
    </li>
<?php
  if($price_id != "all")
  echo' <li class="fa breadcrumb-item fa-angle-right" aria-hidden="true">
         <a class="breadcrumb-link" title="Саунд-системы" href="/shop/collection?cname=' . $category_name .'">' . $category_bd_name . '</a>
    </li>
    <li class="fa breadcrumb-item fa-angle-right" aria-hidden="true">
         <span class="breadcrumb-link current-page">' . $product_name .'</span>
    </li>';
?>
  </ul>
</div>





  <div class="decorated-title-wrapper">
    <div class="decorated-title">
      
<div class="page-header-wrapper">
  <h1 class="page-header">
    <?php echo $product_name;  ?>
  </h1>
</div><!-- /.page_header -->

    </div>
  </div>

  <div class="row">

    <div class="product-gallery-wrapper cell-5 cell-12-sm">
      

<div class="product-gallery">
  <div class="gallery-main-wrapper text-center hide-sm">
  <?php echo $product_image; ?>

  </div>
  <?php echo $label_discount; ?>
  <?php echo $product_image_select; ?>
<!--
  <div class="gallery-thumbs-wrapper ">
    <div class="gallery-thumbs swiper-container js-gallery-thumbs swiper-container-horizontal swiper-container-autoheight" id="product-gallery-thumbs">
      <div class="swiper-wrapper" style="height: 107px;">
       
        <a data-zoom-id="zoom" href="/shop/files/1.jpg" data-image="/shop/files/1.jpg" ><img src="/shop/files/1.jpg" style="height: 104px;" /></a>
		<a data-zoom-id="zoom" href="/shop/files/1-1.jpg" data-image="/shop/files/1-1.jpg" ><img src="/shop/files/1-1.jpg" style="height: 104px;" /></a>
        
      </div>

      <span class="gallery-prev js-gallery-thumbs-prev swiper-button-disabled"><i class="fa fa-angle-left"></i></span>
      <span class="gallery-next js-gallery-thumbs-next swiper-button-disabled"><i class="fa fa-angle-right"></i></span>
    </div>
  </div>
-->
</div>

    </div>

    <div class="product-content-wrapper cell-7 cell-12-sm">
<div>
<div class="product-content">
  <div class="tabs-menu-wrapper">
    <ul class="tabs-menu product-tabs-list"> 
        <li class="tabs-menu-item is-active">
          <a href="#product-description" data-toggle="tabs" class="tabs-menu-link">Описание</a>
        </li>
        <li class="tabs-menu-item is-closed">
          <a href="#product-characteristics" data-toggle="tabs" class="tabs-menu-link">Характеристики</a>
        </li>
    </ul>
  </div><!-- /.tabs-list -->
	<div class="tabs-list product-tabs-list">
      <div id="product-description" class="tab-block is-active">
        <div class="editor">
         <?php echo $product_description; ?>
        </div>
      </div><!-- /#product-description -->
      <div id="product-characteristics" class="tab-block is-closed">
        <div class="editor">
          <?php echo $product_сharacteristics; ?>
        </div>
      </div><!-- /#product-characteristics -->
	</div><!-- /.tabs-list -->
</div>
</div>
 <!-- <div class="option-selectors">
    
      <input type="hidden" name="variant_id" value="127081746">
    
  </div>-->

  <div class="product-sku-wrapper js-product-sku-wrapper">
    <span>Id товара:</span>
    <span class="js-product-sku" id="id_bonis" ><?php echo $product_id;  ?></span>
    <span id="id_category" style="display:none"> <?php echo $category_name; ?> </span>
  </div>

  <div class="product-prices on-page">
    <div class="price js-product-price on-page"><span id="id_summa"><?php echo $product_price; ?></span> &nbsp;руб</div>
	<?php
	if($no_sale_product_price > 0)
		echo '<div class="old-price js-product-old-price on-page"> '. $no_sale_product_price .' </span> &nbsp;руб</div>';
	?>
  </div>

  <div class="product-control on-page" >

    <div class="counter js-product-quantity number" >
      <button type="button" class="counter-button button count-down minus" style="font-weight: bold;font-size: 16px;" >
        -
      </button>
      <input type="text" value="1" min="1" max="1000" name="quantity" id="id_count" class="counter-input input-number input-field">
      <button type="button" class="counter-button button count-up plus" style="font-weight: bold;font-size: 16px;">
        +
      </button>
    </div>

    <div class="buy">

      <div class="product-order-variant variant-shown js-variant-shown" style="">
        <button class="product-button button is-primary" onclick="opus_cum_canistro()" data-item-add="">
          <i class="icon buy-icon ion-ios-cart-outline"></i>
          <span class="button-text">В корзину</span>
        </button>
      </div>

      <div class="product-order-variant variant-hidden js-variant-hidden hide" style="display: none;">
        <p class="notice notice-info">Товар отсутствует</p>
      </div>

      <div class="product-order-variant variant-preorder js-variant-preorder hide" style="display: none;">
        <button class="product-button button" type="button" data-type="sendMessage" data-target="#preorder-form" data-title="Предзаказ" data-before-send="sendPreorder">
          <i class="icon feedback-icon"></i>
          <span class="button-text">Предзаказ</span>
        </button>
      </div>

    </div>
      <button type="button" class="product-button product-quick-checkout button" data-quick-checkout="" onclick="pay('<?php echo $product_price; ?>');" style="">Оформить заказ</button>
  </div>
</div>
</div>
</div>

    </div>
  </div>

<?php
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
    return false;
  });
  $('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
});
function opus_cum_canistro(){
  var id = $('#id_bonis').text();
  var category = $('#id_category').text();
  var count = $('#id_count').val();
  var summa = $('#id_summa').text();
  $.ajax({
       type: "POST",
       url: "cartallum.php",
       data:  {"id_bonis": id,"id_category":category,"id_count":count,"id_summa":summa,},
       cache: false,                                 
       success: function(response){
        alertify.set('notifier','position', 'top-right');
        alertify.success(response);
        cartallumRefresh();
       }
     });
};

(function($) {
  $(document).on('click', '[data-toggle="tabs"]', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $target = $($this.attr('href'));
    var $swiper = $target.find('swiper-container');
    $target
      .parent()
        .children('.tab-block')
          .removeClass('is-active')
          .addClass('is-closed');
    $this
      .parents('.tabs-menu:first')
        .children('.tabs-menu-item')
          .removeClass('is-active')
          .addClass('is-closed');
    $this
      .parent()
        .removeClass('is-closed')
        .addClass('is-active');
    $target
      .removeClass('is-closed')
      .addClass('is-active');

    if ($swiper.lenght) {
      $swiper[0].swiper.update();
    }
  });
  $('.tabs-menu').each(function () {
    var $menu = $(this);

    $menu
      .find('.tabs-menu-link:first')
        .trigger('click');
  });
})(jQuery);

</script>

</body>
</html>