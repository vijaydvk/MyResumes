$(document).ready(function() {
	var expense_list_JSON = [];
	var JSON_loaded_flag = false;
	if(JSON_loaded_flag == false)
	{
		$.when(getexpense_list()).done(function(){				
				$.when(dispexpense_list(expense_list_JSON)).done(function(){
					$('[data-toggle="tooltip"]').tooltip();
					JSON_loaded_flag = true;
					//checkSearchOrNot();
			});					
		});
	}
	else
	{
		//checkSearchOrNot();
	}
	
	function getexpense_list()
	{
		return $.ajax({
			url:'controller/index1.php?action=getexpense_list',
			type:'POST',
			success:function(data){
				expense_list_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("data_change_view - getexpense_list - Error - line 55"); 
			alert('something bad happened'); }
		}) ;
	}
	function dispexpense_list(dataJSON)
	{
		$('#view_expense_list').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "expense_id" },
				{ "mDataProp": "SubmittedBy" },
				{ "mDataProp": "Merchant" },
				{ "mDataProp": "Description" },
				{ "mDataProp": "amount" },	
				{ "mDataProp": "SubmitTime" },	
				{ "mDataProp": "ExpenseTime" },	
				{ "mDataProp": function ( data, type, row, meta ) {
					if (data.ExpenseImage == 'N/A')
					{
						return "---"
					}
					else
					{
						return '<a href="'+data.ExpenseImage+'"><img src="' + data.ExpenseImage + 
						'" height="50px" width="50px" /></a>';}},
					},
				{ "mDataProp": "Approval" },		
				{ "mDataProp": "ExpenseStatus" },
				
			],
			initComplete : function() {
				  var api = this.api();
				  var input = $('.dataTables_filter input');
				  $clearButton = $('<input type = "button" data-toggle="tooltip" data-placement="top" title="Click to clear the search and refresh the table" value="Clear" />')
                       .click(function() {
						 input.val('');
						 api.search(input.val()).draw();
 						 //api.draw();
                       }) ;
					$('.dataTables_filter').append($clearButton); 
					       
					   
			},
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Expense List',
				exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Expense List',
				exportOptions: {
                    columns: [   0, 1, 2, 3, 4, 5 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			]
		});
		return true;
	}
	
 	
	function checkSearchOrNot()
	{
		var browserurl= window.location.href;
		var length = browserurl.indexOf("ticketID=");
		var diff = browserurl.length - (length+9)
		var tID = browserurl.substr(browserurl.length - diff);
		if(length > -1 )
		{
			window.history.pushState('homePage', 'Title', 'index.php?action=homePage');
			filterSearch(tID);
		} 
		
		//alert(url);
	}
	function filterSearch(t_id)
	{
		var table = $('#view_tickets_open').DataTable();
		table.column(0).search(t_id).draw();
	}	
});

