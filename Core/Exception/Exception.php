<?php
/**
 * Exception Administration Class
 *
 * This class controls the Net Routing scope
 *
 * @namespace    Core
 * @package      Exception
 * @subpackage   none
 * @author       Avi Aialon <aviaialon@gmail.com>
 * @copyright    2012 Canspan. All Rights Reserved
 * @license      http://www.canspan.com/license
 * @version      SVN: $Id$
 * @link         SVN: $HeadURL$
 * @since        12:35:53 AM
 *
 */
namespace Core\Exception;

/**
 * Exception Administration Class
 *
 * This class controls the Net Routing scope
 *
 * @namespace    Core
 * @package      Exception
 * @subpackage   none
 * @author       Avi Aialon <aviaialon@gmail.com>
 * @copyright    2012 Canspan. All Rights Reserved
 * @license      http://www.canspan.com/license
 * @version      SVN: $Id$
 * @link         SVN: $HeadURL$
 * @since        12:35:53 AM
 *
 */
class Exception
    extends \Exception
{
    /**
     * Throws an exception
     *
     * @access public
     * @param  string $exception The exception text
     * @throws \Exception
     * @return void
     */
    public static final function raise($exceptionText)
    {
        \Core\Exception\Exception::handle($exceptionText, __FUNCTION__);
    }

    /**
     * logs an exception
     *
     * @access public
     * @param  string $exception The exception text
     * @throws \Exception
     * @return boolean
     */
    public static final function log($exceptionText)
    {
        \Core\Exception\Exception::handle($exceptionText, __FUNCTION__);
    }
	
	/**
     * logs an MVC application exception
     *
     * @access public
     * @param  string $exception The exception text
     * @throws \Exception
     * @return boolean
     */
    public static final function mvcApplicationError($severity = null, $errorTitle = null, $file = null, $line = null, $backtrace = null)
    {
		$Application     = \Core\Application::getInstance();
		$exceptionReport = null;
		
		if (true === is_object($severity)) {
			$errorTitle = $severity->getMessage();
			$file 		= $severity->getFile();
			$line 		= $severity->getLine();
			$backtrace  = $severity->getTrace();	
			$exceptionReport = $severity;
		}
		
		if ((bool) $Application->getConfigs()->get('Application.core.exception.save') === true) {
			 $exceptionHandler = \Core\Hybernate\Exception\Exception::getInstance();
			 $exceptionHandler->setTitle($errorTitle);
			 $exceptionHandler->setTimeDate(date('Y-m-d H:i:s', time()));
			 $exceptionHandler->setRequest_Uri($_SERVER['REQUEST_URI']);
			 $exceptionHandler->setBacktrace(sprintf('Error File [%s] Line [%s]' . PHP_EOL, $file, $line));
			 $exceptionHandler->addBacktrace(str_repeat(PHP_EOL, 2));
			 $exceptionHandler->addBacktrace(print_r($backtrace, true));
			 $exceptionHandler->save();
		}
		
        \Core\Exception\Exception::handle($errorTitle, 'raise', false, $exceptionReport);
    }

    /**
     * Reports an exception
     *
     * @access public
     * @param  string $exception The exception text
     * @throws \Exception
     * @return boolean
     */
     public static final function report($exceptionText)
     {
         $Application = \Core\Application::getInstance();
         $method      = 'log';

         if ((bool) $Application->getConfigs()->get('Application.core.exception.display') === true) {
             $method = 'raise';
         }

         call_user_func_array(array(__CLASS__ , $method), array($exceptionText));
     }

    /**
     * Stores an exception
     *
     * @access protected
     * @param  string $exception The exception text
     * @param  string $errorType The error handling type raise | log
     * @throws \Exception
     * @return void
     */
     protected static final function handle($exceptionText, $errorType, $save = true, \Exception $exception = null)
     {
         $Application = \Core\Application::getInstance();
         if (((bool) $Application->getConfigs()->get('Application.core.exception.save') === true) && true === $save) {
             $exceptionHandler = \Core\Hybernate\Exception\Exception::getInstance();
             $exceptionHandler->setTitle($exceptionText);
             $exceptionHandler->setTimeDate(date('Y-m-d H:i:s', time()));
             $exceptionHandler->setRequest_Uri($_SERVER['REQUEST_URI']);
             $exceptionHandler->setBacktrace(print_r(debug_backtrace(), true));
             $exceptionHandler->addBacktrace(str_repeat(PHP_EOL, 5));
             $exceptionHandler->addBacktrace(print_r($_SERVER, true));
             $exceptionHandler->save();
         }
		
		 ini_set('html_errors', 1);
		 ini_set('display_errors', $Application->getConfigs()->get('Application.core.exception.display'));
         error_log(print_r($exceptionText, true));
		 
		 if ((bool) $Application->getConfigs()->get('Application.core.exception.display') === true) {
			$template  = '<div style="font-size:12px; font-weight:bold; color:#000; border:solid 1px #ccc; width: 100%; ';
			$template .= 'padding: 15px; font-family: Arial"><h2 style="color:#CC0000">APPLICATION ERROR</h2>' . $exceptionText . '<br /><hr /><br />';
			if (empty($exception) === false) {
				$template .= '<pre>' . print_r($exception, true) . '</pre></div>';
			} else {
				$template .= '<pre>' . print_r(debug_backtrace(), true) . '</pre></div>';
			}
			
			
			die ($template);
		 }
     }
}