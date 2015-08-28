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
                <h2>Étudiants</h2>
                <p>Dans le cadre des cours <strong>PED 4300 -  Atelier d’innovation pédagogique</strong>, et, 
                <strong>PED4301 - Projet des finissants d’intégration en adaptation scolaire</strong>, les 
                étudiantes finissantes et les étudiants finissants du baccalauréat en adaptation 
                scolaire de l’Université de Montréal développent un produit, un procédé ou un 
                service orthopédagogique qui répond à des besoins éducatifs actuels.</p>
                
                <p>Pour ce faire, les étudiants ont, d’abord, identifient d’abord les besoins des 
                différents utilisateurs potentiels de l’outil, du produit, du procédé ou du service à 
                l’étude. Les étudiants précisent ensuite les fonctions que l’outil, le produit, le 
                procédé ou le service pédagogique doit remplir pour répondre à leurs besoins. 
                Enfin, les étudiants développent un premier prototype et le mettent à l’essai dans un  
                milieu de pratique.</p>
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
