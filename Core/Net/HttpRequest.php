<?php
/**
 * HttpRequest Administration Class
 *
 * This class controls the Net HttpRequest scope
 *
 * @namespace    Core
 * @package      Net
 * @subpackage   none
 * @author       Avi Aialon <aviaialon@gmail.com>
 * @copyright    2012 Canspan. All Rights Reserved
 * @license      http://www.canspan.com/license
 * @version      SVN: $Id$
 * @link         SVN: $HeadURL$
 * @since        12:35:53 AM
 *
 */
namespace Core\Net;

/**
 * HttpRequest Administration Class
 *
 * This class controls the Net HttpRequest scope
 *
 * @namespace    Core
 * @package      Net
 * @subpackage   none
 * @author       Avi Aialon <aviaialon@gmail.com>
 * @copyright    2012 Canspan. All Rights Reserved
 * @license      http://www.canspan.com/license
 * @version      SVN: $Id$
 * @link         SVN: $HeadURL$
 * @since        12:35:53 AM
 *
 */
class HttpRequest
    extends \Core\Net\Router
{
   /**
    * Sets a view data
    *
    * @param string $dataKey
    * @param mixed  $dataValue
    * @return void
    */
    protected final function setViewData($dataKey, $dataValue = null)
    {
        $this->addViewParams($dataKey, $dataValue);
    }

  /**
    * Gets a view data
    *
    * @param string $dataKey
    * @param mixed  $default
    * @return mixed
    */
    protected final function getViewData($dataKey = null, $default = false)
    {
		$param = $this->getViewParams($dataKey);
		
		if (false === $param) {
			$param = $default;
		}
		
        return $param;
    }

  /**
    * Gets the view file
    *
    * @param string $viewPath
    * @return void
    */
    protected final function getView()
    {
        return $this->getMvcRequest('mvcView');
    }

    /**
     * Returns request data
     *
     * @param  string $requestDataKey (Optional) The request data key
     * @param  string $default        (Optional) The Default value too return if nothing is found
     * @return mixed | false
     */
    public function getRequestParam($requestDataKey = null, $default = false)
    {
		if (empty($requestDataKey) === true) {
			return $this->getRequestData($requestDataKey);
		}
		
		if (true === array_key_exists($requestDataKey, $this->_dataRegistry['requestdata'])) {
			return $this->getRequestData($requestDataKey);
		}
		
        return $default;
    }

  /**
    * Gets the layout used
    *
    * @return string
    */
    protected final function getLayout()
    {
        return $this->getViewParams('mvcLayout');
    }

   /**
    * Creates a route
    *
    * @return string
    */
    protected final function route($controller = null, $action = null, array $params = array())
    {
        $Application    = \Core\Application::getInstance();
        $controllerName = (empty($controller) === false) ? (is_object($controller) ? get_class($controller) : $controller) : 'index';
        $actionName     = (empty($controller) === false) ? $action : 'index';
        $route          = '/' . $controllerName . '/' . $actionName;
		/*
		$route          = rtrim($Application->getConfigs()->get('Application.core.base_url'), '/')
                          . '/' . $controllerName . '/' . $actionName;
		*/						  

        foreach ($params as $paramKey => $paramValue) {
            $paramValue = (true === is_object($paramValue)) ? serialize($paramValue) : $paramValue;
            $route     .= '/' . $paramKey . ':' . $paramValue;
        }
		
		
        $route = preg_replace('/\/index/', '', $route);
        $route = ltrim(preg_replace('/\/\//', '/', $route), '/');
		$route = rtrim($Application->getConfigs()->get('Application.core.base_url'), '/') . '/' . $route;
		
		return $route;
        //return rtrim($route, '/index');
    }
}