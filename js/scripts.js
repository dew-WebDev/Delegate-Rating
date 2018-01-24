$(function() {
	$('#navbar').affix({
		offset: {
			top: 200
		}
	});

	$("pre.html").snippet("html", {style:'matlab'});
	$("pre.css").snippet("css", {style:'matlab'});
	$("pre.javascript").snippet("javascript", {style:'matlab'});
	
	
	$('#cfg-contactform-buyer').easyWizard({
		buttonsClass: 'btn btn-default',
		submitButtonClass: 'btn btn-info',
		before: function(wizardObj, currentStepObj, nextStepObj) {
				if($(currentStepObj).attr('name') == 'page1' && $(nextStepObj).attr('name') == 'page2')
				{
					return SaveForm2();				
				}
				else if($(currentStepObj).attr('name') == 'page2' && $(nextStepObj).attr('name') == 'page3')
				{
					return SaveForm();
				}
				else if($(currentStepObj).attr('name') == 'page3' && $(nextStepObj).attr('name') == 'page4')
				{
					return SaveForm1();
				}
				else if($(currentStepObj).attr('name') == 'page4' && $(nextStepObj).attr('name') == 'page5')
				{
					if(checkValidateBuyer())
					{
					ajaxPostBuyer();
					return true;
					}
					return false;
				}
				return true;
			},
		after: function(wizardObj, prevStepObj, currentStepObj) {
			if($(currentStepObj).attr('name') == 'page6')
			{
				$(currentStepObj).css({'float':'', 'width':'700px', 'margin-left':'auto', 'margin-right':'auto'});
				$(".submit").attr('disabled', true);
				$("#chkagree").prop("checked", false);
				window.onbeforeunload = function() {
				};
		
			}
			else
			{
				window.onbeforeunload = function() {
				  return "Your changes might be lost. Are you sure you wish to leave this page?";
				}
			}
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		}
	});

	$('#cfg-contactform-seller').easyWizard({
		buttonsClass: 'btn',
		submitButtonClass: 'btn btn-info',
		before: function(wizardObj, currentStepObj, nextStepObj) {
				if($(currentStepObj).attr('name') == 'page1' && $(nextStepObj).attr('name') == 'page2')
				{
					ajaxResponse();
					getValue();
					return SaveForm();
				}
				else if($(currentStepObj).attr('name') == 'page2' && $(nextStepObj).attr('name') == 'page3')
				{
					return checkOperatingRegion() && checkBadgeName();
				}
				else if($(currentStepObj).attr('name') == 'page3' && $(nextStepObj).attr('name') == 'page4')
				{
					return SaveForm1();
				}
				else if($(currentStepObj).attr('name') == 'page4' && $(nextStepObj).attr('name') == 'page5')
				{
					if(checkValidate())
					{
					ajaxPost();
					return true;
					}
					return false;
				}
				return true;
			},
		after: function(wizardObj, prevStepObj, currentStepObj) {
			
			if($(currentStepObj).attr('name') == 'page6')
			{
				$(currentStepObj).css({'float':'', 'width':'700px', 'margin-left':'auto', 'margin-right':'auto'});
				$(".submit").attr('disabled', true);
				$("#chkagree").prop("checked", false);
				window.onbeforeunload = function() {
				};
		
			}
			else
			{
				window.onbeforeunload = function() {
				  return "Your changes might be lost. Are you sure you wish to leave this page?";
				}
			}
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		}
	});
	
	$('#cfg-contactform-seller_update').easyWizard({
		buttonsClass: 'btn',
		submitButtonClass: 'btn btn-info',
		before: function(wizardObj, currentStepObj, nextStepObj) {
				if($(currentStepObj).attr('name') == 'page1' && $(nextStepObj).attr('name') == 'page2')
				{
					ajaxResponse();
					getValue();
					return SaveForm();
				}
				else if($(currentStepObj).attr('name') == 'page2' && $(nextStepObj).attr('name') == 'page3')
				{
					return checkOperatingRegion() && checkBadgeName();
				}
				else if($(currentStepObj).attr('name') == 'page3' && $(nextStepObj).attr('name') == 'page4')
				{
					return SaveForm1();
				}
				else if($(currentStepObj).attr('name') == 'page4' && $(nextStepObj).attr('name') == 'page5')
				{
					if(checkValidate())
					{
					ajaxPost();
					return true;
					}
					return false;
				}
				return true;
			},
		after: function(wizardObj, prevStepObj, currentStepObj) {
			
			if($(currentStepObj).attr('name') == 'page6')
			{
				$(currentStepObj).css({'float':'', 'width':'700px', 'margin-left':'auto', 'margin-right':'auto'});
				$("#chkagree").attr('disabled', true);
				$("#chkagree").prop("checked", true);
				window.onbeforeunload = function() {
				};
		
			}
			else
			{
				window.onbeforeunload = function() {
				  return "Your changes might be lost. Are you sure you wish to leave this page?";
				}
			}
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		}
	});
	
	$('#cfg-contactform-buyer_udpate').easyWizard({
		buttonsClass: 'btn btn-default',
		submitButtonClass: 'btn btn-info',
		before: function(wizardObj, currentStepObj, nextStepObj) {
				if($(currentStepObj).attr('name') == 'page1' && $(nextStepObj).attr('name') == 'page2')
				{
					return SaveForm2();				
				}
				else if($(currentStepObj).attr('name') == 'page2' && $(nextStepObj).attr('name') == 'page3')
				{
					return SaveForm();
				}
				else if($(currentStepObj).attr('name') == 'page3' && $(nextStepObj).attr('name') == 'page4')
				{
					return SaveForm1();
				}
				else if($(currentStepObj).attr('name') == 'page4' && $(nextStepObj).attr('name') == 'page5')
				{
					if(checkValidateBuyer())
					{
					ajaxPostBuyer();
					return true;
					}
					return false;
				}
				return true;
			},
		after: function(wizardObj, prevStepObj, currentStepObj) {
			if($(currentStepObj).attr('name') == 'page6')
			{
				$(currentStepObj).css({'float':'', 'width':'700px', 'margin-left':'auto', 'margin-right':'auto'});
				$("#chkagree").attr('disabled', true);
				$("#chkagree").prop("checked", true);
				window.onbeforeunload = function() {
				};
		
			}
			else
			{
				window.onbeforeunload = function() {
				  return "Your changes might be lost. Are you sure you wish to leave this page?";
				}
			}
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		}
	});

	$('#myWizard2').easyWizard({
		buttonsClass: 'btn',
		submitButtonClass: 'btn btn-info',
		before: function(wizardObj, currentStepObj, nextStepObj) {
			alert('Hello, I\'am the before callback');
		},
		after: function(wizardObj, prevStepObj, currentStepObj) {
			alert('Hello, I\'am the after callback');
		},
		beforeSubmit: function(wizardObj) {
			alert('Hello, I\'am the beforeSubmit callback');
		}
	});

	$('#myWizard3').easyWizard({
		showSteps: false,
		showButtons: false,
		submitButton: false
	});
	$('#myWizard3Pager .previous a').bind('click', function(e) {
		e.preventDefault();
		$('#myWizard3').easyWizard('prevStep');
	});
	$('#myWizard3Pager .page a').bind('click', function(e) {
		e.preventDefault();
		$('#myWizard3').easyWizard('goToStep', $(this).attr('rel'));
	});
	$('#myWizard3Pager .next a').bind('click', function(e) {
		e.preventDefault();
		$('#myWizard3').easyWizard('nextStep');
	});
});
