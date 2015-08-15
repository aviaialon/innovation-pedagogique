var Parts_Search = Parts_Search || {
	__lang: 'en',
	__config: {},
	__source: {},
	__filters: {},
	__searchPageUrl: null,
	
	setLang: function (__lang__) {
		Parts_Search.__lang = __lang__;
	},
	
	setConfig: function (__config__) {
		Parts_Search.__config = __config__;
	},
	
	setSearchPageUrl: function (__url__) {
		Parts_Search.__searchPageUrl = __url__;
	},
	
	setSources: function (__data__) {
		Parts_Search.__source = __data__;
	},
	
	setFilters: function (__data__) {
		Parts_Search.__filters = __data__;
	},
	
	translate: function (a, b) {
		return (Parts_Search.__lang == 'fr' ? b : a);
	},
	
	inViewport: function($el) {
		var elH = $el.outerHeight(),
			H   = jQuery(window).height(),
			r   = $el[0].getBoundingClientRect(), t=r.top, b=r.bottom;
		return Math.max(0, t>0? Math.min(elH, H-t) : (b<H?b:H));
	},
	
	init : function () {
		jQuery(document).ready(function($) {
            $('#__keyword').typeahead({
				minLength: 3,
				maxItem: 4,
				order: "asc",
				group: true,
				hint: true,
				list: true,
				dynamic: true,
				display: 'title',
				defaultSource: Parts_Search.translate('All Categories', 'Toute Categories'),
				delay: 200,
				backdrop: {
					"background-color": "#F8F8F8"
				},
				template: '<div>' +
					'<div class="productImg">' +
						'<img src="{{mainImage}}" />' +
					'</div>' +
					'<div class="productInfo">' +
						'<span class="title">{{title}} <small>{{excerpt}}</small></span>' +
					'</div>' +
				'</div>',
				filter: Parts_Search.translate('All Categories', 'Toute Categories'),
				source: Parts_Search.__source,
				catFilters: Parts_Search.__filters,
				debug: false,
				callback: {
					onClick: function (node, a, obj, e) {
						if (typeof obj.id !== "undefined") {
							$('#__productId').val(obj.urlProductKey);	
						}
					},
					
					onSubmit: function (node, form, e) {
						redirectUrl = Parts_Search.__searchPageUrl + '?q=' + $('#__keyword').val();
						if ($('#__productId').val() != '') {
							redirectUrl = Parts_Search.__searchPageUrl + '?q=' + $('#__productId').val();
						}
						
						window.location.href = redirectUrl;
					},
					
					onSeeAll: function (event) {
						window.location.href = Parts_Search.__searchPageUrl + '?q=' + $('#__keyword').val();
					}
				}	
			});
        });
	}
};
