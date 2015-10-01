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
                <h2>C'est quoi?</h2>
                <p>Le site Innovation Pédagogique Umontreal présente la conception ou la reconception d'outils, de produits, 
                de procédés ou de services pédagogiques développés  par nos étudiantes finissantes et étudiants finissants 
                du baccalauréat en adaptation scolaire de l'Université de Montréal. Ce site vise, tout particulièrement la 
                visibilité de projets innovateurs. En outre, ce site souhaite favoriser la pérennité des projets et engager 
              la collaboration des établissements scolaires et milieux cliniques.</p>
                <br />
                <!-- Pour consulter la liste Ã©volutive de nos collaborateurs cliquez ici --> 
                <p>Pour devenir client-collaborateurs <a href="/contact/collaborate">cliquez ici</a></p>
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
