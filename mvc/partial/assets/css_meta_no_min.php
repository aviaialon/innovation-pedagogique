<?php
    $Application   = \Core\Application::getInstance();
    $assetsBaseCcs = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.css');
	$assetsBaseJs  = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.js');
	$assetsBaseImg = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
	$cssFileAssets = array(
		'fonts'		    => $assetsBaseCcs . "/fonts.css",
		'default-css' 	=> $assetsBaseCcs . "/style.css",
		'shortcodes-css'=> $assetsBaseCcs . "/shortcodes.css",
		'skin-css'		=> $assetsBaseCcs . "/skyblue/style.css",
		'responsive'	=> $assetsBaseCcs . "/responsive.css",
		'layer-slider'	=> $assetsBaseCcs . "/skin/layerslider.css",
		'meanmenu'		=> $assetsBaseCcs . "/skin/meanmenu.css",
		'prettyPhoto'	=> $assetsBaseCcs . "/skin/prettyPhoto.css",
		'animations'	=> $assetsBaseCcs . "/skin/animations.css",
		'awesome'		=> $assetsBaseCcs . "/skin/font-awesome.min.css",
		'skin-css'		=> $assetsBaseCcs . "/skyblue/style.css"
    ); 
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo sprintf('%s | %s', 
	$Application->getConfigs()->get('Application.core.mvc.site.title'),
	$Application->getConfigs()->get('Application.core.mvc.site.short_desc')); ?></title>
<meta name="description" content="" />
<meta name="author" content="" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
<link rel="profile" href="http://gmpg.org/xfn/11"> 
<link rel="shortcut icon" href="<?php echo $assetsBaseImg; ?>/favicon.png" />
<?php foreach ($cssFileAssets as $assetId => $cssFileAsset) { ?>
<link id="<?php echo ($assetId); ?>" rel="stylesheet" href="<?php echo $cssFileAsset; ?>" type="text/css" media="all" />
<?php } ?>

<script type="text/javascript" src="http://www.geoplugin.net/javascript.gp"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?language=en-CA&sensor=false&v=3.13&libraries=places"></script>
<script type="text/javascript" src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script>