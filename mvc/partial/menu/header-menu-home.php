<?php
    $Application   = \Core\Application::getInstance();
	$configs       = $Application->getConfigs();
    $imagePath     = $configs->get('Application.core.mvc.controller.assets.base.img');
?>
<!-- **Top Bar** -->
<div class="top-bar">
  <div class="container">
    <ul class="top-menu">
      <li> <i class="fa fa-phone"></i> Des Questions? Appelez Nous: <span> <?php echo $Application->getConfigs()->get('Application.core.mvc.contact.number'); ?> </span></li>
    </ul>
    <div class="top-right"> <span>Suivez-nous!</span>
      <ul class="dt-sc-social-icons">
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.facebook'); ?>" title="Facebook" target="_blank"> <i class="fa fa-facebook"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.twitter'); ?>" title="Twitter" target="_blank"> <i class="fa fa-twitter"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.instagram'); ?>" title="Instagram" target="_blank"> <i class="fa fa-instagram"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.youtube'); ?>" title="Youtube" target="_blank"> <i class="fa fa-youtube"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.rss'); ?>" title="Rss" target="_blank"> <i class="fa fa-rss"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.carrefour'); ?>" title="Le Carrefour" target="_blank"> <i class="fa fa-ellipsis-h"></i> </a> </li>
      </ul>
    </div>
  </div>
</div>
<!-- **Top Bar - End** -->
<div id="header-wrapper">
  <header class="header">
    <div class="container"> 
      <div id="logo">
      	<a href="<?php echo $Application->getConfigs()->get('Application.site.site_url'); ?>" 
        	title="<?php echo $Application->getConfigs()->get('Application.core.mvc.site.title'); ?>">
            <img src="<?php echo $imagePath; ?>/logo.png" alt="<?php echo $Application->getConfigs()->get('Application.core.mvc.site.title'); ?>"/></a>
      </div>
      
      <div id="menu-container">
        <!-- **Nav - Starts**-->
        <nav id="main-menu">
          <div id="dt-menu-toggle" class="dt-menu-toggle"> 
          	Menu <span class="dt-menu-toggle-icon"></span> 
          </div>
          <?php echo \Core\Hybernate\Menu\Menu::getSiteMenuHtml($Application->translate(1, 2, 3)); ?>
        </nav>
        <!-- **Nav - End**--> 
      </div>
    </div>
  </header>
</div>