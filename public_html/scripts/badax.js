var myHash = '';
var container = null;

var loading = '<div id="loading" style="text-align:center; background-color: #000; background-color: rgba(0,0,0,0.5); z-index:1000; position:absolute; width:100%; padding-top:20px; padding-bottom:20px; color:#000; display:none1;"><div style="background-color:#FFF;width:150px;height:30px;text-align:center;padding-top:10px;margin:0px auto;"><img src="/images/ajax-loader.gif" />  Loading...</div></div>';
var loadingTable = '<tr><td colspan="99" style="text-align:center;padding-top:20px;padding-bottom:20px;"><img src="/images/ajax-loader.gif" /></td></tr>';
var loadingContent = '<div style="text-align:center;padding-top:20px;padding-bottom:20px;"><img src="/images/ajax-loader.gif" /></div>';

$.ajaxSetup ({cache: false});

function loadingAnimation()
{
	container.html(loadingContent);
}

function doJSON(type, url, callback, inputData)
{
	$.ajax({
		type: type,
		url: url,
		dataType: 'json',
		data: inputData,
		success: (function(data, textStatus, jqXHR) { 	
			callback(data, jqXHR);
		}),
		error: (function(jqXHR, textStatus, errorThrown) {
			var data = $.parseJSON(jqXHR.responseText);
			console.log(data);

			if(jqXHR.status==401) window.location.replace('/login');
			else if(jqXHR.status==404) callback(data, jqXHR);
			//$('#consoleBox').html('error: '+data.error);
		})
	});
}

// Event handlers
$.address.init(function(event) {

	container = $('#main_container');

}).change(function(event) {		
	//$('#content').hide();
	//$('select').selectBox('destroy');

	$('html, body').animate({ scrollTop: 0 }, 'fast');

	//$('.overview').collapse('hide');
	
	myHash = $.address.pathNames();
	var newURL = event.value;

	console.log("myHash:"+myHash+"  newURL:"+newURL);

	//$('#loading').show();
	//$('body').append(loading);	
	
	//$('#sidebar_menu li').removeClass('active');
	//$('#sidebar_menu li.'+myHash[0]).addClass('active');

	/*
	$('.accordion-group').click(function(dealerships){
		$(this).addClass('active');
	});
	*/
	
	//$('#horizontal_nav a').removeClass('active');
	//$('.nav_'+myHash[0]).addClass('active');

	if(myHash[0] == 'main')
	{
		loadingAnimation();
		
		$.fetcherHTML("templates/dashboard.html", "dashboard", function(){

			/*
			doJSON('GET','/ajax/dealerships/'+dealership_id, function(dealerships){
				container.html( $.render.dealerships_campaigns(dealerships[0]) );
			});
			*/

			container.html( $.render.dashboard() );

			$('.itoggle').click(function(){
				$(this).toggleClass('itoggle-active');
				$(this).parent().find('.itoggle-content-on').toggle(100);
				$(this).parent().find('.itoggle-content-off').toggle(100);
				return false;
			});

		});

	}
	else if(myHash[0] == 'dealerships')
	{
		loadingAnimation();
		
		if(myHash[1])
		{
			
		}		
		else
			dealerships();
	}
	else
		$.address.value("/main");
});