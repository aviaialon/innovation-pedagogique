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
class Product_Shopping_Cart
    extends \Core\Interfaces\Base\ObjectBaseInterface
{	
  /**
	* session key handler
	*
	* @var string
	*/
	private $_sessionHandler = '__product_cart_items__';
	
  /**
	* called after instantiation
	*
	* @param  array $instanceParams (Optional) Instance params
	* @return void
	*/
	protected final function onGetInstance()
	{
		/*if (false === $this->hasActiveSession()) {
			session_start();	
		}*/
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
	* returns all the items in shopping cart
	*
	* @return array
	*/
	public final function getAll()
	{	
		return (empty($_SESSION[$this->_sessionHandler]) === false ? $_SESSION[$this->_sessionHandler] : array());
	}

  /**
	* returns the item count in shopping cart
	*
	* @return integer
	*/
	public final function count()
	{	
		return count($_SESSION[$this->_sessionHandler]);
	}
	
  /**
	* returns an item in shopping cart
	*
	* @param  integer $partId The part id
	* @return array | false
	*/
	public final function get($partId)
	{	
		$returnItem = false;
		if (empty($_SESSION[$this->_sessionHandler][$partId]) === false) {
			$returnItem = $_SESSION[$this->_sessionHandler][$partId];
		}
		
		return $returnItem;
	}
	
  /**
	* adds a item in shopping cart
	*
	* @param  integer $productId The productId
	* @param  string  $title	 The product title
	* @return boolean
	*/
	public final function process()
	{	
		$productId = (int) $_POST['productId'];
		$partId    = (int) $_POST['partId'];
		$qty       = (int) $_POST['qty'];
		
		$product   = \Core\Hybernate\Products\Product_Part::getInstance($partId);
		$lang    = \Core\Application::translate('eng', 'fr');
		
		if ($qty === 0) {
			unset ($_SESSION[$this->_sessionHandler][$partId]);
		} else if ($qty > 0) {
			$_SESSION[$this->_sessionHandler][$partId] = array(
				'id' 	    => $partId,
				'productId' => $productId,
				'model'	    => $product->getProductKey(),
				'partId'	=> $product->getPartId(),
				'title'	    => $product->getVariable('desc' . $lang),
				'price'     => $product->getPrice(),
				'pkgAmt'    => $product->getMinQty(),
				'qty'       => $qty,
				'total'		=> $product->getPrice() * $qty
			);		
		}
		
		return true;
	}
	
  /**
	* adds a item in shopping cart
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
	* clears the shopping cart
	*
	* @return void
	*/
	public final function clear()
	{	
		$_SESSION[$this->_sessionHandler] = array();
	}	
	
  /**
	* creates a add to shopping cart url
	*
	* @return string
	*/
	public static final function getApiUrl()
	{
        return \Core\Application::getInstance()->getConfigs()->get('Application.core.mvc.base_server_path') .
				'/catalog/api/' .
				\Core\Net\Router::callbackToken(__CLASS__, 'process', array());
	}	
	
  /**
	* Gets the full cart summary
	*
	* @return array
	*/
	public static final function getSummary()
	{
		$summary = array(
			'items'      => \Core\King\Products\Product_Shopping_Cart::getInstance()->getAll(),
			'subTotal'   => 0.00,
			'total'      => 0.00,
			'shipping'   => 0.00,
			'totalItems' => 0
		);
		
		foreach ($summary['items'] as $item) {
			$summary['subTotal']   += (float) $item['total'];
			$summary['totalItems'] += $item['qty'];
			$summary['items'][$item['id']]['total'] = number_format($summary['items'][$item['id']]['total'], 2);
		}
		
		$summary['shipping'] = \Core\King\Products\Product_Shopping_Cart::getShipping($summary['subTotal']);
		$summary['total']    = floatval($summary['subTotal']) + floatval($summary['shipping']);; 
		//$summary['total']    = number_format($summary['total'], 2); 
		
		return $summary;
	}
	
  /**
	* Gets the shipping cost
	*
	* @return float
	*/
	public static final function getShipping($total = 0.00)
	{
		$shippingCost = 0.00;
		$total 		  = (float) $total;
		
		switch (true)
		{
			case ($total > 0.01 && $total <= 25) :
			{
				$shippingCost = 9.95;
				break;	
			}
			
			case ($total > 25 && $total <= 50) :
			{
				$shippingCost = 14.95;
				break;	
			}
			
			case ($total > 50 && $total <= 100) :
			{
				$shippingCost = 19.95;
				break;	
			}
			
			case ($total > 100) :
			{
				$shippingCost = 29.95;
				break;	
			}
		}
		
		return (float) number_format($shippingCost, 2);
	}
	
  /**
	* Sends the shopping cart via email
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
		
		/*
		'email': email,
						'companyName': companyName,
						'storeNum' : storeNum,
						'contact' : contact,
						'tel' : tel,
						'fax' : fax
						*/
	
		if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) === false && 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
			empty($_POST) === false) {
				
			$_requiredFields = array(
				'email'   => $Application->translate('Please enter your email.', 'Veuillez entrer votre address courriel.'),
				'companyName' => $Application->translate('Please enter your company name.', 'Veuillez entrer le nom de companie.'),
				'companyAddress' => $Application->translate('Please enter your company address.', 'Veuillez entrer l\'address de companie.'),
				'contact' => $Application->translate('Please provide us with a contact name.', 'Veuillez fournir un nom de contact.'),
				'tel' => $Application->translate('Please provide a phone number.', 'Veuillez fournir un numéro de téléphone.')
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
				
				
				if (empty($response['error']) === true) {
					// Process here...
					$items = \Core\King\Products\Product_Shopping_Cart::getSummary();
					
					if (empty($items['items']) === true) {
						$response['error'] = $Application->translate('There are no items in your cart.', 'Il n\'y a aucun articles dans votre liste d\'achats.');
					}
					
					if (empty($response['error']) === true) {
						\Core\Application::bootstrapResource('\Core\King\Mail\Mail');
						
						// ---------------------------------------------------------------------------
						// Create the admin email, and pdf
						$_admEmailTemplate  = '		<h3 style="font-family: Arial; font-size: 16px; ">A King Canada order was just created.</h3>';
						$_admEmailTemplate .= '		<p style="font-family: Arial; font-size: 12px;"><strong>Date: </strong>' . date('Y-m-d H:i:s') . '</p>';	
						$_admEmailTemplate .= '		<p style="font-family: Arial; font-size: 12px;"><strong>User IP: </strong>' . $_SERVER['REMOTE_ADDR'] . '</p>';	
						$_userInfo          = array();
						foreach (array(
							'email',
							'companyName',
							'companyAddress',
							'storeNum',
							'contact',
							'tel',
							'fax'
						) as $formKey) {
							if (empty($_POST[$formKey]) === false) {
								$_userInfo[ucwords(strtolower($formKey))] =  strip_tags($_POST[$formKey]);
								$_admEmailTemplate .= '		<p style="font-family: Arial; font-size: 12px;"><strong>' . 
									ucwords(strtolower($formKey)) . ': </strong>' .  strip_tags($_POST[$formKey]) . '</p>';	
							}
						}
						
						$_admEmailTemplate .= '<br />';								
						$_admEmailTemplate .= '<table cellpadding="0" cellspacing="0" border="0" width="850">';
						$_admEmailTemplate .= '<tr>';
						$_admEmailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_admEmailTemplate .= '		Part Id';
						$_admEmailTemplate .= '	</th>';
						$_admEmailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_admEmailTemplate .= '		Name';
						$_admEmailTemplate .= '	</th>';
						$_admEmailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_admEmailTemplate .= '		Price';
						$_admEmailTemplate .= '	</th>';
						$_admEmailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_admEmailTemplate .= '		Qty.';
						$_admEmailTemplate .= '	</th>';
						$_admEmailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_admEmailTemplate .= '		Total.';
						$_admEmailTemplate .= '	</th>';
						$_admEmailTemplate .= '</tr>';
						
						foreach ($items['items'] as $item) {
							$_admEmailTemplate .= '<tr>';
							$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_admEmailTemplate .= '		' . $item['partId'];
							$_admEmailTemplate .= '	</td>';
							$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_admEmailTemplate .= '		' . $item['title'];
							$_admEmailTemplate .= '	</td>';
							$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_admEmailTemplate .= '		$' . $item['price'];
							$_admEmailTemplate .= '	</td>';
							$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_admEmailTemplate .= '		' . $item['qty'];
							$_admEmailTemplate .= '	</td>';
							$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_admEmailTemplate .= '		$' . $item['total'];
							$_admEmailTemplate .= '	</td>';
							$_admEmailTemplate .= '</tr>';
						}
						$_admEmailTemplate .= '<tr>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #FFF" colspan="5">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '</tr>';
						
						$_admEmailTemplate .= '<tr>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding-right: 10px" align="right">';
						$_admEmailTemplate .= '		' . $Application->translate('Sub Total', 'Sous Total');
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
						$_admEmailTemplate .= '		$' . $items['subTotal'];
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '</tr>';
						
						$_admEmailTemplate .= '<tr>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding-right: 10px" align="right">';
						$_admEmailTemplate .= '		' . $Application->translate('Shipping', 'Livraison');
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
						$_admEmailTemplate .= '		$' . $items['shipping'];
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '</tr>';
						
						$_admEmailTemplate .= '<tr>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_admEmailTemplate .= '		&nbsp;';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding-right: 10px" align="right">';
						$_admEmailTemplate .= '		Total';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
						$_admEmailTemplate .= '		<b>$' . $items['total'] . '</b>';
						$_admEmailTemplate .= '	</td>';
						$_admEmailTemplate .= '</tr>';
						$_admEmailTemplate .= '</table>';
						
						$_pdfPath = \Core\King\Products\Product_Shopping_Cart::_generateOrderPdf($items, $_userInfo);
						if (empty($_pdfPath) === false) {
							$_pdfPath = array($_pdfPath);	
						}
						
						$response['success'] = \Core\King\Mail\Mail::send(
							get_option('admin_email'), 
							'King Canada: An Order was just created on kingcanada.com.', 
							$_admEmailTemplate,
							$_pdfPath
						);
						
						if (empty($_pdfPath[0]) === false) {
							unlink($_pdfPath[0]);	
						}
						
						// ---------------------------------------------------------------------------
						// Create the user email
						$_emailTemplate = '		<h3 style="font-family: Arial; font-size: 16px; text-transform:uppercase">' . 
							$Application->translate('Your King Canada Order.', 'Votre commande d\'achats') . '</h3>';
						$_emailTemplate .= '		<p style="font-family: Arial; font-size: 12px; text-transform:uppercase">' . 
							$Application->translate('Thank you for your order. A King Canada representative will be in touch shortly', 
								'Nous vous remercions de votre commande. Un représentant King Canada sera en contact très prochainement') . '</p><br />';	
								
						$_emailTemplate .= '<table cellpadding="0" cellspacing="0" border="0" width="850">';
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_emailTemplate .= '		Part Id';
						$_emailTemplate .= '	</th>';
						$_emailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_emailTemplate .= '		Name';
						$_emailTemplate .= '	</th>';
						$_emailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_emailTemplate .= '		Price';
						$_emailTemplate .= '	</th>';
						$_emailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_emailTemplate .= '		Qty.';
						$_emailTemplate .= '	</th>';
						$_emailTemplate .= '	<th style="font-family: Arial; font-size: 12px" align="left">';
						$_emailTemplate .= '		Total.';
						$_emailTemplate .= '	</th>';
						$_emailTemplate .= '</tr>';
						
						foreach ($items['items'] as $item) {
							$_emailTemplate .= '<tr>';
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_emailTemplate .= '		' . $item['partId'];
							$_emailTemplate .= '	</td>';
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_emailTemplate .= '		' . $item['title'];
							$_emailTemplate .= '	</td>';
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_emailTemplate .= '		$' . $item['price'];
							$_emailTemplate .= '	</td>';
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_emailTemplate .= '		' . $item['qty'];
							$_emailTemplate .= '	</td>';
							$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px" align="left">';
							$_emailTemplate .= '		$' . $item['total'];
							$_emailTemplate .= '	</td>';
							$_emailTemplate .= '</tr>';
						}
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #FFF" colspan="5">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding-right: 10px; text-align:right" align="right">';
						$_emailTemplate .= '		' . $Application->translate('Sub Total', 'Sous Total');
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
						$_emailTemplate .= '		$' . $items['subTotal'];
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding-right: 10px; text-align:right" align="right">';
						$_emailTemplate .= '		' . $Application->translate('Shipping', 'Livraison');
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
						$_emailTemplate .= '		$' . $items['shipping'];
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						
						$_emailTemplate .= '<tr>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px;background: #EEE">';
						$_emailTemplate .= '		&nbsp;';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px; padding-right: 10px; text-align:right" align="right">';
						$_emailTemplate .= '		Total';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '	<td style="font-family: Arial; font-size: 12px">';
						$_emailTemplate .= '		<b>$' . $items['total'] . '</b>';
						$_emailTemplate .= '	</td>';
						$_emailTemplate .= '</tr>';
						$_emailTemplate .= '</table>';
						
						\Core\King\Products\Product_Shopping_Cart::getInstance()->clear();
						
						$response['success'] = \Core\King\Mail\Mail::send(
							$_POST['email'], 
							$Application->translate('King Canada: Your Order.', 'King Canada: Votre Commande'), 
							$_emailTemplate
						);
					}
				}	
			}
			
			ob_clean();
			
			if (false === headers_sent()) {
				header('Content-Type: application/json');	
			}
			
			echo json_encode($response);
			die;
			
		}
	}
	
  /**
	* Generates an order PDF and returns the PDF path
	*
	* @param  array $items    The order items
	* @param  array $userInfo The user info
	* @return string
	*/
	protected static final function _generateOrderPdf(array $items = array(), array $userInfo = array())
	{
		\Core\Application::bootstrapResource('\Core\Vendor\Fpdf\Fpdf');
		
		$_pdfPath = false;
		
		if (empty($items) === true) {
			return $_pdfPath;
		}
		$Application   = \Core\Application::getInstance();
		$_objPdfWriter = \Core\Vendor\Fpdf\Fpdf_Loader::getInstance();
		
		$_objPdfWriter->SetAuthor($Application->getConfigs()->get('Application.site.site_name'));
		$_objPdfWriter->SetTitle('Product Parts Order');
		$_objPdfWriter->AddPage('P'); 
		$_objPdfWriter->SetFont('Arial', 'B', 15);
		$_objPdfWriter->SetTextColor(0, 0, 0);
		$_objPdfWriter->SetDisplayMode('real', 'default');
		$_objPdfWriter->SetAutoPageBreak(true);
		$_objPdfWriter->SetLeftMargin(10);
		$_objPdfWriter->SetRightMargin(10);
		
		$_currY = 20;
		$_objPdfWriter->SetXY(50, $_currY);
		$_objPdfWriter->SetDrawColor(255, 255, 255);
		$_objPdfWriter->SetTextColor(0, 81, 137);
		$_objPdfWriter->Cell(100, 10, sprintf('Parts Order %s', date('F j, Y g:i a')), 0, 0, 'C', 0);
		$_currY += 10;
		
		$userInfo['IP Address'] = $_SERVER['REMOTE_ADDR'];
		$_ovUKeys = array(
			'companyname' => 'Company Name',
			'companyaddress' => 'Company Address',
			'storenum' => 'Store Number'
		);
		
		foreach ($userInfo as $_userKey => $_userValue) {
			if (true === array_key_exists(strtolower($_userKey), $_ovUKeys)) {
				$_userKey = $_ovUKeys[strtolower($_userKey)];	
			}
			$_currY += 8;
			$_objPdfWriter->SetXY(10, $_currY);
			$_objPdfWriter->SetFontSize(10);
			
			$_objPdfWriter->SetTextColor(0, 0, 0);
			$_objPdfWriter->Write(5, sprintf('%s: ', $_userKey));
			$_objPdfWriter->SetTextColor(0, 81, 137);
			$_objPdfWriter->Write(5, sprintf('%s', $_userValue));
			$_objPdfWriter->SetTextColor(0, 0, 0);
		}
		
		$_objPdfWriter->Ln( 12 );
		
		// Create the table header row
		$_objPdfWriter->SetFont('Arial', 'B', 11);
		
		// "PRODUCT" cell
		$_objPdfWriter->SetTextColor(255, 255, 255);
		$_objPdfWriter->SetFillColor(0, 81, 137);
		$_objPdfWriter->Cell(38, 12, "Part ID", 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 12, "Part Name", 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 12, "Price", 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 12, "QTY", 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 12, "Total", 1, 0, 'C', true);
		
		$_objPdfWriter->SetTextColor(0, 0, 0);
		$_objPdfWriter->Ln( 9 );
		$_objPdfWriter->SetFont('Arial', '', 10);
		$_objPdfWriter->SetDrawColor(255, 255, 255);
		
		foreach ($items['items'] as $key => $item) {
			$_objPdfWriter->SetFillColor(234, 237, 242);
			$_objPdfWriter->Cell(38, 9, $item['partId'], 1, 0, 'C', true);
			$_objPdfWriter->Cell(38, 9, $item['title'], 1, 0, 'C', true);
			$_objPdfWriter->Cell(38, 9, '$' . $item['price'], 1, 0, 'C', true);
			$_objPdfWriter->Cell(38, 9, $item['qty'], 1, 0, 'C', true);
			$_objPdfWriter->Cell(38, 9, '$' . $item['total'], 1, 0, 'C', true);
			$_objPdfWriter->Ln( 9 );
		}
		
		$_objPdfWriter->SetFillColor(255, 255, 255);
		$_objPdfWriter->Cell(38, 9, ' ', 'T', 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, ' ', 'T', 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, ' ', 'T', 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, 'Sub Total: ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, '$' . $items['subTotal'], 1, 0, 'C', true);
		$_objPdfWriter->Ln( 9 );
		
		$_objPdfWriter->Cell(38, 9, ' ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, ' ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, ' ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, 'Shipping: ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, '$' . $items['shipping'], 1, 0, 'C', true);
		$_objPdfWriter->Ln( 9 );
		
		$_objPdfWriter->Cell(38, 9, ' ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, ' ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, ' ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, 'Order Total: ', 1, 0, 'C', true);
		$_objPdfWriter->Cell(38, 9, '$' . $items['total'], 1, 0, 'C', true);
		$_objPdfWriter->Ln( 9 );
		
		//$_fileOutput = sprintf('%s/%s', $Application->getConfigs()->get('Application.core.mvc.tmp_dir_path'), md5(time()) . '.pdf');
		$_fileOutput = sprintf('%s/%s', sys_get_temp_dir(), md5(time()) . '.pdf');
		$_objPdfWriter->Output($_fileOutput, 'F');
		
		return $_fileOutput;
	}	
}