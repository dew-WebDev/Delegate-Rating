function initTableSorter()
{
  $("table").tablesorter({debug: false});
  
	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
	{
		$("#ajaxResult").css("height","500px");
		$("#ajaxResult").parents(".panel-primary").css("border","");
	}
}
