/**
 * Application Administration Class
 * 
 * This class controls the Application scope
 *
 * @namespace	SYSTEM
 * @package		SYSTEM.APPLICATION
 * @subpackage	MAIN
 * @author      Avi Aialon <aviaialon@gmail.com>
 * @copyright	2012 Avi Aialon. All Rights Reserved
 * @license		http://www.SYSTEM.com/license
 * @version		SVN: $Id$
 * @link		SVN: $HeadURL$
 * @since		12:35:53 AM
 *
 */	
var SYSTEM 							= SYSTEM || {};
SYSTEM.APPLICATION 					= SYSTEM.APPLICATION || {};
SYSTEM.APPLICATION.STATIC_INSTANCE	= SYSTEM.APPLICATION.STATIC_INSTANCE || {};
(SYSTEM.APPLICATION.MAIN  = function(objParams) {
	
	/**
	 * Define Class Constants
	 * 
	 * @var String
	 */
	
	// Class configurations
	SYSTEM.APPLICATION.MAIN.STATUS 								= {};
	SYSTEM.APPLICATION.MAIN.STATUS.TYPE							= {};
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT						= {};
	SYSTEM.APPLICATION.MAIN.CONFIGURATION						= {};
	SYSTEM.APPLICATION.MAIN.SELECTIONS							= {};
	SYSTEM.APPLICATION.MAIN.POST_HANDLER						= {};
	SYSTEM.APPLICATION.MAIN.MODULE								= {};
	SYSTEM.APPLICATION.MAIN.EVENT_HOOKS							= {};
	
	// Status Responses
	SYSTEM.APPLICATION.MAIN.STATUS.TYPE.ERROR 					= 'error';
	SYSTEM.APPLICATION.MAIN.STATUS.TYPE.INFO 					= 'info';
	SYSTEM.APPLICATION.MAIN.STATUS.TYPE.OK 						= 'success';
	SYSTEM.APPLICATION.MAIN.STATUS.TYPE.MESSAGE					= 'message';
	SYSTEM.APPLICATION.MAIN.STATUS.TYPE.RESPONSE_OK 			= 'OK';
	
	// Event Responses
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK					= 'click';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSEOVER				= 'hover';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.KEYUP					= 'keyup';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.KEYDOWN				= 'keydown';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.KEYPRESS				= 'keypress';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.ONMOVE					= 'onmove';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSEOVER				= 'mouseover';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSEOUT				= 'mouseout';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSENTER				= 'mousenter';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSELEAVE				= 'mouseleave';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSEUP				= 'mouseup';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSEDOWN				= 'mousedown';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CHANGE					= 'change';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.BLUR					= 'blur';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.FOCUS					= 'focus';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.HOVER					= 'hover';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.SUBMIT					= 'submit';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.WKTRANSEND				= 'webkitTransitionEnd';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.OTRANSEND				= 'oTransitionEnd';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.TRANSEND				= 'transitionend';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.ONHIDE					= 'onHideEvent';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.ONSHOW					= 'onShowEvent';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.RESIZE					= 'resize';
	SYSTEM.APPLICATION.MAIN.STATUS.EVENT.VOID					= 'void';
	
	
	// Parameter constants (to use with setter / configure)
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.SITE_URL		 			= 'siteApplicationUrl';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.LANGUAGE	 		 		= 'application_configLang';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.JS_DOCUMENT_ROOT			= 'jsDocumentRoot';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.STATIC_DOCUMENT_ROOT	 	= 'staticDocumentRoot';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.IMG_DOCUMENT_ROOT		 	= 'imgDocumentRoot';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.IMG_WEB_ROOT		 	    = 'imgWebRoot';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.WEB_DOCUMENT_ROOT		 	= 'webDocumentRoot';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.IS_MOBILE_DEVICE	 	 	= 'application_boolIsMobile';
		
	// Configuration of registered modules.
	SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES					= 'pageModules';
		
	/**
	 * Application initialisation method
	 *
	 * @param	none
	 * @return	SYSTEM.APPLICATION.MAIN
	 */
	 SYSTEM.APPLICATION.MAIN.prototype.initialise = function(fnCallback)
	 {
		 var fnAppInitialiseCallback = (typeof fnCallback == "function" ? fnCallback : function() {}),
		 	 me = this;
			 
		 me.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.IS_MOBILE_DEVICE, 
		 	Boolean(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)));
		 
		 jQuery(document).ready(function($) {

			 // Call the onInit event handler
			 fnAppInitialiseCallback(me);
			 
			 //
			 // Load and save the static application handler.
			 //
			 SYSTEM.APPLICATION.STATIC_INSTANCE = me;
		 });
		 
		 return (this);
	 }
	 	
	/**
	 * Variable getter method
	 *
	 * @param	strVarName 	- The variable name
	 * @return	mxResult 	- The variable value
	 */
	 SYSTEM.APPLICATION.MAIN.prototype.getVariable = function(strVarName)
	 {
		var mxResult = false;
		if (typeof this[strVarName] !== "undefined") {
			mxResult = this[strVarName];
		}
		
		return (mxResult);
	 }
	 
	/**
	 * Message setter method
	 *
	 * @param	strVarName 	- The variable name
	 * @param	strVarValue	- The variable value
	 * @return	void
	 */
	 SYSTEM.APPLICATION.MAIN.prototype.setVariable = function(strVarName, strVarValue)
	 {
		if (typeof strVarName !== "undefined") {
			this[strVarName] = strVarValue;
		}
	 }
	 
	/**
	 * Message setter method
	 *
	 * @param	strVarName 	- The variable name
	 * @param	strVarValue	- The variable value
	 * @return	void
	 */
	 SYSTEM.APPLICATION.MAIN.prototype.configure = function(strVarName, strVarValue)
	 {
		this.setVariable(strVarName, strVarValue);
	 }
	 
	 /**
	  * This method returns the translated string according to the language
	  * 
	  * @param	strEngVal String - The english value
	  * @param	strFrVal  String - The french value
	  * @return String
	  */
	 SYSTEM.APPLICATION.MAIN.prototype.translate = function(strEngVal, strFrVal, strChVal)
	 {
		 var strRetData = strEngVal;
		 var strlang 	= (this.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.LANGUAGE) || ('en'));
		 if (strlang.toLowerCase() == 'fr')
		 {
			 strRetData = strFrVal;
		 }
		 else if (strlang.toLowerCase() == 'ch')
		 {
			 strRetData = strChVal;
		 }
		 
		 return (strRetData);
	 }
	 
	 /**
	  * This method initilises and starts modules from array
	  * 
	  * @param	array / Object arrModuleNames
	  * @return void
	  */
	 SYSTEM.APPLICATION.MAIN.prototype.startModuleArray = function(arrModuleNames)
	 {
		var me = this;
		if (
			(typeof arrModuleNames !== "undefined") && 
			((typeof arrModuleNames == "array") || (typeof arrModuleNames == "object")) && 
			(Number(arrModuleNames.length) > 0)
		) {
			jQuery.each(arrModuleNames, function(intIndex, strModuleName) {
				me.startModule(strModuleName);	
			});
		}
	 }
	 
	 


	 /**
	  * This method initilises a page based on the controller
	  * 

	  * @param	string strControllerName
	  * @return void
	  */
	 SYSTEM.APPLICATION.MAIN.prototype.startModuleCollection = function(strControllerName)
	 {
		var me = this;
		console.log('** Starting Controller: ' + strControllerName);
		switch (strControllerName) 
		{
			case ('index') : 
			{
				me.startModuleArray([SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES]);
				
				/*
				me.startModuleArray([
					SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES,
					SYSTEM.APPLICATION.MAIN.MODULE.BROWSER_DETECT,
					SYSTEM.APPLICATION.MAIN.MODULE.TOOLTIPS,
					SYSTEM.APPLICATION.MAIN.MODULE.PAGE_PRELOADER,
					SYSTEM.APPLICATION.MAIN.MODULE.USER_LOGIN_INPUTS,
					SYSTEM.APPLICATION.MAIN.MODULE.CUSTOM_COMBO_BOX,
					SYSTEM.APPLICATION.MAIN.MODULE.CALL_MODULE
				]);
				*/
				break;	
			}
			
			case (SYSTEM.APPLICATION.MAIN.STATUS.EVENT.VOID) :
			{
				return me;
				break;
			}
			
			default :
			{
				me.startModuleArray([]);
				
				break;
			}
		}
	 }
	
	 /**
	  * This method initilises and starts modules
	  * 
	  * @param	none
	  * @return void
	  */
	 SYSTEM.APPLICATION.MAIN.prototype.startModule = function(strModuleName)
	 {
		 var me = this;
		 console.log('Loading Module: ' + strModuleName);
		 switch (strModuleName)
		 {
			 
			 /**
			  * Browser detection
			  */
			case (SYSTEM.APPLICATION.MAIN.MODULE.BROWSER_DETECT) : 
			{}
			
			
			/**
			 * Loading the default page modules
			 */
			case (SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES) : 
			{
                                var lsjQuery = jQuery;
				lsjQuery(document).ready(function() {
				    lsjQuery("#layerslider_9").layerSlider({
					responsiveUnder: 1240,
					layersContainer: 1170,
					startInViewport: false,
					pauseOnHover: false,
					forceLoopNum: false,
					autoPlayVideos: false,
					skinsPath: __JS__ + '/layerslider/skins/'
				    });
				});

				break;	
			}
		 }
	 }
});


function __(a, b, c) {
	return SYSTEM.APPLICATION.STATIC_INSTANCE.translate(a, b, c);	
}

if (typeof window.console == "undefined") {
	window.console = { log: function() {} };	
}

Array.prototype.first = function () {
    return this[0];
};

Array.prototype.getAt = function (intIndex) {
    return this[Number(intIndex)];
};

var Core = Core || {};
Core.StaticInstance = Core.StaticInstance || {
	__staticInstances: {},
	
	resister: function (__a, __b) {
		Core.StaticInstance.__staticInstances[__a] = __b;
		
		return __b;
	},
	
	get: function (__a) {
		return (typeof Core.StaticInstance.__staticInstances[__a] !== "undefined" ? Core.StaticInstance.__staticInstances[__a] : false);
	},
	
	set: function (__a, __b) {
		return Core.StaticInstance.resister(__a, __b);
	}
};
