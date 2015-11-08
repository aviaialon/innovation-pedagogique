<?php 
	$Application   = \Core\Application::getInstance();
	$assetsBaseImg = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
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
        
                
         <div class="column">
            <div class="dt-sc-team-wrapper">
                <h2>Où?</h2>
                <p>À quel endroit, réalisent-ils ces projets innovateurs? Les étudiants réalisent leurs projets à l’Université de Montréal, 
                dans le contexte de leur programme d’étude. Par contre, la démarche de l’AVP, engage les étudiants à collaborer avec 
                (notamment l’analyse des besoins et la mise à l’essai du prototype) un milieu de pratique; un établissement scolaire, un centre ou une clinique.</p>
                
                
                <!-- Pour consulter la liste Ã©volutive de nos collaborateurs cliquez ici --> 
                <p>Pour collaborer avec une équipe dévouée d’étudiants, veuillez <a href="/contact/collaborate">remplir le document suivant</a>.</p>
            </div><!-- **dt-sc-team-carousel - Ends** -->
        </div>       
        
      </section>
      <!-- left section --> 
    </div>
    <!-- **container - Ends** -->
    <div class="dt-sc-margin50"></div>
  </div>
  <!-- **Full-width-section - Ends** --> 
  
  <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?>  
</div>
