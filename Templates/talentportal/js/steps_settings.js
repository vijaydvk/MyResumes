$(document).ready(function() {
	var steps_settings_JSON = [];
	$.when(getStepsSettingsDetails()).done(function(){
				dispStepsSettingsDetails(steps_settings_JSON);
				$('[data-toggle="tooltip"]').tooltip();
			});

	function getStepsSettingsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStepsSettingsDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					steps_settings_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getStepsSettingsDetails - Error - line 24"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function dispStepsSettingsDetails(dataJSON)
	{
		$('#view_steps_settings').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [

				{ "mDataProp": "step" },
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
							return '<p id="'+ data.a_step_id +'" class="btn stepsSettingsBtnDelete" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.step+'"><i class="fas fa-trash-alt" aria-hidden="true"></i></p>';
						else
							return '<p id="'+ data.a_step_id +'" class="btn stepsSettingsBtnActive" style="padding:0px;"  role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.step+'"><i class="fas fa-check" aria-hidden="true"></i></p>';
					},"bSortable":false
				},				
				
			],
/* 			initComplete : function() {
				  var api = this.api();
				  var input = $('.dataTables_filter input');
				  $clearButton = $('<input type = "button" data-toggle="tooltip" data-placement="top" title="Click to clear the search and refresh the table" value="Clear" />')
                       .click(function() {
						 input.val('');
						 api.search(input.val()).draw();
 						 //api.draw();
                       }) ;
					$newButton = $('<input type = "button" class="fa-input recruiterTrackingBtnnew" value="New" data-toggle="tooltip" data-placement="top" title="Click to Add Employer Details" />');
					$('.dataTables_filter').append($newButton); 				   
			}, */
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
	
	$(document).on('click','.stepsSettingsBtnDelete',function(){
		var index = $(this).attr("id");
		console.log(index);
		$.confirm({
			title: 'Are you sure!',
			content: 'Delete Application Step',
			buttons: {
				confirm: function () {				
						request = $.ajax({
						url: 'index.php',
						data: {"action": "updateProcessStep","mode":"delete","a_step_id":index},
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

	$(document).on('click','.stepsSettingsBtnActive',function(){
		var index = $(this).attr("id");
		console.log(index);
		$.confirm({
			title: 'Are you sure!',
			content: 'Active Application Step',
			buttons: {
				confirm: function () {				
						request = $.ajax({
						url: 'index.php',
						data: {"action": "updateProcessStep","mode":"active","a_step_id":index},
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
		var table = $('#view_steps_settings').DataTable();
		table.destroy();
			$.when(getStepsSettingsDetails()).done(function(){
				dispStepsSettingsDetails(steps_settings_JSON);
				$('[data-toggle="tooltip"]').tooltip();
			});
	}

});

