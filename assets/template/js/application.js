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
	SYSTEM.APPLICATION.MAIN.CONFIGURATION.WISHLIST_COUNT    		= 'application_wishlistCount';
	
	// Configuration of registered modules.
	SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES					= 'pageModules';
	SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM					= 'contactFormModule';
	SYSTEM.APPLICATION.MAIN.MODULE.SPONSOR_FORM					= 'sponsorFormModule';
	SYSTEM.APPLICATION.MAIN.MODULE.COLLABORATE_FORM				= 'collaborateFormModule';
	SYSTEM.APPLICATION.MAIN.MODULE.LOCATIONS_MAP				= 'locationsMapModule';
	SYSTEM.APPLICATION.MAIN.MODULE.PROJECTS						= 'projectsModule';
		
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
			case ('index/index') : 
			{
				// Special alert just for the homepage...
				$_notyEleme = noty({
					text        : 'Nous sommes conscients de certaines coquilles et erreurs typographiques. Nous sommes à l\'œuvre pour les corriger et pour apporter les améliorations nécessaires.',
					type        : 'warning',
					theme       : 'relax',
					dismissQueue: true,
					layout      : 'top',
					timeout     : 30000,/*
					animation   : {
						open  : 'animated ' + window.anim.open,
						close : 'animated ' + window.anim.close
					},*/
					buttons     : false
				}); 
				
				window.onscroll = function() {
					window.setTimeout(function() {
						$_notyEleme.close()
					}, 500);
				};
				
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
			
			case ('contact/collaborate') :
			case ('contact/sponsor') :
			case ('contact/index') :
			{
				SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM = jQuery('form[name="frmsponsor"]').length > 0 ? 
					SYSTEM.APPLICATION.MAIN.MODULE.SPONSOR_FORM : (
						jQuery('form[name="frmcollaborate"]').length > 0 ? 
							SYSTEM.APPLICATION.MAIN.MODULE.COLLABORATE_FORM : SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM
					);
					
				me.startModuleArray([
                    SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES,
 					SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM,
 					SYSTEM.APPLICATION.MAIN.MODULE.LOCATIONS_MAP
 				]);
				
				break;
			}
			
			case ('projects/wishlist') :
			case ('projects/detail') :
			case ('projects/index') :
			{
				me.startModuleArray([
                    SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES,
                    SYSTEM.APPLICATION.MAIN.MODULE.PROJECTS
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
				me.startModuleArray([SYSTEM.APPLICATION.MAIN.MODULE.PAGE_MODULES]);
				
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
				
				// Make the parent menus active as well.
				lsjQuery('.current_page_item').parents('.menu-item-simple-parent').addClass('current_page_item');
				lsjQuery('.wishListCount').html('(' + me.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.WISHLIST_COUNT) + ')');
				lsjQuery('span.wl').html(me.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.WISHLIST_COUNT));
				
				if (parseInt(me.getVariable(SYSTEM.APPLICATION.MAIN.CONFIGURATION.WISHLIST_COUNT)) == 0) {
					lsjQuery('span.wl').html('').hide();
					lsjQuery('.wishListCount').html('');
				} else {
					lsjQuery('span.wl').show();
				}
				
				break;	
			}
			
			/**
			 * Projects modules
			 */
			case (SYSTEM.APPLICATION.MAIN.MODULE.PROJECTS) : 
			{
				$ = jQuery;
				
				$('.applyFilters').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function(event) {
					event.preventDefault();
					
					currentUrl = $('form.filters').attr('action'),
					data       = $('form.filters').serializeArray(),
					urlData    = {};
					
					$.each(data, function(index, __object) {
						if (__object.value.length && __object.value != 0) {
							//currentUrl += __object.name + ':' + __object.value + '/';
							urlData[__object.name] = __object.value;
						}
					});
					
					//$('form.filters').attr('action', currentUrl);
					//$('form.filters').submit();
					window.location.href = currentUrl + '?' + $.param(urlData);
				}); 
				
				if($( "#priceslider" ).length) {
					
					$( "#priceslider" ).slider({
						range: true,
						animate: 200,
						min: 0,
						max: 18,
						values: [
							(parseInt($('.min-age').val()) > 0 ? parseInt($('.min-age').val()) : 0), 
							(parseInt($('.max-age').val()) > 0 ? parseInt($('.max-age').val()) : 18)
						],
						step: 1,
						slide: function( event, ui ) {
							if (ui.values[0] >= ui.values[1]) return;
							$('.applyFilters').removeClass('hide');
							$('.min-age').val(parseInt(ui.values[0]));
							$('.max-age').val(parseInt(ui.values[1]));
							$("#age-filter").html('&nbsp;<b>' + ui.values[0] + ' &mdash; ' + ui.values[1]  + '</b> an(s).');
						},
						create: function(event, ui) {
							if (parseInt($('.min-age').val()) > 0 || parseInt($('.max-age').val()) > 0) {
								$("#age-filter").html('&nbsp;<b>' + parseInt($('.min-age').val()) + ' &mdash; ' + parseInt($('.max-age').val())  + '</b> an(s).');	
							}
						}
					});
				}
				// parseInt(new Date().getFullYear())
				if($( "#yearslider" ).length) {
					$( "#yearslider" ).slider({
						range: false,
						animate: 200,
						min: parseInt(new Date().getFullYear()) - 5,
						max: parseInt(new Date().getFullYear()),
						/*values: [
							(parseInt($('.min-age').val()) > 0 ? parseInt($('.min-age').val()) : 0), 
							(parseInt($('.max-age').val()) > 0 ? parseInt($('.max-age').val()) : 18)
						],*/
						value: (parseInt($('.year').val()) > 0 ? parseInt($('.year').val()) : parseInt(new Date().getFullYear())),
						step: 1,
						slide: function( event, ui ) {
							$('.applyFilters').removeClass('hide');
							if (parseInt(new Date().getFullYear()) == parseInt(ui.value)) {
								$('.year').val('');
							} else {
								$('.year').val(parseInt(ui.value));
							}
							
							$("#year-filter").html('&nbsp;<b>' + parseInt(ui.value) + '</b>');
						},
						create: function(event, ui) {
							if (parseInt($('.year').val()) > 0) {
								$("#year-filter").html('&nbsp;<b>' + $('.year').val() + '</b>');
							}
						}
					});
				}
				
				// Category selection:
				$container = $('ul.categorySelection').find('a.active').parents('li.category-list-item');
				$container.find('a.dt-sc-toggle').addClass('active');
				$container.find('ul.dt-sc-toggle-content').css({'display': 'block'});
				
				/**
				 * Wishlist handling
				 */
				$('.wishlistBtn').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, document, function(event) {
					event.preventDefault(); 
					target = $(this);
					$.ajax({
						type : "POST",
						url : target.attr('href'), //window.location.href,
						dataType : "html",
						cache : false,
						processData : true,
						data: {},
						xhrFields : {
						  withCredentials : true
						},
						/**
						 * @param {?} textStatus
						 * @return {undefined}
						 */
						success : function(response) {
							var data = $.parseJSON(response);
							if (data.success == true) {
								switch (data.action) {
									case 'add' : {
										target.addClass('active');
										target.attr({
											'href': data.rmvUrl,
											'title': __('Remove from wishlist', 'Retirer de la liste de souhaits')
										});
										break;	
									}
									
									case 'remove' : {
										if (target.hasClass('fromListPage')) {
											target.parents('li').fadeOut(300, function() {
												target.parents('li').remove();	
											});
										} else {
											target.removeClass('active');
											target.attr({
												'href': data.addUrl,
												'title': __('Add to wishlist', 'Ajouter à la liste de souhaits')
											});	
										}
										break;	
									}
								}
								
								if (typeof data.itemCount !== "undefined") {
									
									if (parseInt(data.itemCount) > 0) {
										$('.wishListCount').html('(' + data.itemCount + ')');
										$('span.wl').html(data.itemCount).show();
									} else {
										$('span.wl').hide();
										$('.wishListCount').html('');
										$('span.wl').html('');
									}
									
								}
							} else {
								// Handle something when wrong here...
							}
							
							
						},
						/**
						 * @param {?} jqXHR
						 * @param {?} textStatus
						 * @param {?} origError
						 * @return {undefined}
						 */
						error : function(jqXHR, textStatus, origError) {
						},
						/**
						 * @return {undefined}
						 */
						complete : function() {
						}
					});
			   }); 
				
				instance = $('[data-remodal-id=wishListShare]').remodal({});
				
				// Send the wishlist 
				$('.sendWishlist').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, document, function(event) {
					event.preventDefault();
					$('#wishListShare form').addClass('loading');
					$('#wishListShare .error_msg').addClass('hide').html('');
					
					email   = $('#wishListShare .email').val();
					
					if (email == '') {
						$('#wishListShare .error_msg').removeClass('hide').addClass('active').html(__('Please complete all the required fields.', 'Veuillez remplir tous les champs obligatoires'));
						$('#wishListShare form').removeClass('loading');
						return;
					}
					
					if (! new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/).test(email)) {
						$('#wishListShare .error_msg').removeClass('hide').addClass('active').html(
							__('Please enter a valid email address.', 'Veuillez entrer une adresse email valide.')
						);
						$('#wishListShare form').removeClass('loading');
						return;
					}
					
					$('#wishListShare .error_msg').addClass('hide').removeClass('active');
					
					$.ajax({
						type : "POST",
						url : window.location.href ,
						dataType : "html",
						cache : false,
						processData : true,
						data: $('#wishListShare form').serialize(),
						xhrFields : {
						  withCredentials : true
						},
						/**
						 * @param {?} textStatus
						 * @return {undefined}
						 */
						success : function(response) {
							var data = $.parseJSON(response);
							$('#wishListShare form').removeClass('loading');
							if (data.success == true) {
								$('#wishListShare .error_msg').remove();
								$('#wishListShare form').html(__('<p>Thank you. Your wishlist was sent.</p>', '<p>Merci. Votre liste de souhaits a été envoyé</p>'));
							} else {
								// Handle something when wrong here...
								$('#wishListShare .error_msg').removeClass('hide').addClass('active').html(data.error);
							}
							
							
						},
						/**
						 * @param {?} jqXHR
						 * @param {?} textStatus
						 * @param {?} origError
						 * @return {undefined}
						 */
						error : function(jqXHR, textStatus, origError) {
							$('#wishListShare form').removeClass('loading');
						},
						/**
						 * @return {undefined}
						 */
						complete : function() {
							$('#wishListShare form').removeClass('loading');
						}
					});
				});
				
				// Request product information
				$('.sendInfoRequest').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, document, function(event) {
					event.preventDefault();
					$('#productMoreInfo form').addClass('loading');
					$('#productMoreInfo .error_msg').addClass('hide').html('');
					
					email = $('#productMoreInfo .email').val();
					
					if (email == '') {
						$('#productMoreInfo .error_msg').removeClass('hide').addClass('active').html(
							__('Please complete all the required fields.', 'Veuillez remplir tous les champs obligatoires'));
						$('#productMoreInfo form').removeClass('loading');
						return;
					}
					
					if (! new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/).test(email)) {
						$('#productMoreInfo .error_msg').removeClass('hide').addClass('active').html(
							__('Please enter a valid email address.', 'Veuillez entrer une adresse email valide.')
						);
						$('#productMoreInfo form').removeClass('loading');
						return;
					}
					
					$('#productMoreInfo .error_msg').addClass('hide').removeClass('active');
					
					$.ajax({
						type : "POST",
						url : window.location.href,
						dataType : "html",
						cache : false,
						processData : true,
						data: $('#productMoreInfo form').serialize(),
						xhrFields : {
						  withCredentials : true
						},
						/**
						 * @param {?} textStatus
						 * @return {undefined}
						 */
						success : function(response) {
							var data = $.parseJSON(response);
							$('#productMoreInfo form').removeClass('loading');
							if (data.success == true) {
								$('#productMoreInfo .error_msg').remove();
								$('#productMoreInfo form').html(__('<p>Thank you. Your request was sent.</p>', '<p>Merci. Votre demande de renseignement a été envoyé</p>'));
							} else {
								// Handle something when wrong here...
								$('#productMoreInfo .error_msg').removeClass('hide').addClass('active').html(data.error);
							}
							
							
						},
						/**
						 * @param {?} jqXHR
						 * @param {?} textStatus
						 * @param {?} origError
						 * @return {undefined}
						 */
						error : function(jqXHR, textStatus, origError) {
							$('#productMoreInfo form').removeClass('loading');
						},
						/**
						 * @return {undefined}
						 */
						complete : function() {
							$('#productMoreInfo form').removeClass('loading');
						}
					});
				});
				
				$('.printWishlist').on('click', document, function(event) {
					event.preventDefault(); 
					$content = $('.wishlistContent').clone();
					$content.find('#wishlist-links').remove();
					$content.print();
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
			 * Collaborate form
			 */
			case (SYSTEM.APPLICATION.MAIN.MODULE.COLLABORATE_FORM) : 
			{
				$ = jQuery;
				
				$('a.submit').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function (event) {
					event.preventDefault();
					$('.error_msg').html('').removeClass('active');
					$(this).parents('form').submit();	
				});
				
				validator = $('form[name="frmcollaborate"]').validate({
					rules: {
						project_hours: { required: true, digits: true },
						project_students: { required: true, digits: true },
						documents: { required: true },
						product: { required: true },
						problem: { required: true },
						description: { required: true },
						name: { required: true },
						title: { required: true },
						tel: { required: true, phoneUS: true },
						email: { required: true, email: true }
					},
					messages: {
						tel: "Veuillez fournir un numéro de téléphone valide.",
						name: "Veuillez indiquer votre nom.",
						title: "Veuillez indiquer votre titre.",
						email: "Veuillez fournir une adresse courriel valide.",
						description: "Décrivez brièvement votre milieu et les services offerts.",
						problem: "Décrivez le problème que vous souhaitez résoudre ou le besoin que vous aimeriez satisfaire dans votre milieu.",
						product: "Décrivez le genre d’outil, de produit, de procédé ou de service pédagogique idéal que vous aimeriez",
						documents: "Dans le cadre de ce projet, vous pourriez fournir à l’équipe de conception les éléments",
						project_hours: "Nombre d'heures estimées",
						project_students: "Nombre d'étudiants estimées."
					}
				});	
				
				$('form[name="frmcollaborate"]').submit(function () {
					
					var This = $(this),
						messages = {
							tel: "Veuillez fournir un numéro de téléphone valide.",
							name: "Veuillez indiquer votre nom.",
							title: "Veuillez indiquer votre titre.",
							email: "Veuillez fournir une adresse courriel valide.",
							description: "Décrivez brièvement votre milieu et les services offerts.",
							problem: "Décrivez le problème que vous souhaitez résoudre ou le besoin que vous aimeriez satisfaire dans votre milieu.",
							product: "Décrivez le genre d’outil, de produit, de procédé ou de service pédagogique idéal que vous aimeriez",
							documents: "Dans le cadre de ce projet, vous pourriez fournir à l’équipe de conception les éléments",
							project_hours: "Nombre d'heures estimées",
							project_students: "Nombre d'étudiants estimées."
						};
					
					error = false;	
					$.each(This.find('.input-item'), function(index, element) {
						if ($(element).val() == '') {
							$('.error_msg').html(messages[$(element).attr('name')]).addClass('active');	
							//$(element).closest(":has(h5 a.toggler)").find('a.toggler').trigger(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK);
							segment = $(element).parents('.segment');
							if (! segment.find('.dt-sc-toggle-accordion').hasClass('active')) {
								segment.find('a.toggler').trigger(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK);
								$('html, body').animate({
									scrollTop: segment.offset().top - 20
								}, 1000);
							}
							error = true;
							return false;
						}
					});
					
					frmValid = $(This).valid();
					
					if (!error && frmValid) {
						This.find('a.submit').html('<i class="fa fa-spinner fa-spin"></i> Demande en traitement...');
						This.find('input').fadeTo(300, 0.3);
						This.find('textarea').fadeTo(300, 0.3);
						var action     = $(This).attr('action');
						var data_value = unescape($(This).serialize());
						$.ajax({
							 type: "POST",
							 url:action,
							 data: data_value,
							 error: function (xhr, status, error) {
								 //confirm('Une erreur s\'est produite. Veuillez essayer à nouveau.');
							 },
							 success: function (__response) {
								 if (true == __response.success) {
									 SYSTEM.APPLICATION.MAIN.sendAlert({
										type: SYSTEM.APPLICATION.MAIN.STATUS.TYPE.OK,
										title: 'Votre demade a été envoyé avec succès',
										message: 'Merci pour votre intérêt. Votre demande a été envoyé avec succès et nous serons en contact bientôt.'
									});	 
									
									This[0].reset();
									grecaptcha.reset();
								 } else {
									SYSTEM.APPLICATION.MAIN.sendAlert({
										type: SYSTEM.APPLICATION.MAIN.STATUS.TYPE.ERROR,
										title: 'Erreur',
										message: __response.message
									});	 
								 }
								 
								 This.find('a.submit').html('Envoyer votre demande');
								 This.find('input').fadeTo(300, 1);
								 This.find('textarea').fadeTo(300, 1);
							 },
							 complete: function() {
								try {
									This.find('input').fadeTo(300, 1);
									This.find('a.submit').html('Envoyer votre demande');
									grecaptcha.reset();
								} catch (e) {
									
								}
							}
						});
					} else if (!error && !frmValid) {
						$('.error_msg').html($('label.error:visible').html()).addClass('active');
					}
					
					return false;	
				});
				break;	
			}
			
			/**
			 * Sponsor form
			 */
			case (SYSTEM.APPLICATION.MAIN.MODULE.SPONSOR_FORM) : 
			{
				$ = jQuery;
				
				//  packageSelect" rel-package="platine"
				$('a.packageSelect').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function (event) {
					event.preventDefault();
					var target = $(this).attr('rel-package');
					$('select#package').find('option[value="' + target + '"]').attr('selected', 'selected');
					$('html, body').animate({
						scrollTop: $('form[name="frmsponsor"]').offset().top - 20
					}, 1000);
				});
				
				$('a.submit').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function (event) {
					event.preventDefault();
					$(this).parents('form').submit();	
				});
				
				if($().validate) {
					// AJAX CONTACT FORM...
					$('form[name="frmsponsor"]').submit(function () {
						var This = $(this);
						if($(This).valid()) {
							This.find('a.submit').html('<i class="fa fa-spinner fa-spin"></i> Demande en traitement...');
							This.find('input').fadeTo(300, 0.3);
							This.find('textarea').fadeTo(300, 0.3);
							var action     = $(This).attr('action');
							var data_value = unescape($(This).serialize());
							$.ajax({
								 type: "POST",
								 url:action,
								 data: data_value,
								 error: function (xhr, status, error) {
									 //confirm('Une erreur s\'est produite. Veuillez essayer à nouveau.');
								 },
								 success: function (__response) {
									 if (true == __response.success) {
										 SYSTEM.APPLICATION.MAIN.sendAlert({
											type: SYSTEM.APPLICATION.MAIN.STATUS.TYPE.OK,
											title: 'Votre demade a été envoyé avec succès',
											message: 'Merci pour votre intérêt. Votre demande a été envoyé avec succès et nous serons en contact bientôt.'
										});	 
										
										This[0].reset();
										grecaptcha.reset();
									 } else {
										SYSTEM.APPLICATION.MAIN.sendAlert({
											type: SYSTEM.APPLICATION.MAIN.STATUS.TYPE.ERROR,
											title: 'Erreur',
											message: __response.message
										});	 
									 }
									 
									 This.find('a.submit').html('Envoyer votre demande');
									 This.find('input').fadeTo(300, 1);
									 This.find('textarea').fadeTo(300, 1);
								 },
								 complete: function() {
									try {
										This.find('input').fadeTo(300, 1);
										This.find('a.submit').html('Envoyer votre demande');
										grecaptcha.reset();
									} catch (e) {
										
									}
								}
							});
						}
						return false;
					});
					
					$('form[name="frmsponsor"]').validate({
						rules: {
							package: { required: true },
							name: { required: true },
							email: { required: true, email: true },
							companyName: { required: true },
							tel: { required: true, phoneUS: true },
							fax: { required: false, phoneUS: true },
							address: { required: true },
							message: { required: false }
						},
						messages: {
							package: "Veuillez choisir le type de commandite.",
							name: "Veuillez indiquer votre nom.",
							email: "Veuillez fournir une adresse courriel valide.",
							companyName: "Veuillez indiquer le nom de l\'organisation ou de l\'entreprise.",
							tel: "Veuillez fournir un numéro de téléphone valide.",
							fax: "Veuillez fournir un numéro de fax valide.",
							address: "Veuillez fournir une address valide.",
							message: "Ce champ est requis."
						},
						/*errorPlacement: function(error, element) { }*/
					});	
				}
				
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
			
			/**
			 * Conatct us form
			 */
			case (SYSTEM.APPLICATION.MAIN.MODULE.CONTACT_FORM) :
			{
				$ = jQuery;
				
				$('a.submit').on(SYSTEM.APPLICATION.MAIN.STATUS.EVENT.CLICK, function (event) {
					event.preventDefault();
					$(this).parents('form').submit();	
				});
				
				if($().validate) {
					// AJAX CONTACT FORM...
					$('form[name="frmcontact"]').submit(function () {
						var This = $(this);
						if($(This).valid()) {
							This.find('a.submit').html('<i class="fa fa-spinner fa-spin"></i> Demande en traitement...');
							This.find('input').fadeTo(300, 0.3);
							This.find('textarea').fadeTo(300, 0.3);
							var action     = $(This).attr('action');
							var data_value = unescape($(This).serialize());
							$.ajax({
								 type: "POST",
								 url:action,
								 data: data_value,
								 error: function (xhr, status, error) {
									 confirm('Oops. An error occured. Please try again later.');
								 },
								 success: function (__response) {
									 if (true == __response.success) {
										 SYSTEM.APPLICATION.MAIN.sendAlert({
											type: SYSTEM.APPLICATION.MAIN.STATUS.TYPE.OK,
											title: 'Votre message a été envoyé avec succès',
											message: 'Merci pour votre intérêt. Votre message a été envoyé avec succès et nous serons en contact bientôt.'
										});	 
										
										This[0].reset();
										grecaptcha.reset();
									 } else {
										SYSTEM.APPLICATION.MAIN.sendAlert({
											type: SYSTEM.APPLICATION.MAIN.STATUS.TYPE.ERROR,
											title: 'Erreur',
											message: __response.message
										});	 
									 }
									 
									 This.find('a.submit').html('Envoyer votre demande');
									 This.find('input').fadeTo(300, 1);
									This.find('textarea').fadeTo(300, 1);
								 },
								 complete: function() {
									try {
										This.find('input').fadeTo(300, 1);
										This.find('a.submit').html('Envoyer votre demande');
										grecaptcha.reset();
									} catch (e) {
										
									}
								}
							});
						}
						return false;
					});
					
					$('form[name="frmcontact"]').validate({
						rules: { 
							name: { required: true },
							email: { required: true, email: true },
							message: { required: true }
						},
						messages: {
							name: "Veuillez indiquer votre nom.",
							email: "Veuillez fournir une adresse courriel valide.",
							message: "Ce champ est requis."
						},
						/*errorPlacement: function(error, element) { }*/
					});	
				}
				
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

/**
 * This method throws an alert message to the user
 * 
 * @access 	Static
 * @param	Object objParams - Parameter settings:
 * 	objParams.type [
 * 		SYSTEM.APPLICATION.MAIN.STATUS.TYPE.ERROR
 * 		SYSTEM.APPLICATION.MAIN.STATUS.TYPE.INFO
 * 		SYSTEM.APPLICATION.MAIN.STATUS.TYPE.OK
 * 	]
 * 
 * 	objParams.title 	- Alert box title
 * 	objParams.message	- Alert box message
 * @return void
 */
SYSTEM.APPLICATION.MAIN.sendAlert = function(objParams)
{
	$('body').push({
		'type': 	(typeof objParams.type !== "undefined" ? objParams.type : SYSTEM.APPLICATION.MAIN.STATUS.TYPE.INFO),
		'title':	(typeof objParams.title !== "undefined" ? objParams.title : 'Message Alert'),
		'content': 	'<div style="width: 350px;">' + (typeof objParams.message !== "undefined" ? objParams.message : '') + '</div>'
	});
}


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
