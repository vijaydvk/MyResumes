$(document).ready(function() {
	var districtDetails_JSON = [];
	var DMDetailsList_JSON = [];
	var StoreDetailsList_JSON = [];
	var MarketDetailsList_JSON = [];
	var DMStoreList_JSON = [];
	var mode="";
	var district_id="";
	$.when(getDistrictDetails()).done(function(){				
		dispDistrictDetails(districtDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
	});
	$.when(getDMDetails()).done(function(){
		$.when(getMarketDetails()).done(function(){
			$.when(getStoreDetails()).done(function(){
				initializeMultiselect();
				dispDropDown();	
			});
		});
	});
	function getDMDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDMDetails',
			type:'POST',
			success:function(data){
				DMDetailsList_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("district - getDMDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getMarketDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getMarketDetails',
			type:'POST',
			success:function(data){
				MarketDetailsList_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("district - getMarketDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getStoreDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoreDetails',
			type:'POST',
			success:function(data){
				StoreDetailsList_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("district - getStoreDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}

	function getDistrictDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDistrictDetails',
			type:'POST',
			success:function(data){
				districtDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("district - getDistrictDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}	

	function dispDistrictDetails(dataJSON)
	{
		$('#view_district_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "name" },
				{ "mDataProp": "market_name" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
					return '<a id="'+ meta.row +'" class="btn districtBtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.name+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a id="'+
					meta.row +'" class="btn districtBtndelete" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.name+'" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
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
					$newButton = $('<input type = "button" class="fa-input districtBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New DM" />');
					$('#view_district_details_filter').append($clearButton,$newButton);
			},
		});
		return true;
	}
	
	function dispDropDown()
	{
		var index;
		$('#district_name').html('');
		$('#market_id').html('');
		$("#store_district_id").html('');
		for(index=0;index < DMDetailsList_JSON.length;index++)
		{			
			 $("#district_name").append('<option value="' + DMDetailsList_JSON[index].uid + '">' + DMDetailsList_JSON[index].name + '</option>');
		}
		for(index=0;index < MarketDetailsList_JSON.length;index++)
		{			
			 $("#market_id").append('<option value="' + MarketDetailsList_JSON[index].market_id + '">' + MarketDetailsList_JSON[index].market_name + '</option>');
		}
		for(index=0;index < StoreDetailsList_JSON.length;index++)
		{			
			 $("#store_district_id").append('<option value="' + StoreDetailsList_JSON[index].store_id + '">' + StoreDetailsList_JSON[index].store_name + '</option>');
		}
		 $('#district_name').selectpicker('refresh');
		 $('#market_id').selectpicker('refresh');
		 $('#store_district_id').multiselect('rebuild');
	}
 	
	$(document).on('click','.districtBtnnew',function ()
	{
		mode = "add";
		$('#delete_alert').css("display","none");
		$('#save_district_details').attr('disabled',false);
		$('#save_district_details').css('background','#007bff');
		$('#district_model').modal('toggle');			
		$("#save_district_details").html('Add');
		$('.modal-title').html('New DM');
		clearDistrictForm();
		dispDropDown();
		$('#district_name').prop('disabled', false);
		$('#district_name').selectpicker('refresh');
		$('#market_id').prop('disabled', false);
		$('#market_id').selectpicker('refresh');
	});
	
	$(document).on('click','.districtBtnEdit',function ()
	{
		var tempJSON = JSON.parse(JSON.stringify(StoreDetailsList_JSON)); 
		var data=[];
		var index;
		var store_split;
		var id = $(this).attr('id');
		mode = "update";
		$('#delete_alert').css("display","none");
		$('#save_district_details').attr('disabled',false);
		$('#save_district_details').css('background','#007bff');
		district_id = districtDetails_JSON[id].id;
		$('#district_model').modal('toggle');
		$("#save_district_details").html('Update');
		$('.modal-title').html('Update DM');		
		$.when(getDMStoreList()).done(function(){
			$('#district_name').selectpicker('val',districtDetails_JSON[id].id);
			$('#market_id').selectpicker('val',districtDetails_JSON[id].market_id);			
			$("#store_district_id").multiselect("clearSelection");
			store_split = DMStoreList_JSON[0].store_id.split(",");						
			for(var i=0;i<store_split.length;i++)
			{				 
				      for (var j = 0; j < tempJSON.length; j++) {
							var cur = tempJSON[j];
							if (cur.store_id == store_split[i]) {
								tempJSON.splice(j, 1);
								data.push(cur);
								break;
							}
						}
			}  
			for (var j = 0; j < tempJSON.length; j++) {
				var cur = tempJSON[j];
					data.push(cur);		
			}
			$('#store_district_id').html('');			
			for(index=0;index < data.length;index++)
			{			
				 $("#store_district_id").append('<option value="' + data[index].store_id + '">' + data[index].store_name + '</option>');
			} 	
			$('#store_district_id').multiselect('rebuild');	
			$('#store_district_id').multiselect('select', store_split );
			$('#store_district_id').multiselect('refresh');	
			$('#district_name').prop('disabled', true);
			$('#district_name').selectpicker('refresh');
			$('#market_id').prop('disabled', false);
			$('#market_id').selectpicker('refresh');
		});
	});
	
	$(document).on('click','.districtBtndelete',function ()
	{
		var tempJSON = JSON.parse(JSON.stringify(StoreDetailsList_JSON)); 
		var data=[];
		var index;
		var store_split;
		var id = $(this).attr('id');
		mode = "delete";
		district_id = districtDetails_JSON[id].id;
		$('#district_model').modal('toggle');
		$("#save_district_details").html('Delete');	
		$('.modal-title').html('Delete DM');
		$.when(getDMStoreList()).done(function(){
			$('#district_name').selectpicker('val',districtDetails_JSON[id].id);
			$('#market_id').selectpicker('val',districtDetails_JSON[id].market_id);			
			$("#store_district_id").multiselect("clearSelection");
			store_split = DMStoreList_JSON[0].store_id.split(",");
			//console.log(DMStoreList_JSON[0].store_id);
			if(DMStoreList_JSON[0].store_id !== '')
			{
				$('#delete_alert').css("display","block");
				$('#save_district_details').attr('disabled',true);
				$('#save_district_details').css('background','#6c757d');
				
			}
			else
			{
				$('#delete_alert').css("display","none");
				$('#save_district_details').attr('disabled',false);
				$('#save_district_details').css('background','#007bff');				
			}
			for(var i=0;i<store_split.length;i++)
			{				 
				      for (var j = 0; j < tempJSON.length; j++) {
							var cur = tempJSON[j];
							if (cur.store_id == store_split[i]) {
								tempJSON.splice(j, 1);
								data.push(cur);
								break;
							}
						}
			}  
			for (var j = 0; j < tempJSON.length; j++) {
				var cur = tempJSON[j];
					data.push(cur);		
			}
			$('#store_district_id').html('');			
			for(index=0;index < data.length;index++)
			{			
				 $("#store_district_id").append('<option value="' + data[index].store_id + '">' + data[index].store_name + '</option>');
			} 	
			$('#store_district_id').multiselect('rebuild');	
			$('#store_district_id').multiselect('select', store_split );
			$('#store_district_id').multiselect('refresh');	
			$('#district_name').prop('disabled', true);
			$('#district_name').selectpicker('refresh');
			$('#market_id').prop('disabled', true);
			$('#market_id').selectpicker('refresh');	
			$('#store_district_id').multiselect('disable');		
		});
	});

	function initializeMultiselect()
	{
		$('.selectM').multiselect({
					numberDisplayed: 4,
					maxHeight: 250, 
					nonSelectedText: '-- Please select One --'	,
					buttonWidth: 'auto',
					enableCaseInsensitiveFiltering: true,
					moveSelectedToTop: true
				}); 
	}
	
	$('#save_district_details').click(function(e){
		if( $('#district_name').val()=='')
		{
			$.notify({
					message: "DM Name must be provided"
				},{
					type: 'danger'
				});
		}
		else if( $('#market_id').val()=='')
		{
			$.notify({
					message: "Market Name must be provided"
				},{
					type: 'danger'
				});
		}
		else if( $('#store_district_id').val()=='' && mode == 'add')
		{
			$.notify({
					message: "Store Name must be provided"
				},{
					type: 'danger'
				});
		}
		else
		{
		/* console.log($('#store_district_id').val());
		console.log($('#district_name').val());
		console.log($('#market_id').val()); */
		var selectedText = $('#district_name').find("option:selected").text();    
		//$(".test").text(selectedText);
		//console.log(selectedText);
		var temp_store_id = $('#store_district_id').val();
		if(temp_store_id == '')
		{
			temp_store_id = 'empty';
		}
		 var data = [];

			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveDistrict","mode":mode,"district_name":selectedText,"market_id":$('#market_id').val(),"district_id":$('#district_name').val(),
					  "store_id":temp_store_id
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
						refreshDistrictDetails();
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
	
	function refreshDistrictDetails()
	{
		$.when(getDistrictDetails()).done(function(){
			$('#district_model').modal('toggle');
			var table = $('#view_district_details').DataTable();
			table.destroy();
			dispDistrictDetails(districtDetails_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
	function clearDistrictForm()
	{
		 $('#district_name').selectpicker('val','');
		 $('#market_id').selectpicker('val','');
		 $("#store_district_id").multiselect("clearSelection");
	}
	
	function getDMStoreList()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDMStoreList&id='+district_id,
			type:'POST',
			success:function(data){
				DMStoreList_JSON = $.parseJSON(data);			
        },		
		error: function() {
			console.log("district - getDMDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	

});

