<?php
require_once '../../Core/Application.php';
\Core\Application::bootstrapResource('\Core\Config\Configurations');
$Application = \Core\Application::getInstance(array(
	$_SERVER['DOCUMENT_ROOT'] . getenv('BASE') . '../../admin/mvc/config/config.ini'
));


$allowedCalls = array(
	'Core\Inp\Products\Product_Wishlist::remove',
	'Core\Inp\Products\Product_Wishlist::add',
	'Core\Inp\Products\Product_Shopping_Cart::process',
	'Core\Inp\Products\Ajax_Search::findBy'
);


$matched = array();
if (true === isset($_GET['token'])) {
	$_GET['path']    = 'manual';
	$matched['mask'] = $_GET['token'];	
} else {
	preg_match('/(?P<mask>.*[^\/])/', (empty($_GET['path']) === false ? $_GET['path'] : ''), $matched);
}

if (empty($_GET['path']) === true) 		die ('403 Forbidden');
if (empty($matched['mask']) === true) 	die ('403 Forbidden');

\Core\Application::bootstrapResource('\Core\Crypt\AesCrypt');
$aesCrypto = \Core\Crypt\AesCrypt::getInstance();
$data      = @unserialize($aesCrypto->decrypt(base64_decode($matched['mask'])));

if (true === empty($data) || false === is_array($data)) {
	die ('403 Forbidden');	
}

$apiImplicitCall = $data['class'] . '::' . $data['method'];

if (false === in_array($apiImplicitCall, $allowedCalls)) {
	die ('403 Forbidden');	
}

\Core\Application::bootstrapResource('\\' . $data['class']);
$targetObject = call_user_func_array(array($data['class'], 'getInstance'), array());
if (false === headers_sent()) {
	header('Content-Type: application/json');	
}

$response = array(
	'success' 	=> call_user_func_array(array($targetObject, $data['method']), $data['params']), 
	'action' 	=> $data['method']
);

if (strcmp($data['class'], 'Core\Inp\Products\Product_Wishlist') === 0 && empty($data['params']['id']) === false) { 
	$wishList = \Core\Inp\Products\Product_Wishlist::getInstance();
	$response['rmvUrl']    = $wishList->getRemoveUrl((int) $data['params']['id']);
	$response['addUrl']    = $wishList->getAddUrl((int) $data['params']['id']);
	$response['isInList']  = (bool) $wishList->get((int) $data['params']['id']);
	$response['itemCount'] = (int) $wishList->count();
} else if (strcmp($data['class'], 'Core\Inp\Products\Product_Shopping_Cart') === 0) {
	$response['cart'] = $targetObject->getSummary();
} else if (strcmp($data['class'], 'Core\Inp\Products\Ajax_Search') === 0) {
	$data = $response['success'];
	$response['success'] = true;
	$response['results'] = $data;
} 

echo json_encode($response);
