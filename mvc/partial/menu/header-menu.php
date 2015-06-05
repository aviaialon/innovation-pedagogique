<?php
    $Application   = \Core\Application::getInstance();
	$configs       = $Application->getConfigs();
    $imagePath     = $configs->get('Application.core.mvc.controller.assets.base.img');
?>
<!-- **Top Bar** -->
<div class="top-bar type6">
  <div class="container">
    <ul class="top-contact-details alignleft">
      <li> <span> Des Questions?</span></li>
      <li> <i class="fa fa-phone"></i><span><?php echo $Application->getConfigs()->get('Application.core.mvc.contact.number'); ?></span></li>
      <li> <i class="fa fa-envelope"></i><a href="mailto:<?php echo $Application->getConfigs()->get('Application.core.mvc.contact.email'); ?>">
	  	<?php echo $Application->getConfigs()->get('Application.core.mvc.contact.email'); ?></a></li>
    </ul>
    
    <ul class="top-social-icons alignright">
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.facebook'); ?>" title="Facebook" target="_blank"> <i class="fa fa-facebook"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.twitter'); ?>" title="Twitter" target="_blank"> <i class="fa fa-twitter"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.instagram'); ?>" title="Instagram" target="_blank"> <i class="fa fa-instagram"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.youtube'); ?>" title="Youtube" target="_blank"> <i class="fa fa-youtube"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.rss'); ?>" title="Rss" target="_blank"> <i class="fa fa-rss"></i> </a> </li>
        <li> <a href="<?php echo $configs->get('Application.core.mvc.social.carrefour'); ?>" title="Le Carrefour" target="_blank"> <i class="fa fa-ellipsis-h"></i> </a> </li>
    </ul>
  </div>
</div>

<div id="header-wrapper" class="silver">
  <header class="header header7">
    <div class="main-menu-container"> 
      <div class="main-menu">
      	<div id="logo">
            <a href="<?php echo $Application->getConfigs()->get('Application.core.base.url'); ?>" 
                title="<?php echo $Application->getConfigs()->get('Application.core.mvc.site.title'); ?>">
                <img src="<?php echo $imagePath; ?>/logo.png" alt="<?php echo $Application->getConfigs()->get('Application.core.mvc.site.title'); ?>"/></a>
        </div>
        <div id="menu-container">
            <nav id="main-menu">
                <div id="dt-menu-toggle" class="dt-menu-toggle"> 
                	Menu <span class="dt-menu-toggle-icon"></span> 
                </div>
                <?php echo \Core\Hybernate\Menu\Menu::getSiteMenuHtml($Application->translate(2, 1, 3)); ?>
            </nav>
        </div>  
      </div>
    </div>
  </header>
</div>