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
                <h2>Comment?</h2>
                <p>Comment font les étudiants pour innover des outils, produits, procédés, programmes ou services pédagogiques?</p>
                
                <p>En réponse à une problématique exprimée par un milieu collaborateur, les étudiants procèdent à l’application d’une méthode 
                rigoureuse et systématique, nommée l’Analyse de la Valeur Pédagogique (AVP), pour proposer et développer une solution innovante.</p>
                
                <p>En bref, l’AVP comporte une démarche de trois phases.</p>
                <p>
                	<ul>
                    	<li><strong>Phase I,  Préconception:</strong>
                        	<ul>
                            	<li><strong>Étape 1.</strong> Préciser un problème orthopédagogique et mener au moins deux analyses de 
                                	besoins auprès des utilisateurs potentiels du produit, procédé ou service pédagogique à l’étude.</li>
                                <li><strong>Étape 2.</strong> Élaborer un cadre de référence.</li>
                                <li><strong>Étape 3.</strong> Rédiger une fiche synthèse.</li>
                            </ul>
                        </li>
                        
                        <li><strong>Phase II, Analyse fonctionnelle:</strong>
                        	<ul>
                            	<li><strong>Étape 4.</strong> Réaliser au moins deux analyses fonctionnelles.</li>
                                <li><strong>Étape 2.</strong> Élaborer un cahier des charges pour la conception et l’évaluation d’un produit, procédé ou service pédagogique.</li>
                            </ul>
                        </li>
                        
                        <li><strong>Phase III, Conception-Évaluation:</strong>
                        	<ul>
                            	<li><strong>Étape 6.</strong> Rechercher les solutions pour remplir les fonctions prescrites au  cahier des charges. Créer un premier prototype.</li>
                                <li><strong>Étape 7.</strong> Mettre à l’essai le prototype en milieu de stage pour évaluer son efficacité et sa productivité et proposer des ajustements.</li>
                            </ul>
                        </li>
                    </ul>
                </p>
                
                <!-- Pour consulter la liste Ã©volutive de nos collaborateurs cliquez ici --> 
                <p>Pour devenir collaborateurs <a href="/contact/collaborate">cliquez ici</a></p>
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
