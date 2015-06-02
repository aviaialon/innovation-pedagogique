<?php
namespace Core\Hybernate\Users;
/**
 * Users management used with Hybernate loader
 *
 * @package    Core
 * @subpackage Interfaces
 * @file       Core/Interfaces/Base/HybernateBaseInterface.php
 * @desc       Used interface for ORM implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt. 
 */
class Users extends \Core\Interfaces\HybernateInterface
{
	/**
	 * This method returns the current session user
	 *
	 * @return \Core\Hybernate\Users\Users
	 */
	public static function getUser() 
	{
		return \Core\Hybernate\Users\Users::getInstance((int) \Core\Session\Session::getInstance()->get('USER_ID'));
	}
	
	/**
	 * This method logs the user out of the system
	 *
	 * @param  boolean $redirect Redirect the user after logout
	 * @return void
	 */
	public final function logout($redirect = true)
	{
		
		//var_dump(array('it' => $this->_objectInterfaceType));
		/* @var $session \Core\Session\Session */
		
		if ($this->getId() > 0) {
			$Application = \Core\Application::getInstance();
			$session 	 = \Core\Session\Session::getInstance();
			$lang		 = $session->get('lang') | 'en';
			$loginDate	 = $session->get('USER_LOGIN_DATE') | (time() - 120);
			$this->_dataAccessInterface->execute(sprintf(
				'UPDATE %s SET time_spent_last_login = UNIX_TIMESTAMP(NOW()) - %s WHERE id = ?', $this->_objectInterfaceType, $loginDate), array($this->getId()));
			
			$session->reset();	
			$session->getSession();
			$session->set('lang', $lang);
			
			if (true === $redirect) {
				$session->set('info', $Application->translate('You have successfully logged out of the system.', 'Vous avez réussi à vous connecter sur le système.'));
				\Core\Net\Url::redirect($Application->getConfigs()->get('Application.core.base_url'));
				exit;
			}
		}
	}
}