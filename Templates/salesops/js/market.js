$(document).ready(function() {
	var marketDetails_JSON = [];
	var marketNameDetails_JSON = [];
	var rdNameDetails_JSON = [];
	var rvp_uid = "";
	var mode="";
	var district_id="";
	$.when(getMarketViewsDetails()).done(function(){				
		dispMarketViewsDetails(marketDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
	});

		$.when(getMarketNameDetails()).done(function(){
			$.when(getRDNameDetails()).done(function(){
				dispDropDown();	
			});
		});
 
	
	function getMarketViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getMarketViewsDetails',
			type:'POST',
			success:function(data){
				marketDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("market - getMarketViewsDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getMarketNameDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getMarketNameDetails',
			type:'POST',
			success:function(data){
				marketNameDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("market - getMarketNameDetails - Error - line 42"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getRDNameDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getRDNameDetails',
			type:'POST',
			success:function(data){
				rdNameDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("district - getRDNameDetails - Error - line 56"); 
			alert('something bad happened'); }
		}) ;
	}
	

	function dispMarketViewsDetails(dataJSON)
	{
		$('#view_market_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				//{ "mDataProp": "market_id" },
				{ "mDataProp": "market_name" },
				{ "mDataProp": "region_name" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
					return '<a id="'+ meta.row +'" class="btn marketBtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.market_name+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a id="'+
					meta.row +'" class="btn marketBtndelete" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.market_name+'" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				 } 
				},
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Market Details',
				exportOptions: {
                    columns: [  0, 1, 2 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Market Details',
				exportOptions: {
                    columns: [  0, 1, 2 ]
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
					$newButton = $('<input type = "button" class="fa-input marketBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New DM" />');
					$('#view_market_details_filter').append($clearButton,$newButton);
			},
		});
		return true;
	}
	
	function dispDropDown()
	{
		var index;
		$('#market_name').html('');
		$('#region_name').html('');
		//$("#market_name").append('<option value="">''</option>');
		for(index=0;index < marketNameDetails_JSON.length;index++)
		{			
			 $("#market_name").append('<option value="' + marketNameDetails_JSON[index].uid + '">' + marketNameDetails_JSON[index].name + '</option>');
			// $("#region_name").append('<option value="' + marketNameDetails_JSON[index].uid + '">' + marketNameDetails_JSON[index].name + '</option>');
		}
		for(index=0;index < rdNameDetails_JSON.length;index++)
		{			
			 $("#region_name").append('<option value="' + rdNameDetails_JSON[index].region_id + '">' + rdNameDetails_JSON[index].region_name + '</option>');
		} 
		 $('#market_name').selectpicker('refresh');
		 $('#region_name').selectpicker('refresh');
	}
 	
	$(document).on('click','.marketBtnnew',function ()
	{
		mode = "add";
		$('#regiondelete_alert').hide();
		$('#save_market_details').prop('disabled', false);
		$('#market_model').modal('toggle');	
		clearMarketForm();		
		$('#market_name').prop('disabled', false);
		$('#market_name').selectpicker('refresh');
		$('#region_name').prop('disabled', false);
		$('#region_name').selectpicker('refresh');
		$("#save_market_details").html('Add');
		$('.modal-title').html('New Market');
	});
	
	$(document).on('click','.marketBtnEdit',function ()
	{
		mode = "update";
		$('#regiondelete_alert').hide();
		$('#save_market_details').prop('disabled', false);
		$('#market_model').modal('toggle');	
		$('#market_name').prop('disabled', true);
		$('#market_name').selectpicker('refresh');
		$('#region_name').prop('disabled', false);
		$('#region_name').selectpicker('refresh');		
		var id = $(this).attr('id');
		$('#market_name').selectpicker('val',marketDetails_JSON[id].market_id);
		console.log(marketDetails_JSON[id].rd_id);
		$('#region_name').selectpicker('val',marketDetails_JSON[id].rd_id);
		$("#save_market_details").html('Update');
		$('.modal-title').html('Update Market');
	});
	
	$(document).on('click','.marketBtndelete',function ()
	{
		mode = "delete";
		$('#regiondelete_alert').hide();
		$('#save_market_details').prop('disabled', false);
		$('#market_model').modal('toggle');	
		$('#market_name').prop('disabled', true);
		$('#market_name').selectpicker('refresh');
		$('#region_name').prop('disabled', true);
		$('#region_name').selectpicker('refresh');
		var id = $(this).attr('id');
		$('#market_name').selectpicker('val',marketDetails_JSON[id].market_id);
		$('#region_name').selectpicker('val',marketDetails_JSON[id].rd_id);
		
		if($('#region_name').val() !== '')
		{
			$('#regiondelete_alert').show();
			$('#save_market_details').prop('disabled', true);
		}
		$("#save_market_details").html('Delete');
		$('.modal-title').html('Delete Market');
	});

	
	$('#save_market_details').click(function(e){
		if( $('#market_name').val()=='')
		{
			$.notify({
					message: "Market Name must be provided"
				},{
					type: 'danger'
				});
		}
		else if( $('#region_name').val()=='' && mode == 'add' )
		{
			$.notify({
					message: "RD Name must be provided"
				},{
					type: 'danger'
				});
		}
		else
		{
		var selectedText = $('#market_name').find("option:selected").text(); 
		 var data = [];
			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveMarket","mode":mode,"market_name":selectedText,"market_id":$('#market_name').val(),
						"region_id":$('#region_name').val()
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
						refreshMarketDetails();
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
	
	function refreshMarketDetails()
	{
		$.when(getMarketViewsDetails()).done(function(){
			$('#market_model').modal('toggle');
			var table = $('#view_market_details').DataTable();
			table.destroy();
			dispMarketViewsDetails(marketDetails_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
	function clearMarketForm()
	{
		 $('#market_name').selectpicker('val','');
		 $('#region_name').selectpicker('val','');
	}
	
	$(document).on('click','.selected',function(){
		if($(this).hasClass("active"))
		{
			 $(this).removeClass("active");
			 $('#region_name').selectpicker('val','');
		}
	});
	
/* 	$(".selectpicker").on('change', function () {
    var value = $(this).val();
    if (value == "") {
        $(this).closest(".div_img_part-2").find("input[type='checkbox']").prop('checked', false);
        if ($("input:checked").length == 0) {
            $('.disable').prop('disabled', false);
            $('.selectpicker').selectpicker('refresh');
        }
    } else {
        $(this).closest(".div_img_part-2").find("input[type='checkbox']").prop('checked', true);
    }
}); */
});

