<?php 
	$Application = \Core\Application::getInstance();
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
          <h3>Commanditaires</h3>
          <div class="title-sep"> </div>
        </div>
        
        <!-- **column - Starts** -->
        <div class="column first">
          	<p>Nous devons une fière chandelle aux commanditaires nommés ci-après. 
            	Ces derniers partagent notre préoccupation à propos de l’éducation et souhaitent 
                jouer un rôle dans l’évolution de cet enjeu au Québec. Leur soutien nous permet 
                de réaliser une exposition.</p>
                
                <?php $this->renderPartial('modules::slider::sponsors', array()); ?>
        </div>
        <!-- **column - Ends** --> 
        
      </section>
      <!-- left section --> 
    </div>
    <!-- **container - Ends** -->
    <div class="dt-sc-margin50"></div>
  </div>
  <!-- **Full-width-section - Ends** --> 
  
  <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?>  
</div>
