<?php 
/**
 * Google Recaptcha Util Class
 * 
 * @dependencies 	None
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Util
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */

namespace Core\Util\Recaptcha;

/*
	When your users submit the form where you integrated reCAPTCHA, you'll get as part of the payload 
	a string with the name "g-recaptcha-response". In order to check whether Google has verified that 
	user, send a POST request with these parameters:
	
	URL: https://www.google.com/recaptcha/api/siteverify
	secret(required) 		- The secret key:	6LcECgoTAAAAAPYS4FcEBXrl34L7ghiYa4XaGLfO
	response(required) 		- The value of 'g-recaptcha-response'.
	remoteip 				- The end user's ip address.
	
	The response is a JSON object:

	{
	  "success": true|false,
	  "error-codes": [...]   // optional
	}

*/

/**
 * Google Recaptcha Util Class
 * 
 * @dependencies 	None
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Util
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */
class Recaptcha 
    extends \Core\Interfaces\Base\ObjectBaseInterface
{
	
	/**
	 * Instantiation method
	 *
	 * @return \Core\Util\Recaptcha\Recaptcha 
	 */
	public static function getInstance()
	{
		$Application = \Core\Application::getInstance();
		$_recaptcha  = new \Core\Util\Recaptcha\Recaptcha();
		$_recaptcha->setPrivateKey($Application->getConfigs()->get('Application.core.mvc.recaptcha.keys.private'));
		$_recaptcha->setPublicKey($Application->getConfigs()->get('Application.core.mvc.recaptcha.keys.public'));
		
		if (false === $_recaptcha->getPublicKey() || false === $_recaptcha->getPrivateKey()) {
			throw new \Exception(__CLASS__ . ' Requires public and private keys settings. They cannot be empty.');	
		}
		
		return $_recaptcha;
	}
	
	/**
	 * Returns the recaptcha output field
	 *
	 * @return string 
	 */
	public function getRecaptchaField()
	{
		$Application = \Core\Application::getInstance();
		return sprintf('<div class="g-recaptcha" data-sitekey="%s"></div><script type="text/javascript" ' .
                       'src="//www.google.com/recaptcha/api.js?hl=%s"></script>', $this->getPublicKey(), $Application->translate('en', 'fr'));
	}
	
	/**
	 * Validates a recaptcha input response
	 *
	 * @return boolean 
	 */
	public final function isValid()
	{
		$valid       = false;	
		$Application = \Core\Application::getInstance();
		
		if (empty($_POST['g-recaptcha-response']) === true) {
			return $valid;	
		}
		
		$handle  = \curl_init($Application->getConfigs()->get('Application.core.mvc.recaptcha.verify_url'));
		$options = array(
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => http_build_query(array(
				'secret'   => $Application->getConfigs()->get('Application.core.mvc.recaptcha.keys.private'),
				'response' => $_POST['g-recaptcha-response'],
				'remoteip' => $_SERVER['REMOTE_ADDR']
			), '', '&'),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            CURLINFO_HEADER_OUT    => false,
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true
        );
		
        curl_setopt_array($handle, $options);
        $response = json_decode(curl_exec($handle), true);
        curl_close($handle);
		
		
		return ((bool) $response['success']);
	}
}