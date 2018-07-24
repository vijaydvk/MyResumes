$(document).ready(function () { 
	var counter = 2;
	var clover_counter = 2;
	var rma_counter = 2;
	var register_counter = 2
	var storesDetails = [];
	var handoffDetialsView = [];
	var districtDetailsForDropDowJSON = [];
	var storeManagerForDropDownJSON = [];
	var SMDMForDropDownJSON = [];
	var uniqueHandoffDetails = [];
	$.when(getHandoffMaterialsList()).done(function(){
		dispHandoffMaterialsList();
	});
	$.when(getStoreForDropdown()).done(function(){	
		$.when(getDistrictDetailsForDropDown()).done(function(){
			$.when(getStoreManagerForDropDown()).done(function(){
				dispDropDown();
				$.when(getSMDMForDropDown()).done(function(){
					selectDropDown();
				});
			});
		});
		$('[data-toggle="tooltip"]').tooltip();
	});
	
	function getStoreForDropdown()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoreForDropdown&store_id='+$('#store_id').val(),
			type:'POST',
			success:function(data){
				storesDetails = $.parseJSON(data);     
        },		
		error: function() {
			console.log("manager_handoff - getStoreForDropdown - Error - line 16"); 
			console.log('something bad happened'); }
		}) ;
	}

	function getDistrictDetailsForDropDown()
	{
		return $.ajax({
			url:'controller/index1.php?action=getDistrictDetailsForDropDown',
			type:'POST',
			success:function(data){
				districtDetailsForDropDowJSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("manager_handoff - getDistrictDetailsForDropDown - Error - line 34"); 
			console.log('something bad happened'); }
		}) ;
	}
	function getStoreManagerForDropDown()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoreManagerForDropDown',
			type:'POST',
			success:function(data){
				storeManagerForDropDownJSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("manager_handoff - getStoreManagerForDropDown - Error - line 47"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function getSMDMForDropDown()
	{
		return $.ajax({
			url:'controller/index1.php?action=getSMDMForDropDown&store_id='+$('#store_id').val(),
			type:'POST',
			success:function(data){
				SMDMForDropDownJSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("manager_handoff - getSMDMForDropDown - Error - line 72"); 
			console.log('something bad happened'); }
		}) ;		
	}
	
	function getHandoffMaterialsList()
	{
		return $.ajax({
			url:'controller/index1.php?action=getHandoffMaterialsList',
			type:'POST',
			success:function(data){
				handoffDetialsView = $.parseJSON(data);     
        },		
		error: function() {
			console.log("manager_handoff - getHandoffMaterialsList - Error - line 91"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function dispDropDown()
	{
		var index;
		$('#store_location').html('');
		//$("#store_location").append('<option value="" selected>-- Please Select One --</option>');
		$("#current_manager").append('<option value="" selected>-- Please Select One --</option>');
		$("#new_manager").append('<option value="" selected>-- Please Select One --</option>');
		$("#district_manager").append('<option value="" selected>-- Please Select One --</option>');		
		//for(index=0;index < storesForDropDownJSON.length;index++)
		//{
			//$("#store_location").append('<option value="' + storesForDropDownJSON[index].store_id + '">' + storesForDropDownJSON[index].store_name + '</option>');
		//}
		for(index=0;index < storeManagerForDropDownJSON.length;index++)
		{
			$("#current_manager").append('<option value="' + storeManagerForDropDownJSON[index].uid + '">' + storeManagerForDropDownJSON[index].name + '</option>');
			$("#new_manager").append('<option value="' + storeManagerForDropDownJSON[index].uid + '">' + storeManagerForDropDownJSON[index].name + '</option>');
		}
		for(index=0;index < districtDetailsForDropDowJSON.length;index++)
		{
			$("#district_manager").append('<option value="' + districtDetailsForDropDowJSON[index].id + '">' + districtDetailsForDropDowJSON[index].name + '</option>');
		}
		$('#store_address').html(storesDetails[0].store_address+","+storesDetails[0].store_city+","+storesDetails[0].store_state+" "+storesDetails[0].store_zip +"<br>"
									+"UID: "+storesDetails[0].store_uid+"<br>"+storesDetails[0].store_phone+"<br>"+storesDetails[0].store_email);
									
		$('#store_image').attr("src","http://www.mysuncomportal.com/"+storesDetails[0].store_image);
	}
	
/* 	$('#hard_count_number').blur(function(){
		var dynamic_form = "";
		var loop_count = $('#hard_count_number').val();
		for (i=0;i<loop_count;i++)
		{
			dynamic_form = dynamic_form + '<div class="col-lg-6" style="float:left;"><div class="form-group-material"><input id="imei'+i+'" type="text" name="imei'+i+'" required="" placeholder="IMEI" class="input-material"></div></div><div class="col-lg-6" style="float:left;"><div class="form-group-material"><input id="reasonmissing'+i+'" type="text" name="reasonmissing'+i+'" required="" placeholder="Reason" class="input-material"></div></div>';	
		}
		//console.log(dynamic_form);
		$('#IMEI_View').html(dynamic_form);
	}); */
	
	$(document).on('click','#radioBtn a',function(){
		var sel = $(this).data('title');
		var tog = $(this).data('toggle');
		$('#'+tog).prop('value', sel);
		
		$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
		$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
	});
	
	$(document).on('mousemover','input',function(){
		$(this).focus();
	});
	
	$(document).on('mousemove','input',function(){
		$(this).focus();
	});
	
    $(".num").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
/* 	$('#save_images').click(function(){
		console.log( $("#old_manager_signature").jSignature("getData"));
		console.log( $("#new_manager_signature").jSignature("getData"));
		console.log( $("#district_manager_signature").jSignature("getData"));
	}); */	
	
/* 	$('#save_images').click(function(e){
		var image_signature = $("#old_manager_signature").jSignature("getData");
		request = $.ajax({
			url: 'index.php',
			data: {"action": "saveHanoff","mode":"insert","image_signature":image_signature	},
			type: 'POST',
		});
		request.done(function (response){
		
		});
		request.fail(function ( jqXHR, textStatus, errorThrown)
		{

		}); 
	}); */

	$('#phone_missing_imei_add').click(function(){
		var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'IMEI_View' + counter);
		 	newTextBoxDiv.after().html('<div class="col-lg-6" style="float:left;">'+
							'<div class="form-group-material">'+
								'<input id="imei[]" type="text" name="imei[]" required="" placeholder="IMEI" class="input-material">'+
							'</div>'+
						'</div>'+
						'<div class="col-lg-6" style="float:left;">'+
							'<div class="form-group-material">'+
								'<input id="reasonmissing[]" type="text" name="reasonmissing[]" required="" placeholder="Reason" class="input-material">'+
							'</div>'+
						'</div>');
            
		newTextBoxDiv.appendTo("#phone_missing_div");

					
		counter++;
	});
	
	$('#phone_missing_imei_remove').click(function(){
		counter--;			
        $("#IMEI_View" + counter).remove();
	});

	$('#clover_devices_add').click(function(){
		var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'CLOVER_View' + clover_counter)
		 .attr("class","col-md-12");
		 	newTextBoxDiv.after().html('<div class="col-lg-6" style="float:left;">'+
										'<div class="form-group-material">'+
										  '<input id="clover_device_imei[]" name="clover_device_imei[]" required="" placeholder="" class="input-material" type="text">'+
										'</div>'+
									'</div>'+
									'<div class="col-lg-6" style="float:left;">'+
										'<div class="form-group-material">'+
										  '<input id="clover_device_reason[]" name="clover_device_reason[]" required="" placeholder="" class="input-material" type="text">'+
										'</div>'+
									'</div>');
            
		newTextBoxDiv.appendTo("#Clover_Devices_Div");					
		clover_counter++;
	});
	
	$('#clover_devices_remove').click(function(){
		clover_counter--;			
        $("#CLOVER_View" + clover_counter).remove();
	});
	
	$('#rma_add').click(function(){
		var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'RMA_View' + rma_counter)
		 .attr("class","col-md-12");
		 	newTextBoxDiv.after().html('<div class="col-lg-6" style="float:left;">'+
										'<div class="form-group-material">'+
										  '<input id="rma_imei[]" name="rma_imei[]" required="" placeholder="" class="input-material" type="text">'+
										'</div>'+
									'</div>'+
									'<div class="col-lg-6" style="float:left;">'+
										'<div class="form-group-material">'+
										  '<input id="rma_reason[]" name="rma_reason[]" required="" placeholder="" class="input-material" type="text">'+
										'</div>'+
									'</div>');
            
		newTextBoxDiv.appendTo("#RMA_Div");					
		rma_counter++;
	});
	
	$('#rma_remove').click(function(){
		rma_counter--;			
        $("#RMA_View" + rma_counter).remove();
	});	
	
	$('#register_add').click(function(){
		var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'Register_view' + register_counter)
		 .attr("class","col-md-12");
		 	newTextBoxDiv.after().html('<div class="col-lg-4" style="float:left;padding-top:15px;">'+
							'<h3 class="h6" style="text-align:left;">Register #'+register_counter+'</h3>'+
							'</div>'+
							'<div class="col-lg-4" style="float:left;">'+
								'<div class="form-group-material">'+
								  '<input id="register_amt[]" name="register_amt[]" required="" placeholder="amount" class="input-material" type="text">'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-4" style="float:left;">'+
								'<div class="form-group-material">'+
								 '<input id="register_comments[]" name="register_comments[]" required="" placeholder="comments" class="input-material" type="text">'+
								'</div>'+
							'</div>');
            
		newTextBoxDiv.appendTo("#Register_Div");					
		register_counter++;
	});
	
	$('#register_remove').click(function(){
		if(register_counter>2)
		{		
			register_counter--;			
			$("#Register_view" + register_counter).remove();
		}
	});
	
	function selectDropDown()
	{
		$('#current_manager').val(SMDMForDropDownJSON[0].RSM_ID);  
		$('#district_manager').val(SMDMForDropDownJSON[0].DM_ID); 
		//$('#current_manager').prop('disabled', 'disabled');
		//$('#district_manager').prop('disabled', 'disabled');
/* 		var dm_img_src = "img/"+SMDMForDropDownJSON[0].DM_ID+".png";
		var om_img_src = "img/"+SMDMForDropDownJSON[0].RSM_ID+".png";
		$("#old_manager_img").bind("error", function () {
			//console.log("error");
			$('#old_manager_signature_div').show();
			$('#old_manager_signature_div_img').hide();			
		}).attr("src", om_img_src);
		$("#old_manager_img").bind("load", function () {
			$('#old_manager_signature_div').hide();
			$('#old_manager_signature_div_img').show();
		}).attr("src", om_img_src);	
		$("#district_manager_img").bind("error", function () {
			//console.log("error");
			$('#district_manager_signature_div').show();
			$('#district_manager_signature_div_img').hide();			
		}).attr("src", dm_img_src);
		$("#district_manager_img").bind("load", function () {
			$('#district_manager_signature_div').hide();
			$('#district_manager_signature_div_img').show();
		}).attr("src", dm_img_src);	 */		
	}
	
	$('#save_button').click(function (e){
		
		var isValid = true;
	        $('input[type="text"]').each(function() {
	            if ($.trim($(this).val()) == '') {
	                isValid = false;
	                $(this).css({
	                    "border": "1px solid red",
	                    "background": "#FFCECE"
	                });
	            }
	        });
			
			if($('#new_manager').val()=="")
			{
				isValid = false;
				$(this).css({
					"border": "1px solid red",
					"background": "#FFCECE"
				});
			}

	        $('input[type="date"]').each(function() {
	            if ($.trim($(this).val()) == '') {
	                isValid = false;
	                $(this).css({
	                    "border": "1px solid red",
	                    "background": "#FFCECE"
	                });
	            }
	        });
			
	        $('textarea').each(function() {
	            if ($.trim($(this).val()) == '') {
	                isValid = false;
	                $(this).css({
	                    "border": "1px solid red",
	                    "background": "#FFCECE"
	                });
	            }
	        });	

			if($("#old_manager_signature").jSignature("getData","native").length == 0)
			{
				isValid = false;
			}
			if($("#district_manager_signature").jSignature("getData","native").length ==0)
			{
				isValid = false;
			}
			if($("#new_manager_signature").jSignature("getData","native").length ==0)
			{
				isValid = false;
			}			
				
		if(isValid == false)
		{
			alert("Please fill the values & signature");
			e.preventDefault();
		}
		else
		{

			var hardcount_imei = [];
			$("input[name='imei[]']").each(function() {
				hardcount_imei.push($(this).val());
			});
			
			
			var hardcount_reason = [];
			$("input[name='reasonmissing[]']").each(function() {
				hardcount_reason.push($(this).val());
			});
			
			var clover_device_imei = [];
			$("input[name='clover_device_imei[]']").each(function() {
				clover_device_imei.push($(this).val());
			});		
			
			var clover_device_reason = [];
			$("input[name='clover_device_reason[]']").each(function() {
				clover_device_reason.push($(this).val());
			});

			var rma_imei = [];
			$("input[name='rma_imei[]']").each(function() {
				rma_imei.push($(this).val());
			});
			
			
			var rma_reason = [];
			$("input[name='rma_reason[]']").each(function() {
				rma_reason.push($(this).val());
			});	

			var register_amt = [];
			$("input[name='register_amt[]']").each(function() {
				register_amt.push($(this).val());
			});
			
			
			var register_comments = [];
			$("input[name='register_comments[]']").each(function() {
				register_comments.push($(this).val());
			});	
			
			var it_equipment_name = [];
			$("input[name='it_equipment_name[]']").each(function() {
				it_equipment_name.push($(this).val());
			});

			var it_equipment_qty = [];
			$("input[name='it_equipment_qty[]']").each(function() {
				it_equipment_qty.push($(this).val());
			});
			
			
			var it_equipment_condition = [];
			$("select[name='it_equipment_condition[]']").each(function() {
				it_equipment_condition.push($(this).val());
			});	
			
			var store_fixtures_name = [];
			$("input[name='store_fixtures_name[]']").each(function() {
				store_fixtures_name.push($(this).val());
			});			

			var store_fixtures_qty = [];
			$("input[name='store_fixtures_qty[]']").each(function() {
				store_fixtures_qty.push($(this).val());
			});
			
			
			var store_fixtures_condition = [];
			$("select[name='store_fixtures_condition[]']").each(function() {
				store_fixtures_condition.push($(this).val());
			});	
			
			var marketing_material_name = [];
			$("input[name='marketing_material_name[]']").each(function() {
				marketing_material_name.push($(this).val());
			});			

			var marketing_material_qty = [];
			$("input[name='marketing_material_qty[]']").each(function() {
				marketing_material_qty.push($(this).val());
			});
			
			
			var marketing_material_condition = [];
			$("select[name='marketing_material_condition[]']").each(function() {
				marketing_material_condition.push($(this).val());
			});	

			var misc_items_name = [];
			$("input[name='misc_items_name[]']").each(function() {
				misc_items_name.push($(this).val());
			});
			
			
			var misc_items_check = [];
			$("input[name='misc_items_check[]']").each(function() {
				misc_items_check.push($(this).val());
			});				

			var form = $('#handoff_form')[0];
			var formdata = new FormData(form);
		
			if ($("#old_manager_signature_div").css('display') === 'block') {
				   formdata.append("oldmgr_sig",$("#old_manager_signature").jSignature("getData"));
				}
			if ($("#district_manager_signature_div").css('display') === 'block') {
				   formdata.append("dmgr_sig",$("#district_manager_signature").jSignature("getData"));
				   //console.log($("#district_manager_signature").jSignature("getData"));
				}
			if ($("#new_manager_signature_div").css('display') === 'block') {
				   formdata.append("nmgr_sig",$("#new_manager_signature").jSignature("getData"));
				   //console.log($("#district_manager_signature").jSignature("getData"));
				}	
			//if(hardcount_imei.length>1 && hardcount_reason.length>1)
			//{
				//console.log("here");
				formdata.append("hardcount_imei",hardcount_imei);
				formdata.append("hardcount_reason",hardcount_reason);
				formdata.append("clover_device_imei",clover_device_imei);
				formdata.append("clover_device_reason",clover_device_reason);
				formdata.append("rma_imei",rma_imei);
				formdata.append("rma_reason",rma_reason);
				formdata.append("register_amt",register_amt);
				formdata.append("register_comments",register_comments);	
				formdata.append("it_equipment_name",it_equipment_name);
				formdata.append("it_equipment_qty",it_equipment_qty);
				formdata.append("it_equipment_condition",it_equipment_condition);
				formdata.append("store_fixtures_name",store_fixtures_name);
				formdata.append("store_fixtures_qty",store_fixtures_qty);
				formdata.append("store_fixtures_condition",store_fixtures_condition);
				formdata.append("marketing_material_name",marketing_material_name);
				formdata.append("marketing_material_qty",marketing_material_qty);
				formdata.append("marketing_material_condition",marketing_material_condition);			
				formdata.append("misc_items_name",misc_items_name);
				formdata.append("misc_items_check",misc_items_check);				
			//}
			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: 'index.php?action=saveHanoff&mode=insert',
				data: formdata,
				processData: false,
				contentType: false,
				//dataType: 'json',
				cache: false,
				timeout: 600000,
				success: function(data){
					var js = $.parseJSON(data);
					if(js.success)
					{
						$('#div_alert').css('display','block');
						//setTimeout( "$('#div_alert').hide();", 4000);
						$('#handoff_form_controls').hide();
						$('html,body').animate({ scrollTop: 0 }, 400);
						$('#reset').click();
						$('#view_of_handoff').html("Click here to View Details");
						$('#view_of_handoff').attr("data-id",js.id);						
					}
					else
					{
						alert("Data not inserted");
					}
				},
			});	 
		}
	});
	
	/*$('#new_manager').change(function()
	{
		//console.log($('#new_manager').val());
		var nm_img_src = "img/"+$('#new_manager').val()+".png";		
		$("#new_manager_img").bind("error", function () {
			//console.log("error");
			$('#new_manager_signature_div').show();
			$('#new_manager_signature_div_img').hide();			
		}).attr("src", nm_img_src);
		$("#new_manager_img").bind("load", function () {
			$('#new_manager_signature_div').hide();
			$('#new_manager_signature_div_img').show();
		}).attr("src", nm_img_src);	
	});*/
	
	$('#view_of_handoff').click(function(){
		$.ajax({
			url:'controller/index1.php?action=getUniqueHandoffForm&id='+$(this).attr("data-id"),
			type:'POST',
			success:function(data){
				uniqueHandoffDetails = $.parseJSON(data);   
				displayHandoffDetails();
        },		
		error: function() {
			console.log("handoff - handoff - Error - line 513"); 
			console.log('something bad happened'); }
		}) ;		
		
	});
	
	function displayHandoffDetails()
	{
		$('#handoff_form_view').show();
		$('#div_alert').css('display','none');
		$('#store_name_view').html(uniqueHandoffDetails[0].store_name)
		$('#store_address_view').html(storesDetails[0].store_address+","+storesDetails[0].store_city+","+storesDetails[0].store_state+" "+storesDetails[0].store_zip +"<br>"
									+"UID: "+storesDetails[0].store_uid+"<br>"+storesDetails[0].store_phone+"<br>"+storesDetails[0].store_email);
									
		$('#store_image_view').attr("src","http://www.mysuncomportal.com/"+storesDetails[0].store_image);
		$('#date_view').html(uniqueHandoffDetails[0].handoff_date);
		$('#current_manager_view').html(uniqueHandoffDetails[0].handoff_current_mgr);
		$('#new_manager_view').html(uniqueHandoffDetails[0].handoff_new_mgr);
		$('#district_manager_view').html(uniqueHandoffDetails[0].district_manager);
		$('#hard_count_sheet_number_view').html(uniqueHandoffDetails[0].hardcount_sheet_no);
		$('#exp_cashdrawer_view_div').html('<label class="col-5 col-form-label">Explain Variance</label><label class="col-7 col-form-label">'+uniqueHandoffDetails[0].cashcount_variance+'</label>');		
		$('#exp_it_equipment_view_div').html('<label class="col-5 col-form-label">Condition Description</label><label class="col-7 col-form-label">'+uniqueHandoffDetails[0].pos_station_condition+'</label>');		
		$('#exp_store_fixtures_view_div').html('<label class="col-5 col-form-label">Condition Description</label><label class="col-7 col-form-label">'+uniqueHandoffDetails[0].store_fixtures_condition+'</label>');
		$('#cur_mgr_image').attr("src",uniqueHandoffDetails[0].current_mgr_signature_path);
		$('#new_mgr_image').attr("src",uniqueHandoffDetails[0].new_mgr_signature_path);
		$('#dm_image').attr("src",uniqueHandoffDetails[0].dm_signature_path);
		$('#new_mgr_date').html("<b>New Manager Date:</b>"+uniqueHandoffDetails[0].new_mgr_date);
		$('#dm_date').html("<b>District Manager Date:</b>"+uniqueHandoffDetails[0].dm_date);
		$('#cur_mgr_date').html("<b>Current Manager Date:</b>"+uniqueHandoffDetails[0].current_mgr_date);
		$('#departing_manager_comment').html("<b>Departing Manager Comment:</b>"+uniqueHandoffDetails[0].departing_mgr_comment);
		$('#new_manager_comment').html("<b>New Manager Comment:</b>"+uniqueHandoffDetails[0].new_mgr_comment);		
		var hardcount_phone_imei = uniqueHandoffDetails[0].hardcount_missing_ph_imei;
		var harcount_phone_reason = uniqueHandoffDetails[0].hardcount_missing_ph_reason;
		var hardcount_phone_imei_split = hardcount_phone_imei.split(",");
		var harcount_phone_reason_split = harcount_phone_reason.split(",");
		var hardcount_html='';
		for(var i=0;i<hardcount_phone_imei_split.length;i++)
		{
			hardcount_html = hardcount_html + '<div class="form-group row">'+
							  '<label class="col-6 col-form-label">'+hardcount_phone_imei_split[i]+'</label>'+
							 ' <label class="col-6 col-form-label">'+harcount_phone_reason_split[i]+'</label>'+
							'</div>	';
		}
		$('#hardcount_view_imei_reason').html(hardcount_html);
		var clover_devices_imei = uniqueHandoffDetails[2].cloverdevice_imei;
		var clover_devices_reason = uniqueHandoffDetails[2].cloverdevice_reason;
		var clover_devices_imei_split = clover_devices_imei.split(",");
		var clover_devices_reason_split = clover_devices_reason.split(",");		
		var clover_devices_html='';
		for(var i=0;i<clover_devices_imei_split.length;i++)
		{
			clover_devices_html = clover_devices_html + '<div class="form-group row">'+
							  '<label class="col-6 col-form-label">'+clover_devices_imei_split[i]+'</label>'+
							  '<label class="col-6 col-form-label">'+clover_devices_reason_split[i]+'</label>'+
							'</div>';
		}
		$('#cloverdevices_view_imei_reason').html(clover_devices_html);	
		var rma_devices_imei = uniqueHandoffDetails[1].rma_imei;
		var rma_devices_reason = uniqueHandoffDetails[1].rma_reason;
		var rma_devices_imei_split = rma_devices_imei.split(",");
		var rma_devices_reason_split = rma_devices_reason.split(",");		
		var rma_devices_html='';
		for(var i=0;i<rma_devices_imei_split.length;i++)
		{
			rma_devices_html = rma_devices_html + '<div class="form-group row">'+
							  '<label class="col-6 col-form-label">'+rma_devices_imei_split[i]+'</label>'+
							  '<label class="col-6 col-form-label">'+rma_devices_reason_split[i]+'</label>'+
							'</div>';
		}
		$('#rma_view_imei_reason').html(rma_devices_html);	
		var cashcount_amt = uniqueHandoffDetails[3].cashcount_amt;
		var cashcount_comments = uniqueHandoffDetails[3].cashcount_comments;
		var cashcount_amt_split = cashcount_amt.split(",");
		var cashcount_comments_split = cashcount_comments.split(",");		
		var cash_count_html='';
		for(var i=0;i<cashcount_amt_split.length;i++)
		{
			cash_count_html = cash_count_html + '<div class="form-group row">'+
							  '<label class="col-4 col-form-label">Register #'+(i+1)+'</label>'+
							  '<label class="col-4 col-form-label">'+cashcount_amt_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+cashcount_comments_split[i]+'</label>'+
							'</div>';
		}
		$('#cashdrawer_view_div').html(cash_count_html);	
		var question = uniqueHandoffDetails[4].question;
		var answer = uniqueHandoffDetails[4].answer;
		var question_split = question.split(",");
		var answer_split = answer.split(",");		
		var misc_html='';
		for(var i=0;i<question_split.length;i++)
		{
			var yes_no;
			if(answer_split[i]==1)
			{
				yes_no ='Yes';
			}
			else
			{
				yes_no ='No';
			}
			misc_html = misc_html + '<div class="form-group row">'+
							  '<label class="col-8 col-form-label">'+question_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+yes_no+'</label>'+
							'</div>';
		}
		$('#misc_items_view_div').html(misc_html);
		var equipment_name = uniqueHandoffDetails[5].equipment_name;
		var equipment_qty = uniqueHandoffDetails[5].equipment_qty;
		var equipment_condition = uniqueHandoffDetails[5].equipment_condition;
		var equipment_name_split = equipment_name.split(",");
		var equipment_qty_split = equipment_qty.split(",");	
		var equipment_condition_split = equipment_condition.split(",");			
		var it_equip_html='';
		for(var i=0;i<equipment_name_split.length;i++)
		{
			it_equip_html = it_equip_html + '<div class="form-group row">'+
							  '<label class="col-4 col-form-label">'+equipment_name_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+equipment_qty_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+equipment_condition_split[i]+'</label>'+
							'</div>';
		}
		$('#it_equipment_view_div').html(it_equip_html);	
		var storefixtures_name = uniqueHandoffDetails[7].storefixtures_name;
		var storefixtures_qty = uniqueHandoffDetails[7].storefixtures_qty;
		var storefixtures_condition = uniqueHandoffDetails[7].storefixtures_condition;
		var storefixtures_name_split = storefixtures_name.split(",");
		var storefixtures_qty_split = storefixtures_qty.split(",");	
		var storefixtures_condition_split = storefixtures_condition.split(",");			
		var store_fixtures_html='';
		for(var i=0;i<storefixtures_name_split.length;i++)
		{
			store_fixtures_html = store_fixtures_html + '<div class="form-group row">'+
							  '<label class="col-4 col-form-label">'+storefixtures_name_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+storefixtures_qty_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+storefixtures_condition_split[i]+'</label>'+
							'</div>';
		}
		$('#store_fixtures_view_div').html(store_fixtures_html);
		var marketingmaterial_name = uniqueHandoffDetails[6].marketingmaterial_name;
		var marketingmaterial_qty = uniqueHandoffDetails[6].marketingmaterial_qty;
		var marketingmaterial_condition = uniqueHandoffDetails[6].marketingmaterial_condition;
		var marketingmaterial_name_split = marketingmaterial_name.split(",");
		var marketingmaterial_qty_split = marketingmaterial_qty.split(",");	
		var marketingmaterial_condition_split = marketingmaterial_condition.split(",");			
		var marketingmaterial_html='';
		for(var i=0;i<marketingmaterial_name_split.length;i++)
		{
			marketingmaterial_html = marketingmaterial_html + '<div class="form-group row">'+
							  '<label class="col-4 col-form-label">'+marketingmaterial_name_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+marketingmaterial_qty_split[i]+'</label>'+
							  '<label class="col-4 col-form-label">'+marketingmaterial_condition_split[i]+'</label>'+
							'</div>';
		}
		$('#marketing_material_view_div').html(marketingmaterial_html);		
	}
	
	function dispHandoffMaterialsList()
	{
		
		$('#it_equipment_view_div_list').html('');
		$('#store_fixtures_view_div_list').html('');		
		$('#marketing_material_view_div_list').html('');
		$('#misc_items_view_div_list').html('');
		var it_equipment_view_div='';
		var store_fixtures_view_div='';
		var marketing_material_view_div='';
		var misc_items_view_div='';
		for(var i=0;i<handoffDetialsView.length;i++)
		{
			if(handoffDetialsView[i].material_category == 'IT Equipment')
			{
				it_equipment_view_div = it_equipment_view_div + '<div class="col-lg-12">'+
							'<div class="col-lg-6" style="float:left;margin-top:15px;">'+
							'<h6 class="h6" style="text-align:left;">'+handoffDetialsView[i].material_name+'</h6>'+
							'<input type="hidden" name="it_equipment_name[]" id="it_equipment_name" value="'+handoffDetialsView[i].material_name+'" />'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;margin-top:0px;">'+
								'<div class="form-group-material">'+
								  '<input id="it_equipment_qty" name="it_equipment_qty[]" required="" placeholder="QTY" class="input-material num" type="text">'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-4" style="float:left;">'+
								'<div class="form-group-material">'+
								  '<select id="it_equipment_condition" name="it_equipment_condition[]" required="" class="form-control round select-no-pad">'+
									'<option value="Like new">Like New</option>'+
									'<option value="Good">Good</option>'+
									'<option value="Damaged">Damaged</option>'+
									'<option value="Needs Replacement">Needs Replacement</option>'+
								  '</select>'+
								'</div>'+
							'</div>'+				
						'</div>';
			}
			else if(handoffDetialsView[i].material_category == 'Store Fixtures')
			{
				store_fixtures_view_div = store_fixtures_view_div + '<div class="col-lg-12">'+
							'<div class="col-lg-6" style="float:left;margin-top:15px;">'+
							'<h6 class="h6" style="text-align:left;">'+handoffDetialsView[i].material_name+'</h6>'+
							'<input type="hidden" name="store_fixtures_name[]" id="store_fixtures_qty" value="'+handoffDetialsView[i].material_name+'" />'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;margin-top:0px;">'+
								'<div class="form-group-material">'+
								  '<input id="store_fixtures_qty" name="store_fixtures_qty[]" required="" placeholder="QTY" class="input-material num" type="text">'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-4" style="float:left;">'+
								'<div class="form-group-material">'+
								  '<select id="store_fixtures_condition" name="store_fixtures_condition[]" required="" class="form-control round select-no-pad">'+
									'<option value="Like new">Like New</option>'+
									'<option value="Good">Good</option>'+
									'<option value="Damaged">Damaged</option>'+
									'<option value="Needs Replacement">Needs Replacement</option>'+
								  '</select>'+
								'</div>'+
							'</div>	'+					
						'</div>';
			}
			else if(handoffDetialsView[i].material_category == 'Marketing Material')
			{
				marketing_material_view_div = marketing_material_view_div + '<div class="col-lg-12">'+
														'<div class="col-lg-6" style="float:left;margin-top:15px;">'+
														'<h6 class="h6" style="text-align:left;">'+handoffDetialsView[i].material_name+'</h6>'+
														'<input type="hidden" name="marketing_material_name[]" id="marketing_material_name" value="'+handoffDetialsView[i].material_name+'" />'+
														'</div>'+
														'<div class="col-lg-2" style="float:left;margin-top:0px;">'+
															'<div class="form-group-material">'+
															  '<input id="marketing_material_qty" name="marketing_material_qty[]" required="" placeholder="QTY" class="input-material num" type="text">'+
															'</div>'+
														'</div>'+
														'<div class="col-lg-4" style="float:left;">'+
															'<div class="form-group-material">'+
															  '<select id="marketing_material_condition" name="marketing_material_condition[]" required="" class="form-control round select-no-pad">'+
																'<option value="Like new">Like New</option>'+
																'<option value="Good">Good</option>'+
																'<option value="Damaged">Damaged</option>'+
																'<option value="Needs Replacement">Needs Replacement</option>'+
															  '</select>'+
															'</div>'+
														'</div>'+				
													'</div>';
			}
			else if(handoffDetialsView[i].material_category == 'Misc Items')
			{
				var str_rep = handoffDetialsView[i].material_category;
				misc_items_view_div = misc_items_view_div + '<div class="col-lg-12">'+
							'<div class="col-lg-10" style="float:left;">'+
							'<h3 class="h6" style="text-align:left;">'+handoffDetialsView[i].material_name+'?</h3>'+
							'<input type="hidden" name="misc_items_name[]" id="misc_items_name" value="'+handoffDetialsView[i].material_name+'" />'+
							'</div>'+
							'<div class="col-lg-2" style="float:left;">'+
							'<div class="input-group" style="margin-top:2px;margin-bottom:2px;">'+
								'<div id="radioBtn" class="btn-group">'+
									'<a class="btn btn-primary btn-sm notActive" data-toggle="'+str_rep.replace(' ','')+handoffDetialsView[i].material_id+'" data-title="1">YES</a>'+
									'<a class="btn btn-primary btn-sm active" data-toggle="'+str_rep.replace(' ','')+handoffDetialsView[i].material_id+'" data-title="0">NO</a>'+
								'</div>'+
								'<input type="hidden" name="misc_items_check[]" id="'+str_rep.replace(' ','')+handoffDetialsView[i].material_id+'" value="0">'+
							'</div>'+
							'</div>'+					
						'</div>';
			}			
		}
		$('#it_equipment_view_div_list').html(it_equipment_view_div);
		$('#store_fixtures_view_div_list').html(store_fixtures_view_div);		
		$('#marketing_material_view_div_list').html(marketing_material_view_div);  
		$('#misc_items_view_div_list').html(misc_items_view_div);
	}
	
});
						
							
                              
                              
                            
						
						
							