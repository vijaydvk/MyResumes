$(document).ready(function() {
	var rebuild_dataJSON;
	$('#loader').hide();
	$('#load').hide();	
	$('#monthly_ebit_upload_clear_button').click(function (){
		clearRentForm();
	});
	$('#monthly_ebit_upload_button').click(function (){
		if ($('#monthly_ebit_upload').val()=='')
		{
			$.notify({
				
					message: 'Check Excel File'
				},{
					
					type: 'danger'
				}); 
		}
		else
		{
			$('#loader').show();
			$('#load').show();	
			var form = $('#monthly_ebit_upload_form')[0];
			var data = new FormData(form);
			request = $.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "index.php?action=saveMonthlyebit",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
			});
			request.done(function (response){
			$('#loader').hide();
			$('#load').hide();	
			var js = $.parseJSON(response);
				if(js.success)
				{
					$.notify({
						// options
						message: js.count + " " + js.msg 
					},{
						// settings
						type: 'success'
					});
					 if(js.dup_chk != '')
					{
						$.notify({
						// options
						message: js.dup_chk
						},{
							// settings
							type: 'danger'
						});
						/* rebuild_dataJSON = js.data_JSON;
						rebuildDataTable(); */
					}					
					/* else
					{  */
						clearRentForm();
					/* } */					
				}
				else
				{
					$.notify({
						// options
						message: js.errors
					},{
						// settings
						type: 'danger'
					});
				}
			});
			request.fail(function ( jqXHR, textStatus, errorThrown)
			{
				$('#loader').hide();
				$('#load').hide();	
				$.notify({
				
					message: errorThrown
				},{
					
					type: 'danger'
				}); 
			}); 
		}
	});
	function clearRentForm()
	{
		$('#monthly_ebit_upload_form')[0].reset();		
		if ( $.fn.DataTable.isDataTable('#view_monthly_ebit_file') ) {
			  $('#view_monthly_ebit_file').DataTable().destroy();
			  $('#view_monthly_ebit_file').css("display","none");
		}
		$('#file_name').html('');
	}
	
	function rebuildDataTable()
	{
		$('#monthly_ebit_upload_form')[0].reset();		
		if ( $.fn.DataTable.isDataTable('#view_monthly_ebit_file') ) {
			  $('#view_monthly_ebit_file').DataTable().destroy();
			  //console.log(rebuild_dataJSON);
			   $('#view_monthly_ebit_file').DataTable({
					 "aaData": rebuild_dataJSON,
					  "aoColumns": [
							{ "mDataProp": "store_id" },
							{ "mDataProp": "OPPS" },
							{ "mDataProp": "GPO" },
							{ "mDataProp": "GM" },
							{ "mDataProp": "EBITDA" },
							{ "mDataProp": "PAYROLL" },
							{ "mDataProp": "RENT" },
							{ "mDataProp": "CSP" },
							{ "mDataProp": "HANDSET MARGIN" },
							{ "mDataProp": "for_month" },
							{ "mDataProp": "for_year" },
						],
			   });
		}
		$('#file_name').html('');
	}
});

