<?php
	$Application = \Core\Application::getInstance();
	$imagePath   = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
?>
<!Doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-CA" class="no-js">
<!--<![endif]-->
<head>
<?php $this->renderPartial('assets::css_meta_no_min', array()); ?>
</head>

<body class="<?php echo ($this->getMvcRequest('controller')); ?> <?php echo ($this->getMvcRequest('rawAction')); ?>_page">
<!--<div class="loader-wrapper">
  <div id="loader-image"></div>
</div>-->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
 
</div>

<!-- **Wrapper** -->
<div class="wrapper">
  <div class="inner-wrapper"> 
    
    <!-- **Top Bar** -->
    <div class="top-bar">
      <div class="container">
        <ul class="top-menu">
          <li> <i class="fa fa-phone"></i> Any Questions? Call Us: <span> 1-223-355-2214 </span></li>
          <li> <i class="fa fa-skype"></i> Skype: <a href="#" title="Design Themes"> DesignThemes </a></li>
        </ul>
        <div class="top-right"> <span>Get social with us!</span>
          <ul class="dt-sc-social-icons">
            <li> <a href="#" title="facebook"> <i class="fa fa-facebook"></i> </a> </li>
            <li> <a href="#" title="twitter"> <i class="fa fa-twitter"></i> </a> </li>
            <li> <a href="#" title="google-plus"> <i class="fa fa-google-plus"></i> </a> </li>
            <li> <a href="#" title="pinterest"> <i class="fa fa-pinterest"></i> </a> </li>
            <li> <a href="#" title="skype"> <i class="fa fa-skype"></i> </a> </li>
            <li> <a href="#" title="youtube"> <i class="fa fa-youtube"></i> </a> </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- **Top Bar - End** -->
    
    <div id="header-wrapper"> 
      <!-- **Header** -->
      <header class="header">
        <div class="container"> 
          
          <!-- **Logo - End** -->
          <div id="logo"> <a href="index.html" title="Priority"> <img src="<?php echo $imagePath; ?>/logo.png" alt="logo"/> </a> </div>
          <!-- **Logo - End** -->
          
          <div id="menu-container"> 
            <!-- **Nav - Starts**-->
            <nav id="main-menu">
              <div id="dt-menu-toggle" class="dt-menu-toggle"> Menu <span class="dt-menu-toggle-icon"></span> </div>
              <ul class="menu">
                <li class="current_page_item menu-item-simple-parent"><a href="index.html">Home</a>
                  <ul class="sub-menu">
                    <li><a href="index.html">Home Example 1</a></li>
                    <li><a href="index-v2.html">Home Example 2</a></li>
                    <li><a href="index-v3.html">Home Example 3</a></li>
                    <li class="current_page_item"><a href="index-v4.html">Home Example 4</a></li>
                    <li><a href="index-v5.html">Home Example 5</a></li>
                    <li><a href="index-v6.html">Home Example 6</a></li>
                    <li><a href="index-v7.html">Home Example 7</a></li>
                    <li><a href="index-v8.html">Home Example 8</a></li>
                    <li><a href="one-page.html">One page Layout</a></li>
                  </ul>
                  <a class="dt-menu-expand">+</a> </li>
                <li class="menu-item-megamenu-parent megamenu-4-columns-group menu-item-depth-0"><a href="side-navigation.html">Features</a>
                  <div class="megamenu-child-container">
                    <ul class="sub-menu">
                      <li class="menu-item-with-widget-area"> <a href="#">Templates</a>
                        <p>We are the best in what we do.</p>
                        <div class="menu-item-widget-area-container">
                          <ul>
                            <li class="widget widget_text">
                              <div class="textwidget">
                                <ul>
                                  <li><a href="#">About</a></li>
                                  <li><a href="#">Team</a></li>
                                  <li><a href="#">Login</a></li>
                                  <li><a href="#">Register</a></li>
                                  <li><a href="#">404 Page</a></li>
                                  <li><a href="#">Coming soon</a></li>
                                </ul>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="menu-item-with-widget-area"> <a href="#">Shortcodes</a>
                        <p>The following features we have</p>
                        <div class="menu-item-widget-area-container">
                          <ul>
                            <li class="widget widget_text">
                              <div class="textwidget">
                                <ul>
                                  <li><a href="#">Side Tabs</a></li>
                                  <li><a href="#">Icon Boxes</a></li>
                                  <li><a href="#">Progress Bar</a></li>
                                  <li><a href="#">Accordions &amp; Tabs</a></li>
                                  <li><a href="#">Donut Charts</a></li>
                                  <li><a href="#">Pricing Tables</a></li>
                                </ul>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="menu-item-with-widget-area"> <a href="#">Home Page Designs</a>
                        <p>The following features we have</p>
                        <div class="menu-item-widget-area-container">
                          <ul>
                            <li class="widget widget_text">
                              <div class="textwidget">
                                <ul>
                                  <li><a href="#">Multipurpose Version 1</a></li>
                                  <li><a href="#">Multipurpose Version 2</a></li>
                                  <li><a href="#">Multipurpose Version 3</a></li>
                                  <li><a href="#">Shop Page</a></li>
                                  <li><a href="#">Portfolio Page</a></li>
                                </ul>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="menu-item-with-widget-area"> <a href="#">Miscellaneous</a>
                        <p>The following features we have</p>
                        <div class="menu-item-widget-area-container">
                          <ul>
                            <li class="widget widget_text">
                              <div class="textwidget">
                                <ul>
                                  <li><a href="#">100% Fully Responsive</a></li>
                                  <li><a href="#">Boxed and Wide Versions</a></li>
                                  <li><a href="#">10 Unique Home Page Options</a></li>
                                  <li><a href="#">Font Awesome Icons</a></li>
                                  <li><a href="#">Valid HTML5 and CSS3</a></li>
                                </ul>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <a class="dt-menu-expand">+</a> </li>
                <li class="menu-item-simple-parent"><a href="tabs-accordions.html" >Pages</a>
                  <ul class="sub-menu">
                    <li class="menu-item-simple-parent menu-item-depth-0"><a href="headers.html">Headers</a>
                      <ul class="sub-menu">
                        <li><a href="headers.html">Header 1</a></li>
                        <li><a href="header2.html">Header 2</a></li>
                        <li><a href="header3.html">Header 3</a></li>
                        <li><a href="header4.html">Header 4</a></li>
                        <li><a href="header5.html">Header 5</a></li>
                        <li><a href="header6.html">Header 6</a></li>
                        <li><a href="header7.html">Header 7</a></li>
                        <li><a href="header8.html">Header 8</a></li>
                        <li><a href="header9.html">Header 9</a></li>
                        <li><a href="header10.html">Header 10</a></li>
                        <li><a href="header11.html">Header 11</a></li>
                        <li><a href="header12.html">Header 12</a></li>
                      </ul>
                      <a class="dt-menu-expand">+</a> </li>
                    <li class="menu-item-simple-parent menu-item-depth-0"><a href="footer1.html">Footers</a>
                      <ul class="sub-menu">
                        <li><a href="footer1.html">Footer 1</a></li>
                        <li><a href="footer2.html">Footer 2</a></li>
                        <li><a href="footer3.html">Footer 3</a></li>
                        <li><a href="footer4.html">Footer 4</a></li>
                        <li><a href="footer5.html">Footer 5</a></li>
                        <li><a href="footer6.html">Footer 6</a></li>
                        <li><a href="footer7.html">Footer 7</a></li>
                      </ul>
                      <a class="dt-menu-expand">+</a> </li>
                    <li class="menu-item-simple-parent menu-item-depth-0"><a href="about.html">About</a>
                      <ul class="sub-menu">
                        <li><a href="about.html">About 1</a></li>
                        <li><a href="about-2.html">About 2</a></li>
                        <li><a href="about-3.html">About 3</a></li>
                      </ul>
                      <a class="dt-menu-expand">+</a> </li>
                    <li><a href="team.html"> Team </a></li>
                    <li><a href="services.html"> Services </a></li>
                    <li><a href="pricing-table.html"> Pricing </a></li>
                    <li><a href="tabs-accordions.html"> Shortcodes </a></li>
                    <li><a href="miscellaneous.html"> Miscellaneous </a></li>
                    <li><a href="coming-soon.html"> Coming Soon </a></li>
                    <li><a href="login.html"> Login </a></li>
                    <li><a href="register.html"> Register </a></li>
                    <li><a href="404-page.html"> 404 - page </a></li>
                  </ul>
                  <a class="dt-menu-expand">+</a> </li>
                <li class="menu-item-megamenu-parent megamenu-4-columns-group menu-item-depth-0"><a href="blog-with-rhs.html">Blog</a>
                  <div class="megamenu-child-container">
                    <ul class="sub-menu">
                      <li><a href="blog.html"> I Column</a>
                        <ul class="sub-menu">
                          <li><a href="blog.html">Fullwidth</a></li>
                          <li><a href="blog-with-lhs.html">With Left Sidebar</a></li>
                          <li><a href="blog-with-rhs.html">With Right Sidebar</a></li>
                          <li><a href="blog-with-pagination.html">With Pagination</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                      <li><a href="blog-2-column.html"> II Column</a>
                        <ul class="sub-menu">
                          <li><a href="blog-2-column.html">Fullwidth</a></li>
                          <li><a href="blog-2-column-with-lhs.html">With Left Sidebar</a></li>
                          <li><a href="blog-2-column-with-rhs.html">With Right Sidebar</a></li>
                          <li><a href="blog-2-column-with-pagination.html">With Pagination</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                      <li><a href="blog-masonry.html"> Blog Masonry</a>
                        <ul class="sub-menu">
                          <li><a href="blog-masonry.html">Fullwidth</a></li>
                          <li><a href="blog-masonry-with-lhs.html">With Left Sidebar</a></li>
                          <li><a href="blog-masonry-with-rhs.html">With Right Sidebar</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                      <li><a href="blog-detail.html"> Single Post </a>
                        <ul class="sub-menu">
                          <li><a href="blog-detail.html">Fullwidth</a></li>
                          <li><a href="blog-detail-with-left-sidebar.html">With Left Sidebar</a></li>
                          <li><a href="blog-detail-with-right-sidebar.html">With Right Sidebar</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                    </ul>
                  </div>
                  <a class="dt-menu-expand">+</a> </li>
                <li class="menu-item-megamenu-parent megamenu-5-columns-group menu-item-depth-0"><a href="portfolio-4-column-with-space.html">Portfolio</a>
                  <div class="megamenu-child-container">
                    <ul class="sub-menu">
                      <li><a href="portfolio-1-column-without-space.html"> I Column</a>
                        <ul class="sub-menu">
                          <li><a href="portfolio.html">Fullwidth</a></li>
                          <li><a href="portfolio-with-lhs.html">With Left Sidebar</a></li>
                          <li><a href="portfolio-with-rhs.html">With Right Sidebar</a></li>
                          <li><a href="portfolio-without-space.html">Without Space</a></li>
                          <li><a href="portfolio-with-pagination.html">With Pagination</a></li>
                          <li><a href="portfolio-without-filter.html">Without Filter</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                      <li><a href="portfolio-2-column-without-space.html"> II Column</a>
                        <ul class="sub-menu">
                          <li><a href="portfolio-2-column-with-space.html">Fullwidth</a></li>
                          <li><a href="portfolio-2-column-with-lhs.html">With Left Sidebar</a></li>
                          <li><a href="portfolio-2-column-with-rhs.html">With Right Sidebar</a></li>
                          <li><a href="portfolio-2-column-without-space.html">Without Space</a></li>
                          <li><a href="portfolio-2-column-with-pagination.html">With Pagination</a></li>
                          <li><a href="portfolio-2-column-without-filter.html">Without Filter</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                      <li><a href="portfolio-3-column-without-space.html"> III Column</a>
                        <ul class="sub-menu">
                          <li><a href="portfolio-3-column-with-space.html">Fullwidth</a></li>
                          <li><a href="portfolio-3-column-with-lhs.html">With Left Sidebar</a></li>
                          <li><a href="portfolio-3-column-with-rhs.html">With Right Sidebar</a></li>
                          <li><a href="portfolio-3-column-without-space.html">Without Space</a></li>
                          <li><a href="portfolio-3-column-with-pagination.html">With Pagination</a></li>
                          <li><a href="portfolio-3-column-without-filter.html">Without Filter</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                      <li><a href="portfolio-4-column-without-space.html"> IV Column</a>
                        <ul class="sub-menu">
                          <li><a href="portfolio-4-column-with-space.html">Fullwidth</a></li>
                          <li><a href="portfolio-4-column-with-lhs.html">With Left Sidebar</a></li>
                          <li><a href="portfolio-4-column-with-rhs.html">With Right Sidebar</a></li>
                          <li><a href="portfolio-4-column-without-space.html">Without Space</a></li>
                          <li><a href="portfolio-4-column-with-pagination.html">With Pagination</a></li>
                          <li><a href="portfolio-4-column-without-filter.html">Without Filter</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                      <li><a href="portfolio-detail.html"> Gallery Single</a>
                        <ul class="sub-menu">
                          <li><a href="portfolio-detail-v2.html">Fullwidth</a></li>
                          <li><a href="portfolio-detail.html">Left Gallery</a></li>
                          <li><a href="portfolio-detail-v3.html">Right Gallery</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a> </li>
                    </ul>
                  </div>
                  <a class="dt-menu-expand">+</a> </li>
                <li class="menu-item-simple-parent"><a href="shop.html">Shop</a>
                  <ul class="sub-menu">
                    <li><a href="shop.html">Shop Pages</a>
                      <ul class="sub-menu">
                        <li><a href="shop-without-sidebar.html">Without Sidebar</a></li>
                        <li><a href="shop.html">With Sidebar</a></li>
                      </ul>
                      <a class="dt-menu-expand">+</a> </li>
                    <li><a href="shop-cart.html">Cart</a></li>
                    <li><a href="shop-checkout.html">Checkout</a></li>
                  </ul>
                  <a class="dt-menu-expand">+</a> </li>
                <li class="menu-item-simple-parent"><a href="contact.html" >Contact</a>
                  <ul class="sub-menu">
                    <li><a href="contact.html">Contact Layout 1</a></li>
                    <li><a href="contact-v2.html">Contact Layout 2</a></li>
                  </ul>
                  <a class="dt-menu-expand">+</a> </li>
              </ul>
            </nav>
            <!-- **Nav - End**--> 
          </div>
        </div>
      </header>
      <!-- **Header - End** --> 
    </div>
    
    <!-- **Main - Starts** -->
    <div id="main"> 
      
      <!-- **banner - Starts** -->
      <div class="banner"> 
        <!-- **Slider Section** -->
        <div id="layerslider_9" class="ls-wp-container" style="width:100%;height:645px;max-width:1920px;margin:0 auto;margin-bottom: 0px;">
        	
            
        	
          <div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;">
            <img src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/bg3.jpg" class="ls-bg" alt="bg3" />
            <div class="ls-l" style="top:170px;left:820px;font-weight:300; z-index:5;repadding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:39px;line-height:46px;color:#101017;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-100;durationin:2000;delayin:2500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">
            Visibilité de projets </div>
            <div class="ls-l" style="top:308px;left:781px;font-weight:normal; z-index:3;font-family:'Lato';font-size:14px;line-height:26px;color:rgb(77, 77, 77);text-shadow: 2px 2px #FFFFFF;;white-space: nowrap;" data-ls="offsetxin:-100;durationin:2000;delayin:4000;">
            Le site Innovation Pédagogique Umontreal présente la conception<br /> 
            ou la reconception d’outils, de produits, de procédés ou de services <br />
            pédagogiques développés  par nos étudiantes finissantes et étudiants <br />
            finissants du baccalauréat en adaptation scolaire de l’Université de <br />
            Montréal. Ce site vise, tout particulièrement la visibilité de projets <br />
            innovateurs. En outre, ce site souhaite favoriser la pérennité des projets <br />
            et engager la collaboration des établissements scolaires et milieux cliniques.</div>
            <div class="ls-l" style="top:230px;left:820px;font-weight:700; z-index:3;font-family:'Lato';font-size:45px;line-height:26px;color:#01a8df;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:50;durationin:2000;delayin:3000;">INNOVATEURS</div>
            
            <div class="ls-l" style="top:135px;left:832px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;delayin:3000;"><span style="background: #00a5df; color: #fff; display: inline-block; font-family: 'Lato', sans-serif; font-size: 20px; font-weight: 300; line-height: 24px; margin: 10px 0 0; padding: 0 7px 0 7px; position: relative; text-decoration: none; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; -o-border-radius: 3px; ">Innovation Pédagogique</span> 
           </div>
           
           <img class="ls-l" style="top:145px;left:780px;white-space: nowrap;" data-ls="durationin:1600;delayin:3500;rotateyin:90;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/quote.png" alt="image"> 
           <?php /*?><img class="ls-l" style="top:405px;left:1070px;white-space: nowrap;" data-ls="offsetxin:-150;delayin:5500;rotateyin:180;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/html-logo.png" alt="image"> 
           <img class="ls-l" style="top:405px;left:790px;white-space: nowrap;" data-ls="offsetxin:0;delayin:4500;rotateyin:180;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/css3-logo.png" alt="image"> <?php */?>
            <img class="ls-l" style="top:80px;left:50px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:300;durationin:1500;delayin:500;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/Happy-Teacher.png" alt="image"> 
            <img class="ls-l" style="top:156px;left:-32px;white-space: nowrap;" data-ls="offsetxin:-150;durationin:1500;delayin:1500;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/education-innovation-bulb.png" alt="image"> 
            
            
            <img class="ls-l" style="top:20px;left:195px;white-space: nowrap;" data-ls="parallaxlevel:2;delayin:2700;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/baloon.png" alt="image"> 
            <img class="ls-l" style="top:8px;left:250px;white-space: nowrap;" data-ls="parallaxlevel:4;delayin:3000;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/bulb.png" alt="image"> 
            
            <?php /*?><img class="ls-l" style="top:432px;left:940px;white-space: nowrap;" data-ls="offsetxin:-150;delayin:5000;rotateyin:180;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/plus.png" alt="image"> <?php */?>
            
            <!--<p class="ls-l" style="top:470px;left:210px;white-space: nowrap;" data-ls="offsetxin:-150;delayin:7500;"> <a href="#" class="dt-sc-button2">En Savoir Plus &raquo;</a></p>
            <p class="ls-l" style="top:510px;left:920px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;delayin:4000;">
            	<a href="#" class="dt-sc-button2 ico-button">En Savoir Plus &raquo;</a></p>-->
            
         </div>
        
        	<div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;">
                <img src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/kids-bg.jpg" class="ls-bg" alt="kids-bg" />
                <img class="ls-l" style="top:6px;left:28px;white-space: nowrap;" data-ls="delayin:500;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/child.png" alt="image">
                <img class="ls-l" style="top:256px;left:452px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;delayin:1500;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/book-bg.png" alt="image">
                <img class="ls-l" style="top:296px;left:475px;white-space: nowrap;" data-ls="offsetxin:0;delayin:2000;rotatexin:180;rotateyin:180;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/edu-txt.png" alt="image">
                <img class="ls-l" style="top:66px;left:432px;white-space: nowrap;" data-ls="offsetxin:0;durationin:3000;delayin:3000;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/priority-edu-txt.png" alt="image">
                <img class="ls-l" style="top:66px;left:432px;white-space: nowrap;" data-ls="offsetxin:0;durationin:3000;delayin:3000;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/priority-edu-txt.png" alt="image">
                <img class="ls-l" style="top:7px;left:850px;white-space: nowrap;" data-ls="offsetxin:0;delayin:3000;rotatein:180;offsetxout:0;parallaxlevel:2;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/sun.png" alt="image">
                <img class="ls-l" style="top:376px;left:-78px;white-space: nowrap;" data-ls="offsetxin:100;durationin:3000;delayin:3200;offsetxout:0;parallaxlevel:1;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/cloud2.png" alt="image">
                <img class="ls-l" style="top:30px;left:-355px;white-space: nowrap;" data-ls="offsetxin:-100;offsetyin:-100;durationin:5000;delayin:4000;offsetxout:0;parallaxlevel:-2;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/cloud1.png" alt="image">
                <img class="ls-l" style="top:358px;left:782px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-30;durationin:2500;delayin:3800;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/avp.png" alt="image">
            </div>
            
            
            
          <div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;"> <img src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/bg1.jpg" class="ls-bg" alt="bg1" />
            <div class="ls-l" style="top:196px;left:20px;font-weight:300; z-index:5;padding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:59px;line-height:46px;color:#101017;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:200;durationin:2500;delayin:1500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">Create with <span style="color:#21c2f8; font-weight:900">Priority</span> </div>
            <div class="ls-l" style="top:266px;left:22px;font-weight:300; z-index:3;font-family:'Lato';font-size:30px;line-height:26px;color:#101017;white-space: nowrap;" data-ls="offsetxin:-100;durationin:2000;delayin:2500;">win the race <span style="color:#21c2f8;">- a modern HTML template</span> </div>
            <div class="ls-l" style="top:325px;left:20px;z-index: display:block;width:622px;height:2px;border-bottom:1px solid #101017;font-family:'Ubuntu';font-size:24px;line-height:34px;color:#020203;background:#101017;white-space: nowrap;" data-ls="offsetxin:-500;durationin:2500;delayin:4500;"><br>
            </div>
            <img class="ls-l" style="top:23px;left:623px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-100;delayin:500;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/running-man.png" alt="image">
            <p class="ls-l" style="top:172px;left:551px;font-weight:300;font-family:Lato;font-size:123px;color:#a2abb8;white-space: nowrap;" data-ls="durationin:2000;delayin:2000;">&amp;</p>
            <div class="ls-l" style="top:360px;left:20px;font-weight:normal; z-index:5; letter-spacing: 7px;padding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:62px;line-height:46px;color:#101017;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:200;durationin:2500;delayin:3500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">SMOOTH + <span style="color:#a2abb8;">CLEAN</span> </div>
          </div>
          <div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;"> <img src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/bg2.jpg" class="ls-bg" alt="bg2" />
            <div class="ls-l" style="top:185px;left:15px;font-weight:normal; z-index:5;padding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:60px;line-height:46px;color:#101017;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-100;durationin:2000;delayin:2500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">PRIORITY<span style="font-weight:300;padding-left:110px">TEMPLATE</span> </div>
            <div class="ls-l" style="top:150px;left:20px;font-weight:700; z-index:3;font-family:'Lato';font-size:18px;line-height:26px;color:#01a8df;white-space: nowrap;" data-ls="offsetxin:-100;durationin:2000;delayin:1500;">Unlimited Combinations from</div>
            <div class="ls-l" style="top:257px;left:20px;font-weight:300; z-index:3; letter-spacing:5.5px;font-family:'Lato';font-size:43px;line-height:26px;color:#101017;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;durationin:2000;delayin:3500;">Smooth &amp; Clean</div>
            <div class="ls-l" style="top:323px;left:20px;font-weight:300;font-family:'Lato';font-size:18px;color:#101017;white-space: nowrap;" data-ls="delayin:4500;"><span style="color:#00a5df; font-weight:700;">8+ </span>Home Page Designs</div>
            <p class="ls-l" style="top:470px;left:20px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;delayin:7000;"> <a href="#" class="dt-sc-button1 ico-button"> VIEW DEMO</a></p>
            <div class="ls-l" style="top:178px;left:302px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:100;delayin:3000;"><span style="background: #00a5df; color: #fff; display: inline-block; font-family: 'Lato', sans-serif; font-size: 20px; font-weight: 300; line-height: 24px; margin: 10px 0 0; padding: 0 7px 0 7px; position: relative; text-decoration: none; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; -o-border-radius: 3px; }">HTML 5 </span> </div>
            <img class="ls-l" style="top:0px;left:636px;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:500;durationin:1800;" src="<?php echo $imagePath; ?>/sliders/blank.gif" data-src="<?php echo $imagePath; ?>/sliders/woman.png" alt="image">
            <div class="ls-l" style="top:353px;left:20px;font-weight:300;font-family:'Lato';font-size:18px;color:#101017;white-space: nowrap;" data-ls="delayin:5000;">Lots of <span style="color:#00a5df; font-weight:700;">Shortcode Elements</span></div>
            <div class="ls-l" style="top:383px;left:20px;font-weight:300;font-family:'Lato';font-size:18px;color:#101017;white-space: nowrap;" data-ls="delayin:5500;">Coded with <span style="color:#00a5df; font-weight:700;">HTML 5 &amp; Css3</span> </div>
            <div class="ls-l" style="top:413px;left:20px;font-weight:300;font-family:'Lato';font-size:18px;color:#101017;white-space: nowrap;" data-ls="delayin:6000;"><span style="color:#00a5df; font-weight:700;">Animated</span> Elements</div>
            <p class="ls-l" style="top:470px;left:210px;white-space: nowrap;" data-ls="offsetxin:-150;delayin:7500;"> <a href="#" class="dt-sc-button2">PURCHASE NOW</a></p>
          </div>
        </div>
      </div>
      <!-- **banner - Ends** --> 
      
      <!-- **intro-text - starts** -->
      <div class="intro-text type2">
        <div class="container">
          <div class="column dt-sc-two-third first">
            <h4>Great Combinations of <span>elements</span> only from PRIORITY</h4>
          </div>
          <div class="column dt-sc-one-third"> <a class="dt-sc-button large" href="#">Purchase this theme <span class="fa fa-angle-right"></span></a> </div>
        </div>
      </div>
      <!-- **intro-text - Ends** --> 
      <!-- **Full-width-section - Starts** -->
      <div class="full-width-section">
        <div class="dt-sc-margin65"></div>
        <div class="container">
          <div class="column dt-sc-one-third first">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInRight" data-delay="100"> <img src="<?php echo $imagePath; ?>/admin1.png" alt="admin"/> </div>
              <h4> <a href="#"> Awesome Features </a> </h4>
              <p>Donec sodales sagittis magna. Sed conse quat, leo eget bibendum sodales, augue velit cursus nunc. </p>
            </div>
          </div>
          <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInUp" data-delay="100"> <img src="<?php echo $imagePath; ?>/tablet-icon1.png" alt="tablet"/> </div>
              <h4> <a href="#"> 100% Responsive </a> </h4>
              <p>Etiam sit amet orci eget eros fauc ibus la tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.</p>
            </div>
          </div>
          <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate"  data-animation="fadeInLeft" data-delay="100"> <img src="<?php echo $imagePath; ?>/camera1.png" alt="plane"/> </div>
              <h4> <a href="#"> Media Support </a> </h4>
              <p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui.</p>
            </div>
          </div>
          <div class="dt-sc-margin30"></div>
          <div class="column dt-sc-one-third first">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate"  data-animation="fadeInRight" data-delay="100"> <img src="<?php echo $imagePath; ?>/power-gears1.png" alt="flag"/> </div>
              <h4> <a href="#"> Extremely Flexible </a> </h4>
              <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. </p>
            </div>
          </div>
          <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInUp" data-delay="100"> <img src="<?php echo $imagePath; ?>/battery.png" alt="flag"/> </div>
              <h4> <a href="#"> Light Weight </a> </h4>
              <p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui.</p>
            </div>
          </div>
          <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInLeft" data-delay="100"> <img src="<?php echo $imagePath; ?>/watch.png" alt="flag"/> </div>
              <h4> <a href="#"> Latest Design Trend </a> </h4>
              <p>Etiam sit amet orci eget eros fauc ibus la tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. </p>
            </div>
          </div>
          <div class="dt-sc-margin30"></div>
          <div class="column dt-sc-one-third first">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInRight" data-delay="100"> <img src="<?php echo $imagePath; ?>/book-mark.png" alt="flag"/> </div>
              <h4> <a href="#"> Exclusive Documentation </a> </h4>
              <p>Donec sodales sagittis magna. Sed conse quat, leo eget bibendum sodales, augue velit cursus nunc. </p>
            </div>
          </div>
          <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInUp" data-delay="100"> <img src="<?php echo $imagePath; ?>/speaker.png" alt="flag"/> </div>
              <h4> <a href="#"> Product Page </a> </h4>
              <p>Etiam sit amet orci eget eros fauc ibus la tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. </p>
            </div>
          </div>
          <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInLeft" data-delay="100"> <img src="<?php echo $imagePath; ?>/brush-bucket.png" alt="flag"/> </div>
              <h4> <a href="#"> Unlimited Colors </a> </h4>
              <p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui.</p>
            </div>
          </div>
        </div>
        <div class="dt-sc-margin50"></div>
      </div>
      <!-- **Full-width-section - Ends** --> 
      
      <!-- **Full-width-section - Starts** -->
      <div class="full-width-section grey">
        <div class="dt-sc-margin50"></div>
        <div class="container">
          <h2 class="aligncenter">Our Portfolio</h2>
          <div class="sorting-container"> <a data-filter=".all-sort" class="active-sort" href="#" >All</a> <a data-filter=".photography-sort" href="#" >Photography</a> <a href="#" data-filter=".outdoors-sort" >Outdoors</a> <a href="#" data-filter=".fashion-sort" >Fashion</a> <a data-filter=".graphic-sort" href="#" >Graphic Design</a> </div>
          <div class="dt-sc-hr-invisible-small"></div>
          <!-- **portfolio-container - Starts** -->
          <div class="portfolio-container no-space">
            <div class="portfolio dt-sc-one-fourth no-space column all-sort outdoors-sort fashion-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image13.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image13.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail-v2.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail-v2.html"> Dandelion Falls </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
            <div class="portfolio dt-sc-one-fourth no-space column all-sort fashion-sort graphic-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image12.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image12.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail.html"> Fashion </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
            <div class="portfolio dt-sc-one-fourth no-space column all-sort fashion-sort photography-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image10.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image10.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail-v2.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail-v2.html"> World is ours </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
            <div class="portfolio dt-sc-one-fourth no-space column all-sort photography-sort outdoors-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image18.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image18.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail.html"> Love the Life </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
            <div class="portfolio dt-sc-one-fourth no-space column all-sort fashion-sort outdoors-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image19.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image19.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail-v2.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail-v2.html"> Snow Time </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
            <div class="portfolio dt-sc-one-fourth no-space column all-sort graphic-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image22.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image22.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail.html"> Black Jade </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
            <div class="portfolio dt-sc-one-fourth no-space column all-sort photography-sort graphic-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image24.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image24.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail-v2.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail-v2.html"> Photography </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
            <div class="portfolio dt-sc-one-fourth no-space column all-sort graphic-sort"> 
              <!-- **portfolio-thumb - Starts** -->
              <div class="portfolio-thumb">
                <figure> <img src="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image15.jpg" alt="image"/>
                  <div class="image-overlay"> <a class="zoom" href="<?php echo $imagePath; ?>/portfolio-<?php echo $imagePath; ?>/image15.jpg" data-gal="prettyPhoto[gallery]"><span class="fa fa-search"></span></a> <a class="link" href="portfolio-detail.html"><span class="fa fa-link"></span></a>
                    <div class="portfolio-content">
                      <h5> <a href="portfolio-detail.html"> An Adventure </a> </h5>
                      <span class="fa fa-sort-up"></span> </div>
                  </div>
                </figure>
              </div>
              <!-- **portfolio-thumb - Ends** --> 
            </div>
          </div>
          <!-- **portfolio-container - Ends** -->
          <div class="dt-sc-hr-invisible"></div>
        </div>
      </div>
      <!-- **Full-width-section - Ends** --> 
      
      <!-- **Full-width-section - Starts** -->
      <div class="parallax full-width-section fullwidth-testimonial">
        <div class="container">
          <div class="dt-sc-testimonial-wrapper type2">
            <ul class="dt-sc-testimonial-carousel">
              <li>
                <div class="dt-sc-testimonial">
                  <h5>" This template is composed of colors. A great deal if you want a colorful &amp; vibrant website for your business or portfolio.<br/>
                    I highly recommend it."</h5>
                  <span>Sarah Mitchell</span>
                  <div class="dt-sc-margin30"></div>
                  <div class="author"> <img src="<?php echo $imagePath; ?>/author.jpg" alt="image"/> </div>
                </div>
              </li>
              <li>
                <div class="dt-sc-testimonial">
                  <h5>" This template is composed of colors. A great deal if you want a colorful &amp; vibrant website for your business or portfolio.<br/>
                    I highly recommend it. A great deal."</h5>
                  <span> Sean Bean </span>
                  <div class="dt-sc-margin30"></div>
                  <div class="author"> <img src="<?php echo $imagePath; ?>/author3.jpg" alt="image"/> </div>
                </div>
              </li>
              <li>
                <div class="dt-sc-testimonial">
                  <h5>" This template is composed of colors. A great deal if you want a colorful &amp; vibrant website for your business or portfolio.<br/>
                    I highly recommend it. Website for your business."</h5>
                  <span> Mathew Braveheart </span>
                  <div class="dt-sc-margin30"></div>
                  <div class="author"> <img src="<?php echo $imagePath; ?>/author2.jpg" alt="image"/> </div>
                </div>
              </li>
            </ul>
            <div class="slider-controls">
              <div class="pager"> <a href="#"> <span> 1 </span> </a> <a href="#"> <span> 2 </span> </a> <a href="#"> <span> 3 </span> </a> </div>
            </div>
          </div>
        </div>
      </div>
      <!-- **Full-width-section - Ends** --> 
      
      <!-- **Full-width-section - Starts** -->
      <div class="full-width-section">
        <div class="dt-sc-margin50"></div>
        <div class="container">
          <h2 class="aligncenter">Recent Blog</h2>
          <p class="middle-align">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical<br/>
            Latin literature from 45 BC, making it over 2000 years old. </p>
          <div class="dt-sc-hr-invisible-small"></div>
          <div class="column dt-sc-one-third first animate" data-animation="fadeInDown" data-delay="100"> 
            <!-- **entry-post - Starts** -->
            <article class="entry-post">
              <div class="entry-meta">
                <div class="date">
                  <p> <span>28</span> FEB 2014 </p>
                </div>
                <div class="post-comments"> <a href="#"><span class="fa fa-comment"></span> 12</a> </div>
              </div>
              <div class="entry-post-content">
                <div class="entry-thumb"> <a href="blog-detail-with-right-sidebar.html"><img src="<?php echo $imagePath; ?>/blog-8.jpg" alt="image"/></a> </div>
                <div class="entry-detail">
                  <h5><a href="blog-detail-with-right-sidebar.html"> Switzerland at its best </a></h5>
                  <p> Occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. </p>
                  <a class="dt-sc-button small" href="#">Read More <span class="fa fa-long-arrow-right"></span> </a> </div>
              </div>
            </article>
            <!-- **entry-post - Ends** --> 
          </div>
          <div class="column dt-sc-one-third animate" data-animation="fadeInUp" data-delay="100"> 
            <!-- **entry-post - Starts** -->
            <article class="entry-post">
              <div class="entry-meta">
                <div class="date">
                  <p> <span>27</span> AUG 2014 </p>
                </div>
                <div class="post-comments"> <a href="#"><span class="fa fa-comment"></span> 15</a> </div>
              </div>
              <div class="entry-post-content">
                <div class="entry-thumb"> <a href="blog-detail-with-right-sidebar.html"><img src="<?php echo $imagePath; ?>/blog-6.jpg" alt="image"/></a> </div>
                <div class="entry-detail">
                  <h5><a href="blog-detail-with-right-sidebar.html"> Get a little closer to the graphics. </a></h5>
                  <p> Rokccaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum.. </p>
                  <a class="dt-sc-button small" href="#">Read More <span class="fa fa-long-arrow-right"></span> </a> </div>
              </div>
            </article>
            <!-- **entry-post - Ends** --> 
          </div>
          <div class="column dt-sc-one-third animate" data-animation="fadeInDown" data-delay="100"> 
            <!-- **entry-post - Starts** -->
            <article class="entry-post">
              <div class="entry-meta">
                <div class="date">
                  <p> <span>10</span> NOV 2014 </p>
                </div>
                <div class="post-comments"> <a href="blog-detail-with-right-sidebar.html"><span class="fa fa-comment"></span> 18</a> </div>
              </div>
              <div class="entry-post-content">
                <div class="entry-thumb"> <a href="blog-detail-with-right-sidebar.html"><img src="<?php echo $imagePath; ?>/blog-7.jpg" alt="image"/></a> </div>
                <div class="entry-detail">
                  <h5><a href="#"> Get the App now 35% Discount </a></h5>
                  <p> Eccaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. </p>
                  <a class="dt-sc-button small" href="#">Read More <span class="fa fa-long-arrow-right"></span> </a> </div>
              </div>
            </article>
            <!-- **entry-post - Ends** --> 
          </div>
          <div class="dt-sc-margin70"></div>
        </div>
      </div>
      <!-- **Full-width-section - Ends** --> 
      
      <!-- **Full-width-section - Starts** -->
      <div class="full-width-section grey">
        <div class="dt-sc-hr-invisible"></div>
        <div class="container"> 
          <!-- **dt-sc-partner-carousel-wrapper - Starts** -->
          <div class="dt-sc-partner-carousel-wrapper">
            <ul class="dt-sc-partner-carousel">
              <li><a href="#"><img src="<?php echo $imagePath; ?>/client-<?php echo $imagePath; ?>/client-logo1.png" alt="image"/></a></li>
              <li><a href="#"><img src="<?php echo $imagePath; ?>/client-<?php echo $imagePath; ?>/client-logo2.png" alt="image"/></a></li>
              <li><a href="#"><img src="<?php echo $imagePath; ?>/client-<?php echo $imagePath; ?>/client-logo3.png" alt="image"/></a></li>
              <li><a href="#"><img src="<?php echo $imagePath; ?>/client-<?php echo $imagePath; ?>/client-logo4.png" alt="image"/></a></li>
              <li><a href="#"><img src="<?php echo $imagePath; ?>/client-<?php echo $imagePath; ?>/client-logo3.png" alt="image"/></a></li>
            </ul>
          </div>
          <!-- **dt-sc-partner-carousel-wrapper - Starts** --> 
        </div>
        <div class="dt-sc-hr-invisible-small"></div>
      </div>
      <!-- **Full-width-section - Ends** --> 
      
      <!-- **Full-width-section - Starts** -->
      <div class="full-width-section">
        <div id="map"></div>
        <div class="dt-sc-margin50"></div>
        <div class="container">
          <div class="column dt-sc-three-fourth first animate" data-animation="fadeInRight" data-delay="100">
            <div class="hr-title">
              <h3>Give a Message</h3>
              <div class="title-sep"> </div>
            </div>
            <form method="post" class="dt-sc-contact-form" action="php/send.php" name="frmcontact">
              <div class="column dt-sc-one-third first">
                <p> <span>
                  <input type="text" placeholder="Name*" name="txtname" value="" required />
                  </span> </p>
              </div>
              <div class="column dt-sc-one-third">
                <p> <span>
                  <input type="email" placeholder="Email*" name="txtemail" value="" required />
                  </span> </p>
              </div>
              <div class="column dt-sc-one-third">
                <p> <span>
                  <input type="text" placeholder="Phone" name="txtphone" value="" />
                  </span> </p>
              </div>
              <p>
                <textarea placeholder="Message*" name="txtmessage" required ></textarea>
              </p>
              <p>
                <input type="submit" value="Send Message" name="submit" />
              </p>
            </form>
            <div id="ajax_contact_msg"></div>
          </div>
          <div class="column dt-sc-one-fourth animate" data-animation="fadeInLeft" data-delay="100">
            <div class="hr-title">
              <h3>Contact Info</h3>
              <div class="title-sep"> </div>
            </div>
            <p class="dt-sc-contact-detail"> We are located in Melbourne, serving clients worldwide. Shoot us an email, give us a call, or fill out our Project Brief if you're interested in getting started. </p>
            <!-- **dt-sc-contact-info - Starts** -->
            <div class="dt-sc-contact-info">
              <p> <i class="fa fa-location-arrow"></i> 121 King St, Melbourne VIC 3000,<br/>
                Australia </p>
              <p> <i class="fa fa-phone"></i> +61 3 8376 6284 </p>
              <p> <i class="fa fa-globe"></i> <a href="#"> envato.com </a> </p>
              <p> <i class="fa fa-envelope"></i> <a href="#"> grandjade@gmail.com </a> </p>
            </div>
            <!-- **dt-sc-contact-info - Ends** --> 
          </div>
        </div>
        <div class="dt-sc-margin80"></div>
      </div>
      <!-- **Full-width-section - Ends** --> 
      
    </div>
    <!-- **Main - Ends** --> 
    
    <!-- **Footer** -->
    <footer id="footer">
      <div class="footer-widgets-wrapper">
        <div class="container">
          <div class="column dt-sc-one-fourth first">
            <aside class="widget widget_text">
              <h3 class="widget-title">Contact <span class="wlast"> Us </span><span class="small-line"> </span></h3>
              <p> <i class="fa fa-phone"></i> <span>Phone:</span> +22 004 324 1124 </p>
              <p> <i class="fa fa-print"></i> <span>Fax:</span> +22 004 324 1124 </p>
              <p> <i class="fa fa-envelope"></i> <span> Email:</span> <a href="#">priority@gmail.com</a> </p>
              <p> <i class="fa fa-globe"></i> <span>Web:</span> <a href="#">www.Wedesignthemes.com</a> </p>
              <p> <i class="fa fa-location-arrow"></i> <span>58, Thomson Street, Edison Avenue,
                Baltimore, USA</span> </p>
            </aside>
          </div>
          <div class="column dt-sc-one-fourth">
            <aside class="widget widget_popular_entries">
              <h3 class="widget-title">Popular <span class="wlast">Posts</span><span class="small-line"> </span></h3>
              <div class="recent-property-widget">
                <ul>
                  <li> <a class="thumb" href="#"><img src="<?php echo $imagePath; ?>/recent-photo1.jpg" alt="image"/></a>
                    <h6><a href="#">Here comes the title for 
                      the post with 2 lines</a></h6>
                    <div class="entry-meta">
                      <p><span class="fa fa-calendar"></span>03Aug2012</p>
                      <p><span class="fa fa-user"></span><a href="">admin</a></p>
                    </div>
                  </li>
                  <li> <a class="thumb" href="#"><img src="<?php echo $imagePath; ?>/recent-photo2.jpg" alt="image"/></a>
                    <h6><a href="#">Here comes the title for 
                      the post with 2 lines</a></h6>
                    <div class="entry-meta">
                      <p><span class="fa fa-calendar"></span>03Aug2012</p>
                      <p><span class="fa fa-user"></span><a href="">admin</a></p>
                    </div>
                  </li>
                </ul>
              </div>
            </aside>
          </div>
          <div class="column dt-sc-one-fourth">
            <aside class="widget widget_tweetbox">
              <h3 class="widget-title">Twitter <span class="wlast">Feeds</span><span class="small-line"> </span></h3>
              <div class="tweet_list"> </div>
            </aside>
          </div>
          <div class="column dt-sc-one-fourth">
            <aside class="widget mailchimp">
              <h3 class="widget-title">Newsletter <span class="wlast">Subscription</span><span class="small-line"> </span></h3>
              <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was of the great explorer.</p>
              <form method="post" class="mailchimp-form" name="frmNewsletter" action="php/subscribe.php">
                <p><span class="fa fa-envelope"></span>
                  <input type="email" placeholder="Enter Email" name="email" value="" required/>
                  <input type="submit" name="submit" class="dt-sc-button" value="Subscribe" />
                </p>
              </form>
              <div id="ajax_newsletter_msg"></div>
              <div class="dt-sc-hr-invisible-small"></div>
              <ul class="dt-sc-social-icons">
                <li><a class="dt-sc-tooltip-top facebook" href='#' target="_blank" title="Facebook"> <i class="fa fa-facebook"></i> </a></li>
                <li><a class="dt-sc-tooltip-top twitter" href='#' target="_blank" title="Twitter"> <i class="fa fa-twitter"></i> </a></li>
                <li><a class="dt-sc-tooltip-top google-plus" href='#' target="_blank" title="Google-plus"> <i class="fa fa-google-plus"></i> </a></li>
                <li><a class="dt-sc-tooltip-top pinterest" href='#' target="_blank" title="Pinterest"> <i class="fa fa-pinterest"></i> </a></li>
                <li><a class="dt-sc-tooltip-top youtube" href='#' target="_blank" title="Youtube"> <i class="fa fa-youtube"></i> </a></li>
              </ul>
            </aside>
          </div>
        </div>
      </div>
      <!-- **footer-widgets-wrapper - End** -->
      
      <div class="copyright">
        <div class="container">
          <p>Priority theme by iamdesigning. © 2015 <a href="#">BuddhaThemes</a></p>
          <ul class="footer-links">
            <li><a href="index.html">Home</a>/</li>
            <li><a href="about.html">About</a>/</li>
            <li><a href="tabs-accordions.html">Pages</a>/</li>
            <li><a href="blog.html">Blog</a>/</li>
            <li><a href="portfolio-3-column-without-space.html">Portfolio</a>/</li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </div>
      </div>
    </footer>
    <!-- **Footer - End** --> 
    
  </div>
  <!-- **inner-wrapper - End** --> 
  
</div>
<!-- **Wrapper - End** --> 


<?php $this->renderPartial('assets::js_no_min', array()); ?>
</body>
</html>