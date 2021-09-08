	/*!
		* strength.js
		* Original author: @aaronlumsden
		* Further changes, comments: @aaronlumsden
		* Licensed under the MIT license
	*/
	;(function ( $, window, document, undefined ) {
		
		var pluginName = "strength", total = "",
        defaults = {
            strengthConfirmPass: false,
            strengthClass: 'strength',
            strengthMeterClass: 'strength_meter',
            strengthButtonClass: 'button_strength',
            strengthButtonText: 'Show Password',
            strengthButtonTextToggle: 'Hide Password'
		};
		
		// $('<style>body { background-color: red; color: white; }</style>').appendTo('head');
		
		function Plugin( element, options ) {
			this.element        = element;
			this.$elem          = $(this.element);
			this.options        = $.extend( {}, defaults, options );
			this.elementRepeat  = $('#'+this.options.strengthConfirmPass);
			this._defaults      = defaults;
			this._name          = pluginName;

			this.init();
			this.repeatPassword();
            
		}
		Plugin.prototype = {
			
			init: function() {
				
				var characters = 0;
				var capitalletters = 0;
				var loweletters = 0;
				var number = 0;
				var special = 0;
				
				var upperCase= new RegExp('[A-Z]');
				var lowerCase= new RegExp('[a-z]');
				var numbers = new RegExp('[0-9]');
				var specialchars = new RegExp('([!,%,&,@,#,$,^,*,?,_,~])');
				
				var thisConfirmid = this.options.strengthConfirmPass;
				$('#'+thisConfirmid).attr('disabled','disabled');
				
				// Find the submit button of the validate password form and add the class as identifier
				var btnSumbit = this.$elem.closest( "form" ).find('button[type=submit]');
				btnSumbit.attr('disabled','disabled');
				
				function GetPercentage(a, b) {
					return ((b / a) * 100);
				}
				
				function check_strength(thisval, thisid, thisRepeatid){
					if (thisval.length > 8) { characters = 1; } else { characters = 0; };
					if (thisval.match(upperCase)) { capitalletters = 1} else { capitalletters = 0; };
					if (thisval.match(lowerCase)) { loweletters = 1}  else { loweletters = 0; };
					if (thisval.match(numbers)) { number = 1}  else { number = 0; };
					if (thisval.match(specialchars)) { special = 1}  else { special = 0; };
					
					total = characters + capitalletters + loweletters + number + special;
					//var totalpercent = GetPercentage(7, total).toFixed(0);
					get_total(total, thisid, thisRepeatid);
				}
				
				function get_total(total, thisid, thisRepeatid){
					var thismeter = $('div[data-meter="'+thisid+'"]');

                    thismeter.removeClass();
                    $('#'+thisConfirmid).attr('disabled','disabled');
                    $('input[type="text"][data-password="'+thisConfirmid+'"]').attr('disabled','disabled');
                    btnSumbit.attr('disabled','disabled');

					if(total == 0){
						thismeter.removeClass().siblings().html('');
                        $('#'+thisConfirmid + ', input[type="text"][data-password="'+thisConfirmid+'"]').val('');
                    }else if (total <= 1) {
						thismeter.addClass('veryweak').siblings().html('<p class="p_veryweak">Fuerza: muy débil</p>');
                    } else if (total == 2){
						thismeter.addClass('weak').siblings().html('<p class="p_weak">Fuerza: débil</p>');
                    } else if(total == 3){
						thismeter.addClass('medium').siblings().html('<p class="p_medium">Fuerza: medio</p>');
                    } else if(total == 4){
						thismeter.addClass('strong').siblings().html('<p class="p_strong">Fuerza: fuerte</p>');
                    } else {
						thismeter.addClass('verystrong').siblings().html('<p class="p_verystrong">Fuerza: cumple con los parametros</p>');
						$('#'+thisConfirmid + ', input[type="text"][data-password="'+thisConfirmid+'"]').removeAttr('disabled');
						btnSumbit.removeAttr('disabled');
                        
                        if($.trim($('#'+thisConfirmid + ', input[type="text"][data-password="'+thisConfirmid+'"]').val()).length == 0){
                            $(this).parent().removeClass('has-error');
                        }
					}
				}
				var isShown = false;
				var strengthButtonText = this.options.strengthButtonText;
				var strengthButtonTextToggle = this.options.strengthButtonTextToggle;
				
				thisid = this.$elem.attr('id');
				thisidR = this.elementRepeat.attr('id');
				
				this.$elem.addClass(this.options.strengthClass).attr('data-password',thisid).after('<input style="display:none" class="form-control m-t-xxs '+this.options.strengthClass+'" data-password="'+thisid+'" type="text" name="" value=""><span class="input-group-addon"><a data-password-button="'+thisid+'" href="" class="'+this.options.strengthButtonClass+'">'+this.options.strengthButtonText+'</a></span><div class="'+this.options.strengthMeterClass+'"><div data-meter="'+thisid+'"></div><p></p></div>');
				


				// Password
				this.$elem.bind('keyup keydown', function(event) {
					thisval = $('#'+thisid).val();
					$('input[type="text"][data-password="'+thisid+'"]').val(thisval);
					check_strength(thisval, thisid, thisidR);
				});
				
				$('input[type="text"][data-password="'+thisid+'"]').bind('keyup keydown', function(event) {
					thisval = $('input[type="text"][data-password="'+thisid+'"]').val();
					$('input[type="password"][data-password="'+thisid+'"]').val(thisval);
					check_strength(thisval, thisid, thisidR);
				});
				
				$(document.body).on('click', '.'+this.options.strengthButtonClass, function(e) {
					e.preventDefault();
					
					thisclass = 'hide_'+$(this).attr('class');
					
					if (isShown) {
						$('input[type="text"][data-password="'+thisid+'"]').hide();
						$('input[type="password"][data-password="'+thisid+'"]').show().focus();
						$('a[data-password-button="'+thisid+'"]').removeClass(thisclass).html(strengthButtonText);
						isShown = false;
                    } else {
						$('input[type="text"][data-password="'+thisid+'"]').show().focus();
						$('input[type="password"][data-password="'+thisid+'"]').hide();
						$('a[data-password-button="'+thisid+'"]').addClass(thisclass).html(strengthButtonTextToggle);
						isShown = true;
					}
				});
			},
			
			repeatPassword: function(el, options) {
				
				thiRepeatsId = this.elementRepeat.attr('id');
                
                var isShownRepeat = false;
 
				this.elementRepeat.addClass(this.options.strengthClass).attr('data-password',thiRepeatsId).after('<input style="display:none" class="form-control m-t-xxs '+this.options.strengthClass+'" data-password="'+thiRepeatsId+'" type="text" name="" value=""><span class="input-group-addon"><a data-password-button="'+thiRepeatsId+'" href="" class="link_'+thiRepeatsId +'">'+this.options.strengthButtonText+'</a></span><div class="'+this.options.strengthMeterClass+'_pass '+  thiRepeatsId+'"><p class="text-right" style="color:#e35b5a;"></p></div>');

                // al presionar una tecla en cualquier  input
                $('#'+thiRepeatsId + ', input[type="text"][data-password="'+thiRepeatsId+'"]').bind('keyup keydown', function(event) {
                    var ValuePass = $('#'+thisid).val();
                    var ValueConfirmPass = $(this).val();
                    var btnSumbit = $('#'+thiRepeatsId).closest( "form" ).find('button[type=submit]');
                    if(total == 5){
                        // si repetir password es la misma que password
                        if(ValueConfirmPass == ValuePass ){
                            //console.log('div.'+thiRepeatsId+' p.text-right');
                            //console.log(btnSumbit);
                            $('div.'+thiRepeatsId+' p.text-right').parent().parent().removeClass('has-error');
                            $('div.'+thiRepeatsId+' p.text-right').html('');
                            btnSumbit.removeAttr('disabled');
                        }else{
                            $('div.'+thiRepeatsId+' p.text-right').parent().parent().addClass('has-error');
                            $('div.'+thiRepeatsId+' p.text-right').html('Las contraseñas no coinciden');
                            btnSumbit.attr('disabled','disabled');
                        }
                    }
                });
                				
				$('#'+thiRepeatsId).bind('keyup keydown', function(event) {
					thisvalRepeat = $('#'+thiRepeatsId).val();
					$('input[type="text"][data-password="'+thiRepeatsId+'"]').val(thisvalRepeat);
				});
				
				$('input[type="text"][data-password="'+thiRepeatsId+'"]').bind('keyup keydown', function(event) {
					thisvalRepeat = $('input[type="text"][data-password="'+thiRepeatsId+'"]').val();
					$('input[type="password"][data-password="'+thiRepeatsId+'"]').val(thisvalRepeat);
				});
				
				$(document.body).on('click', '.link_'+thiRepeatsId, function(e) {
					e.preventDefault();
					thisclass = 'hide_'+$(this).attr('class');
					
					if($('input[type="password"][data-password="'+thiRepeatsId+'"]').prop( "disabled" )){
						$('input[type="text"][data-password="'+thiRepeatsId+'"]').attr('disabled','disabled');
                    }else{
						$('input[type="text"][data-password="'+thiRepeatsId+'"]').removeAttr('disabled');
					}
					
					if (isShownRepeat) {
						$('input[type="text"][data-password="'+thiRepeatsId+'"]').hide();
						$('input[type="password"][data-password="'+thiRepeatsId+'"]').show().focus();
						isShownRepeat = false;
					} else {
						$('input[type="text"][data-password="'+thiRepeatsId+'"]').show().focus();
						$('input[type="password"][data-password="'+thiRepeatsId+'"]').hide();
						isShownRepeat = true;
					}
				});
			}
		};
		
		// A really lightweight plugin wrapper around the constructor,
		// preventing against multiple instantiations
		$.fn[pluginName] = function ( options ) {
			//console.log(this);
			return this.each(function () {
				if (!$.data(this, "plugin_" + pluginName)) {
					$.data(this, "plugin_" + pluginName, new Plugin( this, options ));
				}
			});
		};
	})( jQuery, window, document );