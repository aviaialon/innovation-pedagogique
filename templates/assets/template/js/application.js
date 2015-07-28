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
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_LOCATION_INDEX     = 'application_location';
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_TRAVEL_MODE		= 'application_locationTravelMode';
	
	// Configuration of registered modules.
	SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES					= 'pageModules';
	SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM					= 'contactFormModule';
	SYSTEM.APPLICATION.MAIN.MODULE.LOCATIONS_MAP				= 'locationsMapModule';
		
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
			
			case ('contact') :
			{
				me.startModuleArray([
                    SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES,
 					SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM,
 					SYSTEM.APPLICATION.MAIN.MODULE.LOCATIONS_MAP
 				]);
				
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
				lsjQuery(document).ready(function($) {
					$("#layerslider_9").layerSlider({
						responsiveUnder: 1240,
						layersContainer: 1170,
						startInViewport: false,
						pauseOnHover: false,
						forceLoopNum: false,
						autoPlayVideos: false,
						skinsPath: __JS__ + '/layerslider/skins/'
				    });
				    
				    $('.hasTooltip').tipsy({
				    	'fade': true,
				    	'gravity': 'n',
				    	'title': 'title'
		            });
				});
				
				break;	
			}
			
			/**
			 * Locations Map
			 */
			case (SYSTEM.APPLICATION.MAIN.MODULE.LOCATIONS_MAP) : 
			{
				 $ = jQuery;
				 //
				 // - Configure application vars
				 //
				 me.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.STORE_LOCATIONS, [{ 
					'lat': 45.498612,
					'long': -73.676888,
					'title': 'EnergyOr Technologies',
					'sub_title': "180 Authier St. Montreal <br />QC. Canada H4M 2C6"
				}]);
				
				$('#travelMode').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					if ($(this).hasClass('show')) {
						$('div#travelModeSelection').fadeOut();
						$(this).removeClass('show')
					} else {
						$('div#travelModeSelection').fadeIn();
						$(this).addClass('show');	
					}
				}); 
				
				$('#travelModeSelection ul li').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					event.stopPropagation();
					$('#travelModeSelection ul li').removeClass('selected');
					$(this).addClass('selected');
					var selectedTravelMode = $(this).attr('rel-travel-mode');
					var objTravelModes = {
						driving: google.maps.DirectionsTravelMode.DRIVING,
						transit: google.maps.DirectionsTravelMode.TRANSIT,
						walking: google.maps.DirectionsTravelMode.WALKING
					};
					me.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_TRAVEL_MODE, objTravelModes[selectedTravelMode]);
				}); 
				
				
				$(document).on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.MOUSEUP, function(event) {
					if ($('#travelMode').hasClass('show')) {
						$('div#travelModeSelection').fadeOut();
						$('#travelMode').removeClass('show')
					}
				});
				
				/*- Begin Map direction API - */
				objMapDirectionApi = new MAP_DIRECTION_API();
				objMapDirectionApi.setDestination(me.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_LOCATION_INDEX), function() {
					objMapDirectionApi.setDirectionPanel('directionsPanelContainer');
					objMapDirectionApi.setMapPanel('map_canvas');
					objMapDirectionApi.setAutoCompleteFieldInput('mapSearchTextField');	
					objMapDirectionApi.setVariable('totalDistancePanel', 'total');
					objMapDirectionApi.setVariable('moreInfoPanel', 'more_info');
				});
				
				/*- Begin the map tabs -*/
				$('#map-wrapper div.row div.systabspane ul li a').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					event.preventDefault();
					$('#map-direction-wrapper').fadeOut(400);	
					$("#x").fadeOut();
					$("#travelMode").fadeIn();
					$("#mapSearchTextField").val("");
					
					var intLocationIndex = Number($(this).attr('rel-loc-index'));
					var locationObject	 = me.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.STORE_LOCATIONS).getAt(intLocationIndex);
					me.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_LOCATION_INDEX, locationObject);	
					
					$('div.map_overlay').hide("slide", { direction: "left" }, 500);
					$('#map-wrapper div.row div.systabspane ul li').removeClass('current');
					$(this).parents('li').addClass('current');
					//$('div.map_overlay p.locationAddress, div.map_overlay h3.locationTitle').fadeIn(300);
					$('div.map_overlay').show("slide", { direction: "left" }, 500);
					$('.locationTitle').html(locationObject.title);
					$('.locationAddress').html(locationObject.sub_title);
					objMapDirectionApi.setDestination(locationObject.sub_title);
				});
				
				
				$('a#direction_submit').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					event.preventDefault();
					if ($('#mapSearchTextField').val() !== "") {
						$('#map-direction-wrapper').show();
						$("#travelMode").fadeOut();
						objMapDirectionApi.getDirectionsFromAddress($('#mapSearchTextField').val(), 'directionsPanelContainer', function() {
							$('html, body').animate({
						        scrollTop: $('#more_info').offset().top
						    }, 360);
						}, me.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_TRAVEL_MODE));	
					} else {
						$('#mapSearchTextField').focus();
					}
				});
				
				$('a#useLoc').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					event.preventDefault();
					$('#map-direction-wrapper').show();
					objMapDirectionApi.getGeoLocation(function(objGeoLocation) {
						objMapDirectionApi.getAddressReverseGeocode(
							objGeoLocation.coords.latitude,
							objGeoLocation.coords.longitude,
							function(strFormattedAddress) {
								$('#mapSearchTextField').val(strFormattedAddress);
								$("#x").fadeIn();
								$("#travelMode").fadeOut();
								$('html, body').animate({
							        scrollTop: $('#more_info').offset().top
							    }, 360);
							}
						);
						
						objMapDirectionApi.getDirectionsFromAddress(
							objGeoLocation.coords.latitude + ',' + objGeoLocation.coords.longitude,
							'directionsPanelContainer', function() {
								$('html, body').animate({
							        scrollTop: $('#more_info').offset().top
							    }, 360);
							}, me.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.ACTIVE_TRAVEL_MODE)
						);	
					});	
				});
				
				// if text input field value is not empty show the "X" button
				$("#mapSearchTextField").on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.KEYUP, function(event) {
					$("#x").fadeIn();
					if ($.trim($("#mapSearchTextField").val()) == "") {
						$("#x").fadeOut();
						$("#travelMode").fadeIn();
					}
				});
				
				$("#mapSearchTextField").on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CHANGE, function(event) {
					$("#x").fadeIn();
					if ($.trim($("#mapSearchTextField").val()) == "") {
						$("#x").fadeOut();
						$("#travelMode").fadeIn();
					}
				});
				
				$("#mapSearchTextField").on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.KEYPRESS, function(event) {
					if(event.which == 13) {
						$('#direction_submit').trigger(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK);
					}
				});
				
				// on click of "X", delete input field value and hide "X"
				$("#x").on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					$("#mapSearchTextField").val("");
					$(this).hide();
					$("#travelMode").fadeIn();
					$('#map-direction-wrapper').hide("drop");
				});
				
				$('#mapDirectionDone').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					event.preventDefault();
					$('#map-direction-wrapper').fadeOut(400);	
					$("#x").fadeOut();
					$("#travelMode").fadeIn();
					$("#mapSearchTextField").val("");
				});
				
				$('#mapDirectionPrint').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					event.preventDefault();
					$('div#directionsPanelContainer').print();
				});
				
				break; 
			}
			
			/**
			 * Conatct us form
			 */
			case (SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM) :
			{
				jQuery('form#contactform').submit(function(event) {
					jQuery('input[type="submit"]', this).hide();
					jQuery('span.loading', this).show();
					return (true);
				});
				
				jQuery('#contactFormSubmitBtn').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					jQuery('form#contactform').submit();
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