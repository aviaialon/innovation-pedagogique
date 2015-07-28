<?php 
	$Application 		   = \Core\Application::getInstance();
	$strStaticResourcePath = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.template');
	$blnHideZoom 		   = (bool) $this->getRequestParam('hideZoom'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='long'o:100,300,400|Nobile:400,700italic,700,400italic|Maven+Pro:400,500,700|Oswald:400,700,300"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCyG4O4t5fKaI_UdFazJos3w2tKEUK7x3Q&sensor=false"></script>
<script src="<?php echo($strStaticResourcePath); ?>/js/jquery/jquery.mapstyle.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		function loadLargeMap()
		{
			$(".map_large").html('').css({
				width: $(window).width(),
				height: $(window).height()
			});
			var siteThumbs = [
			    "<?php echo $strStaticResourcePath; ?>/img/education/edu-img5.jpg",
			    "<?php echo $strStaticResourcePath; ?>/img/education/edu-img6.jpg",
			    "<?php echo $strStaticResourcePath; ?>/img/education/edu-img7.jpg"
			];
			$.fn.StylizedMap.options.arrowUrl = "<?php echo $strStaticResourcePath; ?>/img/map/arrow.png";
			var objMapRenderer = $(".map_large").StylizedMap({
				'ribbon': "#ribbon",
				'zoomLevel': 10,
				'styles': $().StylizedMap.styles.rainbow,
				'center': {
					'lat': 45.503297,
					'long': -73.618820
				},
				'locations': [{ 
					'lat': 45.503297,
					'long': -73.618820,
					'title': '<?php echo $Application->getConfigs()->get('Application.site.site_name'); ?>',
					'sub_title': "<?php echo $Application->getConfigs()->get('Application.core.mvc.contact.address'); ?>",
					'slides': siteThumbs,
					'active': <?php echo($this->getRequestParam('location') == 1 ? 'true': 'false'); ?>
				}]
			});	
		}	
		loadLargeMap();
		
		$(window).resize(function (event) {
			//google.maps.event.trigger(sliderMap, "resize");	
			loadLargeMap();
		});
	});
</script>
<style type="text/css">
	body {margin: 0px; padding: 0px;}
	

	/*- Map zoom controls -*/
	#slider-map-zoom-in {
		background: #373737;
		background: rgba(102, 100, 100, 0.82); /*rgba(55, 55, 55, .9)*/
		position: absolute;
		top: 1px;
		right: 1px;
		width: 30px;
		height: 30px;
		background-image: url(<?php echo $strStaticResourcePath; ?>/img/map/slider-map-zoom-in.gif);
		background-repeat: no-repeat;
		background-position: 50% 50%;
		z-index: 9500;
		cursor: pointer;
	}
	
	#slider-map-zoom-out {
		background: #373737;
		background: rgba(102, 100, 100, 0.82); /*rgba(55, 55, 55, .9)*/
		position: absolute;
		top: 32px;
		right: 1px;
		width: 30px;
		height: 30px;
		background-image: url(<?php echo $strStaticResourcePath; ?>/img/map/slider-map-zoom-out.gif);
		background-repeat: no-repeat;
		background-position: 50% 50%;
		z-index: 9500;
		cursor: pointer;
	}
	
	#slider-map-zoom-in:hover, #slider-map-zoom-out:hover {
		background-color: #26abee;
	}
	
/*- @group: map style for the slider -*/
/*
.stylized_map { font-family: "Olswald"; font-size: 13px; width: 100%; height: 600px; overflow: hidden; cursor: default; }
.stylized_map .window { background: #fff; width: 280px; padding: 10px 20px; color: #5F5F5F; }
.stylized_map .window-imgcnt { position:absolute; top: -160px; left: 0; z-index:106; width:235px; height:160px; background: #000 url(<?php echo $strStaticResourcePath; ?>/img/map/wait.gif) no-repeat center center; overflow: hidden; }
.stylized_map .window-noslides { display: none; }
.stylized_map .window-imgcnt, .slides_container, .slides_container img { width:320px; height:160px; cursor: default; }
.stylized_map h3.window-title { font-family: "Olswald"; font-size: 13px; font-weight: bold; padding:0; margin:0; color:#000000; text-transform: uppercase; }
.stylized_map .window-desc { overflow:hidden; margin: 7px 0 0; padding: 0;}
.stylized_map .window-arrow, .stylized_map .window-close { position: absolute; z-index: 107; bottom: -9px; left: 147px; width: 20px; height: 13px; background: url('<?php echo $strStaticResourcePath; ?>/img/map/arrow.png') no-repeat center top; }
.stylized_map .window-close { background: url('<?php echo $strStaticResourcePath; ?>/img/map/close.png') no-repeat; width: 10px; left: 300px; top: 12px; cursor: pointer; }
*/
#map {width: 100% !important; height: 500px;}
.map_large {width: 100%; height: 100%}
.gmnoprint { display: none !important; }
.stylized_map { font-family: "Maven Pro"; font-size: 13px; width: 100%; height: 600px; overflow: hidden; cursor: default; }
.stylized_map .window { background: #fff; width: 150px; padding: 10px 20px 10px 10px; color: #5F5F5F; }
.stylized_map .window-imgcnt { position:absolute; top: -75px; left: 0; z-index:106; width:235px; height:160px; background: #000 url(<?php echo $strStaticResourcePath; ?>/img/map/wait.gif) no-repeat center center; overflow: hidden; }
.stylized_map .window-noslides { display: none; }
.stylized_map .window-imgcnt, .slides_container, .slides_container img { width: 180px; height: 80px; cursor: default; }
.stylized_map h3.window-title { font-family: "Maven Pro";font-size: 12px; font-weight: bold; padding:0; margin:0; color:#000000; text-transform: uppercase; line-height: 15px;}
.stylized_map .window-desc { overflow:hidden; margin: 7px 0 0; padding: 0; font-size: 12px; line-height: 15px;}
.stylized_map .window-arrow, .stylized_map .window-close { position: absolute; z-index: 107; bottom: -9px; left: 147px; width: 20px; height: 13px; background: url('<?php echo $strStaticResourcePath; ?>/img/map/arrow.png') no-repeat center top; }
.stylized_map .window-close { background: url('<?php echo $strStaticResourcePath; ?>/img/map/close.png') no-repeat; width: 10px; left: 160px; top: 16px; cursor: pointer; }
	
</style>
</head>

<body>
<?php if (false === $blnHideZoom) { ?>
	<div id="slider-map-zoom-in"></div>
	<div id="slider-map-zoom-out"></div>
<?php } ?>
<div id="map" class="stylized_map map_large"></div>
</body>
</html>
