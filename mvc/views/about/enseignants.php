<?php 
	$Application   = \Core\Application::getInstance();
	$assetsBaseImg = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
?>
<style type="text/css">
	.dt-sc-team .image img {
		border: solid 3px #FFF;
		border-radius: 100% !important;
		width: 150px !important;
		height: 145px !important;
	}
</style>
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
                <h2>Équipe Des responsables du projet des finissants en adaptation scolaire, UdeM</h2>
                <p>Le Projet des finissants en adaptation scolaire de l’Université de Montréal est devenu un modèle d’activité 
                    d’intégration des connaissances et compétences acquises par des finissants universitaires en éducation. 
                    Ce Projet est encadré par une équipe aguerrie. </p>
                    
                <p>Nous invitons les milieux scolaires et les organismes communautaires préoccupés par l’éducation des élèves handicapés ou 
                en difficulté d’apprentissage ou d’adaptation à soumettre à nos finissantes et finissants des problèmes à résoudre. 
                Vous verrez, ils sont formidables. Chaque année, leurs innovations orthopédagogiques sont impressionnantes.</p>    
            </div><!-- **dt-sc-team-carousel - Ends** -->
            <hr />
            
            <div class="enseignants">
            	<div class="column dt-sc-one-fourth first">
                    <!-- **dt-sc-team - Starts** -->
                    <div class="dt-sc-team type3">
                       <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/nm.jpg" alt="Nathalie Myara" class="bradius0"/></div>
                        <!-- **team-details - Starts** -->
                        <div class="team-details">
                            <h4><a href="#">Nathalie Myara</a></h4>
                            <p>Ph. D en psychopédagogie, professeurs associée au Département de psychopédagogie et andragogie.</p>
                            <!-- **dt-sc-social-icons - Starts** -->
                            <ul class="dt-sc-social-icons">
                                <li> <a href="https://www.facebook.com/nathalie.myara.1" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                <li> <a href="#" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                <li> <a href="http://ca.linkedin.com/pub/nathalie-myara-ifergan/4a/3/18a" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                            </ul> <!-- **dt-sc-social-icons - Ends** -->
                        </div> <!-- **team-details - Ends** -->
                    </div><!-- **dt-sc-team - Ends** -->
                </div>
                
                <div class="column dt-sc-one-fourth ">
                    <!-- **dt-sc-team - Starts** -->
                    <div class="dt-sc-team type3">
                       <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/jl.jpg" alt="Jacques Langevin" class="bradius0"/></div>
                        <!-- **team-details - Starts** -->
                        <div class="team-details">
                            <h4><a href="#">Jacques Langevin</a></h4>
                            <p>Ph. D en psychologie cognitive, professeur titulaire au Département de psychopédagogie et andragogie.</p>
                            <!-- **dt-sc-social-icons - Starts** -->
                            <ul class="dt-sc-social-icons">
                                <li> <a href="#" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                <li> <a href="#" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                <li> <a href="#" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                            </ul> <!-- **dt-sc-social-icons - Ends** -->
                        </div> <!-- **team-details - Ends** -->
                    </div><!-- **dt-sc-team - Ends** -->
                </div>
                
                <div class="column dt-sc-one-fourth">
                    <!-- **dt-sc-team - Starts** -->
                    <div class="dt-sc-team type3">
                       <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/mj.jpg" alt="Manon Jolicoeur" class="bradius0"/></div>
                        <!-- **team-details - Starts** -->
                        <div class="team-details">
                            <h4><a href="#">Manon Jolicoeur</a></h4>
                            <p>Ph.D. Éducation Chercheure au Groupe DÉFI Accessibilité</p>
                            <!-- **dt-sc-social-icons - Starts** -->
                            <ul class="dt-sc-social-icons">
                                <li> <a href="#" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                <li> <a href="https://www.facebook.com/manjolicoeur" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                <li> <a href="https://ca.linkedin.com/pub/manon-jolicoeur/33/836/411" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                            </ul> <!-- **dt-sc-social-icons - Ends** -->
                        </div> <!-- **team-details - Ends** -->
                    </div><!-- **dt-sc-team - Ends** -->
                </div>
                
                <div class="column dt-sc-one-fourth">
                    <!-- **dt-sc-team - Starts** -->
                    <div class="dt-sc-team type3">
                       <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/ia.png" alt="Irma Alaribe" class="bradius0"/></div>
                        <!-- **team-details - Starts** -->
                        <div class="team-details">
                            <h4><a href="#">Irma Alaribe</a></h4>
                            <p>doctorante en psychopédagogie au Groupe DÉFI Accessibilité</p>
                            <!-- **dt-sc-social-icons - Starts** -->
                            <ul class="dt-sc-social-icons">
                                <li> <a href="#" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                <li> <a href="#" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                <li> <a href="#" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                            </ul> <!-- **dt-sc-social-icons - Ends** -->
                        </div> <!-- **team-details - Ends** -->
                    </div><!-- **dt-sc-team - Ends** -->
                </div>
            </div>
			
                                
            
            
            <?php /*?><div class="type2">
                <div class="dt-sc-team-carousel">
                    <div class="column dt-sc-one-column first">
                        <!-- **dt-sc-team - Starts** -->
                        <div class="dt-sc-team type4">
                            <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/nm.jpg" alt="Nathalie Myara" class="bradius0"/></div>
                            <!-- **team-details - Starts** -->
                            <div class="team-details">
                                <h4><a href="#">Nathalie Myara</a></h4>
                                <p>Ph. D en psychopédagogie, professeurs associée au Département de psychopédagogie et andragogie.</p>
                                <!-- **dt-sc-social-icons - Starts** -->
                                <ul class="dt-sc-social-icons">
                                    <li> <a href="https://www.facebook.com/nathalie.myara.1" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                    <li> <a href="#" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                    <li> <a href="http://ca.linkedin.com/pub/nathalie-myara-ifergan/4a/3/18a" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                                </ul> <!-- **dt-sc-social-icons - Ends** -->
                            </div> <!-- **team-details - Ends** -->
                        </div><!-- **dt-sc-team - Ends** -->
                    </div>
                    <hr />
                    <div class="column dt-sc-one-column">
                        <!-- **dt-sc-team - Starts** -->
                        <div class="dt-sc-team type4">
                            <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/jl.jpg" alt="Jacques Langevin" class="bradius0"/></div>
                            <!-- **team-details - Starts** -->
                            <div class="team-details">
                                <h4><a href="#">Jacques Langevin</a></h4>
                                <p>Ph. D en psychologie cognitive, professeur titulaire au Département de psychopédagogie et andragogie.</p>
                                <!-- **dt-sc-social-icons - Starts** -->
                                <ul class="dt-sc-social-icons">
                                    <li> <a href="#" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                    <li> <a href="#" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                    <li> <a href="#" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                                </ul> <!-- **dt-sc-social-icons - Ends** -->
                            </div> <!-- **team-details - Ends** -->
                        </div><!-- **dt-sc-team - Ends** -->
                    </div>
                    <hr />
                    <div class="column dt-sc-one-column">
                        <!-- **dt-sc-team - Starts** -->
                        <div class="dt-sc-team type4">
                            <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/mj.jpg" alt="Manon Jolicoeur" class="bradius0"/></div>
                            <!-- **team-details - Starts** -->
                            <div class="team-details">
                                <h4><a href="#">Manon Jolicoeur</a></h4>
                                <p>Ph.D. Éducation Chercheure au Groupe DÉFI Accessibilité</p>
                                <!-- **dt-sc-social-icons - Starts** -->
                                <ul class="dt-sc-social-icons">
                                    <li> <a href="#" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                    <li> <a href="https://www.facebook.com/manjolicoeur" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                    <li> <a href="https://ca.linkedin.com/pub/manon-jolicoeur/33/836/411" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                                </ul> <!-- **dt-sc-social-icons - Ends** -->
                            </div> <!-- **team-details - Ends** -->
                        </div><!-- **dt-sc-team - Ends** -->
                    </div>
                    <hr />
                    <div class="column dt-sc-one-column">
                        <!-- **dt-sc-team - Starts** -->
                        <div class="dt-sc-team type4">
                            <div class="image"><img src="<?php echo $assetsBaseImg; ?>/teachers/ia.png" alt="Irma Alaribe" class="bradius0"/></div>
                            <!-- **team-details - Starts** -->
                            <div class="team-details">
                                <h4><a href="#">Irma Alaribe</a></h4>
                                <p>doctorante en psychopédagogie au Groupe DÉFI Accessibilité</p>
                                <!-- **dt-sc-social-icons - Starts** -->
                                <ul class="dt-sc-social-icons">
                                    <li> <a href="#" title="twitter"> <span class="fa fa-twitter"></span>  </a> </li>
                                    <li> <a href="#" title="facebook"> <span class="fa fa-facebook"></span>  </a> </li>
                                    <li> <a href="#" title="linkedin"> <span class="fa fa-linkedin"></span>  </a> </li>
                                </ul> <!-- **dt-sc-social-icons - Ends** -->
                            </div> <!-- **team-details - Ends** -->
                        </div><!-- **dt-sc-team - Ends** -->
                    </div>
            
                </div>
                        
                <!--<div class="carousel-arrows">
                    <div class="pager">
                        <a href="#"> <span> 1 </span> </a>
                        <a href="#"> <span> 2 </span> </a>
                        <a href="#"> <span> 3 </span> </a>
                    </div>
                </div>-->
            
            </div><?php */?>
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
