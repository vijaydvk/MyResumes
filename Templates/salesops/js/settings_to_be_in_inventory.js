$(document).ready(function() {
	var mode;
	var dynmic_id;
	var oreder_Product_List_JSON = [];
	var oreder_Product_Email_List_JSON = [];
	var general_product_id ='';
	var email_id = '';
	$.when(getOrderProductViewDetails()).done(function(){		
			dispOrderProductViewDetails(oreder_Product_List_JSON);
	});
	
	function getOrderProductViewDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getOrderProductViewDetails',
			type:'POST',
			success:function(data){
				oreder_Product_List_JSON = $.parseJSON(data)
        },		
		error: function() {
			console.log("settings - getOrderProductViewDetails - Error - line 21"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getOrderProductEmailViewDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getOrderProductEmailViewDetails&general_product_id='+general_product_id,
			type:'POST',
			success:function(data){
				oreder_Product_Email_List_JSON = $.parseJSON(data)
        },		
		error: function() {
			console.log("settings - getOrderProductEmailViewDetails - Error - line 35"); 
			alert('something bad happened'); }
		}) ;
	}

	function dispOrderProductViewDetails(dataJSON)
	{
		$('#view_order_product_details').dataTable( {
				"aaSorting":[],
				"aaData": dataJSON,
				"aoColumns": [
					{ "mDataProp": "product_name" },
					{ "mDataProp": "name" },
					{ 
						"mDataProp": function ( data, type, full, meta) {
							if(data.active == 1)
								return 'Active';
							else
								return 'Inactive';
						return 
					 }
					},					 
					{ 
						"mDataProp": function ( data, type, full, meta) {						 
						if(data.active == 0)
						{
							return '<a id="'+meta.row +'" class="btn orderProductBtnactive" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to activate the '+data.product_name+'" role="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>';
						}	
						else
						{
							return '<a id="'+ meta.row +'" class="btn orderProductBtnedit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.product_name+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'+
							'&nbsp;&nbsp;<a id="'+meta.row +'" class="btn orderProductBtnemail" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to view '+data.product_name+'Email  Details" role="button"><i class="fa fa-envelope" aria-hidden="true"></i></a>'+
							'&nbsp;&nbsp;<a id="'+meta.row +'" class="btn orderProductBtndelete" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.product_name+'" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							
						}
					 } ,"bSortable":false,
					},
				],
				dom: 'Bflrtip',
				buttons: [
				{
					extend: 'excelHtml5',
					title: 'Order Product Details',
					exportOptions: {
						columns: [  0, 1, 2 ]
					},
					"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
				},
				{
					extend: 'pdfHtml5',
					title: 'Order Product Details',
					exportOptions: {
						columns: [  0, 1, 2 ]
					},
					"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
				},
				],
				"initComplete": function () {
	           // var api = this.api();
/* 				  $clearButton = $('<input type = "button" data-toggle="tooltip" data-placement="top" title="Click to clear search and refresh the table" value="Clear" />')
                       .click(function() {
 						 api.search('').draw();
                       }) ; */
					$newButton = $('<input type = "button" class="fa-input orderProductBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New Product Name" />');
					$('#view_order_product_details_filter').append($newButton);
				},
		});
		return true;
	}
	
	$(document).on('click','.orderProductBtnnew',function ()
	{
		mode = "add";
		dynmic_id = 1;
		$('#order_product_model').modal('toggle');	
		$('#product_name').val('');	
		general_product_id = '';		
	});
	
	$('#save_product_name').click(function(e){
		if( $('#product_name').val()=='')
		{
			$.notify({
					message: "Product Name must be provided"
				},{
					type: 'danger'
				});
		}
		else
		{

			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveSettings","mode":mode,"product_name":$('#product_name').val(),"general_product_id":general_product_id
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
						refreshOrderProductViewDetails();
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
	
	function refreshOrderProductViewDetails()
	{
		$.when(getOrderProductViewDetails()).done(function(){
			if(mode != "delete" && mode != "active")
			{
				$('#order_product_model').modal('toggle');
			}
			var table = $('#view_order_product_details').DataTable();
			table.destroy();
			dispOrderProductViewDetails(oreder_Product_List_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});	
	}
	
	
	$(document).on('click','.orderProductBtnedit',function ()
	{
		mode = "update";
		var index = $(this).attr('id');
		$('#order_product_model').modal('toggle');	
		$('#product_name').val(oreder_Product_List_JSON[index].product_name);
		general_product_id = oreder_Product_List_JSON[index].product_id;
	});
	
	$(document).on('click','.buttongreen',function ()
	{		
		$('#email_parent_div').append('<br><br><div><div class="col-md-10" style="padding:0px;float:left"><input type="text" class="form-control input-lg" name="product_name" id="product_name" value=""></div><div class="col-md-2" style="padding:0px;float:left;padding-left:5%;padding-top:0%;"><button class="buttonred buttonadd"><i class="fa fa-minus"></i></button></div></div>');
	});
	
	$(document).on('click','.orderProductBtndelete',function ()
	{
	mode = 'delete';
	var id = $(this).attr('id');
	delete_flag = 1;
	$.confirm({
		title: 'Are you sure!',
		content: 'Delete Product '+ oreder_Product_List_JSON[id].product_name,
		buttons: {
			confirm: function () {				
					request = $.ajax({
					url: 'index.php',
					data: {"action": "saveSettings","mode":mode,"general_product_id":oreder_Product_List_JSON[id].product_id},
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
					refreshOrderProductViewDetails();
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
				
			},
			cancel: function () {
				
			},
		
		}
		});
	});
	
	$(document).on('click','.orderProductBtnactive',function ()
	{
	mode = 'active';
	var id = $(this).attr('id');
	delete_flag = 1;
	$.confirm({
		title: 'Are you sure!',
		content: 'Activate Product '+ oreder_Product_List_JSON[id].product_name,
		buttons: {
			confirm: function () {				
					request = $.ajax({
					url: 'index.php',
					data: {"action": "saveSettings","mode":mode,"general_product_id":oreder_Product_List_JSON[id].product_id},
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
					refreshOrderProductViewDetails();
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
				
			},
			cancel: function () {
				
			},
		
		}
		});
	});
	
	$(document).on('click','.orderProductBtnemail',function (){
		var index = $(this).attr('id');
		$('#view_settings_email_details').show();
		$('#view_settings_datatables').hide();		
		general_product_id = oreder_Product_List_JSON[index].product_id;
		$('#product_email_heading').html('<u>Settings - '+oreder_Product_List_JSON[index].product_name+' Details</u>');
		$.when(getOrderProductEmailViewDetails()).done(function(){
			var table = $('#view_order_product_email_details').DataTable();
			table.destroy();
			dispOrderProductEmailViewDetails(oreder_Product_Email_List_JSON);
		});
	});
	
	function dispOrderProductEmailViewDetails(dataJSON)
	{
		$('#view_order_product_email_details').dataTable( {
				"aaSorting":[],
				"aaData": dataJSON,
				"aoColumns": [
					{ "mDataProp": "email" },
					{ "mDataProp": "subject" },
					{ 
						"mDataProp": function ( data, type, full, meta) {
							if(data.status == 1)
								return 'Active';
							else
								return 'Inactive';
						return 
					 }
					},					 
					{ 
						"mDataProp": function ( data, type, full, meta) {						 
						if(data.status == 0)
						{
							return '';
						}	
						else
						{
							return '<a id="'+ meta.row +'" class="btn orderProductMailBtnedit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.product_name+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'+
							'&nbsp;&nbsp;<a id="'+meta.row +'" class="btn orderProductMailBtndelete" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.product_name+'" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							
						}
					 } ,"bSortable":false,
					},
				],
				dom: 'Bflrtip',
				buttons: [
				{
					extend: 'excelHtml5',
					title: 'Order Product Email Details',
					exportOptions: {
						columns: [  0, 1, 2 ]
					},
					"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
				},
				{
					extend: 'pdfHtml5',
					title: 'Order Product Email Details',
					exportOptions: {
						columns: [  0, 1, 2 ]
					},
					"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
				},
				],
				"initComplete": function () {
	           // var api = this.api();
/* 				  $clearButton = $('<input type = "button" data-toggle="tooltip" data-placement="top" title="Click to clear search and refresh the table" value="Clear" />')
                       .click(function() {
 						 api.search('').draw();
                       }) ; */
					$newButton = $('<input type = "button" class="fa-input orderProductMailBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New Product Name" />');
					$('#view_order_product_email_details_filter').append($newButton);
				},
		});
		return true;
	}	
	
	$(document).on('click','.orderProductMailBtnnew',function ()
	{
		mode = "add";
		email_id='';
		$('#order_product_email_model').modal('toggle');	
		$('#email').val('');
		$('#subject').val('');		
		//general_product_id = '';		
	});
	
	function mailCheck(email)
	{
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test($('#email').val());
	}
	
	$('#email').blur(function(){
		if($('#email').val() !=='')
		{
			if(!mailCheck($('#email').val()))
			{
				$.notify({
							
						message: "Email ID is not valid"
					},{
						
						type: 'danger'
					}); 
				 setTimeout(function() {
						$("#email").focus();
					}, 100);
			}
			else
			{
				var mail_name = $('#email').val().toLowerCase();
				var JSON_mail_name='';
				for(var index=0;index<oreder_Product_Email_List_JSON.length;index++)
				{
					JSON_mail_name=oreder_Product_Email_List_JSON[index].email;
					if(mail_name == JSON_mail_name && mode =="add")
					{
						$.notify({
								
							message: "Mail Id already Exists"
						},{
							
							type: 'danger'
						}); 
					 setTimeout(function() {
							$("#email").focus();
						}, 100);
						
						break;
						
					}
				}
			}
		}
	});	
	
	$('#save_product_email').click(function(e){
		if( $('#email').val()=='')
		{
			$.notify({
					message: "Email must be provided"
				},{
					type: 'danger'
				});
		}
		else if( $('#subject').val()=='')
		{
			$.notify({
					message: "Subject must be provided"
				},{
					type: 'danger'
				});
		}		
		else
		{

			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveSettings","mode":mode,"op_flag":"email","email":$('#email').val(),"subject":$('#subject').val(),"general_product_id":general_product_id,
						"email_id":email_id
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
						refreshOrderProductEmailViewDetails();
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
	
	function refreshOrderProductEmailViewDetails()
	{
		$.when(getOrderProductEmailViewDetails()).done(function(){
			if(mode != "delete")
			{
				$('#order_product_email_model').modal('toggle');
			}
			var table = $('#view_order_product_email_details').DataTable();
			table.destroy();
			dispOrderProductEmailViewDetails(oreder_Product_Email_List_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});	
	}
	
	$(document).on('click','.orderProductMailBtnedit',function ()
	{
		mode = "update";
		var index = $(this).attr('id');
		$('#order_product_email_model').modal('toggle');	
		$('#email').val(oreder_Product_Email_List_JSON[index].email);
		$('#subject').val(oreder_Product_Email_List_JSON[index].subject);
		email_id = oreder_Product_Email_List_JSON[index].email_id;
		general_product_id = oreder_Product_Email_List_JSON[index].general_product_id
		//general_product_id = '';		
	});	
	
	$('#back').on('click',function(){
		$('#view_settings_email_details').hide();
		$('#view_settings_datatables').show();	
	});
	
	$(document).on('click','.orderProductMailBtndelete',function ()
	{
	mode = 'delete';
	var id = $(this).attr('id');
	email_id = oreder_Product_Email_List_JSON[id].email_id;
	$.confirm({
		title: 'Are you sure!',
		content: 'Delete mail '+ oreder_Product_Email_List_JSON[id].email,
		buttons: {
			confirm: function () {				
					request = $.ajax({
					url: 'index.php',
					data: {"action": "saveSettings","mode":mode,"email_id":email_id,"op_flag":"email"},
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
					refreshOrderProductEmailViewDetails();
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
				
			},
			cancel: function () {
				
			},
		
		}
		});
	});	

});