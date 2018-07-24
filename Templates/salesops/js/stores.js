$(document).ready(function() {
	var storesDetails_JSON = [];
	var statesList_JSON = [];
	var DMList_JSON = [];
	var delete_flag = 0;
	var mode="";
	
	$.when(getStoresViewsDetails()).done(function(){				
		dispStoresDetails(storesDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
		
	});
 	$.when(getStates()).done(function(){
		$.when(getDMList()).done(function(){
			dispDropDown();
		});
	}); 
	
	function getStates()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStates',
			type:'POST',
			success:function(data){
				statesList_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores - getStates - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getDMList()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDMList',
			type:'POST',
			success:function(data){
				DMList_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores - getDMList - Error - line 43"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getStoresViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoresViewsDetails',
			type:'POST',
			success:function(data){
				storesDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("stores - getStoresViewsDetails - Error - line 29"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function dispStoresDetails(dataJSON)
	{
		$('#view_stores_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "store_name" },
				{ "mDataProp": "store_address" },
				{ "mDataProp": "store_phone" },
				{ "mDataProp": "district_name" },
				{ "mDataProp": function ( data, type, full, meta) {
					return '<a href="'+ data.store_image +'" target="_blank"><img src="'+data.store_image+'" height="80px" width="80px" alt="No image" data-toggle="tooltip" data-placement="top" title="Click to View Image"  /></a>';
				}
				},
				{ 
					"mDataProp": function ( data, type, full, meta) {
					if(data.store_active ==1)
					{
						return '<a id="'+ meta.row +'" class="btn storesBtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.store_name+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a id="'+
						meta.row +'" class="btn storesBtndelete" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to delete the '+data.store_name+'" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
					}
					else
					{
					}
						return '<a id="'+ meta.row +'" class="btn storesBtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.store_name+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a id="'+
						meta.row +'" class="btn storesBtnactive" style="padding:0px;" data-toggle="tooltip" data-placement="top" title="Click to activate the '+data.store_name+'" role="button"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>';
				 } 
				},
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Store(s) Details',
				exportOptions: {
                    columns: [  0, 1 , 2 , 3 , 4  ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Store(s) Details',
				exportOptions: {
                    columns: [  0, 1 , 2 , 3 , 4  ]
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
					$newButton = $('<input type = "button" class="fa-input storesBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New Store" />');
					$('#view_stores_details_filter').append($clearButton,$newButton);
			
			},
			 "createdRow": function( row, data, dataIndex){
				 
                if( data.store_active ==  0){
					//alert("hi");
                    $(row).css('background-color','#ff4500');				
                }
            }
		});
		return true;
	}
	
	function dispDropDown()
	{
		var index;
		$('#store_state').html('');
		//$('#market_id').html('');
		$("#store_district_id").html('');
		for(index=0;index < statesList_JSON.length;index++)
		{			
			 $("#store_state").append('<option value="' + statesList_JSON[index].codevalue + '">' + statesList_JSON[index].codevalue + '</option>');
		}
		 for(index=0;index < DMList_JSON.length;index++)
		{			
			 $("#store_district_id").append('<option value="' + DMList_JSON[index].district_id + '">' + DMList_JSON[index].district_name + '</option>');
		}
		/*for(index=0;index < StoreDetailsList_JSON.length;index++)
		{			
			 $("#store_district_id").append('<option value="' + StoreDetailsList_JSON[index].store_id + '">' + StoreDetailsList_JSON[index].store_name + '</option>');
		} */
		 $('#store_state').selectpicker('refresh');
		 $('#store_district_id').selectpicker('refresh');
		 /*$('#store_district_id').multiselect('rebuild'); */
	} 
 	
	$(document).on('click','.storesBtnnew',function ()
	{
		mode = "add";
		$('#store_id').removeAttr("readonly");
		$('#stores_model').modal('toggle');	
		$("#save_store_details").html('Add');
		$('.modal-title').html('New Store');
		clearStoreForm();
	});
	
	$(document).on('click','.storesBtnEdit',function ()
	{
		mode = "update";
		$('#stores_model').modal('toggle');	
		$("#save_store_details").html('Update');
		$('.modal-title').html('Edit Store');
		var id = $(this).attr('id');
		$('#store_id').attr('readonly','readonly');
		$('#store_id').val(storesDetails_JSON[id].store_id);
		$('#store_name').val(storesDetails_JSON[id].store_name);
		$('#rq_store_name').val(storesDetails_JSON[id].rq_store_name);
		$('#store_address').val(storesDetails_JSON[id].store_address);
		$('#store_email').val(storesDetails_JSON[id].store_email);
		$('#store_phone').val(storesDetails_JSON[id].store_phone);
		$('#store_uid').val(storesDetails_JSON[id].store_uid);
		$('#store_state').selectpicker('val',storesDetails_JSON[id].store_state);	
		$('#store_city').val(storesDetails_JSON[id].store_city);
		$('#store_zip').val(storesDetails_JSON[id].store_zip);
		$('#store_district_id').selectpicker('val',storesDetails_JSON[id].store_district_id);	
		$('#popup_store_image').show();
		$('#a_magnific').attr('href',storesDetails_JSON[id].store_image);
		$('#store_image_view').attr('src', storesDetails_JSON[id].store_image);
		$('#store_image_view').css("display","block");
	});
	
/* 	$(document).on('click','.storesBtndelete',function ()
	{
		mode = "delete";
		$('#stores_model').modal('toggle');	
		$("#save_store_details").html('Delete');
		$('.modal-title').html('Edit Store');
		var id = $(this).attr('id');

	}); */

	
	$('#save_store_details').click(function(e){
		if( $('#store_id').val()=='')
		{
			$.notify({
					message: "Store ID must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_id").focus();
				}, 100);
		}
		else if( $('#store_name').val()=='')
		{
			$.notify({
					message: "Store Name must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_name").focus();
				}, 100);
		}		
		else if( $('#rq_store_name').val()=='')
		{
			$.notify({
					message: "RQ Store Name must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#rq_store_name").focus();
				}, 100);
		}
		else if( $('#store_address').val()=='')
		{
			$.notify({
					message: "Store address must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_address").focus();
				}, 100);
		}
		else if( $('#store_email').val()=='')
		{
			$.notify({
					message: "Store email must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_email").focus();
				}, 100);
		}
		else if( $('#store_phone').val()=='')
		{
			$.notify({
					message: "Store phone must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_phone").focus();
				}, 100);
		}
		else if( $('#store_uid').val()=='')
		{
			$.notify({
					message: "Store UID must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_uid").focus();
				}, 100);
		}
		else if( $('#store_state').val()=='')
		{
			$.notify({
					message: "Store state must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_state").focus();
				}, 100);
		}
		else if( $('#store_city').val()=='')
		{
			$.notify({
					message: "Store city must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_city").focus();
				}, 100);
		}
		else if( $('#store_zip').val()=='')
		{
			$.notify({
					message: "Store zip must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_zip").focus();
				}, 100);
		}
		else if($('#store_district_id').val()=='' || $('#store_district_id').val()== null)
		{
			$.notify({
					message: "Store district must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_district_id").focus();
				}, 100);
		}
		else if( $('#store_image').val()=='' && mode == 'add' )
		{
			$.notify({
					message: "Store image must be provided"
				},{
					type: 'danger'
				});
				 setTimeout(function() {
					$("#store_image").focus();
				}, 100);
		}
		else
		{
			
		var form = $('#stores_form')[0];
		var data = new FormData(form);
		data.append("mode", mode);
		 request = $.ajax({
					type: "POST",
					enctype: 'multipart/form-data',
					//url: "classes/mileage_expense_db_page.php",
					url: "index.php?action=saveStore",
					data: data,
					processData: false,
					contentType: false,
					cache: false,
					timeout: 600000,
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
						delete_flag = 0;
						refreshStoreDetails();
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
	
	function clearStoreForm()
	{
		$('#store_state').selectpicker('val','');
		$('#store_district_id').selectpicker('val','');
		$('#popup_store_image').hide();
		$('#stores_form')[0].reset();
	}	
	
	$(document).on("keypress","#store_id",function(event){
			var $this = $(this);
			if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
			   ((event.which < 48 || event.which > 57) &&
			   (event.which != 0 && event.which != 8))) {
				   event.preventDefault();
			}

			var text = $(this).val();
			if ((event.which == 46) && (text.indexOf('.') == -1)) {
				setTimeout(function() {
					if ($this.val().substring($this.val().indexOf('.')).length > 3) {
						$this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
					}
				}, 1);
			}

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
					event.preventDefault();
			}      
		});
		$("#store_id").bind("paste", function(e) {
		var text = e.originalEvent.clipboardData.getData('Text');
		if ($.isNumeric(text)) {
			if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
				e.preventDefault();
				$(this).val(text.substring(0, text.indexOf('.') + 3));
		   }
		}
		else {
				e.preventDefault();
			 }
		});
		
	$(document).on("keypress","#store_uid",function(event){
			var $this = $(this);
			if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
			   ((event.which < 48 || event.which > 57) &&
			   (event.which != 0 && event.which != 8))) {
				   event.preventDefault();
			}

			var text = $(this).val();
			if ((event.which == 46) && (text.indexOf('.') == -1)) {
				setTimeout(function() {
					if ($this.val().substring($this.val().indexOf('.')).length > 3) {
						$this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
					}
				}, 1);
			}

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
					event.preventDefault();
			}      
		});
		$("#store_uid").bind("paste", function(e) {
		var text = e.originalEvent.clipboardData.getData('Text');
		if ($.isNumeric(text)) {
			if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
				e.preventDefault();
				$(this).val(text.substring(0, text.indexOf('.') + 3));
		   }
		}
		else {
				e.preventDefault();
			 }
		});

	$(document).on("keypress","#store_zip",function(event){
			var $this = $(this);
			if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
			   ((event.which < 48 || event.which > 57) &&
			   (event.which != 0 && event.which != 8))) {
				   event.preventDefault();
			}

			var text = $(this).val();
			if ((event.which == 46) && (text.indexOf('.') == -1)) {
				setTimeout(function() {
					if ($this.val().substring($this.val().indexOf('.')).length > 3) {
						$this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
					}
				}, 1);
			}

			if ((text.indexOf('.') != -1) &&
				(text.substring(text.indexOf('.')).length > 2) &&
				(event.which != 0 && event.which != 8) &&
				($(this)[0].selectionStart >= text.length - 2)) {
					event.preventDefault();
			}      
		});
		$("#store_zip").bind("paste", function(e) {
		var text = e.originalEvent.clipboardData.getData('Text');
		if ($.isNumeric(text)) {
			if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
				e.preventDefault();
				$(this).val(text.substring(0, text.indexOf('.') + 3));
		   }
		}
		else {
				e.preventDefault();
			 }
		});
	
	$('#store_id').blur(function(){
		var hasFoo = false;
		$.each(storesDetails_JSON, function(i,obj) {
		  if (obj.store_id === $('#store_id').val()) { hasFoo = true; return false;}
		}); 
		if (hasFoo)
		{
			$.notify({
					
				message: "Store ID already exists"
			},{
				
				type: 'danger'
			}); 
		 setTimeout(function() {
				$("#store_id").focus();
			}, 100);
		}
		else
		{
			if($('#store_id').val() !=='')
			{
				var store_uid = '80193'+$('#store_id').val();
				$('#store_uid').val(store_uid);
			}
		}
	});
	
	function mailCheck(email)
	{
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test($('#store_email').val());
	}
	
	$('#store_email').blur(function(){
		if($('#store_email').val() !=='')
		{
			if(!mailCheck($('#store_email').val()))
			{
				$.notify({
							
						message: "Email ID is not valid"
					},{
						
						type: 'danger'
					}); 
				 setTimeout(function() {
						$("#store_email").focus();
					}, 100);
				//$('#store_email').focus();
			}
		}
	});
	
	$(document).on('click','.storesBtndelete',function ()
	{
	mode = 'delete';
	var id = $(this).attr('id');
	delete_flag = 1;
	$.confirm({
		title: 'Are you sure!',
		content: 'Delete Store '+ storesDetails_JSON[id].store_id + '('+storesDetails_JSON[id].store_name +')',
		buttons: {
			confirm: function () {				
					request = $.ajax({
					url: 'index.php',
					data: {"action": "saveStore","mode":mode,"store_id":storesDetails_JSON[id].store_id},
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
					refreshStoreDetails();
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
	
	function refreshStoreDetails()
	{
		$.when(getStoresViewsDetails()).done(function(){
			if(delete_flag == 0)
			{
				$('#stores_model').modal('toggle');				
			}
			var table = $('#view_stores_details').DataTable();
			table.destroy();
			dispStoresDetails(storesDetails_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
	
	$(document).on('change','#store_image',function(){
		readURL(this);
	});
	
	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
			$('#popup_store_image').show();
            $('#store_image_view').attr('src', e.target.result);
			$('#store_image_view').css("display","block");
			var tmppath = URL.createObjectURL(input.files[0]);
			$('#a_magnific').attr('href',tmppath);			
        }
        reader.readAsDataURL(input.files[0]);
    }
	}
	
	$('.parent-container').magnificPopup({
	  delegate: 'a', // child items selector, by clicking on it popup will open
	  type: 'image'
	  // other options
	});
	
	$('#store_image_view').click(function(){
		$('#a_magnific').click();
		$('#stores_model').css("z-index","0");
	});
	
	$(document).on('click','.mfp-close',function(){
		$('#stores_model').css("z-index","1050");
	});

	$('img').on("error", function() {
		console.log("HI");
	});
	
	$(document).on('click','.storesBtnactive',function ()
	{
	mode = 'active';
	var id = $(this).attr('id');
	delete_flag = 1;
	$.confirm({
		title: 'Are you sure!',
		content: 'Activate Store '+ storesDetails_JSON[id].store_id + '('+storesDetails_JSON[id].store_name +')',
		buttons: {
			confirm: function () {				
					request = $.ajax({
					url: 'index.php',
					data: {"action": "saveStore","mode":mode,"store_id":storesDetails_JSON[id].store_id},
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
					refreshStoreDetails();
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

