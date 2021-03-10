@extends('layouts.frontpage')
@section('content')
    <div class="ps-home-slider">
      <div id="rev_slider_2_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="home-1" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">        <!-- START REVOLUTION SLIDER 5.4.6.3.1 fullwidth mode -->
              <div id="rev_slider_2_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.6.3.1">
                  <ul>
                      {{-- <!-- SLIDE  -->
                      <li data-index="rs-6" data-transition="zoomout,slotzoom-vertical,curtain-2" data-slotamount="default,default,default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power0.easeInOut,default,default" data-easeout="default,default,default" data-masterspeed="default,default,default" data-rotate="0,0,0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                          <!-- MAIN IMAGE -->
                          <img src="images/slider/slider-1.jpg" alt="" title="slider-1" width="1920" height="750" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                          <!-- LAYERS -->
                          <!-- LAYER NR. 1 -->
                          <div class="tp-caption rev-btn " id="slide-6-layer-1" data-x="['left','left','left','left']" data-hoffset="['1','20','10','10']" data-y="['middle','top','top','middle']" data-voffset="['110','374','548','90']" data-fontweight="['600','600','400','500']" data-color="['rgb(51,51,51)','rgb(51,51,51)','rgb(51,51,51)','rgb(0,0,0)']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-responsive_offset="on" data-responsive="off" data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"500","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);bg:rgb(51,51,51);bc:rgb(0,0,0);"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[14,14,14,10]" data-paddingright="[45,45,45,30]" data-paddingbottom="[12,12,12,10]" data-paddingleft="[45,45,45,30]" style="z-index: 5; white-space: nowrap; font-size: 14px; line-height: 20px; font-weight: 600; color: #333333;font-family:Poppins;text-transform:uppercase;background-color:rgba(0,0,0,0);border-color:rgba(0,0,0,1);border-style:solid;border-width:3px 3px 3px 3px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">View Collection </div>
                          <!-- LAYER NR. 2 -->
                          <div class="tp-caption   tp-resizeme" id="slide-6-layer-2" data-x="['left','left','left','left']" data-hoffset="['0','20','10','11']" data-y="['middle','middle','middle','middle']" data-voffset="['0','1','-1','0']" data-fontsize="['60','40','35','25']" data-lineheight="['60','60','40','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 60px; line-height: 60px; font-weight: 400; color: #FFF; letter-spacing: 0px;font-family:Libre Baskerville;text-transform:uppercase;">MEN SUIT </div>
                          <!-- LAYER NR. 3 -->
                          <div class="tp-caption   tp-resizeme" id="slide-6-layer-3" data-x="['left','left','left','left']" data-hoffset="['0','20','10','10']" data-y="['middle','top','middle','middle']" data-voffset="['50','334','40','36']" data-fontsize="['20','15','15','15']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":10,"speed":1500,"frame":"0","from":"x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 20px; font-weight: 600; color: #9f9f9f; letter-spacing: 0px;font-family:Nunito Sans;">Simple, Special & Sexy </div>
                          <!-- LAYER NR. 4 -->
                          <div class="tp-caption   tp-resizeme" id="slide-6-layer-5" data-x="['left','left','left','left']" data-hoffset="['0','20','10','10']" data-y="['middle','middle','middle','middle']" data-voffset="['-60','-44','-44','-36']" data-fontsize="['20','18','18','18']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1500,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 20px; line-height: 20px; font-weight: 600; color: #333333; letter-spacing: 0px;font-family:Poppins;text-transform:uppercase;">Features Product </div>
                      </li>
                      <!-- SLIDE  --> --}}
                      <li data-index="rs-10" data-transition="zoomout,slotzoom-vertical,curtain-2" data-slotamount="default,default,default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power0.easeInOut,default,default" data-easeout="default,default,default" data-masterspeed="default,default,default" data-rotate="0,0,0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                          <!-- MAIN IMAGE -->
                          <img src="images/slider/slider-2.jpg" alt="" title="slider-2" width="1920" height="750" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                          <!-- LAYERS -->
                          <!-- LAYER NR. 5 -->
                          <div class="tp-caption rev-btn " id="slide-10-layer-1" data-x="['right','right','right','right']" data-hoffset="['0','10','10','10']" data-y="['middle','top','top','middle']" data-voffset="['110','374','548','90']" data-fontweight="['600','600','500','500']" data-color="['rgb(51,51,51)','rgb(51,51,51)','rgb(51,51,51)','rgb(0,0,0)']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-responsive_offset="on" data-responsive="off" data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"500","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);bg:rgb(51,51,51);bc:rgb(0,0,0);"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[14,14,14,10]" data-paddingright="[45,45,45,30]" data-paddingbottom="[12,12,12,10]" data-paddingleft="[45,45,45,30]" style="z-index: 5; white-space: nowrap; font-size: 14px; line-height: 20px; font-weight: 600; color: #333333;font-family:Poppins;text-transform:uppercase;background-color:rgba(0,0,0,0);border-color:rgba(0,0,0,1);border-style:solid;border-width:3px 3px 3px 3px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">View Collection </div>
                          <!-- LAYER NR. 6 -->
                          <div class="tp-caption   tp-resizeme" id="slide-10-layer-2" data-x="['right','right','right','right']" data-hoffset="['0','10','10','10']" data-y="['middle','middle','middle','middle']" data-voffset="['0','1','-1','0']" data-fontsize="['60','40','35','25']" data-lineheight="['60','60','40','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 60px; line-height: 60px; font-weight: 400; color: #000000; letter-spacing: 0px;font-family:Libre Baskerville;text-transform:uppercase;">WOMEN SUIT </div>
                          <!-- LAYER NR. 7 -->
                          <div class="tp-caption   tp-resizeme" id="slide-10-layer-3" data-x="['right','right','right','right']" data-hoffset="['0','10','10','10']" data-y="['middle','top','middle','middle']" data-voffset="['50','335','40','36']" data-fontsize="['20','15','15','15']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":10,"speed":1500,"frame":"0","from":"x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 20px; font-weight: 600; color: #9f9f9f; letter-spacing: 0px;font-family:Poppins;">Simple, Special & Sexy </div>
                          <!-- LAYER NR. 8 -->
                          <div class="tp-caption   tp-resizeme" id="slide-10-layer-5" data-x="['right','right','right','right']" data-hoffset="['0','10','10','10']" data-y="['middle','middle','middle','middle']" data-voffset="['-60','-45','-44','-36']" data-fontsize="['20','18','18','18']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1500,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 20px; line-height: 20px; font-weight: 600; color: #333333; letter-spacing: 0px;font-family:Poppins;text-transform:uppercase;">Features Product </div>
                      </li>
                  </ul>
                  <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
              </div>
          </div>
    </div>
    <div class="ps-section--collection">
      <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="0" data-radio="4:3">
        <div class="ps-masonry">
          <!-- <div class="grid-sizer"></div> -->
          <div class="container col-lg-12" >
            <div class="row" style="background-color: #fff; padding-top: 30px; padding-bottom:  30px;">
                 
              <div class="col-lg-4" >
              
            <a class="ps-collection" href="product-listing"><img src="images/collection/home-1.jpg" alt=""></a></div>

          
                <div class="col-lg-4">
                 
            <a class="ps-collection" href="product-listing"><img src="images/collection/home-2.jpg" alt=""></a></div>
               

              <div class="col-lg-4" >
                 
            <a class="ps-collection" href="product-listing"><img src="images/collection/home-3.png" alt=""></a>

          </div>
              </div>
            </div>  </div>
              
     <!--      <div class="grid-item">
            <div class="grid-item__content-wrapper"><a class="ps-collection" href="product-listing"><img src="images/collection/home-3.jpg" alt=""></a></div>
          </div>
          <div class="grid-item ">

            <div class="border">
            <div class="grid-item__content-wrapper"><a class="ps-collection" href="product-listing"><img src="images/collection/home-2.jpg" alt=""></a>
              <div class="top-right">Collection <br> <h1>WOMEN</h1>></div><b></div>
          </div></div>
          <div class="grid-item">
            <div class="grid-item__content-wrapper"><a class="ps-collection" href="product-listing"><img src="images/collection/home-3.jpg" alt=""></a></div>

            <div class="grid-item__content-wrapper"><a class="ps-collection" href="product-listing"><img src="images/collection/home-2.jpg" alt=""></a></div>
          </div>
          <div class="grid-item large">
            <div class="grid-item__content-wrapper"><a class="ps-collection" href="product-listing"><img src="images/collection/home-1.jpg" alt=""></a></div>

          </div>
           <div class="grid-item">
            <div class="grid-item__content-wrapper"><a class="ps-collection" href="product-listing"><img src="images/collection/home-4.jpg" alt=""></a>
             <div class="centered"><h1>ACCESSORIES</h1>></div><b></div>
          </div> -->
          <!-- <div class="grid-item">
            <div class="grid-item__content-wrapper"><a class="ps-collection" href="product-listing"><img src="images/collection/home-5.jpg" alt=""></a></div>
          </div> -->
        </div>
      </div>
    </div>
    <div class="ps-section pt-80 pb-30">
      <!-- <div class="ps-container">
        <!- <div class="ps-subscribe"> 
          <div class="row">
            <div class="col-md-6 col-sm-12 col-md-push-6">
              <div class="ps-subscribe__content"><i class="ps-icon-notify"></i>
                <h3>SIGN UP TO NEWSLETTERS</h3>
                <p>And receive <strong>Rs. 25 coupon</strong> for first shopping ...!</p>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-pull-6">
              <form class="ps-form--subscribe" action="do_action" method="post">
                <div class="form-group">
                  <div class="form-group__icon"><i class="fa fa-envelope"></i></div>
                  <input class="form-control" type="text" placeholder="Type Your Email">
                </div>
                <button><i class="ps-icon-arrow-right"></i></button>
              </form>
            </div>
          </div>
        </div> -->
        <div class="ps-section__header text-center">
          <h2 class="ps-section__title">OTHERS PRODUCT</h2>
          <p>Featured collections created and curated by our editors</p>
        </div>
        <div class="ps-section__content">
          <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-1.jpg" alt="">
                      <div class="ps-badge ps-badge--sale-off"><span>-40%</span></div>
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">D TSHIRT</a>
                      <p class="ps-product__price">
                        <del>Rs. 450.89</del>Rs. 200
                      </p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-2.jpg" alt="">
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Kurti</a>
                      <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-3.jpg" alt="">
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Saree</a>
                      <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-4.jpg" alt="">
                      <div class="ps-badge"><span>New</span></div>
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Saree</a>
                      <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-5.jpg" alt="">
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer T-Shirt</a>
                      <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-6.jpg" alt="">
                      <div class="ps-badge ps-badge--sale-off"><span>-40%</span></div>
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Kurti</a>
                      <p class="ps-product__price">
                        <del>Rs. 450.89</del>Rs. 200
                      </p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-7.jpg" alt="">
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Saree</a>
                      <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                  <div class="ps-product--fashion">
                    <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-8.jpg" alt="">
                      <ul class="ps-product__actions">
                        <li><a class="ps-modal-open" href="#quickview" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                        <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                        <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                      </ul>
                    </div>
                    <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Kurti</a>
                      <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
                    </div>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  <!--   <div class="ps-section--offer-1">
      <div class="container">
        <div class="ps-block--offer-fashion">
          <div class="ps-block__left bg--cover" data-background="images/offers/home-offer-1.jpg"></div>
          <div class="ps-block__right">
            <h3>Converse Legacy Duffle</h3>
            <h2>Rs. 155 <del> Rs. 255</del></h2>
            <p>Over the past 50 years, Fjallraven has expanded from an office in a basement to a globally respected brand...</p>
            <ul class="ps-countdown ps-countdown--fashion" data-time="May 30, 2019 12:00:00">
              <li><span class="days"></span><p>Days</p></li>
              <li><span class="hours"></span><p>Hours</p></li>
              <li><span class="minutes"></span><p>minutes</p></li>
              <li><span class="seconds"></span><p>Seconds</p></li>
            </ul><a class="ps-btn--outline" href="#">Order Now</a>
          </div>
        </div>
      </div>
    </div> -->
    <div class="ps-section pt-60 pb-30">
      <div class="ps-container">
        <div class="ps-section__header text-center">
          <h2 class="ps-section__title">POPULAR PRODUCT</h2>
          <p>Here are key products that bring fashionistas to FGrouth Store.</p>
        </div>
        <div class="ps-section__content">
          <div class="ps-slider--center owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-nav-left="&lt;i class='ps-icon-arrow-left'&gt;&lt;/i&gt;" data-owl-nav-right="&lt;i class='ps-icon-arrow-right'&gt;&lt;/i&gt;">
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-1.jpg" alt="">
                <div class="ps-badge ps-badge--sale-off"><span>-40%</span></div>
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">PARKER TSHIRT</a>
                <p class="ps-product__price">
                  <del>Rs. 450.89</del>Rs. 200
                </p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-2.jpg" alt="">
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Kurti</a>
                <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-3.jpg" alt="">
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Saree</a>
                <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-4.jpg" alt="">
                <div class="ps-badge"><span>New</span></div>
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Saree</a>
                <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-5.jpg" alt="">
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">T-Shirt</a>
                <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-6.jpg" alt="">
                <div class="ps-badge ps-badge--sale-off"><span>-40%</span></div>
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Kurti</a>
                <p class="ps-product__price">
                  <del>Rs. 450.89</del>Rs. 200
                </p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-7.jpg" alt="">
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Saree</a>
                <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
            <div class="ps-product--fashion">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail"></a><img class="lazy" src="images/product/fashion-8.jpg" alt="">
                <ul class="ps-product__actions">
                  <li><a href="#" title="Quick View"><i class="ps-icon-eye"></i></a></li>
                  <li><a href="#" title="Compare"><i class="ps-icon-compare"></i></a></li>
                  <li><a href="#" title="Favorite"><i class="ps-icon-heart"></i></a></li>
                </ul>
              </div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail">Designer Kurti</a>
                <p class="ps-product__price">Rs. 350.00</p><a class="ps-product__cart" href="#" title="Add To Cart"><i class="ps-icon-cart-2"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   
    @endsection