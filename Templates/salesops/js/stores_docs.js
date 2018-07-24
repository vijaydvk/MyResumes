$(document).ready(function() {	
	var doc_type_view_JSON = [];
	var stores_docs_JSON = [];
	var store_details_JSON = [];
	var doc_type_JSON = [];	
	var doc_type_id ="";
	$.when(getStoresDocsViewsDetails()).done(function(){
		disptStoresDocsViewsDetails(stores_docs_JSON);
		$.when(getStoresDocsListDetails()).done(function(){	
			$.when(getDocTypeListDetails()).done(function(){
					dispDropDown();
			});
		});
		$.when(getDocsTypeViewsDetails()).done(function(){				
			disptDocsTypeViewsDetails(doc_type_view_JSON);		
		});
	});
	
	function getDocsTypeViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDocsTypeViewsDetails',
			type:'POST',
			success:function(data){
				doc_type_view_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores_docs - getDocsTypeViewsDetails - Error - line 18"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getStoresDocsViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoresDocsViewsDetails',
			type:'POST',
			success:function(data){
				stores_docs_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores_docs - getStoresDocsViewsDetails - Error - line 33"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getStoresDocsListDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoresDocsListDetails',
			type:'POST',
			success:function(data){
				store_details_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores_docs - getStoresDocsListDetails - Error - line 56"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getDocTypeListDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDocTypeListDetails',
			type:'POST',
			success:function(data){
				doc_type_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores_docs - getDocTypeListDetails - Error - line 70"); 
			alert('something bad happened'); }
		}) ;
	}

	function dispDropDown()
	{
		var index;
		$('#store_id').html('');
		$('#docs_type').html('');		
		for(index=0;index < store_details_JSON.length;index++)
		{			
			 $("#store_id").append('<option value="' + store_details_JSON[index].store_id + '">' + store_details_JSON[index].store_name + '</option>');
		}
		for(index=0;index < doc_type_JSON.length;index++)
		{			
			 $("#docs_type").append('<option value="' + doc_type_JSON[index].doc_type_id + '">' + doc_type_JSON[index].doc_type + '</option>');
		}
		 $('#store_id').selectpicker('refresh');
		 $('#docs_type').selectpicker('refresh');
		 
	}	
	
	function disptDocsTypeViewsDetails(dataJSON)
	{
		$('#view_docs_type').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "doc_type" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if (data.active=='1')
						{
						return 'Active';
						}
						else
						{
							return 'Inactive';
						}
					} 
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
					return '<a id="'+meta.row +'" class="btn docsTypeBtnupdate" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.doc_type+'" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
				 }
				}
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Document Types Details',
				exportOptions: {
                    columns: [  0, 1  ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Document Types Details',
				exportOptions: {
                    columns: [  0, 1  ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],
			"initComplete": function () {
	            var api = this.api();
				 /*  $clearButton = $('<input type = "button" data-toggle="tooltip" data-placement="top" title="Click to clear search and refresh the table" value="Clear" />')
                       .click(function() {
 						 api.search('').draw();
                       }) ; */
					$newButton = $('<input type = "button" class="fa-input docsTypeBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New DM" />');
					$('#view_docs_type_filter').append($newButton);
			},
		});
		//var height = $('#view_users_details').height();
		return true;
	}

	function disptStoresDocsViewsDetails(dataJSON)
	{
		$('#view_stores_docs_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "doc_id" },
				{ "mDataProp": "store_id" },
				{ "mDataProp": "store_name" },
				{ "mDataProp": "doc_type" },
				{ "mDataProp": "doc_file_name" },
				{ "mDataProp": "doc_file_type" },
				{ "mDataProp": "renewal_date" },
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Store Document Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3, 4, 5, 6, 7 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Store Document Details',
				exportOptions: {
                     columns: [  0, 1, 2, 3, 4, 5, 6, 7 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],
	});
	return true;
	}	
	
	$('.nav-tabs a').click(function(){
	   $(".nav-tabs a").removeClass("active");
	   $(this).addClass("active");
	   //alert($(this).attr('href'));
	   var id=$(this).attr('href');
	   $(".content-pane").removeClass("is-active");
	   $(id).addClass("is-active");   
	});	

	$(document).on('click','.docsTypeBtnnew',function ()
		{
			mode = "add";
			$('#doc_type_model').modal('toggle');
			$('#doc_type').val('');
			$('#status_div').hide();
			$("#save_doc_type").html('Add');
			doc_type_id = 0
		});
		
	$(document).on('click','.docsTypeBtnupdate',function ()
		{
			mode = "update";
			$('#doc_type_model').modal('toggle');
			var id = $(this).attr('id');
			$('#doc_type').val(doc_type_view_JSON[id].doc_type);
			doc_type_id = doc_type_view_JSON[id].doc_type_id;
			$('#status_div').show();
			$("input[name=edit_doc_type_status][value='"+doc_type_view_JSON[id].active+"']").prop("checked",true);
			$("#save_doc_type").html('Update');
		});
		
	$('#save_doc_type').click(function(e){
		var active = $('#edit_doc_type_status:checked').val();
		if( $('#doc_type').val()=='')
		{
			$.notify({
					message: "Document Types must be provided"
				},{
					type: 'danger'
				});
		}
		else
		{
			request = $.ajax({
					url: 'index.php',
					data: {"action": "saveDocType","mode":mode,"doc_type":$('#doc_type').val(),"doc_type_id":doc_type_id,"status":active
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
							refreshDocTypeDetails();
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

	function refreshDocTypeDetails()
	{
		$.when(getDocsTypeViewsDetails()).done(function(){
			$('#doc_type_model').modal('toggle');
			var table = $('#view_docs_type').DataTable();
			table.destroy();
			disptDocsTypeViewsDetails(doc_type_view_JSON);	
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
});

