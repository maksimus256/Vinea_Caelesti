<?php
include_once '/var/www/html/shop/session.php';
$conn_db = mysqli_connect('127.0.0.1', '', '', '') or die(mysqli_error());
mysqli_set_charset($conn_db, "utf8");
$category_num_to_name = array( 1 =>'sound_systems', 2=>'televizory', 3=>'planshety', 4=>'noutbuki',"all" => 'all');
$category_name_to_num = array( 'sound_systems' => 1,'televizory' => 2, 'planshety'=>3, 'noutbuki'=>4,"all" => 'all');
$category_name = 1;
$category_id = 1;
if(isset($_REQUEST['category']))
{ 
  if(isset($category_num_to_name[$_REQUEST['category']]))
    $category_name = $category_num_to_name[$_REQUEST['category']];

	$category_id = $_REQUEST['category'];

}
if(isset($_REQUEST['cname']))
{
  if(isset($category_name_to_num[$_REQUEST['cname']]))
	$category_id = $category_name_to_num[$_REQUEST['cname']];
  $category_name = $_REQUEST['cname'];
}
//print_r($_SESSION['data_canistro']);

function summ_cart(){
if(!isset($_SESSION['data_canistro']))
return 0;
$session_array = $_SESSION['data_canistro'];
$summ = 0;
  foreach($session_array as $key => $value) {
    $summ = $summ + $value[2]*$value[3];
  }
return $summ;
}
?>
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
<meta name="keywords" content="интернет магазин, домашние кинотеатры, телевизоры, планшеты, ноутбуки, скидки" />
<meta name="description" content="Интернет магазин электроники Vinea Caelesti" />
<title>Vinea Caelesti</title>
<link rel="stylesheet" href="/shop/css/font-awesome.css">
<link href="files/theme.css" rel="stylesheet" type="text/css">
<link href="files/magiczoom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="/shop/files/magiczoom.js"></script>
<script src="/shop/files/alertify.min.js"></script>
<script src="//bot.gold-ak.net/bpopup/jquery.bpopup.js"></script>
<link rel="stylesheet" href="/shop/files/alertify.min.css"/>
</head>
<body class="fhg-body">

  <div class="top-panel">
  <div class="container">
    <div class="top-panel-inner row flex-between flex-middle">
      <div class="top-menu-wrapper cell- hide-sm">
        <ul class="top-menu menu">
         <li class="top-menu-item menu-item level-1 "><a href="/shop/delivery.php" class="top-menu-link menu-link level-1">Доставка</a></li>
		 <li class="top-menu-item menu-item level-1 "><a href="/shop/solucionis.php" class="top-menu-link menu-link level-1">Оплата</a></li>
         <li class="top-menu-item menu-item level-1 "><a href="/shop/nobis.php" class="top-menu-link menu-link level-1">О магазине</a></li>
        </ul>
      </div>
      <div class="cell- hide show-sm">
        <button type="button" class="top-panel-open" data-target="#left-panel" data-type="panel" data-position="left" data-onopen="initLeftMenu">
          <i class="fa fa-bars"></i>
        </button>
        <button type="button" class="top-panel-open" data-target="#mobile-search" data-type="panel" data-position="top mobile-search">
          <i class="fa fa-search"></i>
        </button>
      </div>      
        <!-- <div class="compares-widget cell- ">
          <a href="http://demo-neuron2.myinsales.ru/compares" class="compares-widget-link">
           <i class="compare-widget-icon fa fa-bar-chart"></i>
            <span class="hide-sm">Сравнение:</span>
            <span class="compares-widget-count js-compares-widget-count">0</span>
          </a>
        </div>-->
      <div class="shopcart-widget cell- text-right">
        <a href="/shop/cartallum.php?review" title="Корзина" class="shopcart-link">
          <span class="shopcart-icon">
            <i class="fa fa-shopping-cart"></i>
          </span>
          <span class="shopcart-widget-count js-shopcart-widget-count hide show-sm">0</span>
          <span class="hide-sm">Корзина:
            <span class="shopcart-widget-amount js-shopcart-widget-amount"><span id="summ_cart"><?php echo summ_cart() ?></span>&nbsp;руб</span>
          </span>
        </a>
      </div>
    </div>
  </div>
</div>
  <div class="page-wrapper fhg-content">
    <div class="container page-inner ">
      <header class="header">
  <div class="row flex-between flex-middle">
    <div class="logotype header-block cell-6 cell-12-sm _flex-first-sm flex-center-md">
	<a title="Тема Нейрон" href="//nightbot.ru/shop/" class="logotype-link"><span class="logotype-text">Vinea Caelesti</span></a> 
    </div>
    <div class="cell-3 cell-12-sm">
   <!--   <div class="phone header-block flex-center-sm">
        <a href="tel:+7 495 123-45-67" class="contact-link"><i class="icon fa fa-phone"></i> +7 495 123-45-67</a>      
      </div>-->
      <div class="email header-block flex-center-xs hidden-sm">      
        <a href="mailto:admin@nightbot.ru" class="contact-link"><i class="icon fa fa-envelope-o"></i> admin@nightbot.ru</a>     
      </div>
    </div>
  </div>
</header>
<?php
if(!isset($nomenu))
echo <<<TEXT
<div class="main-menu-wrapper hide-sm">
<ul class="main-menu menu level-1">
<!--<li class="main-menu-item menu-item level-1 ">
<a href="/shop/collection?category=0" class="main-menu-link menu-link level-1">Домашние кинотеары</a>
<button class="main-menu-marker menu-marker menu-marker level-1" type="button"></button>
<ul class="main-menu menu level-2">
<li class="main-menu-item menu-item level-2 "><a href="/shop/collection?cname=sound_systems" class="main-menu-link menu-link level-2">Саунд-системы</a></li>
<li class="main-menu-item menu-item level-2 "><a href="/shop/collection?cname=televizory" class="main-menu-link menu-link level-2">Телевизоры</a></li>
</ul>-->
<li class="main-menu-item menu-item level-1 "><a href="/shop/collection?cname=sound_systems" class="main-menu-link menu-link level-1">Домашние кинотеатры</a></li>
<li class="main-menu-item menu-item level-1 "><a href="/shop/collection?cname=televizory" class="main-menu-link menu-link level-1">Телевизоры</a></li>

<li class="main-menu-item menu-item level-1 "><a href="/shop/collection?cname=planshety" class="main-menu-link menu-link level-1">Планшеты</a></li>
<li class="main-menu-item menu-item level-1 "><a href="/shop/collection?cname=noutbuki" class="main-menu-link menu-link level-1">Ноутбуки</a></li>
  </ul>
</div>
TEXT;
?>