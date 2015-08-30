<?php
	$Application = \Core\Application::getInstance();
	$imagePath   = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
?>
<div class="full-width-section callout-avp">
  <div class="container">
    <div class="dt-sc-margin50"></div>
    <h2>Comment?</h2>
    <p>Comment font les étudiants pour innover des outils, produits, procédés, programmes ou services pédagogiques? </p>
    <p>En réponse à une problématique exprimée par un milieu collaborateur, les étudiants 
      procèdent à l’application d’une méthode rigoureuse et systématique, nommée 
      l’Analyse de la Valeur Pédagogique (AVP), pour proposer et développer une solution innovante.</p>
    <p>En bref, <strong>l’AVP</strong> comporte une démarche de trois phases:</p>
    <div class="dt-sc-margin30"></div>
    <div class="column dt-sc-one-third first animate fadeInDown" data-ls="delayin:300;">
      <div class="dt-sc-ico-content type13">
        <div class="icon"> <img src="<?php echo $imagePath; ?>/phase1.jpg" alt="Phase I: Préconception" /> </div>
        <h4> <a href="#">Phase I, Préconception:</a></h4>
        <div class="dt-sc-margin10"></div>
        <p><strong>Étape 1 <i class="fa fa-arrow-right"></i></strong> Préciser un problème orthopédagogique et mener au moins deux 
          analyses de besoins auprès des utilisateurs potentiels du produit, procédé ou service pédagogique à l’étude.</p>
        <p><strong>Étape 2 <i class="fa fa-arrow-right"></i></strong> Élaborer un cadre de référence. </p>
        <p><strong>Étape 3 <i class="fa fa-arrow-right"></i></strong> Rédiger une fiche synthèse. </p>
      </div>
    </div>
    <div class="column dt-sc-one-third fadeInLeft" data-animation="fadeInLeft" data-ls="delayin:550;">
      <div class="dt-sc-ico-content type13">
        <div class="icon"> <img src="<?php echo $imagePath; ?>/phase2.jpg" alt="Phase II: Analyse fonctionnelle" /> </div>
        <h4> <a href="#">Phase II, Analyse fonctionnelle:</a> </h4>
        <div class="dt-sc-margin10"></div>
        <p><strong>Étape 4 <i class="fa fa-arrow-right"></i></strong> Réaliser au moins deux analyses fonctionnelles.</p>
        <p><strong>Étape 5 <i class="fa fa-arrow-right"></i></strong> Élaborer un cahier des charges pour la conception et l’évaluation 
          d’un produit, procédé ou service pédagogique.</p>
      </div>
    </div>
    <div class="column dt-sc-one-third fadeInRight" data-animation="fadeInRight" data-ls="delayin:800;">
      <div class="dt-sc-ico-content type13">
        <div class="icon"> <img src="<?php echo $imagePath; ?>/phase3.jpg" alt="Phase III: Conception-Évaluation" /> </div>
        <h4><a href="#">Phase III, Conception-Évaluation:</a></h4>
        <div class="dt-sc-margin10"></div>
        <p><strong>Étape 6 <i class="fa fa-arrow-right"></i></strong> Rechercher les solutions pour remplir les fonctions prescrites au 
          cahier des charges. Créer un premier prototype.</p>
        <p><strong>Étape 7 <i class="fa fa-arrow-right"></i></strong> Mettre à l’essai le prototype en milieu de stage pour évaluer son 
          efficacité et sa productivité et proposer des ajustements.</p>
      </div>
    </div>
  </div>
  <div class="dt-sc-hr-invisible"></div>
</div>
<hr />
      <?php /*?><div class="full-width-section " style="background-position: 50% 83px;">
        <div class="container">
            <h2 class="aligncenter">Our Features</h2>
            <p class="middle-align">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical<br> Latin literature from 45 BC, making it over 2000 years old. </p>
            <div class="dt-sc-margin50"></div>
            <div class="column dt-sc-one-fourth first fadeInRight" data-animation="fadeInRight" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border red">
                    <div class="icon">
                        <span class="small-circle">1</span>
                        <span class="fa fa-shopping-cart"></span>
                    </div>
                    <h4> <a href="#"> Activities </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            
            <div class="column dt-sc-one-fourth fadeInLeft" data-animation="fadeInLeft" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border yellow">
                    <div class="icon">
                        <span class="small-circle">2</span>
                        <span class="fa fa-plane"></span>
                    </div>
                    <h4> <a href="#"> School bus </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            
            <div class="column dt-sc-one-fourth fadeInRight" data-animation="fadeInRight" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border green">
                    <div class="icon">
                        <span class="small-circle">3</span>
                        <span class="fa fa-money"></span>
                    </div>
                    <h4> <a href="#"> Kids Play Land </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            <div class="column dt-sc-one-fourth fadeInLeft" data-animation="fadeInLeft" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border blue">
                    <div class="icon">
                        <span class="small-circle">4</span>
                        <span class="fa fa-umbrella"></span>
                    </div>
                    <h4> <a href="#"> Learning </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            <div class="dt-sc-hr-invisible"></div>
            <div class="column dt-sc-one-fourth first fadeInLeft" data-animation="fadeInLeft" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border green">
                    <div class="icon">
                        <span class="small-circle">5</span>
                        <span class="fa fa-trophy"></span>
                    </div>
                    <h4> <a href="#"> School Timing </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            
            <div class="column dt-sc-one-fourth fadeInRight" data-animation="fadeInRight" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border blue">
                    <div class="icon">
                        <span class="small-circle">6</span>
                        <span class="fa fa-tint"></span>
                    </div>
                    <h4> <a href="#"> Environment </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            
            <div class="column dt-sc-one-fourth fadeInLeft" data-animation="fadeInLeft" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border red">
                    <div class="icon">
                        <span class="small-circle">7</span>
                        <span class="fa fa-trophy"></span>
                    </div>
                    <h4> <a href="#"> Educators </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            
            <div class="column dt-sc-one-fourth fadeInRight" data-animation="fadeInRight" data-delay="100">
                <div class="dt-sc-ico-content type9 without-border yellow">
                    <div class="icon">
                        <span class="small-circle">8</span>
                        <span class="fa fa-tint"></span>
                    </div>
                    <h4> <a href="#"> Daycare </a> </h4>
                    <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna.</p>
                </div>
            </div>
            <div class="dt-sc-hr-invisible"></div>
        </div>
    </div><?php */?>
      
      
      
      
      
       
       <?php /*?><div class="full-width-section">
        <div class="dt-sc-margin30"></div> 
            <div class="container">
            	<h3>Comment?</h3>
                <p>Comment font les étudiants pour innover des outils, produits, procédés, programmes ou services pédagogiques? </p>
                
                <p>En réponse à une problématique exprimée par un milieu collaborateur, les étudiants 
                procèdent à l’application d’une méthode rigoureuse et systématique, nommée 
                l’Analyse de la Valeur Pédagogique (AVP), pour proposer et développer une solution innovante.</p>
                
                <p>En bref, <strong>l’AVP</strong> comporte une démarche de trois phases.</p>
        		<div class="dt-sc-margin80"></div> 
                
                <div class="column dt-sc-one-third first animate fadeInUp" data-animation="fadeInUp" data-delay="100">
                    <div class="dt-sc-ico-content type8" style="min-height:340px">
                        <div class="icon">
                            <img src="<?php echo $imagePath; ?>/admin1-hover.png" alt="Phase I, Préconception" />
                            <img src="<?php echo $imagePath; ?>/admin1.png" alt="Phase I, Préconception" />
                        </div>
                        <h4> <a href="#">Phase I,  <strong>Préconception</strong>:</a> </h4>
                        <div style="text-align:left; padding:10px;">
                        	<p><strong>Étape 1 <i class="fa fa-arrow-right"></i></strong> Préciser un problème orthopédagogique et mener au moins deux 
                                analyses de besoins auprès des utilisateurs potentiels du produit, procédé ou service pédagogique à l’étude.</p>
                                
                            <p><strong>Étape 2 <i class="fa fa-arrow-right"></i></strong> Élaborer un cadre de référence. </p>  
                            <p><strong>Étape 3 <i class="fa fa-arrow-right"></i></strong> Rédiger une fiche synthèse. </p>     
                        </div>  
                        <a class="read-more" href="#"> Read More <span class="fa fa-long-arrow-right"></span> </a>
                    </div>
                </div>
                
                <div class="column dt-sc-one-third animate fadeInDown" data-animation="fadeInDown" data-delay="100">
                    <div class="dt-sc-ico-content type8" style="min-height:340px">
                        <div class="icon">
                            <img src="<?php echo $imagePath; ?>/power-gears1-hover.png" alt="tablet">
                            <img src="<?php echo $imagePath; ?>/power-gears1.png" alt="Phase II, Analyse fonctionnelle"/>
                        </div>
                        <h4> <a href="#">Phase II,  <strong>Analyse fonctionnelle</strong>:</a> </h4>
                        <div style="text-align:left; padding:10px;">
                            <p><strong>Étape 4 <i class="fa fa-arrow-right"></i></strong> Réaliser au moins deux analyses fonctionnelles.</p>    
                            <p><strong>Étape 5 <i class="fa fa-arrow-right"></i></strong> Élaborer un cahier des charges pour la conception et l’évaluation 
                            d’un produit, procédé ou service pédagogique.</p>      
                        </div>
                        <a class="read-more" href="#"> Read More <span class="fa fa-long-arrow-right"></span> </a>
                    </div>
                </div>
                
                <div class="column dt-sc-one-third animate fadeInDown" data-animation="fadeInDown" data-delay="100">
                    <div class="dt-sc-ico-content type8" style="min-height:340px">
                        <div class="icon">
                            <img src="<?php echo $imagePath; ?>/book-mark-hover.png" alt="Phase III, Conception-Évaluation">
                            <img src="<?php echo $imagePath; ?>/book-mark.png" alt="Phase III, Conception-Évaluation">
                        </div>
                        <h4><a href="#">Phase III,  <strong>Conception-Évaluation</strong>:</a></h4>
                        <div style="text-align:left; padding:10px;">
                            <p><strong>Étape 6 <i class="fa fa-arrow-right"></i></strong> Rechercher les solutions pour remplir les fonctions prescrites au 
                            cahier des charges. Créer un premier prototype.</p>    
                            <p><strong>Étape 7 <i class="fa fa-arrow-right"></i></strong> Mettre à l’essai le prototype en milieu de stage pour évaluer son 
                            efficacité et sa productivité et proposer des ajustements.</p>      
                        </div>
                        <a class="read-more" href="#"> Read More <span class="fa fa-long-arrow-right"></span> </a>
                    </div>
                </div>
                
                
            </div>
            <div class="dt-sc-hr-invisible"></div>
        </div><?php */?>
             
      <?php /*?>
      <!-- **Full-width-section - Starts** -->
      <div class="full-width-section">
        <div class="dt-sc-margin65"></div>
        <div class="container">
        
          
          
          <div class="column first animate" data-animation="fadeInDown" data-delay="100" style="color:#000">
            <h3>Comment?</h3>
            <p>Comment font les étudiants pour innover des outils, produits, procédés, programmes ou services pédagogiques? </p>
            
            <p>En réponse à une problématique exprimée par un milieu collaborateur, les étudiants 
            procèdent à l’application d’une méthode rigoureuse et systématique, nommée 
            l’Analyse de la Valeur Pédagogique (AVP), pour proposer et développer une solution innovante.</p>
            
            <p>En bref, <strong>l’AVP</strong> comporte une démarche de trois phases.</p>
         </div>
         <div class="clearfix"></div>
         <div class="clearfix"></div>
         
         
         <div class="column dt-sc-one-third first">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInRight" data-delay="100"> <img src="<?php echo $imagePath; ?>/book-mark.png" alt="Phase I, Préconception"/> </div>
              <h4> <a href="#">Phase I,  <strong>Préconception</strong>:</a></h4>
              <p><strong>Étape 1 <i class="fa fa-arrow-right"></i></strong> Préciser un problème orthopédagogique et mener au moins deux 
                	analyses de besoins auprès des utilisateurs potentiels du produit, procédé ou service pédagogique à l’étude.</p>
                    
               <p><strong>Étape 2 <i class="fa fa-arrow-right"></i></strong> Élaborer un cadre de référence. </p>  
               <p><strong>Étape 3 <i class="fa fa-arrow-right"></i></strong> Rédiger une fiche synthèse. </p>       
            </div>
          </div>
         
         <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInRight" data-delay="100">
              	<img src="<?php echo $imagePath; ?>/power-gears1.png" alt="Phase II, Analyse fonctionnelle"/>
              </div>
              <h4> <a href="#">Phase II, <strong>Analyse fonctionnelle</strong>:</a></h4>
              <p><strong>Étape 4 <i class="fa fa-arrow-right"></i></strong> Réaliser au moins deux analyses fonctionnelles.</p>    
              <p><strong>Étape 5 <i class="fa fa-arrow-right"></i></strong> Élaborer un cahier des charges pour la conception et l’évaluation 
              	d’un produit, procédé ou service pédagogique.</p>      
            </div>
          </div>
          
          <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type7">
              <div class="icon animate" data-animation="fadeInRight" data-delay="100">
              	<img src="<?php echo $imagePath; ?>/admin1.png" alt="Phase III, Conception-Évaluation"/>
              </div>
              <h4> <a href="#">Phase III,  <strong>Conception-Évaluation</strong>:</a></h4>
              <p><strong>Étape 6 <i class="fa fa-arrow-right"></i></strong> Rechercher les solutions pour remplir les fonctions prescrites au 
              	cahier des charges. Créer un premier prototype.</p>    
              <p><strong>Étape 7 <i class="fa fa-arrow-right"></i></strong> Mettre à l’essai le prototype en milieu de stage pour évaluer son 
              	efficacité et sa productivité et proposer des ajustements.</p>      
            </div>
          </div>
        <div class="dt-sc-margin50"></div>
      </div>
      <!-- **Full-width-section - Ends** --> 
      <?php */?>
      
      
