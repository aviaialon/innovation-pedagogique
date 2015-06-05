<?php
        $Application = \Core\Application::getInstance();
        $imagePath   = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
?>
<!-- **Main - Starts** -->
<div id="main"> 
  <?php $this->renderPartial('modules::slider::home-slider', array()); ?>
  <?php $this->renderPartial('modules::home::callout-intro', array()); ?>
  <?php $this->renderPartial('modules::home::callout-avp', array()); ?>
  <?php $this->renderPartial('modules::rss::feed-large', array()); ?>
  <?php $this->renderPartial('modules::slider::sponsors', array()); ?>
</div>
<!-- **Main - Ends** --> 

<div class="full-width-section">
    <div class="full-bg-img">
        <div class="container">
            <img class="align-center" src="<?php echo $imagePath; ?>/tree.png" alt="image">
        </div>
    </div>
</div>
