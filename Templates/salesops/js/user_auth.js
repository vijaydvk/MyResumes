$(document).ready(function() {
	var userAuth_JSON = [];
	var userDetailsAuth_JSON = [];
	var titleDetailsAuth_JSON = [];
	var mode="";
	var district_id="";
	$.when(getUserAuthDetails()).done(function(){				
		dispUserAuthDetails(userAuth_JSON);
		$('[data-toggle="tooltip"]').tooltip();
	});
	
	$.when(getUserDropdownDetails4Auth()).done(function(){
	$.when(getTitleDropdownDetails4Auth()).done(function(){
			dispDropDown();	
		});
	});

	function getUserAuthDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getUserAuthDetails',
			type:'POST',
			success:function(data){
				userAuth_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("userAuth - getUserAuthDetails - Error - line 25"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getUserDropdownDetails4Auth()
	{
		return $.ajax({
			url:'controller/index1.php?action=getUserDropdownDetails4Auth',
			type:'POST',
			success:function(data){
				userDetailsAuth_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("userAuth - getUserDropdownDetails4Auth - Error - line 39"); 
			alert('something bad happened'); }
		}) ;
	}	
	
	function getTitleDropdownDetails4Auth()
	{
		return $.ajax({
			url:'controller/index1.php?action=getTitleDropdownDetails4Auth',
			type:'POST',
			success:function(data){
				titleDetailsAuth_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("userAuth - getTitleDropdownDetails4Auth - Error - line 53"); 
			alert('something bad happened'); }
		}) ;
	}		
	
	function dispUserAuthDetails(dataJSON)
	{
		$('#view_user_auth_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "name" },
				{ "mDataProp": "title" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
					return '<a id="'+meta.row +'" class="btn userAuthBtndelete" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.name+'" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				 } 
				},
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'DM Details',
				exportOptions: {
                    columns: [  0, 1 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'DM Details',
				exportOptions: {
                    columns: [  0, 1 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],
			"initComplete": function () {
	            var api = this.api();
				  $clearButton = $('<input type = "button" data-toggle="tooltip" data-placement="top" title="Click to clear search and refresh the table" value="Clear" />')
                       .click(function() {
 						 api.search('').draw();
                       }) ;
					$newButton = $('<input type = "button" class="fa-input userAuthBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New DM" />');
					$('#view_user_auth_details_filter').append($clearButton,$newButton);
			},
		});
		return true;
	}
	
	function dispDropDown()
	{
		var index;
		$('#user_name').html('');
		$('#user_title').html('');
		for(index=0;index < userDetailsAuth_JSON.length;index++)
		{			
			 $("#user_name").append('<option value="' + userDetailsAuth_JSON[index].uid + '">' + userDetailsAuth_JSON[index].name + '</option>');
		}
		for(index=0;index < titleDetailsAuth_JSON.length;index++)
		{			
			 $("#user_title").append('<option value="' + titleDetailsAuth_JSON[index].title + '">' + titleDetailsAuth_JSON[index].title + '</option>');
		}
		 $('#user_name').selectpicker('refresh');
		 $('#user_title').selectpicker('refresh');
	}
 	
	$(document).on('click','.userAuthBtnnew',function ()
	{
		mode = "add";
		$('#user_auth_modal').modal('toggle');	
		$('#user_name').selectpicker('val','');
		$('#user_name').selectpicker('val','');
		$(".modal-title").html('New URL Access');
		
	});
	
	$(document).on('click','.userAuthBtnEdit',function ()
	{
		var id = $(this).attr('id');
		$('#user_auth_modal').modal('toggle');	
		$('#user_name').selectpicker('val',userAuth_JSON[id].uid);
		$('#user_title').selectpicker('val',userAuth_JSON[id].title);

	});
	
	$(document).on('click','.userAuthBtndelete',function ()
	{
		
		mode = 'delete';
		var id = $(this).attr('id');
		console.log(id);
		delete_flag = 1;
		$.confirm({
		title: 'Are you sure!',
		content: 'Delete Access For '+ userAuth_JSON[id].name + ', Title:'+userAuth_JSON[id].title,
		buttons: {
			confirm: function () {				
					request = $.ajax({
					url: 'index.php',
					data: {"action": "saveUrlAuth","mode":mode,"auth_id":userAuth_JSON[id].auth_id},
					type: 'POST',
				});
				request.done(function (response){
				var js = $.parseJSON(response);
				if(js.success)
				{
					$.notify({
						// options
						message: js.msg
					},{
						// settings
						type: 'success'
					});
					refreshUserAuthDetails();
				}					
				});
				request.fail(function ( jqXHR, textStatus, errorThrown)
				{
					$.notify({
					
						message: errorThrown
					},{
						
						type: 'danger'
					}); 
				}); 
				
			},
			cancel: function () {
				
			},
		
		}
		});
	});

/* 	function initializeMultiselect()
	{
		$('.selectM').multiselect({
					numberDisplayed: 4,
					maxHeight: 250, 
					nonSelectedText: '-- Please select One --'	,
					buttonWidth: 'auto',
					enableCaseInsensitiveFiltering: true,
					moveSelectedToTop: true
				}); 
	} */
	
	$('#save_user_Auth').click(function(e){
		if($('#user_name').val() == "" || $('#user_title').val() == "")
		{
			$.notify({
				message: "Name or Title Must be provided"				
			},{
				type: 'danger'
			});	
		}
		else
		{
			if(checkNameTiltleExist())
			{
				$.notify({
					message: "Name and Title already taken"
				},{
					type: 'warning'
				});
			}
			else
			{
				for (var index = 0; index < titleDetailsAuth_JSON.length; ++index) {
				 var unique_JSON = titleDetailsAuth_JSON[index];
				 if(unique_JSON.title == $('#user_title').val()){
					console.log($('#user_name').val());
					console.log($('#user_title').val());
				    console.log(unique_JSON.url);
					console.log(unique_JSON.auth_type);
				    break;
				 }
				}
				
				request = $.ajax({
					url: 'index.php',
					data: {"action": "saveUrlAuth","mode":mode,"title":$('#user_title').val(),"uid":$('#user_name').val(),"url":unique_JSON.url,
						  "auth_type":unique_JSON.auth_type
						  },
					type: 'POST',
				});
				request.done(function (response){
						var js = $.parseJSON(response);
						if(js.success)
						{
							$.notify({
								// options
								message: js.msg
							},{
								// settings
								type: 'success'
							});
							refreshAddUserAuthDetails();
						}					
				});
				request.fail(function ( jqXHR, textStatus, errorThrown)
						{
							$.notify({
							
								message: errorThrown
							},{
								
								type: 'danger'
							}); 
						}); 				
				
			}
		}
		

	});
	

	function checkNameTiltleExist()
	{
		var hasMatch =false;
		console.log($('#user_name').val());
		for (var index = 0; index < userAuth_JSON.length; ++index) {

		 var unique_JSON = userAuth_JSON[index];

		 if(unique_JSON.uid == $('#user_name').val() && unique_JSON.title == $('#user_title').val()){
		   hasMatch = true;
		   break;
		 }
		}
		return hasMatch;
	}
	
	function refreshUserAuthDetails()
	{
		var table = $('#view_user_auth_details').DataTable();
		table.destroy();
		$.when(getUserAuthDetails()).done(function(){				
			dispUserAuthDetails(userAuth_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
	
	function refreshAddUserAuthDetails()
	{
		var table = $('#view_user_auth_details').DataTable();
		table.destroy();
		$('#user_auth_modal').modal('toggle');	
		$.when(getUserAuthDetails()).done(function(){				
			dispUserAuthDetails(userAuth_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});		
	}

});

