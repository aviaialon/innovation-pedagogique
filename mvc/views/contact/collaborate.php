<?php 
	$Application       = \Core\Application::getInstance(); 
	$arrAppAttachments = array();
?>
<div id="main">
  <?php $this->renderPartial('menu::breadcrumb', array()); ?>
  <!-- **Full-width-section - Starts** --> 
  <div class="full-width-section ">
    <div class="dt-sc-margin30"></div>
	    
	<div class="container">
    
	    <div class="column full-width-section first">
	        <!--<div class="hr-title">
	            <h4>DEMANDE DE PROJET:</h4>
                <p><strong>Faculté des sciences de l’éducation Adaptation Scolaire:</strong> Projet intégrateur final en adaptation scolaire</p>
	            <div class="title-sep">
	            </div>
	        </div>-->
            <p>Veuillez remplir le formulaire ci-dessous pour soumettre une demande de projet.</p>
	        <form method="post" class="dt-sc-contact-form" action="" name="frmcollaborate" id="frmcollaborate">
            	<div class="column full-width-section first">
                	<p class="error_msg"></p>
                </div>
            	<div class="dt-sc-margin25"></div>
                <!-- **dt-sc-toggle-frame-set - Starts** -->
                <div class="dt-sc-toggle-frame-set type3">
                    <div class="segment">
                    	<h5 class="dt-sc-toggle-accordion active"><a href="#" class="toggler">1. Introduction</a></h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                               <textarea placeholder="Décrivez brièvement votre milieu et les services offerts." class="input-item" 
                                    name="description" required><?php echo($this->getRequestParam('description')); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="segment">
                    	<h5 class="dt-sc-toggle-accordion "><a href="#" class="toggler">2. Problématique ou besoin</a></h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                                <textarea class="input-item" placeholder="Décrivez le problème que vous souhaitez résoudre ou le besoin que vous aimeriez satisfaire dans votre milieu." 
                                    name="problem" required><?php echo($this->getRequestParam('problem')); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="segment">
                    	<h5 class="dt-sc-toggle-accordion "><a href="#" class="toggler">3. Description du produit</a></h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                                <textarea class="input-item" placeholder="Décrivez le genre d’outil, de produit, de procédé ou de service pédagogique idéal que vous aimeriez (fonctionnalité, caractéristique etc.)" 
                                    name="product" required><?php echo($this->getRequestParam('product')); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="segment">
                    	<h5 class="dt-sc-toggle-accordion "><a href="#" class="toggler">4. Estimation de l’effort</a></h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                                <p>Selon vous, le projet demandé est estimé à combien d’heures et à combien d’étudiants?</p>
                                <div class="column dt-sc-one-half first">
                                    <p> <span> <input class="input-item" type="number" placeholder="Nombre d'heures estimées" name="project_hours" 
                                        value="<?php echo($this->getRequestParam('project_hours')); ?>" required> </span> </p>
                                </div>
                                <div class="column dt-sc-one-half">
                                    <p> <span> 
                                    <input class="input-item" type="number" placeholder="Nombre d'étudiants" name="project_students" 
                                        value="<?php echo($this->getRequestParam('project_students')); ?>" required /></span> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="segment">
                    	<h5 class="dt-sc-toggle-accordion "><a href="#" class="toggler">5. Détails et soutien au projet</a></h5>
                        <div class="dt-sc-toggle-content">
                            <div class="block">
                                <div class="full-width-section">
                                    <div class="column">
                                        <p>Dans le cadre de ce projet, vous pourriez fournir à l’équipe de conception les éléments suivants : (documentation, logiciel, matériel, etc.) :</p>
                                        <div class="column dt-sc-one-half first">
                                        <select class="input-item" name="documents" id="documents" required>
                                            <option value="oui">Oui</option>
                                            <option value="non">Non</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="dt-sc-margin10"></div>
                                <div class="full-width-section">
                                    <div class="column">
                                        <p>Un représentant de votre milieu sera disponible pour rencontrer l’équipe de conception à l’université de Montréal.</p>
                                        <div class="column dt-sc-one-half first">
                                            <p> <span> <input class="input-item" type="text" placeholder="<?php echo $Application->translate('Complete Name', 'Nom complet'); ?>" name="name" 
                                                value="<?php echo($this->getRequestParam('name')); ?>" required> </span> </p>
                                        </div>
                                        <div class="column dt-sc-one-half">
                                            <p> <span> <input class="input-item" type="text" placeholder="Titre" name="title" 
                                                value="<?php echo($this->getRequestParam('title')); ?>" required> </span> </p>
                                        </div>
                                        <div class="column dt-sc-one-half first">
                                            <p> <span> <input class="input-item" type="tel" placeholder="Téléphone" name="tel" 
                                                value="<?php echo($this->getRequestParam('tel')); ?>" required> </span> </p>
                                        </div>
                                        <div class="column dt-sc-one-half">
                                            <p> <span> <input class="input-item" type="email" placeholder="Courriel" name="email" 
                                                value="<?php echo($this->getRequestParam('email')); ?>" required /> </span> </p>
                                        </div>
                                        <div class="dt-sc-margin20"></div>
                                        <div class="column dt-sc-one-half first">
                                            <?php echo \Core\Util\Recaptcha\Recaptcha::getInstance()->getRecaptchaField(); ?>
                                        </div>
                                        <div class="column dt-sc-one-half">
                                            <a class="dt-sc-button medium submit" href="#">Envoyez votre demande</a>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="dt-sc-margin20"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- **dt-sc-toggle-frame-set - Ends** -->
	        </form>
	    </div>
	    
	</div>
    
  <div class="dt-sc-margin50"></div>
  <!-- **Full-width-section - Ends** --> 
  <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?>  
</div>
