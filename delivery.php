<?php
include_once '/var/www/html/shop/header.php';
?>
<div class="container page-inner ">
	<div class="breadcrumb-wrapper">
	  <ul class="breadcrumb">
		<li class="breadcrumb-item home">
		  <a class="breadcrumb-link" title="Главная" href="https://nightbot.ru/shop"><i class="fa fa-home"></i></a>
		</li>
		<li class="breadcrumb-item">
		  <span class="breadcrumb-link current-page">Доставка</span>
		 </li>
	  </ul>
	</div>
	<div class="decorated-title-wrapper">
	  <div class="decorated-title">
	<div class="page-header-wrapper">
	  <h1 class="page-header">Доставка   
	  </h1>
	</div>
	  </div>
	</div>
	  <div class="page-content page-/page/payment">
		<div class="editor">
		Здесь вы можите расчитать стоимость доставки<br>
		<iframe  id="frame" src="https://alliance-catalog.ru/delcalcframe/?city=Кемерово" frameborder="0" style="width: 600px; height: 660px; display: block;"></iframe>
	<!--
	<script src="https://alliance-catalog.ru/site/delivery-iframe/scriptMoscow.js"></script>
<div><a href="https://alliance-catalog.ru/deliverycalc/" id="link" >* Рассчитывается</a> ориентировочная стоимость доставки, конечная стоимость определяется после приема груза на терминале компании.</div>
		-->
			</div>
	  </div>
</div>
<?php
include_once '/var/www/html/shop/footer.php';
?>
</body></html>