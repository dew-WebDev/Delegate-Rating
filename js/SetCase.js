(function($) {
  //Create plugin named Setcase
 $.fn.Setcase = function(settings) {
        // Defaults
		var config = {
			caseValue: 'Upper',
			changeonFocusout: false
		};
		
		//Merge settings
		if(settings) $.extend(config, settings);
		
	this.each(function() {
        //keypress event
		if(config.changeonFocusout == false)
		{
			if ($(this).attr('name').toLowerCase().indexOf('email') == -1 && $(this).attr('name').toLowerCase().indexOf('website') == -1 && $(this).attr('name').toLowerCase().indexOf('txtcowsite') == -1)
			{
				$(this).keypress(function(){
					if(config.caseValue == "upper")
					{
						var currVal = $(this).val();
						//console.log(currVal);
						//console.log(currVal.toUpperCase());
						$(this).val(currVal.toUpperCase());
					}
					else if(config.caseValue == "lower")
					{
						var currVal = $(this).val();
						$(this).val(currVal.toLowerCase());
					}
					else if(config.caseValue == "title")
					{
						var currVal = $(this).val();
						$(this).val(currVal.charAt(0).toUpperCase() + currVal.slice(1).toLowerCase());
					}
					else if(config.caseValue == "pascal")
					{
						var currVal = $(this).val();
						currVal = currVal.toLowerCase().replace(/\b[a-z]/g, function(txtVal) {
							return txtVal.toUpperCase();
						});
						$(this).val(currVal);
					}
				});
			}
		}
        //blur event		
		if ($(this).attr('name').toLowerCase().indexOf('email') == -1 && $(this).attr('name').toLowerCase().indexOf('website') == -1 && $(this).attr('name').toLowerCase().indexOf('txtcowsite') == -1)
		{
			$(this).blur(function(){
				 if(config.caseValue == "upper")
				{
					var currVal = $(this).val();
					$(this).val(currVal.toUpperCase());
				}
				else if(config.caseValue == "lower")
				{
					var currVal = $(this).val();
					$(this).val(currVal.toLowerCase());
				}
				else if(config.caseValue == "title")
				{
					var currVal = $(this).val();
					$(this).val(currVal.charAt(0).toUpperCase() + currVal.slice(1).toLowerCase());
				}
				else if(config.caseValue == "pascal")
				{
					var currVal = $(this).val();
					currVal = currVal.toLowerCase().replace(/\b[a-z]/g, function(txtVal) {
						return txtVal.toUpperCase();
					});
					$(this).val(currVal);
				}
			});
		}
	});
 };
})(jQuery);
