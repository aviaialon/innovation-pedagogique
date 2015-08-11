<?php
/**
 * Contact Controller
 *
 * @package    Admin
 * @subpackage None
 * @file       Admin/IndexControler.php
 * @desc       Used interface for base objects implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */

namespace Ipm\Mvc\Controller;

/**
 * Base controller for admin section
 *
 * @package    Admin
 * @subpackage None
 * @file       Views/ContactControler.php
 * @desc       Used interface for base objects implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */

class ContactController
    extends \Core\Net\HttpRequest
{
   /**
    * Predispatch hook
    *
    * @return void
    */
   public final function preDispatch(array $requestDispatchData)
   {
   }
	   
   /**
    * index action
    *
    * @return void
    */
   public final function indexAction(array $requestDispatchData)
   {
	   $this->_postGeneralContactForm();
   }
   
   /**
    * Sponsor action
    *
    * @return void
    */
   public final function sponsorAction(array $requestDispatchData)
   {
	   $this->_postSponsorRequestForm();
   }
   
   /**
    * collaborate action
    *
    * @return void
    */
   public final function collaborateAction(array $requestDispatchData)
   {
	   $this->_postCollaborateRequestForm();
   }
   
   /**
    * Validates an address action
    *
    * @return void
    */
   protected final function _validateAddress($address)
   {
	    $this->setContentType(\Core\Net\Router::Content_Type_Json);
	    $this->disableRender();
		$returnData = array('valid' => true, 'message' => '');
		$address    = $this->getRequestParam('address');
		
		if (empty($address) === false) {
			// Validate the address
			$url  = sprintf('http://maps.google.com/maps/api/geocode/json?sensor=false&address=%s', urlencode($address));
			try {
				$_geoCodeResponse = @json_decode(@file_get_contents($url), true);
				
				if (true === is_array($_geoCodeResponse) && true === empty($_geoCodeResponse['results'])) {
					$returnData['valid'] = false;
				} else if (false === empty($_geoCodeResponse['results'][0]['formatted_address'])) {
					$returnData['valid']   = true;
					$returnData['message'] = $_geoCodeResponse['results'][0]['formatted_address'];
				}
			
			} catch (\Exception $_reqException) { }
		}
		
		echo json_encode($returnData);
   }
   
   /**
    * Post the collaborate form
    *
    * @return void
    */
	protected final function _postCollaborateRequestForm()
	{
		if (true === $this->isPost()) {
			$this->setContentType(\Core\Net\Router::Content_Type_Json);
			$this->disableRender();
			
			$Application  = \Core\Application::getInstance();
			$objMailer    = \Core\Mail\Mail::getInstance();
			$returnData   = array(
				'success' => true,
				'message' => ''
			);
			
			if (true === isset($_POST['project_hours'])) {
				$_POST['project_hours'] = (int) $_POST['project_hours'];
			}
			
			if (true === isset($_POST['project_students'])) {
				$_POST['project_students'] = (int) $_POST['project_students'];
			}
			
			$_postFields = array(
				'tel' 	=> "Veuillez fournir un numero de telephone valide.",
				'name' 	=> "Veuillez indiquer votre nom.",
				'title' => "Veuillez indiquer votre titre.",
				'email'	=> "Veuillez fournir une adresse courriel valide.",
				'description' => "Decrivez brièvement votre milieu et les services offerts.",
				'problem' => "Decrivez le problème que vous souhaitez resoudre ou le besoin que vous aimeriez satisfaire dans votre milieu.",
				'product' => "Decrivez le genre d’outil, de produit, de procede ou de service pedagogique ideal que vous aimeriez",
				'documents' => "Dans le cadre de ce projet, vous pourriez fournir à l’equipe de conception les elements",
				'project_hours' => "Nombre d'heures estimees",
				'project_students' => "Nombre d'etudiants estimees."
			);
			
			foreach ($_postFields as $_field => $_errorMessage) {
				if (false === $this->getRequestParam($_field)) {
					$returnData['success'] = false;
					$returnData['message'] = $_errorMessage;
					break;
				}
			}
			
			if (true === $returnData['success']) {
				// Validate the email
				if (false === filter_var($this->getRequestParam('email'), FILTER_VALIDATE_EMAIL)) {
					$returnData['message'] = $Application->translate('Please enter a valid email.', 'Veuillez entrer une address courriel valide.');
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// Validate the email
				if (false === ($_POST['project_hours'] > 0)) {
					$returnData['message'] = 'Veuillez fournir un nombre d\'heures estimees valid.';
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// Validate the email
				if (false === ($_POST['project_hours'] > 0)) {
					$returnData['message'] = 'Veuillez fournir un nombre d\'etudiants estimees valid.';
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// Validate the recaptcha
				if (false === \Core\Util\Recaptcha\Recaptcha::getInstance()->isValid()) {
					$returnData['message'] = $Application->translate('Please click the captcha field.', 'Veuillez cliquez sur le champ captcha.');
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// SEND OUT THE EMAIL HERE!		   
			   $objMailer->setData(array(
					'ROOT' 		=> $Application->getConfigs()->get('Application.site.site_url'),
					'SITE_NAME'	=> $Application->getConfigs()->get('Application.site.site_name'),
					'ADDRESS'	=> $Application->getConfigs()->get('Application.core.mvc.contact.address'),
					'EMAIL'		=> $Application->getConfigs()->get('Application.core.mvc.contact.email'),
					'DATE'		=> 	date("F j, Y"),
					'YEAR'		=> 	date("Y")
				)); 
				
				$objMailer->setTo($Application->getConfigs()->get('Application.core.mvc.contact.email'));
				$objMailer->setSubject('%%SITE_NAME%%: Un Formulaire de collaboration a ete soumis.');
			
				
				$tel         = strip_tags($this->getRequestParam('tel'));
				$name 		 = strip_tags($this->getRequestParam('name'));
				$title 	 	 = strip_tags($this->getRequestParam('title'));
				$email 		 = strip_tags($this->getRequestParam('email'));
				$description = strip_tags($this->getRequestParam('description'));
				$problem     = strip_tags($this->getRequestParam('problem'));
				$product     = strip_tags($this->getRequestParam('product'));
				$documents   = strip_tags($this->getRequestParam('documents'));
				$projectHrs  = strip_tags($this->getRequestParam('project_hours'));
				$projectHSts = strip_tags($this->getRequestParam('project_students'));
				$template 	 = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial; font-size: 12px">' .
								  '<tr>' .
									'<td width="100%" align="left" colspan="2"><b>Bonjour, un formulaire de collaboration a ete soumis. Voici les informations:</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="100%" colspan="2">&nbsp;</td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Titre:</td>' .
									'<td width="80%" align="left"><b>' . ($title) . '</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Nom:</td>' .
									'<td width="80%" align="left"><b>' . ucwords($name) . '</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Email:</td>' .
									'<td width="80%" align="left"><b>' . $email . '</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Tel:</td>' .
									'<td width="80%" align="left"><b>' . ucwords($tel) . '</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Introduction:</td>' .
									'<td width="80%" align="left"><b>' . $description . '</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Problematique ou besoin:</td>' .
									'<td width="80%" align="left"><b>' . $problem . '</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Description du produit:</td>' .
									'<td width="80%" align="left"><b>' . $product . '</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Estimation de l’effort:</td>' .
									'<td width="80%" align="left"><b>' . $projectHrs . ' heure(s) estimees, ' . $projectHSts . ' etudiant(s)</b></td>' .
								  '</tr>' .
								  '<tr>' .
									'<td width="20%">Documentation:</td>' .
									'<td width="80%" align="left"><b>' . $documents . '</b></td>' .
								  '</tr>' .
								'</table>';
				$objMailer->setMessage($template);
				$objMailer->setTemplate('templates/email/site.html');
				$returnData['success'] = $objMailer->send();
				$errors                = $objMailer->getError();
				$returnData['message'] = empty($errors) === false ? array_shift($errors) : '';
			}
			
			echo json_encode($returnData);
	   	}
	}
	
   /**
    * Post the sponsor form
    *
    * @return void
    */
	protected final function _postSponsorRequestForm()
	{
		if (true === $this->isPost()) {
			$this->setContentType(\Core\Net\Router::Content_Type_Json);
			$this->disableRender();
			
			$Application  = \Core\Application::getInstance();
			$objMailer    = \Core\Mail\Mail::getInstance();
			$returnData   = array(
				'success' => true,
				'message' => ''
			);
			
			$_postFields = array(
				'package'    => $Application->translate('Please choose a sponsorship package.', 'Veuillez choisir le type de commandite.'),
				'name'    		 => $Application->translate('Please provide your name.', 'Veuillez indiquer votre nom.'),
				'companyName'    => $Application->translate('Please indicate the company name.', 'Veuillez indiquer le nom de l\'organisation ou de l\'entreprise.'),
				'tel'    => $Application->translate('Please provide a valid phone number.', 'Veuillez fournir un numero de telephone valide.'),
				'address'    => $Application->translate('Please provide a valid address.', 'Veuillez fournir une address valide.'),
				'name'    => $Application->translate('Please specify your name.', 'Veuillez indiquer votre nom.'),
				'email'   => $Application->translate('Please provide a valid email address.', 'Veuillez fournir une adresse courriel valide.')
			);
			
			foreach ($_postFields as $_field => $_errorMessage) {
				if (false === $this->getRequestParam($_field)) {
					$returnData['success'] = false;
					$returnData['message'] = $_errorMessage;
					break;
				}
			}
			
			if (true === $returnData['success']) {
				// Validate the address
				$url  = sprintf('http://maps.google.com/maps/api/geocode/json?sensor=false&address=%s', urlencode($this->getRequestParam('address')));
				try {
					$_geoCodeResponse = @json_decode(@file_get_contents($url), true);
				
					if (true === is_array($_geoCodeResponse) && true === empty($_geoCodeResponse['results'])) {
						$returnData['message'] = $_postFields['address'];
						$returnData['success'] = false;
					} else if (false === empty($_geoCodeResponse['results'][0]['formatted_address'])) {
						$_POST['address'] = $_geoCodeResponse['results'][0]['formatted_address'];
						$this->setRequestParam('address', $_geoCodeResponse['results'][0]['formatted_address']);
					}
					
				} catch (\Exception $_reqException) { }
			}
			
			if (true === $returnData['success']) {
				// Validate the email
				if (false === filter_var($this->getRequestParam('email'), FILTER_VALIDATE_EMAIL)) {
					$returnData['message'] = $Application->translate('Please enter a valid email.', 'Veuillez entrer une address courriel valide.');
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// Validate the recaptcha
				if (false === \Core\Util\Recaptcha\Recaptcha::getInstance()->isValid()) {
					$returnData['message'] = $Application->translate('Please click the captcha field.', 'Veuillez cliquez sur le champ captcha.');
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// SEND OUT THE EMAIL HERE!		   
			   $objMailer->setData(array(
					'ROOT' 		=> $Application->getConfigs()->get('Application.site.site_url'),
					'SITE_NAME'	=> $Application->getConfigs()->get('Application.site.site_name'),
					'ADDRESS'	=> $Application->getConfigs()->get('Application.core.mvc.contact.address'),
					'EMAIL'		=> $Application->getConfigs()->get('Application.core.mvc.contact.email'),
					'DATE'		=> 	date("F j, Y"),
					'YEAR'		=> 	date("Y")
				)); 
				
				$objMailer->setTo($Application->getConfigs()->get('Application.core.mvc.contact.email'));
				$objMailer->setSubject('%%SITE_NAME%%: Un Formulaire de Commandite a ete soumis.');
				
				$package 	 = strip_tags($this->getRequestParam('package'));
				$name 		 = strip_tags($this->getRequestParam('name'));
				$email 		 = strip_tags($this->getRequestParam('email'));
				$companyName = strip_tags($this->getRequestParam('companyName'));
				
				$tel         = strip_tags($this->getRequestParam('tel'));
				$fax         = strip_tags($this->getRequestParam('fax'));
				$address     = strip_tags($this->getRequestParam('address'));
				$message 	 = strip_tags($this->getRequestParam('message'));
				
				$template 	= '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial; font-size: 12px">' .
							  '<tr>' .
								'<td width="100%" align="left" colspan="2"><b>Bonjour, un formulaire de commandite a ete soumis. Voici les informations:</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="100%" colspan="2">&nbsp;</td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Type de commandite:</td>' .
								'<td width="80%" align="left"><b>' . strtoupper($package) . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Nom:</td>' .
								'<td width="80%" align="left"><b>' . ucwords($name) . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Email:</td>' .
								'<td width="80%" align="left"><b>' . $email . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Nom de l\'entreprise:</td>' .
								'<td width="80%" align="left"><b>' . $companyName . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Tel:</td>' .
								'<td width="80%" align="left"><b>' . $tel . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Fax:</td>' .
								'<td width="80%" align="left"><b>' . $fax . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Address postale:</td>' .
								'<td width="80%" align="left"><b>' . $address . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="100%" colspan="2">&nbsp;</td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%" align="left">Message:</td>' .
								'<td width="80%">&nbsp;</td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="100%" colspan="2" align="left"><b>' . $message . '</b></td>' .
							  '</tr>' .
							'</table>';
				$objMailer->setMessage($template);
				$objMailer->setTemplate('templates/email/site.html');
				$returnData['success'] = $objMailer->send();
				$errors                = $objMailer->getError();
				$returnData['message'] = empty($errors) === false ? array_shift($errors) : '';
			}
			
			echo json_encode($returnData);
	   	}
	}
   
   /**
    * Post the contact form
    *
    * @return void
    */
	protected final function _postGeneralContactForm()
	{
		if (true === $this->isPost()) {
			$this->setContentType(\Core\Net\Router::Content_Type_Json);
			$this->disableRender();
			
			$Application  = \Core\Application::getInstance();
			$objMailer    = \Core\Mail\Mail::getInstance();
			$returnData   = array(
				'success' => true,
				'message' => ''
			);
			
			$_postFields = array(
				'name'    => $Application->translate('Please specify your name.', 'Veuillez indiquer votre nom.'),
				'email'   => $Application->translate('Please provide a valid email address.', 'Veuillez fournir une adresse courriel valide.'),
				'message' => $Application->translate('Please provide a message.', 'Veuillez fournir un message.')
			);
			
			foreach ($_postFields as $_field => $_errorMessage) {
				if (false === $this->getRequestParam($_field)) {
					$returnData['success'] = false;
					$returnData['message'] = $_errorMessage;
					break;
				}
			}
			
			if (true === $returnData['success']) {
				// Validate the email
				if (false === filter_var($this->getRequestParam('email'), FILTER_VALIDATE_EMAIL)) {
					$returnData['message'] = $Application->translate('Please enter a valid email.', 'Veuillez entrer une address courriel valide.');
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// Validate the recaptcha
				if (false === \Core\Util\Recaptcha\Recaptcha::getInstance()->isValid()) {
					$returnData['message'] = $Application->translate('Please click the captcha field.', 'Veuillez cliquez sur le champ captcha.');
					$returnData['success'] = false;
				}	
			}
			
			if (true === $returnData['success']) {
				// SEND OUT THE EMAIL HERE!		   
			   $objMailer->setData(array(
					'ROOT' 		=> $Application->getConfigs()->get('Application.site.site_url'),
					'SITE_NAME'	=> $Application->getConfigs()->get('Application.site.site_name'),
					'ADDRESS'	=> $Application->getConfigs()->get('Application.core.mvc.contact.address'),
					'EMAIL'		=> $Application->getConfigs()->get('Application.core.mvc.contact.email'),
					'DATE'		=> 	date("F j, Y"),
					'YEAR'		=> 	date("Y")
				)); 
				
				
				$objMailer->setTo($Application->getConfigs()->get('Application.core.mvc.contact.email'));
				$objMailer->setSubject('%%SITE_NAME%%: Une demande de contact generale a ete soumis.');
				$name 		= strip_tags($this->getRequestParam('name'));
				$email 		= strip_tags($this->getRequestParam('email'));
				$subject 	= strip_tags($this->getRequestParam('subject'));
				$message 	= strip_tags($this->getRequestParam('message'));
				$template 	= '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial; font-size: 12px">' .
							  '<tr>' .
								'<td width="100%" align="left" colspan="2"><b>Bonjour, une demande de contact generale a ete soumis. Voici les informations:</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="100%" colspan="2">&nbsp;</td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Nom:</td>' .
								'<td width="80%" align="left"><b>' . $name . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Email:</td>' .
								'<td width="80%" align="left"><b>' . $email . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%">Sujet:</td>' .
								'<td width="80%" align="left"><b>' . $subject . '</b></td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="100%" colspan="2">&nbsp;</td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="20%" align="left">Message:</td>' .
								'<td width="80%">&nbsp;</td>' .
							  '</tr>' .
							  '<tr>' .
								'<td width="100%" colspan="2" align="left"><b>' . $message . '</b></td>' .
							  '</tr>' .
							'</table>';
				$objMailer->setMessage($template);
				$objMailer->setTemplate('templates/email/site.html');
				$returnData['success'] = $objMailer->send();
				$errors                = $objMailer->getError();
				$returnData['message'] = empty($errors) === false ? array_shift($errors) : '';
			}
			
			echo json_encode($returnData);
	   	}
	}
}
