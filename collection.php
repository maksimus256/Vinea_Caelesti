<?php
include_once '/var/www/html/shop/header.php';
if($category_id  != "all")
{
$sql = "SELECT `name`,`description`,`category_id` FROM `collections` WHERE `id` = '$category_id'";
$result=mysqli_query($conn_db, $sql) or die(mysqli_error($conn_db));
$arr = mysqli_fetch_assoc($result);
$category_description = $arr['description'];
$category_name = $arr['name'];
$category_id = $arr['category_id'];

if(strripos($category_id,';') === false)
  $sql= "SELECT `id`, `name`, `price`, `image`, `discount` FROM `products`  WHERE `category` = '$category_id' ";
else
{
  $category_id = explode(";", $category_id );
  $sql= "SELECT `id`, `name`, `price`, `image`, `discount`, '{$category_id[0]}' as categ FROM `products` WHERE `category` = '{$category_id[0]}' union SELECT `id`, `name`, `price`, `image`, `discount`, '{$category_id[1]}' as categ FROM `products`  WHERE `category` = '{$category_id[1]}'";
}
}else{
$sql= "SELECT `id`, `name`, `price`, `image`, `discount` FROM `products`";

}
?>
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
  if($category_id  != "all")
  echo' <li class="fa breadcrumb-item fa-angle-right" aria-hidden="true">
         <a class="breadcrumb-link" title="Саунд-системы" href="/shop/collection?id=' . $category_id .'">' . $category_name . '</a>
    </li>';
?>
  </ul>
</div>

<div class="page-content cell-8-md cell-12-sm">
<div class="decorated-title-wrapper">
<?php
if($category_id  != "all")
echo <<<TEXT
<div class="decorated-title">   
  <div class="page-header-wrapper">
    <h1 class="page-header">$category_name </h1>
  </div>
</div>
<div class="collection-toolbar is-top"></div>

</div>
<div class="collection-description at-top content editor">
<span style="font-size: 12pt;">$category_description</span>
</div>
<div class="products-list row">
TEXT;


$result=mysqli_query($conn_db, $sql) or die(mysqli_error($conn_db));
while($arr = mysqli_fetch_assoc($result)){
  $product_id = $arr['id'];
  $product_name = $arr['name'];
  $product_price = $arr['price'];
  $product_image = $arr['image'];
  $product_discount = $arr['discount'];
  if(isset($arr['categ']))
    $category_id = $arr['categ'];
    
  if(strripos($product_image,';') !== false)
  {
    $product_image_temp = explode(";", $product_image );
    $product_image = $product_image_temp[0];
  }else
  {
    $product_image = $product_image;
  }
  $discount = '';
  $no_sale = '';
  if($product_discount > 0)
  {
    $discount = '<div class="product-labels labels-list">
      <span class="label label-discount">' . $product_discount .'%</span>
    </div>';
	$no_sale =  '<div class="product-prices in-card price" style="position: absolute;left: 100px;bottom: 0px;text-decoration:line-through">'. $product_price .'руб</div>';
	$product_price = $product_price-($product_price*$product_discount/100);
	$product_price = round($product_price,1);
  }

echo <<<TEXT
<div class="product-card-wrapper cell-4 cell-6-md cell-12-mc">
  <a href="viewship.php?cname={$category_id}&id={$product_id}" class="product-card product-link ">
    <div class="card-inner">
      <div class="product-photo">
        <div class="product-link image-container is-square ">
          <img src="$product_image" alt="" title="" class="product-image">
        </div>
            $discount
        <div class="product-prices in-card">
          <div class="price in-card">
             $product_price&nbsp;руб
          </div>
		  $no_sale
        </div>
      </div>
      <div class="product-caption">
        <div class="product-title in-card">
          $product_name 
        </div>
      </div>
    </div>
  </a>
</div>
TEXT;
}
?>

</div>
<!--<div class="collection-toolbar is-bottom flex-middle flex-between"></div>-->
  </div>
<?php
include_once '/var/www/html/shop/footer.php';
?>
</body></html>