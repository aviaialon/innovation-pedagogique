var Shopping_Cart = Shopping_Cart || {
	__lang: 'en',
	__config: {
		apiUrl: null
	},
	__currentTotal : 0,
	__taxes : {},
	
	getInstance: function (__configs__) 
	{
		return Shopping_Cart;	
	},
	
	setApiUrl: function (__apiUrl) 
	{
		Shopping_Cart.__config.apiUrl = __apiUrl;
		
		return Shopping_Cart;	
	},
	
	setTaxes: function (__taxes) 
	{
		var __taxes = $.parseJSON(__taxes);
		$.each(__taxes, function(index, value) {
			Shopping_Cart.__taxes[value.state_id] = value;
		})
		
		return Shopping_Cart;	
	},
	
	getTaxes: function (__stateId) 
	{
		var __taxes = false;
		
		if (Shopping_Cart.__currentTotal == 0) {
			return __taxes;
		}
		
		if (Shopping_Cart.__taxes.hasOwnProperty(parseInt(__stateId))) {
			__taxes = Shopping_Cart.__taxes[parseInt(__stateId)];
		}
		
		return __taxes;	
	},
	
	addTaxes: function (stateId) 
	{
		Shopping_Cart.clearTaxes();
		
		if (stateId == '') return;		
		if (Shopping_Cart.getCurrentTotal() == 0) return;
				
		taxes = Shopping_Cart.getTaxes(stateId);
		
		if (false !== taxes) {
			taxAmt = parseFloat((Shopping_Cart.getCurrentTotal() * taxes.total) / 100).toFixed(2);
			$('.taxes').find('.name').html(taxes.name + ' <small><b>(' + taxes.total + '%)</b></small>');
			$('.taxes').find('.taxTotal').html(taxAmt);
			$('.cart-footer .total').html(Shopping_Cart.getCurrentTotal() + parseFloat(taxAmt));
			$('.cart-footer .total').currency();
			$('.taxes').find('.taxTotal').currency();
		}
	},
	
	clearTaxes: function()
	{
		$('.taxes').find('.name').html('Tax');
		$('.taxes').find('.taxTotal').html('$0.00');
		$('.cart-footer .total').html(Shopping_Cart.getCurrentTotal());
		$('.cart-footer .total').currency();
	},
	
	setTrigger: function (__qtySelector) 
	{
		Shopping_Cart.__config.qtySelector = __qtySelector;
		
		return Shopping_Cart;	
	},
	
	setCurrentTotal: function (__currentTotal) 
	{
		Shopping_Cart.__currentTotal = __currentTotal;
		
		return Shopping_Cart;	
	},
	
	getCurrentTotal: function () 
	{
		return Shopping_Cart.__currentTotal;	
	},
	
	refresh: function (parts) 
	{
		$('.cart-footer .sub, .cart-footer .shipping, .cart-footer .total').html('$0.00');
		$('ul.cd-cart-items').empty();
		$.each(parts.items, function(index, element) {
            htmlData = $('<li>' +
                '<span class="cd-qty">' + element.qty + 'x</span> ' + element.title +
                ' <small>($' + element.price + ')</small><div class="cd-price">$' + element.total + '</div>' +
                '<a href="#0" class="cd-item-remove cd-img-replace" onclick="javascript:Shopping_Cart.remove(' + element.id + ')">' +
				'Remove</a>' +
            '</li>');
			
			$('ul.cd-cart-items').append(htmlData);
			$('.cart-footer .sub').html('$' + parts.subTotal);
			$('.cart-footer .shipping').html('$' + parts.shipping);
			$('.cart-footer .total').html(parts.total);
			$('.cart-footer .total').currency();
			$('.cart-footer .shipping').currency();
			$('.cart-footer .sub').currency();

			Shopping_Cart.__currentTotal = parts.total;
			Shopping_Cart.clearTaxes();
        });
	},
	
	reset: function () 
	{
		$('.cart-footer .sub, .cart-footer .shipping, .cart-footer .total').html('$0.00');
		$('ul.cd-cart-items').empty();
		$('input.partQty').val('');
		htmlData = $('<li>Your cart is empty.</li>');
		$('ul.cd-cart-items').append(htmlData);
		
		if ($('#cd-shadow-layer').hasClass('is-visible')) {
			$('#cd-shadow-layer').trigger('click');
		}
	},
	
	remove: function (partId) 
	{
		var pId = partId;
		return Shopping_Cart.process(0, partId, 0, function(__cart) {
			$('input[data-part-id="' + pId + '"]').val('');
			$('input[data-part-id="' + pId + '"]').parents('tr').removeClass('active');
		});
	},
	
	process: function (qty, partId, productId, fnAjaxUpdateCallback) 
	{
		fnAjaxUpdateCallback = (typeof(fnAjaxUpdateCallback) === "function") ? fnAjaxUpdateCallback : function() {};
		
		if (parseInt(qty) <= 0) {
			$('tr.tr_part_' + partId).removeClass('active');
		} else {
			$('tr.tr_part_' + partId).addClass('active');	
		}
		
		$.ajax({
			url: Shopping_Cart.__config.apiUrl,
			type: "POST",
			dataType : "html",
			cache : false,
			processData : true,
			data: {
				'qty': parseInt(qty),
				'partId': partId,
				'productId': productId
			},
			xhrFields : {
			  withCredentials : true
			},
			beforeSend: function () { },
			error: function (request) { 
				//alert(request) 
			},
			success: function (response) {
				var data = $.parseJSON(response);
				fnAjaxUpdateCallback(response);
				
				if (data.success == true) {
					fnAjaxUpdateCallback(response);
					// The action to take
					Shopping_Cart.refresh(data.cart);
				} 
			}
		});	
	},
	
	initialise: function (__fnCallback) 
	{
		__fnCallback = (typeof(__fnCallback) === "function") ? __fnCallback : function() {};
		
		$(document).ready(function(e) {
			var isMobile = false; //initiate as false
			// device detection
			if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
			    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
			
			if (false == isMobile) {
				$('#partsOrder').draggable({
					handle: ".partsOrder-header"
				});
			}
			
			/**
			 * Initialise the credit card entry form
			 */
			$('#card_number').validateCreditCard(function(result) {
	            /*
	            if (result.card_type == null) {
	                $('.vertical.maestro').slideUp({
	                    duration: 200
	                }).animate({
	                    opacity: 0
	                }, {
	                    queue: false,
	                    duration: 200
	                });
	                return;
	            }
	            */
				if (result.card_type == null) {
					return;
				}
				$(this).addClass(result.card_type.name);
	            /*
	            if (result.card_type.name === 'maestro') {
	                $('.vertical.maestro').slideDown({
	                    duration: 200
	                }).animate({
	                    opacity: 1
	                }, {
	                    queue: false
	                });
	            } else {
	                $('.vertical.maestro').slideUp({
	                    duration: 200
	                }).animate({
	                    opacity: 0
	                }, {
	                    queue: false,
	                    duration: 200
	                });
	            }
	            */
	            if (result.valid) {
	                return $(this).addClass('valid');
	            } else {
	                return $(this).removeClass('valid');
	            }
	        }, {
	            accept: ['visa', 'visa_electron', 'mastercard', 'maestro', 'discover']
	        });
			
			
			$('.partQty').on('keypress', function(event) {
				if (event.which == 13) {
					return $(this).parents('td').find('.addCart').trigger('click');
				}
				
				$(this).parents('td').find('.addCart').removeClass('hide');
			});
			
			$('.partQty').on('change', function(event) {
				$(this).parents('td').find('.addCart').removeClass('hide');
			});
			
			$("a[rel*=modal]").leanModal({
				closeButton: ".modal_close",
				onClose: function(event) {
					$('#partsOrder .error').addClass('hide').html('');
					$('.partsOrder-ct form')[0].reset();
					$('#partsOrder .country').trigger('change');
					$('.paymentInfoForm').fadeOut('fast');
				}
			});
			
			$('#partsOrder .country').on('change', function(event) {
				Shopping_Cart.clearTaxes();
				$target = $('#partsOrder .country_state_sel_' + $(this).val());
				if ($target.length) {
					$('#partsOrder .country_state_selector.active').find('option:first').attr('selected', 'selected');
					$('#partsOrder .country_state_selector.active').removeClass('active');
					$target.find('option:first').attr('selected', 'selected');
					$target.addClass('active');
				} else {
					$('.country_state_selector.active').removeClass('active');
				}
			});
			
			$('#partsOrder .state').on('change', function(event) {
				Shopping_Cart.addTaxes($(this).val());
			});
			
			$('.sendOrder').on('click', document, function(event) {
				event.preventDefault(); 
				$('#partsOrder form').addClass('loading');
				$('#partsOrder .error').addClass('hide').html('');
				
				email   		= $('#partsOrder .email_address').val(),
				companyName 	= $('#partsOrder .company_name').val(),
				companyAddress 	= $('#partsOrder .company_address').val(),
				storeNum 		= $('#partsOrder .store_number').val(),
				contact 		= $('#partsOrder .contact').val(),
				tel 			= $('#partsOrder .tel').val(),
				fax 			= $('#partsOrder .fax').val(),
				country			= $('#partsOrder .country').val(),
				state			= $('#partsOrder .country_state_selector.active').find('.state').val(),
				cardNum			= $('#partsOrder #card_number').val(),
				expDate			= $('#partsOrder #expiry_date').val(),
				cvv 			= $('#partsOrder #cvv').val(),
				cardname        = $('#partsOrder #name_on_card').val();
				
				
				if (email == '' || companyName == ''|| contact == '' || tel == '' || country == '' || state == '') {
					$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please complete all the required fields.' : 'Veuillez remplir tous les champs obligatoires'));
					$('#partsOrder form').removeClass('loading');
					return;
				}
				
				if (! new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/).test(email)) {
					$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please enter a valid email address.' : 'Veuillez entrer une adresse email valide.'));
					$('#partsOrder form').removeClass('loading');
					return;
				}
				
				if (! new RegExp(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/).test(tel)) {
					$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please enter a valid telephone number.' : 'Veuillez entrer un numero de telephone valide.'));
					$('#partsOrder form').removeClass('loading');
					return;
				}
				
				if (fax !== '' && ! new RegExp(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/).test(fax)) {
					$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please enter a valid fax number.' : 'Veuillez entrer un numero de fax valide.'));
					$('#partsOrder form').removeClass('loading');
					return;
				}
				
				// Validate credit card entry
				vCCardData = cardNum + expDate + cvv + cardname;
				if (vCCardData.length > 1) {
					if (cardNum == '') {
						$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please enter a valid credit card number.' : 'Veuillez entrer un numero de carte de credit valide.'));
						$('#partsOrder form').removeClass('loading');
						return;
					}
					
					if (expDate == '' || ! new RegExp(/([0-9]){1,2}\/([0-9]){2}/).test(expDate)) {
						$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please enter a valid expiry date.' : 'Veuillez entrer une date d\'expiration valide.'));
						$('#partsOrder form').removeClass('loading');
						return;
					}
					
					if (cvv == '' || isNaN(cvv)) {
						$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please enter a valid CVV.' : 'Veuillez entrer un CVV valide.'));
						$('#partsOrder form').removeClass('loading');
						return;
					}
					
					if (cardname == '') {
						$('#partsOrder .error').removeClass('hide').html((icl_lang  == 'en' ? 'Please enter a valid card holder name.' : 'Veuillez entrer un nom valide.'));
						$('#partsOrder form').removeClass('loading');
						return;
					}
				}
				
				$.ajax({
					type : "POST",
					url : window.location.href,
					dataType : "html",
					cache : false,
					processData : true,
					data: {
						'email': email,
						'companyName': companyName,
						'companyAddress': companyName,
						'country' : country,
						'state' : state,
						'storeNum' : storeNum,
						'contact' : contact,
						'tel' : tel,
						'fax' : fax,
						'cardNum': cardNum,
						'expDate': expDate,
						'cvv': cvv,
						'cardname': cardname
					},
					xhrFields : {
					  withCredentials : true
					},
					/**
					 * @param {?} textStatus
					 * @return {undefined}
					 */
					success : function(response) {
						var data = $.parseJSON(response);
						$('#partsOrder form').removeClass('loading');
						if (data.success == true) {
							$('#partsOrder .error').remove();
							$('#partsOrder form').html(icl_lang  == 'en' ? '<p>Thank you. Your order was sent.</p>' : '<p>Merci. Votre commande a été envoyé</p>');
							Shopping_Cart.reset();
							
						} else {
							// Handle something when wrong here...
							$('#partsOrder .error').removeClass('hide').html(data.error);
						}
						
						
					},
					/**
					 * @param {?} jqXHR
					 * @param {?} textStatus
					 * @param {?} origError
					 * @return {undefined}
					 */
					error : function(jqXHR, textStatus, origError) {
						$('#partsOrder form').removeClass('loading');
					},
					/**
					 * @return {undefined}
					 */
					complete : function() {
						$('#partsOrder form').removeClass('loading');
					}
				});
			});
			
			
			$('.addCart').on('click', function(event) {
				event.preventDefault();
				var trigger   = $(this),
					target    = $(trigger.attr('rel-target')),
					qty       = target.val(),
					partId    = target.attr('data-part-id'),
					productId = target.attr('data-product-id');
				 
				if (qty == '') {
					qty = 0;
				}
				
				if (isNaN(qty)) {
					target.val('');
					return;
				}
				
				if (qty < 0) {
					target.val('');
					return;
				}
				
				Shopping_Cart.process(qty, partId, productId, function(data) {
					target.addClass("flash");
					trigger.addClass('hide');
					setTimeout( function(){
						target.removeClass("flash");
					}, 1000);
				});
			});
			
            __fnCallback(Shopping_Cart);
        });
		
		return Shopping_Cart;	
	}
};



/*
 * jQuery Currency v0.6 ( January 2015 )
 * Simple, unobtrusive currency converting and formatting
 *
 * Copyright 2015, sMarty
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * http://coderspress.com
*
 */

(function ($) {

    $.fn.currency = function (method) {

        var methods = {

            init: function (options) {
                var settings = $.extend({}, this.currency.defaults, options);
                return this.each(function () {
                    var $element = $(this),
                        element = this;
                    var value = 0;

                    if ($element.is(':input')) {
                        value = $element.val();
                    } else {
                        value = $element.text();
                    }

                    if (helpers.isNumber(value)) {
                        if (settings.convertFrom != '') {

                            if ($element.is(':input')) {
                                $element.val(value + ' ' + settings.convertLoading);
                            } else {
                                $element.html(value + ' ' + settings.convertLoading);
                            }

                            $.post(settings.convertLocation, {
                                amount: value,
                                from: settings.convertFrom,
                                to: settings.region
                            }, function (data) {
                                value = data;

                                if ($element.is(':input')) {
                                    $element.val(helpers.format_currency(value, settings));
                                } else {
                                    $element.html(helpers.format_currency(value, settings));
                                }
                            });
                        } else {

                            if ($element.is(':input')) {
                                $element.val(helpers.format_currency(value, settings));
                            } else {
                                $element.html(helpers.format_currency(value, settings));
                            }

                        }
                    }
                });
            },
        }

        var helpers = {
            format_currency: function (amount, settings) {
                var bc = settings.region;
                var currency_before = '';
                var currency_after = '';
                if (bc == 'ALL') currency_before = 'Lek';
                if (bc == 'ARS') currency_before = '$';
                if (bc == 'AWG') currency_before = 'f';
                if (bc == 'AUD') currency_before = '$';
                if (bc == 'BSD') currency_before = '$';
                if (bc == 'BBD') currency_before = '$';
                if (bc == 'BYR') currency_before = 'p.';
                if (bc == 'BZD') currency_before = 'BZ$';
                if (bc == 'BMD') currency_before = '$';
                if (bc == 'BOB') currency_before = '$b';
                if (bc == 'BAM') currency_before = 'KM';
                if (bc == 'BWP') currency_before = 'P';
                if (bc == 'BRL') currency_before = 'R$';
                if (bc == 'BND') currency_before = '$';
                if (bc == 'CAD') currency_before = '$';
                if (bc == 'KYD') currency_before = '$';
                if (bc == 'CLP') currency_before = '$';
                if (bc == 'CNY') currency_before = '&yen;';
                if (bc == 'COP') currency_before = '$';
                if (bc == 'CRC') currency_before = 'c';
                if (bc == 'HRK') currency_before = 'kn';
                if (bc == 'CZK') currency_before = 'Kc';
                if (bc == 'DKK') currency_before = 'kr';
                if (bc == 'DOP') currency_before = 'RD$';
                if (bc == 'XCD') currency_before = '$';
                if (bc == 'EGP') currency_before = '&pound;';
                if (bc == 'SVC') currency_before = '$';
                if (bc == 'EEK') currency_before = 'kr';
                if (bc == 'EUR') currency_before = '&euro;';
                if (bc == 'FKP') currency_before = '&pound;';
                if (bc == 'FJD') currency_before = '$';
                if (bc == 'GBP') currency_before = '&pound;';
                if (bc == 'GHC') currency_before = 'c';
                if (bc == 'GIP') currency_before = '&pound;';
                if (bc == 'GTQ') currency_before = 'Q';
                if (bc == 'GGP') currency_before = '&pound;';
                if (bc == 'GYD') currency_before = '$';
                if (bc == 'HNL') currency_before = 'L';
                if (bc == 'HKD') currency_before = '$';
                if (bc == 'HUF') currency_before = 'Ft';
                if (bc == 'ISK') currency_before = 'kr';
                if (bc == 'IDR') currency_before = 'Rp';
                if (bc == 'IMP') currency_before = '&pound;';
                if (bc == 'JMD') currency_before = 'J$';
                if (bc == 'JPY') currency_before = '&yen;';
                if (bc == 'JEP') currency_before = '&pound;';
                if (bc == 'LVL') currency_before = 'Ls';
                if (bc == 'LBP') currency_before = '&pound;';
                if (bc == 'LRD') currency_before = '$';
                if (bc == 'LTL') currency_before = 'Lt';
                if (bc == 'MYR') currency_before = 'RM';
                if (bc == 'MXN') currency_before = '$';
                if (bc == 'MZN') currency_before = 'MT';
                if (bc == 'NAD') currency_before = '$';
                if (bc == 'ANG') currency_before = 'f';
                if (bc == 'NZD') currency_before = '$';
                if (bc == 'NIO') currency_before = 'C$';
                if (bc == 'NOK') currency_before = 'kr';
                if (bc == 'PAB') currency_before = 'B/.';
                if (bc == 'PYG') currency_before = 'Gs';
                if (bc == 'PEN') currency_before = 'S/.';
                if (bc == 'PLN') currency_before = 'zl';
                if (bc == 'RON') currency_before = 'lei';
                if (bc == 'SHP') currency_before = '&pound;';
                if (bc == 'SGD') currency_before = '$';
                if (bc == 'SBD') currency_before = '$';
                if (bc == 'SOS') currency_before = 'S';
                if (bc == 'ZAR') currency_before = 'R';
                if (bc == 'SEK') currency_before = 'kr';
                if (bc == 'CHF') currency_before = 'CHF';
                if (bc == 'SRD') currency_before = '$';
                if (bc == 'SYP') currency_before = '&pound;';
                if (bc == 'TWD') currency_before = 'NT$';
                if (bc == 'TTD') currency_before = 'TT$';
                if (bc == 'TRY') currency_before = 'TL';
                if (bc == 'TRL') currency_before = '&pound;';
                if (bc == 'TVD') currency_before = '$';
                if (bc == 'GBP') currency_before = '&pound;';
                if (bc == 'USD') currency_before = '$';
                if (bc == 'UYU') currency_before = '$U';
                if (bc == 'VEF') currency_before = 'Bs';
                if (bc == 'ZWD') currency_before = 'Z$';
                if (currency_before == '' && currency_after == '') currency_before = '$';
                var output = '';

                if (!settings.hidePrefix) output += currency_before;
                output += helpers.number_format(amount, settings.decimals, settings.decimal, settings.thousands);

                if (!settings.hidePostfix) output += currency_after;
                return output;
            },

            // Kindly borrowed from http://phpjs.org/functions/number_format
            number_format: function (number, decimals, dec_point, thousands_sep) {
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };

                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }

                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            },
            isNumber: function (n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }
        }

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method "' + method + '" does not exist in currency plugin!');
        }
    }

    $.fn.currency.defaults = {
        region: "USD", // The 3 digit ISO code you want to display your currency in
        thousands: ",", // Thousands separator
        decimal: ".", // Decimal separator
        decimals: 2, // How many decimals to show
        hidePrefix: false, // Hide any prefix
        hidePostfix: false, // Hide any postfix
        convertFrom: "", // If converting, the 3 digit ISO code you want to convert from,
        convertLoading: "(Converting...)", // Loading message appended to values while converting
        convertLocation: "convert.php" // Location of convert.php file
    }

    $.fn.currency.settings = {}

})(jQuery);