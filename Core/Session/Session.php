<?php
/**
 * Session Class for storing session data in mysql
 * 
 * Features :
 * This class help you to Store Data on mysql server.
 * 
 * How to use :
 *  Create your database in MySQL, and create a table in which
 *  to store your session information.  The example code below
 *  uses a table called "session".  Here is the SQL command
 *  which created it:
 * 
 *  CREATE TABLE sessions (id varchar(32) NOT NULL,access
 *  int(10) unsigned,data text,PRIMARY KEY (id));


 * 
 * @version 0.1 20100602
 * 
 	 * Session Administration Class
	 * This class represents the CRUD behaviors implemented 
	 * with the Hybernate framework 
	 *
	 * @package		CLASSES::HYBERNATE
	 * @subpackage	none
	 * @author      Avi Aialon <aviaialon@gmail.com>
	 * @copyright	2010 Deviant Logic. All Rights Reserved
	 * @license		http://www.deviantlogic.ca/license
	 * @version		SVN: $Id$
	 * @link		SVN: $HeadURL$
	 * @since		12:35:53 PM
	
	EXAMPLE:
	--------	
	require_once "session.php";
	$oSession = new Session();
	print_r($_SESSION); // First
	$_SESSION['hi'] = "Hello"; // Comment this Once sessoin is set
	$_SESSION['test'] = "great"; // Comment this Once sessoin is set

 */ 
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
namespace Core\Session;

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
class Session /* implements SessionHandlerInterface */ 
{
	/**
     * Database object
     *
     * @access protected
     * @var \Core\Database\Driver\Pdo
     */
	protected static $_dboInterface = false;
	
	/**
     * Session save path (For file save sessions)
     *
     * @access protected
     * @var string
     */
	protected $_sessionSavePath;
    
	/**
     * Session config name
     *
     * @access protected
     * @var string
     */
	protected $_sessionName;
	
	/**
     * Class constructor
     *
     * @access public
     */
    public function __construct()
	{
		\Core\Session\Session::collectGarbage();
		
		if (
			(! session_id()) ||	
			(false === isset($_SESSION))
		) { 
			#ini_set('session.save_handler', 'user');
			$configs = \Core\Application::getInstance()->getConfigs();
			
			session_set_save_handler(
				array(&$this, 'open'),
				array(&$this, 'close'),
				array(&$this, 'read'),
				array(&$this, 'write'),
				array(&$this, 'destroy'),
				array(&$this, 'clean')
			);
			register_shutdown_function('session_write_close');
			session_name($configs->get('Application.core.session.name'));
			session_cache_expire(((int) $configs->get('Application.core.session.expiration_seconds')) / 60);
			@session_start();	
		}
    }
	
	/**
     * Opens a new sessions
     *
     * @param  string $_sessionSavePath The session save path
     * @param  string $_sessionName 	The session name
     * @access public
     * @return boolean
     */
	public function open($_sessionSavePath, $_sessionName) 
	{
        $this->_sessionSavePath = $_sessionSavePath;
        $this->_sessionName 	= $_sessionName;
		
        return true;
    }
	
	/**
     * Writes to the current session
     *
     * @param  string $id 	The session id
     * @param  string $data The session data
     * @access public
     * @return boolean
     */
    public function write($id, $data) 
	{
    	$access = time();
		// Write the data to session
        $sql 	 = "REPLACE INTO sessions VALUES  (?, ?, ?, ?, ?)";
		$agent	 = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "") . " | ";
		$ipAddr  = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "");
		
		return self::getDbo()->execute($sql, array(
			$id, $access, $data, $agent, $ipAddr
		));
    }
	
	/**
     * Reads from the current session
     *
     * @param  string $id 	The session id
     * @access public
     * @return Mixed
     */
    public function read($id) 
	{
		//$id 	= self::getDbo()->escape($id);
        $sql 	= "SELECT data FROM  sessions WHERE  id = ?";
		$result = self::getDbo()->execute($sql, array($id));
		
		if (sizeof($result)) {
			return $result[0]['data'];
		}
		
		return null;
    }
	
	/**
     * Destroys the current session
     *
     * @param  string $id 	The session id
     * @access public
     * @return Mixed
     */
    public function destroy($id) 
	{
		unset($_SESSION);
		session_unset();
		session_destroy();	
		
        $sql = "DELETE FROM sessions WHERE  id = ?";
		
		return self::getDbo()->execute($sql, array($id));
    }
	
	/**
     * resets the current session
     *
     * @param  string $id 	The session id
     * @access public
     * @return Mixed
     */
    public function reset() 
	{
		return $this->destroy($this->getId());
    }
	
	/**
     * Cleans expired sessions
     *
     * @param  integer $max Max session lifetime
     * @access public
     * @return Mixed
     */
    public function clean($max) 
	{
        $old = time() - $max;
        $sql = "DELETE FROM   sessions WHERE  access < ?";
		return self::getDbo()->execute($sql, array($old));
    }

	/**
     * Close the sessions
     *
     * @param  string $id 	The session id
     * @access public
     * @return Mixed
     */
    public function close() 
	{
		session_write_close();
		
		return true;
    }
	
	/**
     * Sets a session value
     *
     * @param  string $strName The value name
     * @param  mixed  $mxValue The value
     * @access public
     * @return void
     */
	public function set($strName, $mxValue = null) 
	{
		$_SESSION[$strName] = $mxValue;
	}
	
	/**
     * Gets a session value
     *
     * @param  string $strName The value name
     * @access public
     * @return mixed
     */
	public function get($strName) 
	{
		return (true === isset($_SESSION[$strName]) ? $_SESSION[$strName] : false);
	}
	
	/**
     * Gets all session values
     *
     * @param  string $strName The value name
     * @access public
     * @return mixed
     */
	public function toArray()
	{
		return $_SESSION;
	}
	
	/**
     * Removes a session value
     *
     * @param  string $strName The value name
     * @access public
     * @return mixed
     */
	public function remove($strName = NULL) 
	{
		if (
			(! is_null($strName)) &&
			(isset($_SESSION[$strName]))
		) {
			unset($_SESSION[$strName]);
		}
	}
	
	/**
     * Collects session garbage
     *
     * @access public
     * @return mixed
     */
	public static function collectGarbage() 
	{
		// This methid is called in a cron job (every 15 minutes) to clean old sessions
		$configs 	   = \Core\Application::getInstance()->getConfigs();
		$_dboInterface = self::getDbo();	
		$_dboInterface->execute("DELETE FROM sessions WHERE UNIX_TIMESTAMP(NOW()) - sessions.access >= ?", array(
			(int) $configs->get('Application.core.session.expiration_seconds')
		));
	}
	
	/**
     * Garbage Collector
     * @param int life time (sec.)
     * @return bool
     * @see session.gc_divisor      100
     * @see session.gc_maxlifetime 1440
     * @see session.gc_probability    1
     * @usage execution rate 1/100
     * (session.gc_probability/session.gc_divisor)
     */
    public function gc($max) 
	{
		$configs = \Core\Application::getInstance()->getConfigs();
			
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'clean')
		);
		
		register_shutdown_function('session_write_close');
		session_name($configs->get('Application.core.session.name'));
		session_cache_expire(((int) $configs->get('Application.core.session.expiration_seconds')) / 60);
		
        return true;
    }
	
	/**
     * Returns the current session instance
     *
     * @access public
     * @return \Core\Session\Session
     */
	public static function getInstance() 
	{
		return (self::getSession());
	}
	
	/**
     * Returns the current session instance
     *
     * @access public
     * @return \Core\Session\Session
     */
	public static function getSession() 
	{
		$strSessionClassName = __CLASS__;
		$objSession          = new $strSessionClassName();	
		
		return ($objSession);
	}
	
	/**
     * Close write on session
     *
     * @access public
     * @return void
     */
	public static function closeWrite() 
	{
		if (session_id())	
			session_write_close();
	}
	
	/**
     * Gets the session id
     *
     * @access public
     * @return string
     */
	public static function getId() 
	{
		return (session_id());
	}
	
	/**
     * Gets the session identifier name
     *
     * @access public
     * @return string
     */
	public static function getName() 
	{
		return (session_name());
	}
	
	/**
	 * Returns an instance of the database object
	 * 
	 * @access protected static final
	 * @return \Core\Database\DriverInterface
	 */
	protected static final function getDbo()
	{
		if (empty(self::$_dboInterface) === true) {
			self::$_dboInterface = \Core\Application::getInstance()->getDatabase();	
		}
		
		return self::$_dboInterface;
	}
}