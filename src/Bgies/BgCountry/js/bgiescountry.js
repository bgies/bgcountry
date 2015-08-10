/*! Bgies Country 0.1.1
 * �2015 bgies Enterprises Limited
 */

/**
 * @summary     Bgies Country State City
 * @description Easy  Country, Province/State, and City Selects
 * @version     0.1.1
 * @file        bigescountry.js
 * @author      Brad Gies - bgies Enterprises Limited (bgies.com)
 * @contact     bgies.com/contact
 * @copyright   Copyright 2015 bgies Enterprises Limited.
 *
 * This source file is free software, available under the following license:
 *   MIT license - http://datatables.net/license/mit
 *
 * This source file is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 *
 * For details please refer to: http://bgies.com
 */
$(function() {
	// the widget definition, where "bgies" is the namespace,
	// "country" the widget name
	$.widget("bgies.bgcountry", {
		// default options
		options : {
			countrySelect : 'bgc-country-sel',
			provinceSelect : 'bgc-province-sel',
			citySelect : 'bgc-city-sel',
			countryVal : '',
			provinceVal : '',
			cityVal : '',
			showProvinceMessage: true,
			showCityMessage: true,
			
			debug: false,
		    // callbacks
			countryChange : null,
			provinceChange : null,
			cityChange : null
		},
		

		// the constructor
		_create : function() {
			// first just get the selectors for the elements, so we don't need to compose them all the time
			// makes the code easier to read :) 
			this._wrapElementId = jQuery(this.element).attr('id');
			
			this._countrySelector = '#' + this._wrapElementId + ' .' +  this.options.countrySelect;
			this._countryText = jQuery(this._countrySelector).siblings('input[type=text]');   //('input.bgc-country-text') ;
			
			this._provinceSelector = '#' + this._wrapElementId + ' .' +  this.options.provinceSelect;
			this._provinceText = jQuery(this._countrySelector).siblings('input.bgc-country-text') ;
			
			this._citySelector = '#' + this._wrapElementId + ' .' +  this.options.citySelect;
			this._cityText = jQuery(this._countrySelector).siblings('input.bgc-country-text') ;
			
			// make debugging easy, so log stuff to the console.
			if (this.options.debug) {
				
				this._citySel = jQuery('#' + this._wrapElementId + ' .' +  this.options.citySelect);
				this._cityText = jQuery(this._citySel).siblings('input.text') ;
				
				console.log("wrap element: " + this._wrapElementId);
				console.log("Country Selector: " + jQuery(this._countrySelector));
				console.log("Country Text Input: " + jQuery(this._countryText).attr('name'));
				console.log("Province Selector: " + jQuery(this._provinceSelector));
				console.log("Province Text Input: " + jQuery(this._provinceText).attr('name'));
				console.log("City Select: " + jQuery(this._citySelector));
				console.log("City Text Input: " + jQuery(this._cityText).attr('name'));
			}
			
			// first hookup the onchange events, that way if we have to fill the options
			// and set the value, the onchange event can handle the cascading.
			jQuery(this._countrySelector).change({param1: this}, this._countryChange);
			jQuery(this._provinceSelector).change({param1: this}, this._provinceChange);
			jQuery(this._citySelector).change({param1: this}, this._cityChange);
       	    
       	    // hide everything that should be hidden in case the form is not perfectly setup
       	    this._hideCountryText();
       	    this._hideProvinceText();
       	    this._hideCityText();
       	    
			// if the country doesn't have options yet, bring them in and set the value if we need to.
			var cOptLen = jQuery(this._countrySelector + ' option').length;
			// the website could have only one country defined, with a blank entry
			// so I need to accept 2 or more  
			if (cOptLen < 3) {
				this._getSelectOptions(this._countrySelector, this._countryText);
				// if we didn't have country options the getSelectOptions and Cascade
				// should finish for us
				return;
			}
			// if we had country options, and we have a passed in country value, 
			// set the value 
			var countryVal =  jQuery(this._countrySelector).val();
			if (this.options.countryVal !== '') {
				jQuery(this._countrySelector).val(this.options.countryVal);
				// if we have a country value, we should have province options also.
				// if not, get them. 
				cOptLen = jQuery(this._provinceSelector + ' option').length;
				if (cOptLen < 3) {
					this._getSelectOptions(this._provinceSelector);
					return;
				}
				if (this.options.provinceVal !== '') {
					jQuery(this._provinceSelector).val(this.options.provinceVal);
					// if we have a province value, we should have city options also.
					// if not, get them. 
					cOptLen = jQuery(this._citySelector + ' option').length;
					if (cOptLen < 3) {
						this._getSelectOptions(this._citySelector);
						return;
					}
					// if we have city options, and a value, set the value
					if (this.options.cityVal !== '') {
						jQuery(this._citySelector).val(this.options.cityVal);
					}
				}
				
			}
        },
		
        _clearCityData: function() {
        	jQuery(this._citySelector).find('option').remove().end();
        	jQuery(this._citySelector).siblings('input[type=text]').val('');
        },
        
        _hideCountryText: function() {
        	jQuery(this._countrySelector).siblings('input').hide();
        	jQuery(this._countrySelector).show();        	
        },
        _hideCountrySelect: function() {
        	jQuery(this._countrySelector).hide();
        	jQuery(this._countrySelector).siblings('input').show();
        },
        _hideProvinceText: function() {
        	jQuery(this._provinceSelector).siblings().hide();
        	jQuery(this._provinceSelector).show();
        },
        _hideProvinceSelect: function() {
        	jQuery(this._provinceSelector).hide();        	
        	jQuery(this._provinceSelector).siblings().show();
        },
        _hideCityText: function() {
        	jQuery(this._citySelector).siblings().hide();
        	jQuery(this._citySelector).show();
        },
        _hideCitySelect: function() {
        	jQuery(this._citySelector).hide();
        	jQuery(this._citySelector).siblings().show();
        },
        
        _countryChange(ev) {
        	var that = ev.data.param1;
        	
        	var curVal = jQuery(that._countrySelector).val();
        	jQuery(that._countryText).val(curVal);
        	// clear the province data
        	jQuery(that._provinceSelector).find('option').remove().end();
        	jQuery(that._provinceSelector).siblings('input[type=text]').val('');//find('option').remove().end();
        	// clear the city data
        	that._clearCityData();
        	
        	that._getSelectOptions(that._provinceSelector);
        },
        
        _provinceChange(ev) {
        	var that = ev.data.param1;
        	// clear the city data
        	that._clearCityData();
        	
        	that._getSelectOptions(that._citySelector);
        },
        
        _getCities(ev) {
        	var that = ev.data.param1;
        	that._getSelectOptions(that._citySelector);
        },
        

		_getSelectOptions: function(elementSelector) {
      	  	var sendUrl = jQuery(elementSelector).attr('data-url');
      	  	if (sendUrl.indexOf('{bgc-country}') !== -1) {
      	  		var countryVal = jQuery(this._countrySelector).val();
      	  		sendUrl = sendUrl.replace('{bgc-country}', countryVal);
      	  	}
      	  	if (sendUrl.indexOf('{bgc-province}') !== -1) {
      	  		var provinceVal = jQuery(this._provinceSelector).val();
      	  		sendUrl = sendUrl.replace('{bgc-province}', provinceVal);
      	  	}

      	    this._sendAndFill(sendUrl, elementSelector);
		},
		         
     	_sendAndFill: function(url, elementSelector) {
     		var that = this;
     		
     		jQuery.ajax({
	   		   type: "GET",
	   		   url: url,
	   		   error: function(data){
	   			   // if we can't get the file, then hide the selector and show the text
	   			 switch(elementSelector) {
	   			 	case that._countrySelector: 
	   			 		that._hideCountrySelect();
	   			 		that._hideProvinceSelect();
	   			 		that._hideCitySelect();
	   			 		if (that.options.countryVal.length > 0) {
	   			 			jQuery(that._countryText).html(that.options.countryVal);
	   			 		}
	   			 		break;
	   			 	case that._provinceSelector: 
	   			 		that._hideProvinceSelect();
	   			 		that._hideCitySelect();
	   			 		if (that.options.provinceVal.length > 0) {
	   			 			jQuery(that._provinceText).html(that.options.provinceVal);
	   			 		}
	   			 		break;
	   			 	case that._citySelector: 
	   			 		that._hideCitySelect();
	   			 		if (that.options.cityVal.length > 0) {
	   			 			jQuery(that._cityText).html(that.options.cityVal);
	   			 		}	   			 		
	   			 		break;
	   			 }  
	   		   },
   			   success: function(data){
	   			 jQuery(elementSelector).empty();
	   			 jQuery(elementSelector).html(data); 
	   			 switch (elementSelector) {
	        	    case that._countrySelector:
	   			 		that._hideCountryText();
	   			 		that._hideProvinceText();
	   			 		that._hideCityText();
	   			 		if (that.options.countryVal.length > 0) {
	   			 			jQuery(that._countrySelector).val(that.options.countryVal);
	   			 			that._getSelectOptions(that._provinceSelector);
	   			 		}
	 	        	 	break;
	       	 	    case that._provinceSelector:
	   			 		that._hideProvinceText();
	   			 		that._hideCityText();
	   			 		if (that.options.provinceVal.length > 0) {
	   			 			jQuery(that._provinceSelector).val(that.options.provinceVal);
		   			 	    that._getSelectOptions(that._citySelector);	   			 			
	   			 		}
         	 		    break;
	       	 	    case that._citySelector:
	   			 		that._hideCityText();
	   			 		if (that.options.cityVal.length > 0) {
	   			 			jQuery(that._citySelector).val(that.options.cityVal);
	   			 		}	   			 		
	       	 	    	break;
  	             }
	   		   }
	   		});
	    },
				
		// events bound via _on are removed automatically
		// revert other modifications here
		_destroy : function() {
			// remove generated elements
			this.bgcountry.remove();
		},

		_setOptions : function() {
			this._superApply(arguments);
		},

		_setOption : function(key, value) {
			this._super(key, value);
		}
	});

});