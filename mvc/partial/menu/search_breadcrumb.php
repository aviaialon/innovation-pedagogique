<?php
	$additional  = $this->getPartialData('additionalItems');
	$title       = $this->getPartialData('title');
?>
<div class="breadcrumb-wrapper type6">
    <div class="container">
      <div class="main-title">
      	<h1><?php echo $title; ?></h1>
        <div class="breadcrumb"> 
        	<?php $this->renderPartial('modules::search::search-bar', array()); ?>
        </div>
      </div>
    </div>
</div>