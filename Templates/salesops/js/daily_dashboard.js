$(document).ready(function() {
	var daily_dashboard_view_JSON = [];
	var daily_dashboard4store_view_JSON = [];
	var s_id;
	var page_number;
	urll = window.location.href;
	
	if (urll.indexOf("&sid=") > -1)
	{
		s_id = urll.substr(urll.indexOf("&sid=") + 1)
		$.when(getDailyDashboard4StoreDetails()).done(function(){
			dispDailyDashboard4StoreDetails(daily_dashboard4store_view_JSON);
			dispDailyDashboard4StoreDetails1(daily_dashboard4store_view_JSON);
			$('#history_navigate').attr("href","index.php?action=dailydashboard&trackPage="+localStorage.getItem(page_number));
			//localStorage.removeItem(page_number);
		});
	}
	else
	{
		$.when(getDailyDashboardDetails()).done(function(){
			dispDailyDashboardDetails(daily_dashboard_view_JSON);
		});
		
		/* if(track_page>3)
		{
			var table = $('#view_daily_dashboard_details').DataTable();
			table.page( track_page-1 ).draw( false );
		} */
	}
	$(document).on('click','.paginate_button', function() {		
		if(($('.current').html() !="Next") && ($('.current').html() !="Previous")  )
		{
			localStorage.removeItem(page_number);
			localStorage.setItem(page_number, $('.current').html());
			//console.log(localStorage.getItem(page_number));
		}
			//page_number = localStorage.getItem(page_number);
			//console.log(localStorage.getItem(page_number));
	});
	

	/* $('#navigate').on('click', function() {
        let name = $(this).attr('data-name');
		console.log(name);
		 var table = $('#view_daily_dashboard_details').DataTable();
        table.page( 2 ).draw( false );
    });
	
	jQuery.fn.dataTable.Api.register( 'page.jumpToData()', function ( data, column ) {
		var pos = this.column(column, {order:'current'}).data().indexOf( data );
	 
		if ( pos >= 0 ) {
			var page = Math.floor( pos / this.page.info().length );
			this.page( page ).draw( false );
		}
	 
		return this;
	} ); */
	
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
		if (urll.indexOf("&trackPage=") > -1)
		{
			s_id = urll.substr(urll.indexOf("&trackPage=") + 1)
			var num = s_id.replace("trackPage=","");
			//console.log(num);
			if(parseInt(num)>1)
			{
				var table = $('#view_daily_dashboard_details').DataTable();
				table.page( parseInt(num)-1 ).draw( false );
			}
		} 
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
			/* "aoColumns": [
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
			], */
			"aoColumns": [
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return data.store_name;
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
					},"bSortable":false
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '';
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

