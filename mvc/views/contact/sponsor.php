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
    
    
        <p class="font14">Dans le cadre d’un <strong>atelier d’innovation pédagogique</strong>, les étudiants finissants au 
            BEAS doivent concevoir ou améliorer un produit, procédé ou service pédagogique.  
            Afin de faire connaître et valoriser ces innovations pédagogiques développées, 
            chaque année, nous organisons une exposition qui prévoit réunir plus de trois cents 
            invités du monde de l’éducation. De plus, un représentant du journal local est 
            présent pour mettre en lumière ces produits, procédés et services qui répondent à 
            des besoins d’actualité en éducation. C’est une occasion pour vous de promouvoir 
            votre entreprise ou votre organisme.</p>
            
            <p class="font14">Votre soutien, quel qu’il soit, serait très apprécié. En tant que commanditaire, vous 
            profiterez d’une visibilité particulière durant la période précédant l’événement ainsi 
            que pendant et après. </p>
            
            <p class="font14">N’hésitez pas à <a href="<?php echo $this->route('contact'); ?>">communiquer</a> avec nous pour toutes questions et tous 
            commentaires. </p>
            
            <p class="font14">Nous vous remercions à l’avance de votre temps et de votre attention. En espérant 
            pouvoir compter sur votre participation à cet événement qui met en évidence les 
            efforts d’innovation de la relève en éducation des élèves handicapés ou en difficultés 
            d’adaptation ou d’apprentissage.</p>
        <hr />
    	<div class="dt-sc-margin30"></div>
        
        <div class="hr-title">
            <h4>RECONNAISSANCE DONT JOUISSENT LES COMMANDITAIRES:</h4>
        </div>
    
    
        
  		<?php $this->renderPartial('modules::cta::sponsor_price_table', array()); ?>
    
	    <div class="column full-width-section first">
	        <div class="hr-title">
	            <h3>Formulaire de Commandite </h3>
	            <div class="title-sep">
	            </div>
	        </div>
	        <form method="post" class="dt-sc-contact-form" action="" name="frmsponsor" novalidate rel-form-id="SYSTEM.APPLICATION.MAIN.MODULE.SPONSOR_FORM">
	            <div class="column dt-sc-one-third first">
	                <!--<p> <span> <input type="text" 
	                	placeholder="<?php echo($Application->translate('Name', 'Nom')); ?>*" name="name" required=""
	                	 value="<?php echo($this->getRequestParam('name')); ?>" /> 
                     </span> </p>-->
                     <select name="package" id="package">
                        <option value="">Veuillez choisir le type de commandite *</option>
                        <option value="platine">Commandite platine</option>
                        <option value="or">Commandite or</option>
                        <option value="argent">Commandite argent</option>
                        <option value="bronze">Commandite bronze</option>
                        <option value="blanc">Commandite blanc</option>
                    </select>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="text" placeholder="<?php echo $Application->translate('Complete Name', 'Nom complet'); ?>*" name="name" 
	                	value="<?php echo($this->getRequestParam('name')); ?>"> </span> </p>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="email" placeholder="Email*" name="email" 
	                	value="<?php echo($this->getRequestParam('email')); ?>" required /> </span> </p>
	            </div>
                
                
                
	            <div class="column dt-sc-one-third first">
	                <p> <span> <input type="text" 
                    	placeholder="<?php echo $Application->translate('Company Name', 'Nom de l\'organisation ou de l\'entreprise'); ?>*" name="companyName" 
	                	value="<?php echo($this->getRequestParam('companyName')); ?>" required /> </span> </p>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="tel" placeholder="Numéro de téléphone*" name="tel" 
	                	value="<?php echo($this->getRequestParam('tel')); ?>" required /> </span> </p>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="tel" placeholder="Numéro de fax" name="fax" 
	                	value="<?php echo($this->getRequestParam('fax')); ?>" /> </span> </p>
	            </div>
                
                <div class="full-width-section ">
	            	<p> <span> <input type="text" placeholder="<?php echo $Application->translate('Adresse', 'Adresse postale'); ?>*" name="address" 
	                	value="<?php echo($this->getRequestParam('address')); ?>" required /> </span> </p>
                </div>
                
                <div class="full-width-section ">
	            	<p> <textarea placeholder="Message" name="message" required><?php echo($this->getRequestParam('subject')); ?></textarea> </p>
                </div>
                <div class="column dt-sc-one-half first">
	                <?php echo \Core\Util\Recaptcha\Recaptcha::getInstance()->getRecaptchaField(); ?>
	            </div>
                <div class="column dt-sc-one-half">
	                <a class="dt-sc-button medium submit" href="#">Envoyer votre demande</a>
	            </div>
	        </form>
	    </div>
	    
	</div>
    
  <div class="dt-sc-margin50"></div>
  <!-- **Full-width-section - Ends** --> 
  <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?>  
</div>
