<?php
/*include_once '/var/www/html/shop/session.php';
$conn_db = mysqli_connect('127.0.0.1', 'test_shop', 'test_shop', 'test_shop') or die(mysqli_error());
mysqli_set_charset($conn_db, "utf8");
$category_name_to_num = array( 'product_sound_systems' => 1);*/
?>

<?php
//$nomenu = true;
include_once '/var/www/html/shop/header.php';
?>
<div class="index-block">
  <div class="row">
     <div class="special-category cell-3 cell-6-sm cell-12-mc">
          <a href="/shop/collection?cname=sound_systems" class="category-inner">
            <div class="category-image-wrapper">
              <span class="category-image-inner image-container is-square is-cover">
            <img src="files/744_0.jpg" class="category-image" title="Фотоаппараты">
              </span>
            </div>
            <div class="category-title">
              Домашние кинотеары
            </div>
          </a>
        </div>  
        <div class="special-category cell-3 cell-6-sm cell-12-mc">
          <a href="/shop/collection?cname=televizory" class="category-inner">
            <div class="category-image-wrapper">
              <span class="category-image-inner image-container is-square is-cover">
                <img src="files/large_1000x1000(5).jpg" class="category-image" title="Домашние кинотеары">
              </span>
            </div>
            <div class="category-title">
              Телевизоры
            </div>
          </a>
        </div>
        <div class="special-category cell-3 cell-6-sm cell-12-mc">
          <a href="/shop/collection?cname=planshety" class="category-inner">
            <div class="category-image-wrapper">
              <span class="category-image-inner image-container is-square is-cover">
                <img src="files/large_samsung_galaxy_tab.jpg" class="category-image" title="Планшеты">
              </span>
            </div>
            <div class="category-title">
              Планшеты
            </div>
          </a>
        </div>
<div class="special-category cell-3 cell-6-sm cell-12-mc">
          <a href="/shop/collection?cname=noutbuki" class="category-inner">
            <div class="category-image-wrapper">
              <span class="category-image-inner image-container is-square is-cover">
                <img src="files/large_Ivy_Bridge_Laptops.jpg" class="category-image" title="Ноутбуки">
              </span>
            </div>
            <div class="category-title">
              Ноутбуки
            </div>
          </a>
        </div>
  </div>
</div>

<div class="index-block benefits-wrapper">
<div class="benefits">
  <div class="decorated-title-wrapper">
    <div class="decorated-title">
      Преимущества компании
    </div>
  </div>
  <div class="row flex-center">
    <span class="benefit cell-12-sm">
      <div class="benefit-inner">
        <div class="benefit-image">
          <div class="image-container is-square">
            <img src="files/a96ab3b07fa89099ef09c0a5553b9fda.png" title="Быстрая доставка до двери" alt="Быстрая доставка до двери">
          </div>

        </div>
        <div class="benefit-title">Быстрая доставка до двери</div>
      </div>
    </span>
    <span class="benefit cell-12-sm">
      <div class="benefit-inner">
        <div class="benefit-image">
          <div class="image-container is-square">
            <img src="files/a751029d63eacb7fb3366ad7e3b7bbba.png" title="Выгодные акции и бонусы" alt="Выгодные акции и бонусы">
          </div>

        </div>
        <div class="benefit-title">Выгодные акции и бонусы</div>
      </div>
    </span>
    <span class="benefit cell-12-sm">
      <div class="benefit-inner">
        <div class="benefit-image">
          <div class="image-container is-square">
            <img src="files/99ffcec5ea28987e98a65df296dc176f.png" title="Гарантии качества продукции" alt="Гарантии качества продукции">
          </div>
        </div>
        <div class="benefit-title">Гарантии качества продукции</div>
      </div>
    </span>
  </div>
</div>
</div>
<?php
$temp_rand = rand(1,count($category_num_to_name));
$sql = "SELECT `id`, `name`, `description`, `category_id` FROM `collections` limit $temp_rand,1";
$result=mysqli_query($conn_db, $sql) or die(mysqli_error($conn_db));
$arr = mysqli_fetch_assoc($result);
$categorie_name = $arr['name'];
$categories_id = $arr['category_id'];
echo <<<TEXT
<div class="index-block title-collections">
    <div class="tabs-menu-wrapper">
      <ul class="tabs-menu collections-tabs">
            <li class="tabs-menu-item active is-active">
              <a class="tabs-menu-link" href="/shop/collection?cname=$categories_id" data-toggle="tabs">$categorie_name</a>
            </li>    
      </ul>
    </div>

<div class="tabs-list collections-list">
<div class="tab-block active is-active" id="domashnie-kinoteatry">
<div class="products-list in-tab row">     
TEXT;

$sql = "SELECT `id`, `name`, `price`, `image` from `products`  WHERE `category` = '$categories_id' limit 4";
$result=mysqli_query($conn_db, $sql) or die(mysqli_error($conn_db));
while($arr = mysqli_fetch_assoc($result)){
//$categories = $category_name_to_num['sound_systems'];
$product_link = "/shop/viewship.php?cname={$categories_id}&id={$arr['id']}";
echo '<div class="title-collections-product cell-3 cell-6-sm cell-12-mc">
<a href="' , $product_link , ' " class="product-card product-link ">
  <div class="card-inner">
    <div class="product-photo">
      <div class="product-link image-container is-square is-cover">';
if(strripos($arr['image'],';') !== false)
{
$product_image_temp = explode(";", $arr['image'] );
$product_image = $product_image_temp[0];
}else
{
	$product_image = $arr['image'];
}
echo '<img src="' . $product_image .'" alt="" title="" class="product-image">';
echo '</div>
        <div class="product-prices in-card">
        <div class="price in-card">';
echo $arr['price'] . '&nbsp;руб';
echo '</div>
      </div>
    </div>
    <div class="product-caption">
      <div class="product-title in-card">';
echo $arr['name'];
echo  '</div>
    </div>
  </div>
</a></div>'; 
}

?>
              
</div>
</div>              
</div>
</div>



<?php
include_once '/var/www/html/shop/footer.php';
?>
</body></html>