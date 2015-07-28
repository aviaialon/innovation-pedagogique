<?php 
/**
 * Mail Util Class
 * 
 * @dependencies 	None
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Mail
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */

namespace Core\Mail;

/**
 * EXAMPLE:
 
	require_once('mail/mail.php');
	$objMailer = new MAIL();
	$objMailer->setData(array(
		'E' 	=> 'aviaialon@gmail.com',
		'ROOT'	=> __ROOT_URL__	,
		'DATE'	=> 	date("F j, Y")
	));
	$objMailer->setTo('%%E%%');
	$objMailer->setSubject('Hello %%E%% This is a test!');
	$objMailer->setMessage('Hello %%E%% This is a test!');
	$objMailer->setTemplate('templates/email/template.tmpl');
	if ($objMailer->send()) {
		print "Mail sent .. yay!";
	} else {
		new dump($objMailer->getError());
	}
	print "ok";
 
*/

/**
 * Mail Util Class
 * 
 * @dependencies 	None
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Mail
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */
class Mail 
    extends \Core\Interfaces\Base\ObjectBaseInterface
{
	protected $strTo;						# Receiver email
	protected $strFrom;						# From email 
	protected $strSubject;					# Subject 
	protected $strHTMLMessage;				# HTML message
	protected $strTextMessage;				# Text message part
	protected $strTemplate;					# HTML Email template
	protected $arrParseData = array();		# Data to parse
	protected $arrErrors 	= array();		# Processing errors
	private   $objParser	= NULL;			# Parseing engine


	public function setTo		($strArgTo=NULL)		{ $this->strTo 		 = $strArgTo; }
	public function setFrom		($strArgFrom=NULL)		{ $this->strFrom 	 = $strArgFrom; }
	public function setSubject	($strArgSubject=NULL)	{ $this->strSubject  = $strArgSubject; }
	public function setTemplate	($strArgTemplate=NULL)	{ $this->strTemplate = $strArgTemplate; }
	public function setMessage	($strArgMessage=NULL)	{ 
		$this->strHTMLMessage = $strArgMessage;
		$this->strTextMessage = strip_tags($strArgMessage);
	}
	
	public function setData (array $arrArgData=array()) 
	{
		$this->arrParseData = $arrArgData;
	}
	
	protected function setError($strError = NULL) {
		$this->arrErrors[] = $strError;
	}
	
	/**
	 * Getters
	 */
	public 	 	function getTo()			{ return($this->strTo); } 
	public  	function getFrom()			{ return($this->strFrom); } 
	public  	function getSubject()		{ return($this->strSubject); } 
	public  	function getHtmlMessage()	{ return($this->strHTMLMessage); } 
	public  	function getTextMessage()	{ return($this->strTextMessage); } 
	public  	function getData()			{ return($this->arrParseData); } 
	public  	function getError()			{ return($this->arrErrors); } 
	protected 	function getParser()		{ return($this->objParser); } 
	protected 	function getTemplate()		{ return($this->strTemplate); } 
	
	/**
	 * Public methods
	 */
	public function __construct() 
	{
		$this->objParser = \Core\Util\Parser\Parser::getInstance();
	} 
	
	/**
	 * Parses the template data
	 *
	 * @return boolean
	 */ 
	public function parseData() 
	{
		$objParser 	= $this->getParser();
		$blnReturn 	= false;
			
		if (sizeof($this->getData())) {
			$objParser->setData($this->getData());
			// Parse the values
			
			// To (reveiver)
			$this->setTo(
				$objParser->parse($this->getTo())				  
			);
			
			// From (sender)
			$this->setFrom(
				$objParser->parse($this->getFrom())				  
			);
			
			// Subject
			$this->setSubject(
				$objParser->parse($this->getSubject())				  
			);
			
			// Message
			$this->setMessage(
				$objParser->parse($this->getHtmlMessage())				  
			);
			
			$blnReturn 	= true;
		}
		
		
		if (strlen($this->getTemplate())) {
			$Application  = \Core\Application::getInstance();
			$templatePath = $Application->getConfigs()->get('Application.server.document_root') . 
							DIRECTORY_SEPARATOR . $this->getTemplate();
			
			if (false === file_exists($templatePath)) 
			{
				throw new \Exception('Template ' . $templatePath . ' does not exists. Please double check the path.');
			}
			
			$this->setMessage($this->getParser()->setData(array_merge(array(
				'MESSAGE' => $this->getHtmlMessage()
			), $this->getData()))->parse(file_get_contents($templatePath)));
		}
		
		return ($blnReturn);
	}	
	
	/**
	 * Sends the email message
	 *
	 * @return boolean
	 */
	public function send() 
	{
		$Application  = \Core\Application::getInstance();
		$blnReturn    = false;
		$objMailer    = \Core\Mail\Smtp_Mailer::getInstance();
		
		if (true === (bool) $Application->getConfigs()->get('Application.core.mvc.mail.smtp.use_smtp')) 
		{	
			$objMailer->isSMTP();
			$objMailer->SMTPAuth   	= true; 
			$objMailer->Port       	= (int) $Application->getConfigs()->get('Application.core.mvc.mail.smtp.port');
			$objMailer->Host       	= gethostbyname($Application->getConfigs()->get('Application.core.mvc.mail.smtp.host'));
			$objMailer->SMTPSecure 	= $Application->getConfigs()->get('Application.core.mvc.mail.smtp.ssl_type'); 
			$objMailer->Username    = $Application->getConfigs()->get('Application.core.mvc.mail.smtp.user');
			$objMailer->Password    = $Application->getConfigs()->get('Application.core.mvc.mail.smtp.pass');
			
			$objMailer->SMTPDebug   = 0;
			$objMailer->Debugoutput = 'html';
		}
		
		// Set the mail data
		$this->parseData();
		$objMailer->WordWrap = 50;
		$objMailer->Subject  = $this->getSubject();
		$objMailer->AltBody  = strip_tags($this->getHtmlMessage());
		$objMailer->setFrom(
			(strlen($this->getFrom()) ? $this->getFrom() : $Application->getConfigs()->get('Application.core.mvc.contact.email')),
			ucwords(strtolower($Application->getConfigs()->get('Application.site.site_name')))
		);
		$objMailer->addReplyTo($objMailer->From, $objMailer->FromName);
		$objMailer->addAddress($this->getTo());
		$objMailer->MsgHTML($this->getHtmlMessage());
		$objMailer->IsHTML(true);
		$blnReturn = $objMailer->send();
			
		if (false === $blnReturn) 
		{
			$this->setError($objMailer->ErrorInfo);
		}
		
		return ($blnReturn);
	}
}