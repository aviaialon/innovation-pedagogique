<?php 
namespace Core\Inp\Products;
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
		return (empty($_SESSION[$this->_sessionHandler]) === false ? $_SESSION[$this->_sessionHandler] : array());
	}

  /**
	* returns the item count in wishlist
	*
	* @return integer
	*/
	public final function count()
	{	
		return empty($_SESSION[$this->_sessionHandler]) === true ? 0 : count($_SESSION[$this->_sessionHandler]);
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
	* checks if an item exists in wishlist
	*
	* @param  integer $productId The productId
	* @return boolean
	*/
	public final function has($productId)
	{	
		return array_key_exists($productId, $_SESSION[$this->_sessionHandler]);
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
		$Application = \Core\Application::getInstance();
		$response    = array(
			'success' => false,
			'error'   => null
		);
		
		if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) === false && 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
			empty($_POST) === false) {
				
			$_requiredFields = array(
				'email'   => $Application->translate('Please enter your email.', 'Veuillez entrer votre address courriel.')
			);	
			
			foreach ($_requiredFields as $reqField => $errorMsg) {
				if (empty($_POST[$reqField]) === true) {
					$response['error'] = $errorMsg;
					break;
				}
			}
			
			if (empty($response['error']) === true) {
				if (false === \Core\Util\Recaptcha\Recaptcha::getInstance()->isValid()) {
					$response['error'] = $Application->translate('Please click the captcha field.', 'Veuillez cliquez sur le champ captcha.');
				}
			}
			
			if (empty($response['error']) === true) {
				if (false === filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$response['error'] = $Application->translate('Please enter a valid email.', 'Veuillez entrer une address courriel valide.');
				}
				
				if (empty($response['error']) === true) {
					// Process here...
					$items = \Core\Inp\Products\Product_Wishlist::getInstance()->getAll();
					
					if (empty($items) === true) {
						$response['error'] = $Application->translate('There are no items in your wishlist.', 'Il n\'y a aucun articles dans votre liste de souhaits');
					}
					
					if (empty($response['error']) === true) {
						// get_template_directory
						$_emailTemplate = '<table cellpadding="0" cellspacing="0" border="0">';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td colspan="2">';
						$_emailTemplate .= '		<h3 style="font-family: Arial; font-size: 16px; text-transform:uppercase">' . 
							$Application->translate('Your wishlist.', 'Votre liste de souhaits') . '</h3><br />';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						$_col = 1;
						foreach ($items as $wishlistItem) {
							$_productUrl = sprintf('http://%s%s', $_SERVER['HTTP_HOST'], $wishlistItem['url']);
							$_imageUrl   = sprintf('http://%s%s/%s', $_SERVER['HTTP_HOST'], 
								\Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(1), $wishlistItem['img']);

							if ($_col === 1)
								$_emailTemplate .= '<tr>';
								
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
							$_emailTemplate .= '		<div style="padding: 8px; border:solid 1px #CCC; min-height: 230px;">';
							$_emailTemplate .= '		<a href="' . $_productUrl . '"><img src="' . $_imageUrl . '" /></a><br />';
							$_emailTemplate .= '		<a href="' . $_productUrl . '" style="text-decoration:none;">' . $wishlistItem['title'] . '</a>';
							$_emailTemplate .= '		</div>';
							$_emailTemplate .= '	</td>';
							
							if ($_col === 3)
								$_emailTemplate .= '</tr>';
							
							$_col ++;
							if ($_col === 4) { $_col = 1; }
						}
						$_emailTemplate  = rtrim($_emailTemplate, '</tr>');
						$_emailTemplate .= '</tr>';
						$_emailTemplate .= '</table>';
						
						// SEND OUT THE EMAIL HERE!	
						$objMailer = \Core\Mail\Mail::getInstance();	   
						$objMailer->setData(array(
							'ROOT' 		=> $Application->getConfigs()->get('Application.site.site_url'),
							'SITE_NAME'	=> $Application->getConfigs()->get('Application.site.site_name'),
							'ADDRESS'	=> $Application->getConfigs()->get('Application.core.mvc.contact.address'),
							'EMAIL'		=> $Application->getConfigs()->get('Application.core.mvc.contact.email'),
							'DATE'		=> 	date("F j, Y"),
							'YEAR'		=> 	date("Y")
						)); 
						
						$objMailer->setTo($_POST['email']);
						$objMailer->setSubject('%%SITE_NAME%%: ' . $Application->translate('Your wishlist', 'Votre liste de souhaits'));
						$objMailer->setMessage($_emailTemplate);
						$objMailer->setTemplate('templates/email/site.html');
						$response['success'] = $objMailer->send();
						$errors              = $objMailer->getError();
						$response['message'] = empty($errors) === false ? array_shift($errors) : '';
					}
				}	
			}
			
			if (false === headers_sent()) {
				header('Content-Type: application/json');	
			}
			
			echo json_encode($response);
			die;
			
		}
	}
	
  /**
	* Sends the product information request by email
	*
	* @return string
	*/	
	public static final function sendProductInquiryEmail()
	{
		$Application = \Core\Application::getInstance();
		$response    = array(
			'success' => false,
			'error'   => null
		);
		
		if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) === false && 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
			empty($_POST) === false) {
				
			$_requiredFields = array(
				'email'     => $Application->translate('Please enter your email.', 'Veuillez entrer votre address courriel.'),
				'productId' => $Application->translate('Please select a valid product.', 'Veuillez selectionner un produit valide.')
			);	
			
			foreach ($_requiredFields as $reqField => $errorMsg) {
				if (empty($_POST[$reqField]) === true) {
					$response['error'] = $errorMsg;
					break;
				}
			}
			
			if (empty($response['error']) === true) {
				if (false === \Core\Util\Recaptcha\Recaptcha::getInstance()->isValid()) {
					$response['error'] = $Application->translate('Please click the captcha field.', 'Veuillez cliquez sur le champ captcha.');
				}
			}
			
			if (empty($response['error']) === true) {
				if (false === filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$response['error'] = $Application->translate('Please enter a valid email.', 'Veuillez entrer une address courriel valide.');
				}
				
				if (empty($response['error']) === true) {
					// Process here...
					$item = \Core\Hybernate\Products\Product::getInstance(array('id' => $_POST['productId'], 'activeStatus' => 1));
					
					if ((int) $item->getId() <= 0) {
						$response['error'] = $_requiredFields['productId'];
					}
					
					if (empty($response['error']) === true) {
						
						$email 	 = strip_tags($_POST['email']);
						$message = strip_tags($_POST['message']);
						
						$_productUrl = sprintf('http://%s%s', $_SERVER['HTTP_HOST'], 
									\Core\Hybernate\Products\Product::getStaticProductUrl($item->getId(), $item->getDescription('fr')->getTitle()));
						$_imageUrl   = sprintf('http://%s/%s', $_SERVER['HTTP_HOST'], $item->getMainImage()->getImagePath(21));
							
						// get_template_directory
						$_emailTemplate = '<table cellpadding="0" cellspacing="0" border="0">';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td colspan="2">';
						$_emailTemplate .= '		<h3 style="font-family: Arial; font-size: 16px; text-transform:uppercase">' . 
										   'Une demande de renseignements sur <b>' . $item->getDescription('fr')->getTitle() . '</b> ete soumis</h3><br />';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px" colspan="2">';
						$_emailTemplate .= '		<div style="padding: 8px; border:solid 1px #CCC; min-height: 230px;">';
						$_emailTemplate .= '		<a href="' . $_productUrl . '"><img src="' . $_imageUrl . '" /></a><br />';
						$_emailTemplate .= '		<a href="' . $_productUrl . '" style="text-decoration:none;float: left">' . $item->getDescription('fr')->getTitle() . '</a>';;
						$_emailTemplate .= '		</div>';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						$_emailTemplate .= '<tr><td colspan="2"><hr /></td></tr>';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		Date: ';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		' . date('l jS \of F Y h:i:s A');
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		IP de l\'usager: ';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		' . $_SERVER['REMOTE_ADDR'];
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		Email: ';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		' . $email;
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		Message: ';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding: 8px">';
						$_emailTemplate .= '		' . $message;
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						$_emailTemplate .= '</table>';
						
						
						
						// SEND OUT THE EMAIL HERE!	
						$objMailer = \Core\Mail\Mail::getInstance();	   
						$objMailer->setData(array(
							'ROOT' 		=> $Application->getConfigs()->get('Application.site.site_url'),
							'SITE_NAME'	=> $Application->getConfigs()->get('Application.site.site_name'),
							'ADDRESS'	=> $Application->getConfigs()->get('Application.core.mvc.contact.address'),
							'EMAIL'		=> $Application->getConfigs()->get('Application.core.mvc.contact.email'),
							'DATE'		=> 	date("F j, Y"),
							'YEAR'		=> 	date("Y")
						)); 
						
						$objMailer->setTo($Application->getConfigs()->get('Application.core.mvc.contact.email'));
						$objMailer->setSubject('%%SITE_NAME%%: Une demande de renseignements de produit ete soumis.');
						
						$objMailer->setMessage($_emailTemplate);
						$objMailer->setTemplate('templates/email/site.html');
						$response['success'] = $objMailer->send();
						$errors              = $objMailer->getError();
						$response['message'] = empty($errors) === false ? array_shift($errors) : '';
					}
				}	
			}
			
			if (false === headers_sent()) {
				header('Content-Type: application/json');	
			}
			
			echo json_encode($response);
			die;
			
		}
	}
}