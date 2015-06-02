<?php
	$Application   = \Core\Application::getInstance();
    $assetsBaseCcs = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.css');
	$cssFileAsset   = \Core\Util\Minification\Minification::getInstance(\Core\Util\Minification\Minification::Minification_Processor_Css)->minifyFiles(array(
		$assetsBaseCcs . "/style.css",
		$assetsBaseCcs . "/shortcodes.css",
		$assetsBaseCcs . "/skyblue/style.css",
		$assetsBaseCcs . "/responsive.css",
		$assetsBaseCcs . "/skin/layerslider.css",
		$assetsBaseCcs . "/skin/meanmenu.css",
		$assetsBaseCcs . "/skin/prettyPhoto.css",
		$assetsBaseCcs . "/skin/animations.css",
		$assetsBaseCcs . "/skin/font-awesome.min.css",
		$assetsBaseCcs . "/skyblue/style.css"
    ));
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
<link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" id="main-css"  href="<?php echo $cssFileAsset; ?>" type="text/css" media="all" />
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?language=en-CA&sensor=false&v=3.13&libraries=places"></script>
<script type="text/javascript" src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script>
<script type="text/javascript" src="http://www.geoplugin.net/javascript.gp"></script>