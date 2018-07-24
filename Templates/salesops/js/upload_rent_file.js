$(document).ready(function() {
	var rebuild_dataJSON;
	$('#loader').hide();
	$('#load').hide();	
	$('#upload_rent_file_clear_button').click(function (){
		clearRentForm();
	});
	$('#upload_rent_file_button').click(function (){
		if ($('#upload_rent_file').val()=='')
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
			var form = $('#upload_rent_file_form')[0];
			var data = new FormData(form);
			request = $.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "index.php?action=saveRentFile",
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
						rebuild_dataJSON = js.data_JSON;
						rebuildDataTable();
					}
					else
					{
						clearRentForm();
					}
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
		$('#upload_rent_file_form')[0].reset();		
		if ( $.fn.DataTable.isDataTable('#view_rent_file') ) {
			  $('#view_rent_file').DataTable().destroy();
			  $('#view_rent_file').css("display","none");
		}
		$('#file_name').html('');
	}
	function rebuildDataTable()
	{
		$('#upload_rent_file_form')[0].reset();		
		if ( $.fn.DataTable.isDataTable('#view_rent_file') ) {
			  $('#view_rent_file').DataTable().destroy();
			  //console.log(rebuild_dataJSON);
			   $('#view_rent_file').DataTable({
					 "aaData": rebuild_dataJSON,
					  "aoColumns": [
							{ "mDataProp": "store_id" },
							{ "mDataProp": "account" },
							{ "mDataProp": "rent_id" },
							{ "mDataProp": "vendor" },
							{ "mDataProp": "address" },
							{ "mDataProp": "vendor_in_gp" },
							{ "mDataProp": "Status" },
							{ "mDataProp": "Service" },
							{ "mDataProp": "for_month" },
							{ "mDataProp": "for_year" },
							{ "mDataProp": "amount" },
							{ "mDataProp": "lease_expiration" },
							{ "mDataProp": "sq_ft" },
						],
			   });
		}
		$('#file_name').html('');
	}
});

