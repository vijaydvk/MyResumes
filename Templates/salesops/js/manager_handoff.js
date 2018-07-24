$(document).ready(function() {
	var handoffDetails_JSON = [];
	var uniqueHandoffDetails = [];
	$.when(getHandoffDetails()).done(function(){				
		dispHandoffDetails(handoffDetails_JSON);
		$('[data-toggle="tooltip"]').tooltip();
		
	});
	
	function getHandoffDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getHandoffDetails',
			type:'POST',
			success:function(data){
				handoffDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("manager_handoff - getHandoffDetails - Error - line 19"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function dispHandoffDetails(dataJSON)
	{
		$('#manager_handoff_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "handoff_store" },
				{ "mDataProp": "handoff_date" },
				{ "mDataProp": "handoff_new_mgr" },
				{ "mDataProp": "handoff_current_mgr" },
				{ "mDataProp": "district_mgr" },
				{ "mDataProp": "new_mgr_comment" },
				{ "mDataProp": "departing_mgr_comment" },
				{ 
					 "mDataProp": function ( data, type, full, meta) {
						//var option_for_select = ["Hard Count","Clover Devices","RMA","Cash Drawer","Misc Items","IT Equipment","Store Fixtures","Marketing Material"];
						var list ='';
/* 						list = list + '<select class="ticket_assignee" id="'+data.handoff_id+'">';
						list = list + '<option value="">-- Select One --</option>';
						for (var index = 0;index < option_for_select.length;index ++)
						{
							list = list + '<option value="'+ option_for_select[index] + '">'+ option_for_select[index] +'</option>';
						}
						list = list + '</select>'; */
						list = list + '<a id="'+ data.handoff_id +'" class="btn btn-success handoff_view_button" style="background-color:white;border-color:white;padding:2px;" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>';
						return list;
					 }
				}				
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Store Handoff Details',
				exportOptions: {
                    columns: [  0, 1 , 2 , 3 , 4, 5, 6  ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Store Handoff Details',
				exportOptions: {
                      columns: [  0, 1 , 2 , 3 , 4, 5, 6 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],
			
		});
		return true;
	}
	
	$(document).on('click','.handoff_view_button',function(){
		//alert($(this).attr('id'));
		var id = $(this).attr('id');
		var select_box = $('#'+id).val();
		//alert(select_box);
		$.ajax({
			url:'controller/index1.php?action=getHandoffDetailsUnique&id='+id,
			type:'POST',
			success:function(data){
				uniqueHandoffDetails = $.parseJSON(data);  
				$('#manager_view').hide();
				$('#handoff_form_view').show();
				displayHandoffDetails();
        },		
		error: function() {
			console.log("manager_handoff - getHandoffDetailsUnique - Error - line 89"); 
			console.log('something bad happened'); }
		}) ;		
	});

	function displayHandoffDetails()
	{
		$('#store_name_view').html(uniqueHandoffDetails[0].store_name)
		$('#store_address_view').html(uniqueHandoffDetails[0].store_address+","+uniqueHandoffDetails[0].store_city+","+uniqueHandoffDetails[0].store_state+" "+uniqueHandoffDetails[0].store_zip +"<br>"
									+"UID: "+uniqueHandoffDetails[0].store_uid+"<br>"+uniqueHandoffDetails[0].store_phone+"<br>"+uniqueHandoffDetails[0].store_email);
									
		$('#store_image_view').attr("src","http://www.mysuncomportal.com/"+uniqueHandoffDetails[0].store_image);
		$('#date_view').html(uniqueHandoffDetails[0].handoff_date);
		$('#current_manager_view').html(uniqueHandoffDetails[0].handoff_current_mgr);
		$('#new_manager_view').html(uniqueHandoffDetails[0].handoff_new_mgr);
		$('#district_manager_view').html(uniqueHandoffDetails[0].district_manager);
		$('#hard_count_sheet_number_view').html(uniqueHandoffDetails[0].hardcount_sheet_no);
		$('#exp_cashdrawer_view_div').html('<label class="col-5 col-form-label">Explain Variance</label><label class="col-7 col-form-label">'+uniqueHandoffDetails[0].cashcount_variance+'</label>');		
		$('#exp_it_equipment_view_div').html('<label class="col-5 col-form-label">Explain Condition</label><label class="col-7 col-form-label">'+uniqueHandoffDetails[0].pos_station_condition+'</label>');		
		$('#exp_store_fixtures_view_div').html('<label class="col-5 col-form-label">Explain Condition</label><label class="col-7 col-form-label">'+uniqueHandoffDetails[0].store_fixtures_condition+'</label>');
		$('#cur_mgr_image').attr("src","../forms/"+uniqueHandoffDetails[0].current_mgr_signature_path);
		$('#new_mgr_image').attr("src","../forms/"+uniqueHandoffDetails[0].new_mgr_signature_path);
		$('#dm_image').attr("src","../forms/"+uniqueHandoffDetails[0].dm_signature_path);
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

	$('#back_click').click(function(){
		$('#manager_view').show();
		$('#handoff_form_view').hide();		
	});
 	
});

