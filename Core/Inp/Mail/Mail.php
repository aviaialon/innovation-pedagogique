<?php 
/**
 * PHP Mail Class
 * 
 * @dependencies 	PDO
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Inp
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */

namespace Core\Inp\Mail;

/**
 * PHP Pagination Class
 * 
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
class Mail 
    extends \Core\Interfaces\Base\ObjectBaseInterface
{
	/**
	 * Sends a HTML Email
	 *
	 * @param  string $to          Who to send it to
	 * @param  string $subject     The email subject
	 * @param  string $content     The html email content
	 * @param  array  $attachments An array of files to attach
	 * @return Boolean 
	 */
	public static final function send($to, $subject, $content = NULL, $attachments = array())
	{
		$Application = \Core\Application::getInstance();
		
		ob_start();
		include(get_template_directory() . "/email/generic.php");
		$emailContent = ob_get_contents();
		ob_end_clean();
		
		$emailContent = str_replace('%%SUBJECT%%', $subject, $emailContent);
		$emailContent = str_replace('%%CONTENT%%', $content, $emailContent);
		
		remove_filter('wp_mail_content_type', array(__CLASS__, 'getContentType'));
		$status = wp_mail($to, $subject, $emailContent, array(
			sprintf('From: %s <%s>', 
				get_option('blogname'),
				get_option('admin_email')
			),
			'Content-Type: text/html; charset=UTF-8'
		), $attachments);
		remove_filter('wp_mail_content_type', array(__CLASS__, 'getContentType'));
		
		return $status;
	}
	
	/**
	 * Returns the email content myme type
	 *
	 * @return String
	 */
	public static final function getContentType() 
	{
		return 'text/html';
	}
}