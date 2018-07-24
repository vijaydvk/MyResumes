$(document).ready(function() {
	var regionDetails_JSON = [];
	var regionNameDetails_JSON = [];
	var mode="";
	var region_id="";
	$.when(getRegionViewsDetails()).done(function(){				
		dispRegionViewsDetails(regionDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
	});

		$.when(getRegionNameDetails()).done(function(){
				dispDropDown();	
		});
 
	
	function getRegionViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getRegionViewsDetails',
			type:'POST',
			success:function(data){
				regionDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("region - getRegionViewsDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getRegionNameDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getRegionNameDetails',
			type:'POST',
			success:function(data){
				regionNameDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("region - getRegionNameDetails - Error - line 42"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function dispRegionViewsDetails(dataJSON)
	{
		$('#view_region_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				//{ "mDataProp": "market_id" },
				{ "mDataProp": "region_name" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
					return '<a id="'+
					meta.row +'" class="btn regionBtndelete" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.region_name+'" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				 } 
				},
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Region Details',
				exportOptions: {
                    columns: [  0  ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Region Details',
				exportOptions: {
                    columns: [  0  ]
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
					$newButton = $('<input type = "button" class="fa-input regionBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New DM" />');
					$('#view_region_details_filter').append($clearButton,$newButton);
			},
		});
		return true;
	}
	
	function dispDropDown()
	{
		var index;
		$('#region_name').html('');
		for(index=0;index < regionNameDetails_JSON.length;index++)
		{			
			 $("#region_name").append('<option value="' + regionNameDetails_JSON[index].uid + '">' + regionNameDetails_JSON[index].name + '</option>');
		
		}
		$('#region_name').selectpicker('refresh');
	}
 	
	$(document).on('click','.regionBtnnew',function ()
	{
		mode = "add";
		region_id = "";
		$('#region_model').modal('toggle');	
		clearRegionForm();		
		$('#region_name').prop('disabled', false);
		$('#region_name').selectpicker('refresh');
		$("#save_region_details").html('Add');
		$('.modal-title').html('New Region');
	});
	
	$(document).on('click','.regionBtndelete',function ()
	{
		mode = "delete";
		$('#region_model').modal('toggle');	
		$('#region_name').prop('disabled', true);
		$('#region_name').selectpicker('refresh');
		var id = $(this).attr('id');
		$('#region_name').selectpicker('val',regionDetails_JSON[id].rvp_uid);
		region_id = regionDetails_JSON[id].region_id
		$("#save_region_details").html('Delete');
		$('.modal-title').html('Delete Region');
	});

	
	$('#save_region_details').click(function(e){
		if( $('#region_name').val()=='')
		{
			$.notify({
					message: "Region Name must be provided"
				},{
					type: 'danger'
				});
		}
		else
		{
		var selectedText = $('#region_name').find("option:selected").text(); 
		 var data = [];
			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveRegion","mode":mode,"region_name":selectedText,"rvp_uid":$('#region_name').val(),
						"region_id":region_id
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
						//refreshDistrictDetails();
						refreshRegionDetails();
					}
					else
					{
						$.notify({
							// options
							message: js.msg
						},{
							// settings
							type: 'danger'
						});
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
	});
	
	function refreshRegionDetails()
	{
		$.when(getRegionViewsDetails()).done(function(){
			$('#region_model').modal('toggle');
			var table = $('#view_region_details').DataTable();
			table.destroy();
			dispRegionViewsDetails(regionDetails_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
	function clearRegionForm()
	{
		 $('#region_name').selectpicker('val','');
	}
});

