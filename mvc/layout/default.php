<?php
	$Application = \Core\Application::getInstance();
	$imagePath   = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
	header('Content-Type: text/html; charset=utf-8');
?>
<!Doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?php echo($Application->translate('en', 'fr')); ?>-CA" class="no-js" xml:lang="<?php echo($Application->translate('en', 'fr')); ?>">
<!--<![endif]-->
<head>
<?php $this->renderPartial('assets::css_meta_no_min', array()); ?>
<?php $this->renderPartial('assets::js_no_min', array()); ?>
</head>

<body class="<?php echo ($this->getMvcRequest('controller')); ?> <?php echo ($this->getMvcRequest('rawAction')); ?>_page">
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<!-- **Wrapper** -->
<div class="wrapper">
 
  <div class="inner-wrapper"> 
    <?php $this->renderPartial('menu::header-menu', array()); ?>
    ${CONTENT}
    <?php $this->renderPartial('menu::footer', array()); ?>
  </div>
  <!-- **inner-wrapper - End** --> 
  
</div>
<!-- **Wrapper - End** --> 
<div class="push-wrapper"></div>
</body>
</html>