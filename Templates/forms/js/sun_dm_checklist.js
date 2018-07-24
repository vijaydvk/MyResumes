$(document).ready(function () {
	//alert($('#s_id').val());
	var dm_checklist_JSON = [];
	var store_details_JSON = [];
	var store_distance_JSON = [];
	//getLocation();
	
	getAPI();
	
/* 	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			alert( "Geolocation is not supported by this browser.");
		}
	} */

	function showPosition(lat,log) {
		//console.log( position.coords.latitude);
		//console.log(position.coords.longitude);
		$.when(getStoreDistaneView(lat,log)).done(function(){
			//console.log(store_distance_JSON.length);
			if(store_distance_JSON.length > 0)
			{
				$('#dm_checklist_location_div').hide();
				$('#dm_checklist_error_div').hide();
				$('#dm_checklist_view_div').show();
				$.when(getStoreDetialsView()).done(function(){
					dispStoreDetialsView();
					$.when(getDMChecklistView()).done(function(){
						dispDMChecklistView();
					});	
				});
			}
			else
			{
				$('#dm_checklist_location_div').hide();
				$('#dm_checklist_error_div').show();
				$('#dm_checklist_view_div').hide();	
				$('#s_lat').html(': '+lat);
				$('#s_longg').html(': '+log);
				$.when(getStoreDetialsView()).done(function(){
					$('#s_name').html(': '+store_details_JSON[0].store_name);
				});
				//window.location.href = "index.php?action=distanceError";
			}
		});
	
	}
	
	function getStoreDistaneView(lat,longg)
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoreDistaneView&sid='+$('#s_id').val()+'&lat='+lat+'&longg='+longg,
			type:'POST',
			success:function(data){
				store_distance_JSON = $.parseJSON(data);							
        },		
		error: function() {
			console.log("opening_checklist - getStoreDistaneView - Error - line 60"); 
			console.log('something bad happened');
		}
		}) ;
	}
	
	function getAPI()
	{
		return $.ajax({
			url:'https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyBFpVmTK_dyBIhJspegmNjHPj7AIkflY6M',
			type:'POST',
			success:function(data){
				//console.log(data);	
				showPosition(data.location.lat,data.location.lng);
        },		
		error: function() {
			console.log("getAPI - getStoreDistaneView - Error - line 76"); 
			console.log('something bad happened');
		}
		}) ;
	}	
	
	function getDMChecklistView()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDMChecklistView',
			type:'POST',
			success:function(data){
				dm_checklist_JSON = $.parseJSON(data);							
        },		
		error: function() {
			console.log("opening_checklist - getDMChecklistView - Error - line 93"); 
			console.log('something bad happened');
		}
		}) ;
	}
	
	function getStoreDetialsView()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoreDetialsView&s_id='+$('#s_id').val(),
			type:'POST',
			success:function(data){
				store_details_JSON = $.parseJSON(data);							
        },		
		error: function() {
			console.log("opening_checklist - getStoreDetialsView - Error - line 108"); 
			console.log('something bad happened');
		}
		}) ;
	}
	
	function dispStoreDetialsView()
	{
		$('#dm_name').html("DM Name:&nbsp;&nbsp;&nbsp;&nbsp;"+store_details_JSON[0].district_name);
		$('#market').html("Market:&nbsp;&nbsp;&nbsp;&nbsp;"+store_details_JSON[0].market_name);
		$('#store_name').html("Store Name:&nbsp;&nbsp;&nbsp;&nbsp;"+store_details_JSON[0].store_name);
		$('#location_id').html("Location ID:&nbsp;&nbsp;&nbsp;&nbsp;"+$('#s_id').val());
		$('#address').html("Address:&nbsp;&nbsp;&nbsp;&nbsp;"+store_details_JSON[0].store_address);
	}
	
	function dispDMChecklistView()
	{
		var disp_QA="";
		for(var i=0;i<dm_checklist_JSON.length;i++)
		{
			if(dm_checklist_JSON[i].category == "Facility")
			{
				$('#facility_view').append('<div class="col-lg-12">'+
							'<div class="col-lg-10" style="float:left;">'+
							'<h3 class="h6" style="text-align:left;">'+dm_checklist_JSON[i].question+'</h3>'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;">'+
							'<div class="input-group" style="margin-top:2px;margin-bottom:2px;">'+
							'	<div id="radioBtn" class="btn-group">'+
							'		<a class="btn btn-primary btn-sm notActive" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="1">YES</a>'+
							'		<a class="btn btn-primary btn-sm active" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="0">NO</a>'+
							'	</div>'+
							'	<input type="hidden" name="'+dm_checklist_JSON[i].q_id+'" id="'+dm_checklist_JSON[i].q_id+'" value="0">'+
							'</div>'+
							'</div>	');
			}
			else if(dm_checklist_JSON[i].category == "Inventory")
			{				
				$('#inventory_view').append('<div class="col-lg-12">'+
							'<div class="col-lg-10" style="float:left;">'+
							'<h3 class="h6" style="text-align:left;">'+dm_checklist_JSON[i].question+'</h3>'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;">'+
							'<div class="input-group" style="margin-top:2px;margin-bottom:2px;">'+
							'	<div id="radioBtn" class="btn-group">'+
							'		<a class="btn btn-primary btn-sm notActive" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="1">YES</a>'+
							'		<a class="btn btn-primary btn-sm active" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="0">NO</a>'+
							'	</div>'+
							'	<input type="hidden" name="'+dm_checklist_JSON[i].q_id+'" id="'+dm_checklist_JSON[i].q_id+'" value="0">'+
							'</div>'+
							'</div>	');
			}
			else if(dm_checklist_JSON[i].category == "Revenue assurance")
			{				
				$('#revenue_view').append('<div class="col-lg-12">'+
							'<div class="col-lg-10" style="float:left;">'+
							'<h3 class="h6" style="text-align:left;">'+dm_checklist_JSON[i].question+'</h3>'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;">'+
							'<div class="input-group" style="margin-top:2px;margin-bottom:2px;">'+
							'	<div id="radioBtn" class="btn-group">'+
							'		<a class="btn btn-primary btn-sm notActive" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="1">YES</a>'+
							'		<a class="btn btn-primary btn-sm active" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="0">NO</a>'+
							'	</div>'+
							'	<input type="hidden" name="'+dm_checklist_JSON[i].q_id+'" id="'+dm_checklist_JSON[i].q_id+'" value="0">'+
							'</div>'+
							'</div>	');				
			}	
			else if(dm_checklist_JSON[i].category == "CPOG")
			{				
				$('#CPOG_view').append('<div class="col-lg-12">'+
							'<div class="col-lg-10" style="float:left;">'+
							'<h3 class="h6" style="text-align:left;">'+dm_checklist_JSON[i].question+'</h3>'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;">'+
							'<div class="input-group" style="margin-top:2px;margin-bottom:2px;">'+
							'	<div id="radioBtn" class="btn-group">'+
							'		<a class="btn btn-primary btn-sm notActive" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="1">YES</a>'+
							'		<a class="btn btn-primary btn-sm active" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="0">NO</a>'+
							'	</div>'+
							'	<input type="hidden" name="'+dm_checklist_JSON[i].q_id+'" id="'+dm_checklist_JSON[i].q_id+'" value="0">'+
							'</div>'+
							'</div>	');	
			}
			else if(dm_checklist_JSON[i].category == "Velocity")
			{				
				$('#velocity_view').append('<div class="col-lg-12">'+
							'<div class="col-lg-10" style="float:left;">'+
							'<h3 class="h6" style="text-align:left;">'+dm_checklist_JSON[i].question+'</h3>'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;">'+
							'<div class="input-group" style="margin-top:2px;margin-bottom:2px;">'+
							'	<div id="radioBtn" class="btn-group">'+
							'		<a class="btn btn-primary btn-sm notActive" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="1">YES</a>'+
							'		<a class="btn btn-primary btn-sm active" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="0">NO</a>'+
							'	</div>'+
							'	<input type="hidden" name="'+dm_checklist_JSON[i].q_id+'" id="'+dm_checklist_JSON[i].q_id+'" value="0">'+
							'</div>'+
							'</div>	');					

			}	
			else if(dm_checklist_JSON[i].category == "Operations")
			{				
				$('#operations_view').append('<div class="col-lg-12">'+
							'<div class="col-lg-10" style="float:left;">'+
							'<h3 class="h6" style="text-align:left;">'+dm_checklist_JSON[i].question+'</h3>'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;">'+
							'<div class="input-group" style="margin-top:2px;margin-bottom:2px;">'+
							'	<div id="radioBtn" class="btn-group">'+
							'		<a class="btn btn-primary btn-sm notActive" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="1">YES</a>'+
							'		<a class="btn btn-primary btn-sm active" data-toggle="'+dm_checklist_JSON[i].q_id+'" data-title="0">NO</a>'+
							'	</div>'+
							'	<input type="hidden" name="'+dm_checklist_JSON[i].q_id+'" id="'+dm_checklist_JSON[i].q_id+'" value="0">'+
							'</div>'+
							'</div>	');					
			}				
			
			
		}
		/*$('#disp_opening_checklist_answer').html(disp_QA);
		setTimeout(function(){
		$('#pleaseWaitDialog').modal('toggle');
		},1000);*/
	}
	
	$(document).on('click','#radioBtn a',function(){
		var sel = $(this).data('title');
		var tog = $(this).data('toggle');
		$('#'+tog).prop('value', sel);
		
		$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
		$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
	});
	
});
						
							
                              
                              
                            
						
						
							