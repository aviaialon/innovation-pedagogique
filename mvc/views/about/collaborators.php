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
                <h2>Collaborateurs</h2>
                <p>L’atelier d’innovation pédagogique, suivi du projet d’intégration en adaptation 
                scolaire, s’insère dans une perspective de recherche collaborative. C’est-à-dire, il 
                invite les milieux de pratique à explorer un aspect de leur pratique pour enfin 
                proposer un objet de recherche. Après avoir présenté une problématique, le milieu 
                de pratique est invité à collaborer soit à l’analyse de leurs besoins, soit à la mise à 
                l’essai de l’outil, du produit, du procédé ou service pédagogique, soit à l’évaluation 
                du prototype.</p>
                
                <p>
                <!-- Pour consulter la liste évolutive de nos collaborateurs cliquez ici --> 
                Pour devenir collaborateurs <a href="/contact/collaborate">cliquez ici</a></p>
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
