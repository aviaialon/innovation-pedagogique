<?php 
	$Application = \Core\Application::getInstance();
	$PageData    = $this->getViewData('PageResource');
	
	if (false === $PageData) {
		$this->pageNotFound();	
	}
	
	$PageContent = $PageData->getPageContent($Application->translate('en', 'fr', 'ch'));
	
	if (empty($PageContent) === true) {
		
	}
?>
<div id="main">
  <?php $this->renderPartial('menu::breadcrumb', array()); ?>
  
  <!-- **Full-width-section - Starts** --> 
  <!-- grey1-->
  <div class="full-width-section ">
    <div class="dt-sc-margin30"></div>
    <div class="container"> 
      <?php $this->renderPartial('menu::left-menu', array()); ?>
      <!-- right section -->
      <section id="primary" class="with-left-sidebar page-with-sidebar width840">
        <div class="hr-title dt-sc-hr-invisible-small">
          <h3><?php echo $PageContent->getTitle(); ?></h3>
          <div class="title-sep"> </div>
        </div>
        
        <!-- **column - Starts** -->
        <div class="column first">
          <?php echo $PageContent->getParsedContent(); ?>
        </div>
        <!-- **column - Ends** --> 
        
      </section>
      <!-- left section --> 
    </div>
    <!-- **container - Ends** -->
    <div class="dt-sc-margin50"></div>
  </div>
  <!-- **Full-width-section - Ends** --> 
  
  
  <!-- **intro-text - starts** -->
  <div class="intro-text type4"> 
    <!-- **container - Starts** -->
    <div class="container">
      <div class="column dt-sc-two-third first">
        <h2>COMMENT COLLABORER?</h2>
        <p>Pour collaborer avec une équipe dévouée d’étudiants, veuillez remplir le document suivant.</p>
      </div>
      <div class="column dt-sc-one-third"> <a class="dt-sc-button large" href="#">Je veut collaborer <span class="fa fa-angle-right"></span></a> </div>
    </div>
    <!-- **container - Ends** --> 
    
  </div>
  <!-- **intro-text - Ends** --> 
  
</div>
