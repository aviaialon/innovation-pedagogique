<?php 
	$Application       = \Core\Application::getInstance(); 
	$arrAppAttachments = array();
?>
<div id="main">
  <?php $this->renderPartial('menu::breadcrumb', array()); ?>
  <!-- **Full-width-section - Starts** --> 
  <div class="full-width-section ">
    <div class="parallax full-width-bg paddingTop0" style="background-position: 50% -4px;">
    	<div class="container"> 
    		<div class="dt-sc-margin30"></div>
    		<?php $this->renderPartial('modules::directions::map_directions', $this->getRequestData()); ?>
    	</div>	
    </div>
	    
	<div class="container">
	    <div class="column dt-sc-two-third first">
	        <div class="hr-title">
	            <h3>Envoyez-nous un message</h3>
	            <div class="title-sep">
	            </div>
	        </div>
	        <form method="post" class="dt-sc-contact-form" action="" name="frmcontact" novalidate rel-form-id="SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM">
	            <div class="column dt-sc-one-third first">
	                <p> <span> <input type="text" 
	                	placeholder="<?php echo($Application->translate('Name', 'Nom')); ?>*" name="name" required=""
	                	 value="<?php echo($this->getRequestParam('name')); ?>" /> 
                     </span> </p>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="email" placeholder="Email*" name="email" 
	                	value="<?php echo($this->getRequestParam('email')); ?>" required /> </span> </p>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="text" placeholder="<?php echo $Application->translate('Subject', 'Sujet'); ?>" name="subject" 
	                	value="<?php echo($this->getRequestParam('subject')); ?>"> </span> </p>
	            </div>
                <div class="full-width-section ">
	            	<p> <textarea placeholder="Message*" name="message" required><?php echo($this->getRequestParam('subject')); ?></textarea> </p>
                </div>
                <div class="column dt-sc-one-half first">
	                <?php echo \Core\Util\Recaptcha\Recaptcha::getInstance()->getRecaptchaField(); ?>
	            </div>
                <div class="column dt-sc-one-half">
	                <a class="dt-sc-button medium submit" href="#">Envoyer votre demande</a>
	            </div>
	        </form>
	    </div>
	    
	    <div class="column dt-sc-one-third">
	        <div class="hr-title">
	            <h3>Informations de Contact</h3>
	            <div class="title-sep"></div>
	        </div>
	        <p class="dt-sc-contact-detail"> 
            	Nous sommes idéalement situés au cœur de Montréal. Donner nous un appel, 
                ou remplissez le formulaire a gauche pour entrer en contact avec nous.  </p>
	        <!-- **dt-sc-contact-info - Starts** -->
	        <div class="dt-sc-contact-info">
	            <p> <i class="fa fa-location-arrow"></i> <?php echo $Application->getConfigs()->get('Application.core.mvc.contact.address'); ?></p>
	            <p> <i class="fa fa-phone"></i> <?php echo $Application->getConfigs()->get('Application.core.mvc.contact.number'); ?> </p>
	            <p> <i class="fa fa-fax"></i> <?php echo $Application->getConfigs()->get('Application.core.mvc.contact.fax'); ?> </p>
	            <p> <i class="fa fa-globe"></i> <a href="<?php echo $Application->getConfigs()->get('Application.site.site_url'); ?>">
					<?php echo $Application->getConfigs()->get('Application.site.site_url'); ?> </a> </p>
	            <p> <i class="fa fa-envelope"></i> <a href="mailto:<?php echo $Application->getConfigs()->get('Application.core.mvc.contact.email'); ?>">
                	<?php echo $Application->getConfigs()->get('Application.core.mvc.contact.email'); ?>
                </a> </p>
	        </div> <!-- **dt-sc-contact-info - Ends** -->
	    </div>
	    
	</div>
    
  <div class="dt-sc-margin50"></div>
  <script type="text/javascript">
	Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').configure(
		SYSTEM.APPLICATION.MAIN.CONFIGURATION.UPLOADED_ATTACHMENTS, 
		<?php echo(json_encode($arrAppAttachments)); ?>
	);
	Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').configure(
		SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_LOCATION_INDEX, 
		<?php echo json_encode(\strip_tags($Application->getConfigs()->get('Application.core.mvc.contact.address'))); ?>
	);
  </script>
  <!-- **Full-width-section - Ends** --> 
  <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?>  
</div>
