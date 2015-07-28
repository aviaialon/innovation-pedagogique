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
	   $this->_postGeneralContactForm();
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
				$objMailer->setSubject('%%SITE_NAME%%: Une demande de contact générale a été soumis.');
				$name 		= strip_tags($this->getRequestParam('name'));
				$email 		= strip_tags($this->getRequestParam('email'));
				$subject 	= strip_tags($this->getRequestParam('subject'));
				$message 	= strip_tags($this->getRequestParam('message'));
				$template 	= '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial; font-size: 12px">' .
							  '<tr>' .
								'<td width="100%" align="left" colspan="2"><b>Bonjour, une demande de contact générale a été soumis. Voici les informations:</b></td>' .
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
