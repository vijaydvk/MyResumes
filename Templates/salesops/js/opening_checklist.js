$(document).ready(function() {
	var openingChecklistDetails_JSON = [];
	var mode="";
	var update_id="";
	$.when(getOpeningChecklistViewsDetails()).done(function(){				
		dispOpeningChecklistViewsDetails(openingChecklistDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
	}); 
	
	function getOpeningChecklistViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getOpeningChecklistViewsDetails',
			type:'POST',
			success:function(data){
				openingChecklistDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("opening_checklist - getOpeningChecklistViewsDetails - Error - line 29"); 
			//alert('something bad happened'); }
			}
		});
	}
	
	function dispOpeningChecklistViewsDetails(dataJSON)
	{
		$('#view_opening_checklist_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				//{ "mDataProp": "market_id" },
				{ "mDataProp": "question" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.active == 1)
							return 'Active';
						else
							return 'Inactive';
				 } 
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
					return '<a id="'+ meta.row +'" class="btn openingchecklistBtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.question+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;';
				 } 
				},
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Opening Checklist Details',
				exportOptions: {
                    columns: [  0, 1 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Opening Checklist Details',
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
					$newButton = $('<input type = "button" class="fa-input openingchecklistBtnNew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New Opening Checklist" />');
					$('#view_opening_checklist_details_filter').append($clearButton,$newButton);
			},
		});
		return true;
	}
	
	$(document).on('click','.openingchecklistBtnNew',function ()
	{
		mode = "add";
		update_id="";
		$('.modal-title').html("New Question");
		$('#opening_checklist_model').modal('toggle');	
		$('#question').val('');
	});
	
	$(document).on('click','.openingchecklistBtnEdit',function ()
	{
		mode = "update";
		var id = $(this).attr('id');
		$('#question').val(openingChecklistDetails_JSON[id].question);
		update_id = openingChecklistDetails_JSON[id].opening_id;
		$('#opening_checklist_model').modal('toggle');
		$('.modal-title').html("Edit Question");
	});
	
	$('#save_opening_checklist').click(function(e){
		if( $('#question').val()=='')
		{
			$.notify({
					message: "Question must be provided"
				},{
					type: 'danger'
				});
		}
		else if(checkExistingQuestion())
		{
			$.notify({
					message: "Question Already Available"
				},{
					type: 'danger'
				});			
		}
		else
		{
			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveOpeningChecklist","mode":mode,"question":$('#question').val(),"opening_id":update_id},
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
						refreshOpeningchecklistDetails();
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
	
	function refreshOpeningchecklistDetails()
	{
		$.when(getOpeningChecklistViewsDetails()).done(function(){
			$('#opening_checklist_model').modal('toggle');
			var table = $('#view_opening_checklist_details').DataTable();
			table.destroy();
			dispOpeningChecklistViewsDetails(openingChecklistDetails_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
	function clearMarketForm()
	{
		 $('#question').val('');
	}

	function checkExistingQuestion()
	{
		var question = $('#question').val();
		var JSONquestion;
		var nquestion = question.replace(/\s+/g, '').toLowerCase();
		var nJSONquestion; 
		for(var i=0;i<openingChecklistDetails_JSON.length;i++)
		{
			JSONquestion = openingChecklistDetails_JSON[i].question;
			nJSONquestion = JSONquestion.replace(/\s+/g, '').toLowerCase();
			if (nquestion == nJSONquestion)
			{
				return true;
			}
		}
		return false;
	}
	
});

