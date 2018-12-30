
<footer class="footer">
  <div class="container" style="height: 40px;">
    <div class="row">
      <div class="footer-block footer-menu-wrapper is-vertical cell-3 cell-12-sm">
         <div class="editor">
          
          </div>
<!--  <ul class="footer-menu menu">
      <li class="footer-menu-item menu-item level-1 "><a href="http://demo-neuron2.myinsales.ru/page/oferta" class="footer-menu-link menu-link level-1">Политика конфиденциальности и оферта </a>
      </li>
      <li class="footer-menu-item menu-item level-1 "><a href="http://demo-neuron2.myinsales.ru/page/agreement" class="footer-menu-link menu-link level-1">Пользовательское соглашение</a>
      </li>
      <li class="footer-menu-item menu-item level-1 ">
        <a href="http://demo-neuron2.myinsales.ru/page/exchange" class="footer-menu-link menu-link level-1"> Условия обмена и возврата</a>
      </li>
      <li class="footer-menu-item menu-item level-1 ">
        <a href="http://demo-neuron2.myinsales.ru/blogs/blog" class="footer-menu-link menu-link level-1">Статьи</a>
      </li> 
  </ul>-->
      </div>
      <div class="footer-block social-menu-wrapper cell-6 cell-12-sm cell-12-xs flex-first-sm text-center">
        
          <ul class="social-menu list">
          
          </ul>     
      </div>
      <div class=" cell-3 cell-6-sm cell-12-xs text-right text-left-sm text-center-xs">
        <div class="footer-block">
                 
        </div>
        <div class="footer-block">        
              <a href="mailto:sales@myshop.ru" class="contact-link"><i class="icon fa fa-envelope-o"></i>  admin@nightbot.ru</a>        
        </div>
      </div>
       <!--   
       <div class="footer-block cell-6 cell-12-xs text-right-sm text-center-xs"> 
       <div class="editor">
            <p>Интернет-магазин на теме Нейрон, рип Mega.Animeshnik</p>
          </div>    
      </div>
      <div class="footer-block insales-copyright cell-6 cell-12-sm text-right text-center-sm">
      Работает на сервере NightBot    
      </div>--> 
    </div>
  </div>
</footer>
<script>
function cartallumRefresh()
{
    jQuery.ajax({
        url: "/shop/index.php",
        type : 'post',
        success: function(data){
            jQuery("#summ_cart").html(jQuery('#summ_cart', data).html());
        }  
    });
}
function pay(summ){
$('#pay').bPopup({
  content:'iframe', //'ajax', 'iframe' or 'image'
  iframeAttr: 'scrolling="no" width="635px" height="290px" frameborder="0"',
  positionStyle: 'absolute',
  loadUrl: "https://www.free-kassa.ru/merchant/forms.php?gen_form=1&writer=seller&targets=Олпата товара&default-sum="+summ+"&button-text=Оплатить&hint=&fio=on&phone=on&encoding=UTF8&type=big&m=104449&id=214149"
 });
}
</script>

<div id="pay" class="textNotification" style= "display:none;text-align: center;">
<!--
<a class="b-close" style="right: 0px;top: 0px;display:none;">x</a>
Укажите своё имя и номер телефона, наши менеджеры свяжутся с вами.<br>
<input placeholder="ФИО" size="30"><br>
<input placeholder="Телефон" size="16"><button type="submit" onclick="alert('Успех\r\n Ожидайте, свами свяжутся');$('.b-close').click();" style="padding: 0.31em 1em;" class="button is-primary">Отправить</button>
-->
</div>