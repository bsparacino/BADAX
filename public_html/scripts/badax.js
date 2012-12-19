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
	url = '/api/'+url;
	var myData = null;

	$.ajax({
		type: type,
		url: url,
		async: false,
		dataType: 'json',
		data: inputData,
		success: (function(data, textStatus, jqXHR) { 
			myData = data;
			if(callback) callback(data, jqXHR);
		}),
		error: (function(jqXHR, textStatus, errorThrown) {
			var data = $.parseJSON(jqXHR.responseText);
			console.log(data);

			if(jqXHR.status==401) window.location.replace('/login');
			else if(jqXHR.status==404) callback(data, jqXHR);
			//$('#consoleBox').html('error: '+data.error);
		})
	});

	return myData;
}

// Event handlers
$.address.init(function(event) {

	container = $('#main_container');

	$('.nav-deploy').click(function(){
		$('.nav-arrow').toggleClass('change-arrow');
		$('.nav-items').toggleClass('show-nav');
	});

}).change(function(event) {
	//$('#content').hide();
	//$('select').selectBox('destroy');

	$('html, body').animate({ scrollTop: 0 }, 'fast');

	//$('.overview').collapse('hide');
	
	myHash = $.address.pathNames();
	var newURL = event.value;

	//console.log("myHash:"+myHash+"  newURL:"+newURL);

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

			doJSON('GET','sensors', function(sensors){

				var data = {'sensors':sensors};

				container.html( $.render.dashboard(data) );

				$('.itoggle').click(function(){
					$(this).toggleClass('itoggle-active');
					$(this).parent().find('.itoggle-content-on').toggle(100);
					$(this).parent().find('.itoggle-content-off').toggle(100);
					return false;
				});

			});

		});

	}
	else if(myHash[0] == 'sensors')
	{
		loadingAnimation();
		
		if(myHash[1])
		{
			$.fetcherHTML("templates/sensor_edit.html", "sensor_edit", function(){

				$.when(doJSON('GET','sensors/'+myHash[1]), doJSON('GET','sensorTypes'))
				.done(function(sensors, sensorTypes){

					var data = {'sensor':sensors[0],'sensorTypes':sensorTypes};
					container.html( $.render.sensor_edit(data) );

				});
			});
		}		
		else
		{
			$.fetcherHTML("templates/sensors.html", "sensors", function(){

				doJSON('GET','sensors', function(sensors){
					var data = {'sensors':sensors};
					container.html( $.render.sensors(data) );
				});

			});
		}

	}
	else if(myHash[0] == 'rooms')
	{
		loadingAnimation();
		
		if(myHash[1])
		{
			
		}		
		else
		{
			container.html('rooms');
		}

	}
	else if(myHash[0] == 'users')
	{
		loadingAnimation();
		
		if(myHash[1])
		{
			
		}		
		else
		{
			container.html('users');
		}

	}
	else
		$.address.value("/main");
});