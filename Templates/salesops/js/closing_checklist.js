$(document).ready(function() {
	var closingChecklistDetails_JSON = [];
	var mode="";
	var update_id="";
	$.when(getclosingChecklistViewsDetails()).done(function(){				
		dispclosingChecklistViewsDetails(closingChecklistDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
	}); 
	
	function getclosingChecklistViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getclosingChecklistViewsDetails',
			type:'POST',
			success:function(data){
				closingChecklistDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("closing_checklist - getclosingChecklistViewsDetails - Error - line 29"); 
			//alert('something bad happened'); }
			}
		});
	}
	
	function dispclosingChecklistViewsDetails(dataJSON)
	{
		$('#view_closing_checklist_details').dataTable( {
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
					return '<a id="'+ meta.row +'" class="btn closingchecklistBtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.question+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;';
				 } 
				},
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'closing Checklist Details',
				exportOptions: {
                    columns: [  0, 1 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'closing Checklist Details',
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
					$newButton = $('<input type = "button" class="fa-input closingchecklistBtnNew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New closing Checklist" />');
					$('#view_closing_checklist_details_filter').append($clearButton,$newButton);
			},
		});
		return true;
	}
	
	$(document).on('click','.closingchecklistBtnNew',function ()
	{
		mode = "add";
		update_id="";
		$('.modal-title').html("New Question");
		$('#closing_checklist_model').modal('toggle');	
		$('#question').val('');
	});
	
	$(document).on('click','.closingchecklistBtnEdit',function ()
	{
		mode = "update";
		var id = $(this).attr('id');
		$('#question').val(closingChecklistDetails_JSON[id].question);
		update_id = closingChecklistDetails_JSON[id].closing_id;
		$('#closing_checklist_model').modal('toggle');
		$('.modal-title').html("Edit Question");
	});
	
	$('#save_closing_checklist').click(function(e){
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
				data: {"action": "saveclosingChecklist","mode":mode,"question":$('#question').val(),"closing_id":update_id},
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
						refreshclosingchecklistDetails();
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
	
	function refreshclosingchecklistDetails()
	{
		$.when(getclosingChecklistViewsDetails()).done(function(){
			$('#closing_checklist_model').modal('toggle');
			var table = $('#view_closing_checklist_details').DataTable();
			table.destroy();
			dispclosingChecklistViewsDetails(closingChecklistDetails_JSON);
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
		for(var i=0;i<closingChecklistDetails_JSON.length;i++)
		{
			JSONquestion = closingChecklistDetails_JSON[i].question;
			nJSONquestion = JSONquestion.replace(/\s+/g, '').toLowerCase();
			if (nquestion == nJSONquestion)
			{
				return true;
			}
		}
		return false;
	}	

});

