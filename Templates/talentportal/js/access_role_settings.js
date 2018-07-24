$(document).ready(function() {
	var access_role_settings_JSON = [];
	var role_details_JSON = [];
	var settings_name_Details_JSON = [];
	$.when(getAccessRoleSettingsDetails()).done(function(){
				dispAccessRoleSettingsDetails(access_role_settings_JSON);
				$('[data-toggle="tooltip"]').tooltip();
			});

	$.when(getRoleDetails()).done(function(){
		$.when(getSettingNameDetails()).done(function(){
				dispRoleSettingsNameDetails();
				$('[data-toggle="tooltip"]').tooltip();
		});
	});			

	function getAccessRoleSettingsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getAccessRoleSettingsDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					access_role_settings_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getAccessRoleSettingsDetails - Error - line 24"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function getRoleDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getRoleDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					role_details_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getRoleDetails - Error - line 24"); 
			console.log('something bad happened'); }
		}) ;
	}

	function getSettingNameDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getSettingNameDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					settings_name_Details_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getSettingNameDetails - Error - line 24"); 
			console.log('something bad happened'); }
		}) ;
	}	
	
	function dispAccessRoleSettingsDetails(dataJSON)
	{
		$('#view_access_role_settings').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [

				{ "mDataProp": "site_setting_friendly_name" },
				{ "mDataProp": "role_name" },				
				{ "mDataProp": "added_name" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.active == '1')
							return 'Active';
						else
							return 'In Active';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.active == '1')
							return '<p id="'+ data.rid_setting_id +'" class="btn useraccessroleBtnDelete" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.site_setting_friendly_name+'"><i class="fas fa-trash-alt" aria-hidden="true"></i></p>';
						else
							return '<p id="'+ data.rid_setting_id +'" class="btn useraccessroleBtnActive" style="padding:0px;"  role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.site_setting_friendly_name+'"><i class="fas fa-check" aria-hidden="true"></i></p>';
					},"bSortable":false
				},					
				
			],
			initComplete : function() {
					$newButton = $('<input type = "button" class="fa-input userAccessRoleBtnnew" value="New" style="color:blue;background:white;padding:0px 10px;" data-toggle="tooltip" data-placement="top" title="Click to Add User Access Role" />');
					$('.dataTables_filter').append($newButton); 				   
			}, 
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Process Steps Details',
				exportOptions: {
                    columns: [  0, 1 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Process Steps Details',
				exportOptions: {
                    columns: [  0, 1 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],
/* 			"createdRow": function( row, data, dataIndex){
				 
                if( data.active ==  0){
					//alert("hi");
                    $(row).css('background-color','#ff4500');				
                }
            } */
		});
		return true;
	}
	
	$(document).on('click','.userAccessRoleBtnnew',function(){
		$('#new_access_role_modal').modal('show');
		 $('#setting_name_dropdown').val('');
		 $('#role_dropdown').val('');
	});
	
	function dispRoleSettingsNameDetails()
	{
		var i;
		$('#role_dropdown').html('');
		$('#setting_name_dropdown').html('');
		$('#role_dropdown').append('<option value="">--Please Select One--</option>');
		$('#setting_name_dropdown').append('<option value="">--Please Select One--</option>');
		for(i=0;i<role_details_JSON.length;i++)
		{
			$('#role_dropdown').append('<option value="'+role_details_JSON[i].rid+'">'+role_details_JSON[i].name+'</option>');
		}
		for(i=0;i<settings_name_Details_JSON.length;i++)
		{
			$('#setting_name_dropdown').append('<option value="'+settings_name_Details_JSON[i].a_button_id+'">'+settings_name_Details_JSON[i].action_setting_friendly_name+'</option>');
		}		
	}
	
	$(document).on('click','.useraccessroleBtnDelete',function(){
		var index = $(this).attr("id");
		console.log(index);
		$.confirm({
			title: 'Are you sure!',
			content: 'Delete Access Role',
			buttons: {
				confirm: function () {				
						request = $.ajax({
						url: 'index.php',
						data: {"action": "updateAccessRole","mode":"delete","rid_setting_id":index},
						type: 'POST',
					});
					request.done(function (response){
					var js = $.parseJSON(response);
					if(js.success)
					{
						afterUpdate();
					}					
					});
					request.fail(function (jqXHR,textStatus,errorThrown)
					{
					}); 
					
				},
				cancel: function () {
					
				},
		
			}
		});		
	});

	$(document).on('click','.useraccessroleBtnActive',function(){
		var index = $(this).attr("id");
		console.log(index);
		$.confirm({
			title: 'Are you sure!',
			content: 'Active Access Role',
			buttons: {
				confirm: function () {				
						request = $.ajax({
						url: 'index.php',
						data: {"action": "updateAccessRole","mode":"active","rid_setting_id":index},
						type: 'POST',
					});
					request.done(function (response){
					var js = $.parseJSON(response);
					if(js.success)
					{
						afterUpdate();
					}					
					});
					request.fail(function (jqXHR,textStatus,errorThrown)
					{
					}); 
					
				},
				cancel: function () {
					
				},
		
			}
		});			
	});	
	
	function afterUpdate()
	{
		var table = $('#view_access_role_settings').DataTable();
		table.destroy();
		$.when(getAccessRoleSettingsDetails()).done(function(){
				dispAccessRoleSettingsDetails(access_role_settings_JSON);
				$('[data-toggle="tooltip"]').tooltip();
			});			
			$("#applicant_unique_head_div").fadeTo(2000, 500).slideUp(500, function(){
				$("#applicant_unique_head_div").slideUp(500);
			});			
	}
	
	$('#access_role_save').click(function(){
		if($('#role_dropdown').val() == "")
		{
			$('#access_role_danger').html("Role Must be provided");
				$("#access_role_danger_div").fadeTo(2000, 500).slideUp(500, function(){
					$("#access_role_danger_div").slideUp(500);
				});
		}
		else if($('#setting_name_dropdown').val() == "")
		{
			$('#access_role_danger').html("Setting name must be provided");
				$("#access_role_danger_div").fadeTo(2000, 500).slideUp(500, function(){
					$("#access_role_danger_div").slideUp(500);
				});			
		}
		else if(checkExistofRid())
		{
			$('#access_role_danger').html("User Role Already Exist");
				$("#access_role_danger_div").fadeTo(2000, 500).slideUp(500, function(){
					$("#access_role_danger_div").slideUp(500);
				});			
		}
		else
		{
			request = $.ajax({
				url: 'index.php',
				data: {"action": "updateAccessRole","mode":"insert","a_button_id":$('#setting_name_dropdown').val(),
							"site_setting_friendly_name":$('#setting_name_dropdown option:selected').html(),"rid":$('#role_dropdown').val()},
				type: 'POST',
			});
			request.done(function (response){
			var js = $.parseJSON(response);
			if(js.success)
			{
				$('#new_access_role_modal').modal('hide');
				afterUpdate();
			}					
			});
			request.fail(function (jqXHR,textStatus,errorThrown)
			{
			}); 			
		}
	});
	
	function checkExistofRid()
	{
		for(var i=0;i<access_role_settings_JSON.length;i++)
		{
			//console.log(access_role_settings_JSON[i].site_setting_name);
			//console.log(access_role_settings_JSON[i].rid);
			if(access_role_settings_JSON[i].a_button_id == $('#setting_name_dropdown').val() && access_role_settings_JSON[i].rid == $('#role_dropdown').val())
			{
				return true;
			}
		}
		return false;
	}
	
	
});

