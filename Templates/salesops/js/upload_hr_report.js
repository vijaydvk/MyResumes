$(document).ready(function() {
	$('#loader').hide();
	$('#load').hide();	
	$('#upload_hr_report_clear_button').click(function (){
		$('#upload_hr_report_form')[0].reset();		
		if ( $.fn.DataTable.isDataTable('#view_tickets_open') ) {
			  $('#view_tickets_open').DataTable().destroy();
			  $('#view_tickets_open').css("display","none");
		}
		$('#file_name').html('');
	});
	$('#upload_hr_report_button').click(function (){
		if ($('#upload_hr_report_file').val()=='')
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
			var form = $('#upload_hr_report_form')[0];
			var data = new FormData(form);
			request = $.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				//url: "classes/mileage_expense_db_page.php",
				url: "index.php?action=saveHRReport",
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
					$('#upload_hr_report_form')[0].reset();
					if ( $.fn.DataTable.isDataTable('#view_tickets_open') ) {
					  $('#view_tickets_open').DataTable().destroy();
					  $('#view_tickets_open').css("display","none");
					}
					$('#file_name').html('');
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

});

