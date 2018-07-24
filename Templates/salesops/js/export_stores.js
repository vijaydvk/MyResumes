$(document).ready(function() {
	var storesDetails_JSON = [];
	
	$.when(getExportStores()).done(function(){				
		dispStoresDetails(storesDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
		
	});
	
	function getExportStores()
	{
		return $.ajax({
			url:'controller/index1.php?action=getExportStores',
			type:'POST',
			success:function(data){
				storesDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores - getExportStores - Error - line 23"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function dispStoresDetails(dataJSON)
	{
		$('#export_stores_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "region_name" },
				{ "mDataProp": "market_name" },
				{ "mDataProp": "district_name" },
				{ "mDataProp": "store_id" },
				{ "mDataProp": "store_name" },
				{ "mDataProp": "rq_store_name" },
				{ "mDataProp": "store_email" },
				{ "mDataProp": "store_address" },
				{ "mDataProp": "store_city" },
				{ "mDataProp": "store_state" },
				{ "mDataProp": "store_zip" },
				{ "mDataProp": "store_phone" },				
				{ "mDataProp": "store_uid" },
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Store(s) Details',
				exportOptions: {
                    columns: [  0, 1 , 2 , 3 , 4, 5, 6, 7, 8, 9, 10, 11, 12  ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Store(s) Details',
				exportOptions: {
                      columns: [  0, 1 , 2 , 3 , 4, 5, 6, 7, 8, 9, 10, 11, 12  ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],
			
		});
		return true;
	}

	

 	
});

