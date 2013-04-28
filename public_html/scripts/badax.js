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

		$('.breadcrumb').html('<a href="/">Home</a>');

		$.fetcherHTML("templates/dashboard.html", "dashboard", function(){

			$.when(doJSON('GET','sensors'), doJSON('GET','system'))
			.done(function(sensors, system)
			{
				var data = {'sensors':sensors,'system':system};				

				container.html( $.render.dashboard(data) );

				var system_status = data.system.status
				if(system_status == 1)
				{
					$('.system_status').addClass('itoggle-active');
					$('.system_status').find('.itoggle-content-on').toggle(100);
				}
				else
				{
					$('.system_status').removeClass('itoggle-active');
					$('.system_status').find('.itoggle-content-off').toggle(100);
				}

				$('.itoggle').click(function(e){
					e.preventDefault();

					$(this).toggleClass('itoggle-active');
					$(this).parent().find('.itoggle-content-on').toggle(100);
					$(this).parent().find('.itoggle-content-off').toggle(100);

					var formData = {
						'status': $(this).hasClass('itoggle-active')?1:0,
					};

					doJSON('POST','system', function(data){
						console.log(data);
						//$.address.value("/sensors");
					}, formData);

					return false;
				});

			});

		});

	}
	else if(myHash[0] == 'sensors')
	{
		loadingAnimation();

		$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/">Sensors</a>');
		
		if(myHash[1])
		{
			if(myHash[1]=='add')
			{
				$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#sensors">Sensors</a><em class="bdiv"></em>Add Sensor');

				$.fetcherHTML("templates/sensor_add.html", "sensor_add", function(){

					$.when(doJSON('GET','sensorTypes'), doJSON('GET','rooms'))
					.done(function(sensorTypes, rooms){

						var data = {'sensor':{},'sensorTypes':sensorTypes,'rooms':rooms};
						container.html( $.render.sensor_add(data) );

					});

					$('#sensor_save_btn').click(function(e){
						e.preventDefault();

						var formData = {
							'title': $('#sensor_title').val(),
							'type': $('#sensor_type').val(),
							'room': $('#sensor_room').val(),
							'serial': $('#sensor_serial').val(),
						};

						doJSON('POST','sensors', function(data){
							console.log(data);
							$.address.value("/sensors");
						}, formData);

					});

				});
			}
			else
			{
				$.fetcherHTML("templates/sensor_edit.html", "sensor_edit", function(){

					var id = '';

					$.when(doJSON('GET','sensors/'+myHash[1]), doJSON('GET','sensorTypes'), doJSON('GET','rooms'))
					.done(function(sensors, sensorTypes, rooms){
						var data = {'sensor':sensors[0],'sensorTypes':sensorTypes,'rooms':rooms};
						container.html( $.render.sensor_edit(data) );
						id = sensors[0].id;

						$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#sensors">Sensors</a><em class="bdiv"></em>'+sensors[0].title);
					});

					$('#sensor_update_btn').click(function(e){
						e.preventDefault();						

						var formData = {
							'title': $('#sensor_title').val(),
							'type': $('#sensor_type').val(),
							'room': $('#sensor_room').val(),
							'serial': $('#sensor_serial').val(),
							'status': $('#sensor_status').val(),
						};

						doJSON('PUT','sensors/'+id, function(data){
							console.log(data);
							$.address.value("/sensors");
						}, formData);

					});

				});
			}
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

		$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#rooms">Rooms</a>');
		
		if(myHash[1])
		{
			if(myHash[1]=='add')
			{
				$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#rooms">Rooms</a><em class="bdiv"></em>Add Room');

				$.fetcherHTML("templates/room_add.html", "room_add", function(){

					container.html( $.render.room_add() );

					$('#room_save_btn').click(function(e){
						e.preventDefault();

						var formData = {
							'title': $('#title').val(),
							'description': $('#description').val(),						
						};

						doJSON('POST','rooms', function(data){
							console.log(data);
							$.address.value("/rooms");
						}, formData);

					});

				});
			}
			else
			{
				$.fetcherHTML("templates/room_edit.html", "room_edit", function(){

					var id = '';

					doJSON('GET','rooms/'+myHash[1], function(rooms){
						var data = {'room':rooms[0]};
						container.html( $.render.room_edit(data) );
						id = rooms[0].id;

						$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#rooms">Rooms</a><em class="bdiv"></em>'+rooms[0].title);
					});

					$('#room_update_btn').click(function(e){
						e.preventDefault();

						var formData = {
							'title': $('#title').val(),
							'description': $('#description').val(),						
						};

						doJSON('PUT','rooms/'+id, function(data){
							console.log(data);
							$.address.value("/rooms");
						}, formData);

					});

				});
			}
		}		
		else
		{
			$.fetcherHTML("templates/rooms.html", "rooms", function(){

				doJSON('GET','rooms', function(rooms){
					var data = {'rooms':rooms};
					container.html( $.render.rooms(data) );
				});

			});
		}

	}
	else if(myHash[0] == 'users')
	{
		loadingAnimation();

		$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#users">Users</a>');
		
		if(myHash[1])
		{
			if(myHash[1]=='add')
			{
				$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#users">users</a><em class="bdiv"></em>Add User');

				$.fetcherHTML("templates/user_add.html", "user_add", function(){

					container.html( $.render.user_add() );

					$('#user_save_btn').click(function(e){
						e.preventDefault();

						var formData = {
							'first_name': $('#first_name').val(),
							'last_name': $('#last_name').val(),
							'email': $('#email').val(),
							'phone': $('#phone').val(),
							'pin': $('#pin').val(),
							'password': $('#password').val(),
						};

						doJSON('POST','users', function(data){
							console.log(data);
							$.address.value("/users");
						}, formData);

					});

				});
			}
			else
			{
				$.fetcherHTML("templates/user_edit.html", "user_edit", function(){

					var id = '';

					doJSON('GET','users/'+myHash[1], function(users){
						var data = {'user':users[0]};
						container.html( $.render.user_edit(data) );
						id = users[0].id;

						$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#users">Users</a><em class="bdiv"></em>'+users[0].first_name+' '+users[0].last_name);
					});

					$('#user_update_btn').click(function(e){
						e.preventDefault();

						var formData = {
							'first_name': $('#first_name').val(),
							'last_name': $('#last_name').val(),
							'email': $('#email').val(),
							'phone': $('#phone').val(),
							'pin': $('#pin').val(),
							'password': $('#password').val(),
						};

						doJSON('PUT','users/'+id, function(data){
							console.log(data);
							$.address.value("/users");
						}, formData);

					});

				});
			}
		}		
		else
		{
			$.fetcherHTML("templates/users.html", "users", function(){

				doJSON('GET','users', function(users){
					var data = {'users':users};
					container.html( $.render.users(data) );
				});

			});
		}

	}
	else if(myHash[0] == 'logs')
	{
		loadingAnimation();

		$('.breadcrumb').html('<a href="/">Home</a><em class="bdiv"></em><a href="/#logs">Logs</a>');
		
		if(myHash[1])
		{
			
		}		
		else
		{
			$.fetcherHTML("templates/logs.html", "logs", function(){

				doJSON('GET','logs', function(logs){
					var data = {'logs':logs};
					container.html( $.render.logs(data) );
				});

			});
		}

	}
	else
		$.address.value("/main");
});