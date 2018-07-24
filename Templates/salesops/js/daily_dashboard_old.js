$(document).ready(function() {
	var daily_dashboard_view_JSON = [];
	var daily_dashboard4store_view_JSON = [];
	var s_id;
	urll = window.location.href;
	
	if (urll.indexOf("&sid=") > -1)
	{
		s_id = urll.substr(urll.indexOf("&sid=") + 1)
		$.when(getDailyDashboard4StoreDetails()).done(function(){
			dispDailyDashboard4StoreDetails(daily_dashboard4store_view_JSON);
			dispDailyDashboard4StoreDetails1(daily_dashboard4store_view_JSON);
		});
	}
	else
	{
		$.when(getDailyDashboardDetails()).done(function(){
			dispDailyDashboardDetails(daily_dashboard_view_JSON);
		});
	}
	
	function getDailyDashboardDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDailyDashboardDetails',
			type:'POST',
			success:function(data){
				daily_dashboard_view_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("daily_dashboard - getDailyDashboardDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getDailyDashboard4StoreDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDailyDashboard4StoreDetails&'+s_id,
			type:'POST',
			success:function(data){
				daily_dashboard4store_view_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("daily_dashboard - getDailyDashboard4StoreDetailsDetails - Error - line 42"); 
			alert('something bad happened'); }
		}) ;
	}
		
	function dispDailyDashboardDetails(dataJSON)
	{
		$('#view_daily_dashboard_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "store_id" },
				{ "mDataProp": "store_name" },
				{ "mDataProp": "month_year" },
				{ "mDataProp": "address" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
					return '<a href="index.php?action=dailydashboard&sid='+data.store_id+'"><i class="fa fa-link" aria-hidden="true"></i></a>';
				 } 
				},
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Daily Dashboard Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Daily Dashboard Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],			
		});
		return true;
	}
	
	function dispDailyDashboard4StoreDetails(dataJSON)
	{
		$('#view_daily_dashboard_store_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "store_name","bSortable":false, },
				{ "mDataProp": "Adds","bSortable":false },
				{ "mDataProp": "UPS","bSortable":false },
				{ "mDataProp": "DTV","bSortable":false },
				{ "mDataProp": "goal","bSortable":false },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.OP_goal*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.RPM*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '$'+data.Acc_Rev;
					},"bSortable":false
				},
				{ "mDataProp": "Acc_Opp","bSortable":false },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.ABP*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.Protect*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.WTR*1).toFixed(2)+'%';
					},"bSortable":false
				},
			],
			dom: 't',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Store Daily Dashboard Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Store Daily Dashboard Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
				orientation: 'landscape',
                pageSize: 'LEGAL'
			},
			],			
		});
		return true;
	}
	
	function dispDailyDashboard4StoreDetails1(dataJSON)
	{
		$('#view_daily_dashboard_store_details1').dataTable( {
					
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "store_name","bSortable":false, },
				{ "mDataProp": "Adds","bSortable":false },
				{ "mDataProp": "UPS","bSortable":false },
				{ "mDataProp": "DTV","bSortable":false },
				{ "mDataProp": "goal","bSortable":false },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.OP_goal*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.RPM*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '$'+data.Acc_Rev;
					},"bSortable":false
				},
				{ "mDataProp": "Acc_Opp","bSortable":false },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.ABP*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.Protect*100).toFixed(2)+'%';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return (data.WTR*1).toFixed(2)+'%';
					},"bSortable":false
				},
			],
			dom: 't',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Store Daily Dashboard Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Store Daily Dashboard Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],			
		});
		//$('#hide_tr').hide();
	}
	
	
});

