<?php
    $Application   = \Core\Application::getInstance();
    $assetsBaseJs  = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.js');
    $jsFileAssets   = array(
		$assetsBaseJs . "/jquery/jquery-1.10.2.min.js",
		$assetsBaseJs . "/application.js",
		$assetsBaseJs . "/jquery/jquery-migrate.min.js", 
		$assetsBaseJs . "/modernizr.js",
		$assetsBaseJs . "/preloader.js",
		$assetsBaseJs . "/pace.min.js",
		$assetsBaseJs . "/jquery/jquery.tabs.min.js", 
		$assetsBaseJs . "/jquery/jquery.tipTip.minified.js", 
		$assetsBaseJs . "/jquery/jquery-easing-1.3.js",
		$assetsBaseJs . "/jquery/jquery.carouFredSel-6.2.1-packed.js",
		$assetsBaseJs . "/jquery/jquery.parallax-1.1.3.js",
		$assetsBaseJs . "/jquery/jquery.inview.js",
		$assetsBaseJs . "/jquery/jquery.nav.js",
		$assetsBaseJs . "/layerslider.transitions.js", 
		$assetsBaseJs . "/layerslider.kreaturamedia.jquery.js", 
		$assetsBaseJs . "/greensock.js", 
		$assetsBaseJs . "/jquery/jquery.jcarousel.min.js",
		$assetsBaseJs . "/jquery/jquery.tweet.min.js",
		$assetsBaseJs . "/jquery/jquery.isotope.min.js",
		$assetsBaseJs . "/jquery/jquery.prettyPhoto.js",
		$assetsBaseJs . "/masonry.pkgd.min.js",
		$assetsBaseJs . "/jquery/jquery.smartresize.js",
		$assetsBaseJs . "/responsive-nav.js",
		$assetsBaseJs . "/jquery/jquery.meanmenu.min.js",
		$assetsBaseJs . "/jquery/jquery.gmap.min.js", 
		$assetsBaseJs . "/jquery/jquery.sticky.js",
		$assetsBaseJs . "/jquery/jquery.ui.totop.min.js",
		$assetsBaseJs . "/jquery/jquery.viewport.js",
		$assetsBaseJs . "/jquery/jquery.validate.min.js", 
    	$assetsBaseJs . "/jquery/jquery.print.js",
    	$assetsBaseJs . "/jquery/jquery.push.js",
    	$assetsBaseJs . "/jquery/jquery.tooltip.js",
		$assetsBaseJs . "/retina.js",
		$assetsBaseJs . "/jquery/jquery.nicescroll.min.js",
		$assetsBaseJs . "/custom.js",
		$assetsBaseJs . "/mp.direction.api.js"
    );
?>
<script type="text/javascript">
	var __IMG__  = '<?php echo($Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img')); ?>',
            __JS__   = '<?php echo($Application->getConfigs()->get('Application.core.mvc.controller.assets.base.js')); ?>',
	    __URL__  = '<?php echo($Application->getConfigs()->get('Application.core.base_url')); ?>',
	    __LANG__ = '<?php echo($Application->translate('en', 'fr', 'ch')); ?>';
</script>
<?php foreach ($jsFileAssets as $jsFileAsset) { ?>
<script type="text/javascript" src="<?php echo $jsFileAsset; ?>"></script>
<?php } ?>

<script type="text/javascript">
	Core.StaticInstance.set('SYSTEM.APPLICATION.MAIN', new SYSTEM.APPLICATION.MAIN()).initialise(function(event) {
		Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.LANGUAGE, __LANG__);
		Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.SITE_URL, __URL__);
		Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.IMG_WEB_ROOT, __IMG__);	
		Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').startModuleCollection('<?php echo($Application->getRequestDispatcher()->getMvcRequest('controller')); ?>');
	});
</script>
