<?php 
namespace Core\King\Products;
/**
 * Products management used with Hybernate loader
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
class Product_Wishlist
    extends \Core\Interfaces\Base\ObjectBaseInterface
{	
  /**
	* session key handler
	*
	* @var string
	*/
	private $_sessionHandler = '__wishlist_items__';
	
  /**
	* called after instantiation
	*
	* @param  array $instanceParams (Optional) Instance params
	* @return void
	*/
	protected final function onGetInstance()
	{
		\Core\Application::bootstrapResource('\Core\Crypt\AesCrypt');
		\Core\Application::bootstrapResource('\Core\Net\Router');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Image_Position');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product');
		
		if (false === $this->hasActiveSession()) {
			session_start();	
		}
	}
	
  /**
	* Checks if an active session
	*
	* @access static
	* @return boolean
	*/
	protected final function hasActiveSession()
	{
		$setting = 'session.use_trans_sid';
		$current = ini_get($setting);
		if (false === $current)
		{
			throw new \Exception(sprintf('Setting %s does not exists.', $setting));
		}
		
		$testate = "mix$current$current";
		$old 	 = @ini_set($setting, $testate);
		$peek 	 = @ini_set($setting, $current);
		$result  = ($peek === $current || $peek === false);
		
		return $result;
	}
	
  /**
	* returns all the items in wishlist
	*
	* @return array
	*/
	public final function getAll()
	{	
		return $_SESSION[$this->_sessionHandler];
	}

  /**
	* returns the item count in wishlist
	*
	* @return integer
	*/
	public final function count()
	{	
		return count($_SESSION[$this->_sessionHandler]);
	}
	
  /**
	* returns an item in wishlist
	*
	* @param  integer $productId The productId
	* @return array | false
	*/
	public final function get($productId)
	{	
		$returnItem = false;
		if (empty($_SESSION[$this->_sessionHandler][$productId]) === false) {
			$returnItem = $_SESSION[$this->_sessionHandler][$productId];
		}
		
		return $returnItem;
	}
	
  /**
	* adds a item in wishlist
	*
	* @param  integer $productId The productId
	* @param  string  $title	 The product title
	* @return boolean
	*/
	public final function add($productId)
	{	
		$product = \Core\Hybernate\Products\Product::getInstance($productId);
		$lang    = \Core\Application::translate('en', 'fr');
		$_SESSION[$this->_sessionHandler][$productId] = array(
			'id' 	  => $productId,
			'model'	  => $product->getProductKey(),
			'title'	  => $product->getDescription($lang)->getTitle(),
			'url'	  => \Core\Hybernate\Products\Product::getStaticProductUrl($productId, $product->getDescription($lang)->getTitle()),
			'img'     => \Core\Hybernate\Products\Product::getMainImageUrlFromId($productId)
		); 
		
		return true;
	}
	
  /**
	* adds a item in wishlist
	*
	* @param  integer $productId The productId
	* @param  string  $title	 The product title
	* @return boolean
	*/
	public final function remove($productId)
	{	
		if (empty($_SESSION[$this->_sessionHandler][$productId]) === false) {
			unset ($_SESSION[$this->_sessionHandler][$productId]);
		}
		
		return true;
	}	
	
  /**
	* clears the wishlist
	*
	* @return void
	*/
	public final function clear()
	{	
		$_SESSION[$this->_sessionHandler] = array();
	}	
	
  /**
	* creates a add to wishlist url
	*
	* @return string
	*/
	public static final function getAddUrl($productId)
	{
        return \Core\Application::getInstance()->getConfigs()->get('Application.core.mvc.base_server_path') .
				'/catalog/api/' .
				\Core\Net\Router::callbackToken(__CLASS__, 'add', array('id' => $productId));
	}	
	
  /**
	* creates a remove from wishlist url
	*
	* @return string
	*/
	public static final function getRemoveUrl($productId)
	{	
		return \Core\Application::getInstance()->getConfigs()->get('Application.core.mvc.base_server_path') .
				'/catalog/api/' .
				\Core\Net\Router::callbackToken(__CLASS__, 'remove', array('id' => $productId));
	}
	
  /**
	* Sends the wishlist via email
	*
	* @return string
	*/	
	public static final function sendEmail()
	{
		\Core\Application::bootstrapResource('\Core\Crypt\AesCrypt');
		$Application = \Core\Application::getInstance();
		$aesCrypto   = \Core\Crypt\AesCrypt::getInstance();
		$response    = array(
			'success' => false,
			'error'   => null
		);
		
//$_POST['captcha'] = $_SESSION['captcha_wishlist_ans'];	
	
		if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) === false && 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
			empty($_POST) === false) {
				
			$_requiredFields = array(
				'email'   => $Application->translate('Please enter your email.', 'Veuillez entrer votre address courriel.'),
				'captcha' => $Application->translate('Please answer the security question.', 'Veuillez répondre à la question de sécurité.'),
				'captcha_wishlist_ans' => $Application->translate('Please answer the security question.', 'Veuillez répondre à la question de sécurité.')
			);	
			
			foreach ($_requiredFields as $reqField => $errorMsg) {
				if (empty($_POST[$reqField]) === true) {
					$response['error'] = $errorMsg;
					break;
				}
			}
			
			if (empty($response['error']) === true) {
				if (false === filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$response['error'] = $Application->translate('Please enter a valid email.', 'Veuillez entrer une address courriel valide.');
				}
				
				$captchaAns = (int) $aesCrypto->decrypt(base64_decode($_POST['captcha_wishlist_ans']));
				if ($captchaAns <> (int) $_POST['captcha']) {
					$response['error'] = $Application->translate('The security answer was invalid.', 'La réponse de sécurité est invalide');
				}
				
				if (empty($response['error']) === true) {
					// Process here...
					$items = \Core\King\Products\Product_Wishlist::getInstance()->getAll();
					
					if (empty($items) === true) {
						$response['error'] = $Application->translate('There are no items in your wishlist.', 'Il n\'y a aucun articles dans votre liste de souhaits');
					}
					
					if (empty($response['error']) === true) {
						// get_template_directory
						$_emailTemplate = '<table cellpadding="0" cellspacing="0" border="0">';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td colspan="2">';
						$_emailTemplate .= '		<h3 style="font-family: Arial; font-size: 16px; text-transform:uppercase">' . 
							$Application->translate('Your King Canada wishlist.', 'Votre liste de souhaits') . '</h3><br />';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						
						foreach ($items as $wishlistItem) {
							$_productUrl = sprintf('http://%s%s', $_SERVER['HTTP_HOST'], $wishlistItem['url']);
							$_imageUrl   = sprintf('http://%s%s/%s', $_SERVER['HTTP_HOST'], 
								\Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(17), $wishlistItem['img']);

							$_emailTemplate .= '<tr>';
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
							$_emailTemplate .= '		<a href="' . $_productUrl . '"><img src="' . $_imageUrl . '" /></a>';
							$_emailTemplate .= '	</td>';
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
							$_emailTemplate .= '		<a href="' . $_productUrl . '">Model: <b>' . $wishlistItem['model'] . '</b> - ' . $wishlistItem['title'] . '</a>';
							$_emailTemplate .= '	</td>';
							$_emailTemplate .= '</tr>';
						}
						$_emailTemplate .= '</table>';
						
						\Core\Application::bootstrapResource('\Core\King\Mail\Mail');
						$response['success'] = \Core\King\Mail\Mail::send(
							$_POST['email'], 
							$Application->translate('Your King Canada wishlist.', 'Votre liste de souhaits'), 
							$_emailTemplate
						);
					}
				}	
			}
			
			if (false === headers_sent()) {
				header('Content-Type: application/json');	
			}
			
			echo json_encode($response);
			die;
			
		} else {
			$_num1 = mt_rand (1 , 5);
			$_num2 = mt_rand (5 , 10);
			$_ans  = $_num1 + $_num2;
			
			
			$_SESSION['captcha_wishlist_query'] = sprintf('%s + %s =', (string) $_num1, (string) $_num2);
			$_SESSION['captcha_wishlist_ans']   = base64_encode($aesCrypto->encrypt($_ans));
		}
	}
}