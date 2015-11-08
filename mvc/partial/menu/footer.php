<?php
    $Application   = \Core\Application::getInstance();
    $imagePath     = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
	$footerMenus   = \Core\Hybernate\Menu\Menu::getParentMenus($Application->translate(2, 1, 3));
?>
<!-- **Footer** -->
<footer id="footer">
<div class="footer-widgets-wrapper">
<div class="container">

  <div class="column dt-sc-one-third first">
    <aside class="widget widget_text">
      <h3 class="widget-title">Contactez-<span class="wlast">nous </span><span class="small-line"> </span></h3>
      <p> <i class="fa fa-phone"></i> <span>Tel:</span> <?php echo $Application->getConfigs()->get('Application.core.mvc.contact.number'); ?> </p>
      <p> <i class="fa fa-print"></i> <span>Fax:</span> <?php echo $Application->getConfigs()->get('Application.core.mvc.contact.fax'); ?> </p>
      <p> <i class="fa fa-envelope"></i> <span> Courriel:</span> <a href="#"><?php echo $Application->getConfigs()->get('Application.core.mvc.contact.email'); ?></a> </p>
      <p> <i class="fa fa-globe"></i> <span>Web:</span> <a href="<?php echo $Application->getConfigs()->get('Application.core.base_url'); ?>"><?php echo $Application->getConfigs()->get('Application.core.base_url'); ?></a> </p>
      <p> <i class="fa fa-location-arrow"></i> <span><?php echo $Application->getConfigs()->get('Application.core.mvc.contact.address'); ?></span> </p>
    </aside>
  </div>
  <?php $this->renderPartial('modules::rss::feed-footer', array()); ?>
  
<?php /*
  <div class="column dt-sc-one-fourth">
    <aside class="widget widget_tweetbox">
      <h3 class="widget-title">Twitter <span class="wlast">Feeds</span><span class="small-line"> </span></h3>
      <div class="tweet_list"> </div>
    </aside>
  </div>
*/ ?>

  <div class="column dt-sc-one-third">
    <aside class="widget mailchimp">
      <h3 class="widget-title">Abonnement <span class="wlast">à l'infolettre</span><span class="small-line"> </span></h3>
      <p>Restez à jour avec un abonnement à l'infolettre.</p>
      <form method="post" class="mailchimp-form" name="frmNewsletter" action="php/subscribe.php">
        <p><span class="fa fa-envelope"></span>
          <input type="email" placeholder="Votre courriel" name="email" value="" required style="width:60%"/>
          <input type="submit" name="submit" class="dt-sc-button" value="S'abonner" />
        </p>
      </form>

      <div id="ajax_newsletter_msg"></div>
      <div class="dt-sc-hr-invisible-small"></div>
	  <ul class="dt-sc-social-icons">
        <li><a class="dt-sc-tooltip-top facebook" href="<?php echo $configs->get('Application.core.mvc.social.facebook'); ?>" target="_blank" title="Facebook">
        	<i class="fa fa-facebook"></i> </a></li>
        <li><a class="dt-sc-tooltip-top twitter" href="<?php echo $configs->get('Application.core.mvc.social.twitter'); ?>" target="_blank" title="Twitter"> 
        	<i class="fa fa-twitter"></i> </a></li>
        <li><a class="dt-sc-tooltip-top pinterest" href="<?php echo $configs->get('Application.core.mvc.social.instagram'); ?>" target="_blank" title="Instagram"> 
        	<i class="fa fa-instagram"></i> </a></li>
        <li><a class="dt-sc-tooltip-top google-plus" href="<?php echo $configs->get('Application.core.mvc.social.rss'); ?>" target="_blank" title="Rss"> 
        	<i class="fa fa-rss"></i> </a></li>
        <li><a class="dt-sc-tooltip-top youtube" href="<?php echo $configs->get('Application.core.mvc.social.youtube'); ?>" target="_blank" title="Youtube"> 
        	<i class="fa fa-youtube"></i> </a></li>
        <li><a class="dt-sc-tooltip-top twitter" href="<?php echo $configs->get('Application.core.mvc.social.carrefour'); ?>" target="_blank" title="Le Carrefour"> 
        	<i class="fa fa-ellipsis-h"></i> </a></li>    
      </ul>
    </aside>
  </div>
</div>
</div>

<!-- **footer-widgets-wrapper - End** -->

<div class="copyright">
<div class="container">
  <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo $Application->getConfigs()->get('Application.core.base_url'); ?>">
	Innovation Umontréal</a></p>
  <ul class="footer-links">
  	<?php foreach ($footerMenus as $footerMenu) { ?>
    <li><a href="<?php echo $footerMenu['url']; ?>" title="<?php echo $footerMenu['title']; ?>" 
    	target="<?php echo $footerMenu['target']; ?>"><?php echo $footerMenu['title']; ?></a>/</li>
    <?php } ?>
  </ul>
</div>
</div>
</footer>
<!-- **Footer - End** --> 

