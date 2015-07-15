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
	    <div class="column dt-sc-three-fourth first">
	        <div class="hr-title">
	            <h3>Give a Message</h3>
	            <div class="title-sep">
	            </div>
	        </div>
	        <form method="post" class="dt-sc-contact-form" action="php/send.php" name="frmcontact" novalidate="novalidate">
	            <div class="column dt-sc-one-third first">
	                <p> <span> <input type="text" 
	                	placeholder="<?php echo($Application->translate('Name', 'Nom')); ?>*" name="name" required=""
	                	 value="<?php echo($this->getRequestParam('name')); ?>" /> </span> </p>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="email" placeholder="Email*" name="email" 
	                	value="value="<?php echo($this->getRequestParam('email')); ?>"" required="" /> </span> </p>
	            </div>
	            <div class="column dt-sc-one-third">
	                <p> <span> <input type="text" placeholder="<?php echo $Application->translate('Subject', 'Sujet'); ?>" name="subject" 
	                	value="<?php echo($this->getRequestParam('subject')); ?>"> </span> </p>
	            </div>
	            <p> <textarea placeholder="Message*" name="message" required=""><?php echo($this->getRequestParam('subject')); ?></textarea> </p>
	            <p> <input type="submit" value="Send Message" name="submit"> </p>
	        </form>
	        <div id="ajax_contact_msg"></div>
	    </div>
	    
	    <div class="column dt-sc-one-fourth">
	        <div class="hr-title">
	            <h3>Contact Info</h3>
	            <div class="title-sep">
	            </div>
	        </div>
	        <p class="dt-sc-contact-detail"> We are located in Melbourne, serving clients worldwide. Shoot us an email, give us a call, or fill out our Project Brief if you're interested in getting started.  </p>
	        <!-- **dt-sc-contact-info - Starts** -->
	        <div class="dt-sc-contact-info">
	            <p> <i class="fa fa-location-arrow"></i> 121 King St, Melbourne VIC 3000,<br> Australia </p>
	            <p> <i class="fa fa-phone"></i> +61 3 8376 6284 </p>
	            <p> <i class="fa fa-globe"></i> <a href="#"> envato.com </a> </p>
	            <p> <i class="fa fa-envelope"></i> <a href="#"> grandjade@gmail.com </a> </p>
	        </div> <!-- **dt-sc-contact-info - Ends** -->
	    </div>
	    
	</div>
    <?php /*<div class="container"> 
    	
    	<!-- Begin contact section -->
		<div class="container-fluid">
			<section id="content-wrapper">
				
		        <div class="row">
		            <div class="twelve columns">
		                <div class="divider"></div>
		            </div>
		        </div>
		        
		        <div class="row-fluid">
		        	<div class="span8">
		            	<div id="contact-form-area">
		                    <!-- Contact Form Start //-->
							<a name="contact"></a>
		                    <form action="#contact" id="contactform" method="post"> 
		                        <fieldset>
		                            <div class="label-form-inline"> 
		                            <label><?php echo($Application->translate('Name', 'Nom')); ?> <em>*</em></label>                           
		                            <input type="text" name="name" class="textfield" id="name" value="<?php echo($this->getRequestParam('name')); ?>" /> 
		                            </div>
		                            <div class="label-form-inline">
		                            <label>E-mail <em>*</em></label> 
		                            <input type="text" name="email" class="textfield" id="email" value="<?php echo($this->getRequestParam('email')); ?>" />  
		                            </div>
		                            <div class="label-form-inline-last">                      
		                            <label><?php echo($Application->translate('Subject', 'Sujet')); ?> <em>*</em></label>
		                            <input type="text" name="subject" class="textfield" id="subject" value="<?php echo($this->getRequestParam('subject')); ?>" />
		                            </div>
		                        <label>Message <em>*</em></label>
		                        <textarea name="message" id="message" class="textarea" cols="2" rows="4"><?php echo($this->getRequestParam('message')); ?></textarea>
		                        <div class="clear"></div> 
								<ul id="__slawnerContactEmailAttachmentForm" class="unstyled"></ul>
		                        <label>&nbsp;</label>
		                        <input type="submit" name="submit" class="buttonShadow buttoncontact" id="buttonsend" value="<?php echo($Application->translate('Send your message', 'Envoyer votre message')); ?>" />
									
		                        <span class="loading" style="display: none;"><?php echo($Application->translate('Please wait', 'Veuillez patienter')); ?>..</span>
		                        <div class="clear"></div>
		                        </fieldset> 
		                    </form>
							
		                    <!-- Contact Form End //-->
		                </div>                
		            </div>
		            
			    </div>  
			 </section>
		    
		    </div>
     	<!-- Contact section EOF -->
    </div>
    <!-- **container - Ends** -->
  </div>*/?>
  
  <div class="dt-sc-margin50"></div>
  <script type="text/javascript">
	Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').configure(
		SYSTEM.APPLICATION.MAIN.CONFIGURATION.UPLOADED_ATTACHMENTS, 
		<?php echo(json_encode($arrAppAttachments)); ?>
	);
	Core.StaticInstance.get('SYSTEM.APPLICATION.MAIN').configure(
		SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_LOCATION_INDEX, 
		'<?php echo \strip_tags($Application->getConfigs()->get('Application.core.mvc.contact.address')); ?>'
	);
  </script>
  <!-- **Full-width-section - Ends** --> 
  <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?>  
</div>
