$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	var getDMUID_JSON = [];
	var applicant_list_JSON = [];
	var process_steps_JSON = [];
	var applicant_list_unique_JSON = [];
	var applicant_list_Pre_JSON = [];
	var applicant_like_JSON = [];
	var store_Details = [];
	var access_Rid_Details = [];
	var applicant_thumbs_JSON = [];
	var applcant_id_for_location_update;
	var store_id_for_dropdown;
	var row_id_for_refresh;
	var status_for_radio;
	var position_job_id;
	var reference_first_name;
	var reference_last_name;
	var reference_phone_number;
	var reference_mode;
	var approval_steps_Details;
	var hiring_steps_list_JSON = [];
	
	if($('#action').val()=="applicantListPage")
	{
		$.when(getApplicantListDetails()).done(function(){
			$.when(getStoreDetails()).done(function(){
				$.when(getProcessStepsDetails()).done(function(){
							dispApplicantListDetails(applicant_list_JSON);
				});
			});
		});
	}
	else
	{
		$.when(getMyLikesDetails()).done(function(){
			$.when(getStoreDetails()).done(function(){
				$.when(getProcessStepsDetails()).done(function(){
						dispApplicantListDetails(applicant_list_JSON);			
				});
		});
		});
	}

	function getMyLikesDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getMyLikesDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					applicant_list_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getMyLikesDetails - Error - line 28"); 
			console.log('something bad happened'); }
		}) ;
	}

	function getApplicantListDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getApplicantListDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					applicant_list_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getApplicantListDetails - Error - line 28"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function dispApplicantListDetails(dataJSON)
	{
		$('#view_applicant_list').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.a_view_id == '-')
							return '<u><span style="color:grey;" class="applicantNameFirstClick" id="'+data.applicant_id+'">'+data.first_name+" "+data.last_name+'</span></u>';
						else
							return '<u><span style="color:grey;" class="applicantNameViewClick" row="'+meta.row+'" id="'+data.applicant_id+'">'+data.first_name+" "+data.last_name+'</span><u>';
					}
				},
				{ "mDataProp": "store_name" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.a_view_id == '-')
							return '<i class="far fa-eye-slash"></i>';
						else
							return '<i class="fa fa-eye" aria-hidden="true"></i>';
					},"bSortable":false
				},				
				{ "mDataProp": "contact_number" },
				//{ "mDataProp": "email" },
				{ "mDataProp": "zip" },
				{ "mDataProp": "applied_date" },
				/*{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.uploaded_file == null)
						{
							return '';
						}
						else
						{
						return "<a href='http://career.suncommobile.com/uploads/"+data.uploaded_file+"' target='_blank'> View </a>";
						}
					},"bSortable":false
				},*/
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '<center><p id="'+ data.applicant_id +'" class="btn applicantViewBtn" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to view '+data.first_name+' Details"><i class="far fa-list-alt"></i></p></center>';
					},"bSortable":false
				},	
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.is_like =='-' &&  data.a_like_id == '-')
						{
							return '<center><p id="'+ data.applicant_id +'" data-mode="insert" data-active="1" class="btn applicantLikeBtn" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to view '+data.first_name+' Details"><i class="fas fa-thumbs-up" style="color:grey;"></i></p></center>';
						}
						if(data.is_like =='0')
						{
							return '<center><p id="'+ data.a_like_id +'" data-mode="update" data-active="1" class="btn applicantLikeBtn" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to view '+data.first_name+' Details"><i class="fas fa-thumbs-up" style="color:grey;"></i></p></center>';
						}
						if(data.is_like =='1')
						{
							return '<center><p id="'+ data.a_like_id +'" data-mode="update" data-active="0" class="btn applicantLikeBtn" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to view '+data.first_name+' Details"><i class="fas fa-thumbs-up" style="color:blue;"></i></p></center>';
						}						
					},"bSortable":false
				},	
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '<p class="viewLikeUser" id="'+data.applicant_id+'"> View </p>';
							
					},"bSortable":false
				},				
				
			],
/* 			initComplete : function() {
				  var api = this.api();
				  var input = $('.dataTables_filter input');
				  $clearButton = $('<input type = "button" data-toggle="tooltip" data-placement="top" title="Click to clear the search and refresh the table" value="Clear" />')
                       .click(function() {
						 input.val('');
						 api.search(input.val()).draw();
 						 //api.draw();
                       }) ;
					$newButton = $('<input type = "button" class="fa-input recruiterTrackingBtnnew" value="New" data-toggle="tooltip" data-placement="top" title="Click to Add Employer Details" />');
					$('.dataTables_filter').append($newButton); 				   
			}, */
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Applicant Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3, 4 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Applicant Details',
				exportOptions: {
                    columns: [  0, 1, 2, 3 , 4 ]
				},
				"text":'<i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in PDF"></i>',
			},
			],
/* 			"createdRow": function( row, data, dataIndex){
				 
                if( data.active ==  0){
					//alert("hi");
                    $(row).css('background-color','#ff4500');				
                }
            } */
		});
		$('#select_store').append('<option value="">Please Select One</option>');
		for(var i=0;i<store_Details.length;i++)
		{
			$('#select_store').append('<option value="'+store_Details[i].store_id+'">'+store_Details[i].store_name+'</option>');
		}
		
		$.when(getCarerAccessRidDetails()).done(function(){
			$('#button_rights_div').html('');
			for(var i=0;i<access_Rid_Details.length;i++)
			{
				if(access_Rid_Details[i].action_setting_name !== null)
				{
					$('#button_rights_div').append('<button type="button" data-toggle="tooltip" title="'+access_Rid_Details[i].action_button_tooltip+'" id="'+access_Rid_Details[i].action_setting_name+'" class="btn btn-primary btn-md" style="margin:5px;padding:5px;font-size:inherit;display:block;float:left;">'+access_Rid_Details[i].action_button_icon+'</button>');
				}
			}
		});	
		return true;
	}
	
	$(document).on('click','.applicantViewBtn',function(){
			var id = $(this).attr('id');
			$.when(getApplicantListPrescreenDetails(id)).done(function(){				
				dispApplicantListPrescreenDetails(applicant_list_Pre_JSON);
				
				//$('[data-toggle="tooltip"]').tooltip();
				//console.log(applicant_list_Pre_JSON);
				//e.preventDefault();
			});	 
			
	});
	
	function getApplicantListPrescreenDetails(id)
	{
		return $.ajax({
			url:'controller/index1.php?action=getApplicantListPrescreenDetails&applicant_id='+id,
			type:'GET',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					applicant_list_Pre_JSON = js.details;
				}
				else
				{
					$.notify({
						message: js.errors
					},{
						type: 'danger'
					});
				}
        },		
		error: function() {
			console.log("applicant_list - getApplicantListPrescreenDetails - Error - line 141"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function dispApplicantListPrescreenDetails(Pre_JSON)
	{
		//alert("hi");
		$('#largeModal').modal('show');
		var text_disp = '';
		for(var i=0;i<Pre_JSON.length;i++)
		{
			//console.log(Pre_JSON[i].prescreen_question);
			//console.log(Pre_JSON.length);
			if(i==0)
			{
				var oSplit = Pre_JSON[i].prescreen_detail;
				var nSplit = oSplit.split("|");
				text_disp = text_disp+ '<div class="col-md-12" style="padding-bottom:40px;"><div class="col-md-9" style="float:left;"><span>'+Pre_JSON[i].prescreen_question+'?</span></div><div class="col-md-3" style="float:left;"><p>'+nSplit[0]+'</p></div></div>';
				if(nSplit.length >0)
				{
					text_disp = text_disp+ '<div class="col-md-12" style="padding-bottom:40px;"><div class="col-md-9" style="float:left;"><span>Employer Name?</span></div><div class="col-md-3" style="float:left;"><p>'+nSplit[1]+'</p></div></div>';
				}
			}
			else
			{
			text_disp = text_disp+ '<div class="col-md-12" style="padding-bottom:40px;"><div class="col-md-9" style="float:left;"><span>'+Pre_JSON[i].prescreen_question+'?</span></div><div class="col-md-3" style="float:left;"><p>'+Pre_JSON[i].prescreen_detail+'</p></div></div>';
			}
		}
		//console.log(text_disp);
		$("#prescreen_Q").html(text_disp);
		
	}
	
	$(document).on('click','.applicantLikeBtn',function(){
		var applicant_id = $(this).attr('id');
		var mode = $(this).attr('data-mode');
		var active = $(this).attr('data-active');
		request = $.ajax({
			type: 'POST',
			url: "index.php",
			data: {"action":"saveLike","is_like":active,"applicant_id":applicant_id,"mode" : mode },
			});
		request.done(function (response){
			var js = $.parseJSON(response);
			if(js.success)
			{
				$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
					$("#success-alert").slideUp(500);
				});
				refreshAfterLikeUpdate();				
			}
			else
			{
			} 

		});
		request.fail(function ( jqXHR, textStatus, errorThrown)
		{
			alert("Failed");
		}); 	
	});
	
	function refreshAfterLikeUpdate()
	{
		$.when(getApplicantListDetails()).done(function(){
			var table = $('#view_applicant_list').DataTable();
			table.destroy();
			dispApplicantListDetails(applicant_list_JSON);
			$('[data-toggle="tooltip"]').tooltip();		
		});		
	}
	
/* 	$(document).on( 'click', '#view_applicant_list tbody tr td:eq(0)', function (){
	   alert("col1");
	}); */
	
	$(document).on('click','.applicantNameFirstClick',function(){
		var id = $(this).attr('id');
		insertViewApplicant(id);
	});
	
	
	
	$(document).on('click','.applicantNameViewClick',function(){
		var id = $(this).attr('id');
		row_id_for_refresh = $(this).attr('row');
		$('#applicant_view_list_div').hide();
		$('#applicant_unique_view_div').show();
		displayApplicantUniqueDetails(id);
	});	
	
	function insertViewApplicant(applicant_id)
	{
		request = $.ajax({
			type: 'POST',
			url: "index.php",
			data: {"action":"saveLike","applicant_id":applicant_id,"mode" : "viewApplicant" },
			});
		request.done(function (response){
			var js = $.parseJSON(response);
			//console.log(js);
			if(js.success)
			{
				refreshAfterView(applicant_id);
				
			}
			else
			{
				alert("Failed to update");
			} 

		});
		request.fail(function (jqXHR,textStatus,errorThrown)
		{
			alert("Failed to update");
		}); 
	}
	
	function refreshAfterView(id)
	{
		$.when(getApplicantListDetails()).done(function(){
			var table = $('#view_applicant_list').DataTable();
			table.destroy();
			dispApplicantListDetails(applicant_list_JSON);			
			$('[data-toggle="tooltip"]').tooltip();		
		});	
		$('#applicant_view_list_div').hide();
		$('#applicant_unique_view_div').show();
		displayApplicantUniqueDetails(id);
	}

	$(document).on('click','#unique_back',function(){
		$('#applicant_view_list_div').show();
		$('#applicant_unique_view_div').hide();	
		$('#view_applicant_list').css("width","100%");
		$('#resume_txt').html('');
	});
	
	function displayApplicantUniqueDetails(applicant_id)
	{
		var j=0;
		$.when(getApplicantUniqueDetails(applicant_id)).done(function(){
			$.when(getProcessStepsThumbsDetails(applicant_id)).done(function(){
				hiringStepDisp(applicant_id);
				var a = [];
				a[0] = applicant_thumbs_JSON[0].c1;
				a[1] = applicant_thumbs_JSON[0].c2;
				a[2] = applicant_thumbs_JSON[0].c3;
				a[3] = applicant_thumbs_JSON[0].c4;
				a[4] = applicant_thumbs_JSON[0].c5;
				$('#process_steps').html('');
				for(var i=0;i<process_steps_JSON.length;i++)
				{
					if(i>0)
					{
						if(a[j] == 0)
						{
						$('#process_steps').append('<div class="col-lg-2  border-center" style="float:left;background:transparent;z-index:1;">'+
														'<center><i class="zmdi zmdi-thumb-down zmdi-hc-2x" data-head="'+process_steps_JSON[i].step+'" style="border:1px solid #B10305;border-radius:50%;padding:5px;background:#B10305;color:white;z-index:-1;"></i><br>'+process_steps_JSON[i].step+'</center>'+
												'</div>');
						}
						else
						{
						$('#process_steps').append('<div class="col-lg-2  border-center" style="float:left;background:transparent;z-index:1;">'+
														'<center><i class="zmdi zmdi-thumb-up zmdi-hc-2x" data-head="'+process_steps_JSON[i].step+'" style="border:1px solid rgb(31,174,154);border-radius:50%;padding:5px;background:rgb(31,174,154);color:white;z-index:-1;"></i><br>'+process_steps_JSON[i].step+'</center>'+
												'</div>');							
						}
						j++;
					}
					else
					{
					$('#process_steps').append('<div class="col-lg-2  border-center" style="float:left;background:transparent;z-index:1;">'+
													'<center><i class="zmdi zmdi-thumb-up zmdi-hc-2x" data-head="'+process_steps_JSON[i].step+'" style="border:1px solid rgb(31,174,154);border-radius:50%;padding:5px;background:rgb(31,174,154);color:white;z-index:-1;"></i><br>'+process_steps_JSON[i].step+'</center>'+
											'</div>');						
					}
				}					
				var db_resume_id = applicant_list_unique_JSON[0].resume_id;
				var db_file_name = applicant_list_unique_JSON[0].file_name;
				var db_timestamp = applicant_list_unique_JSON[0].timestamp;
				//console.log(js_resume_id.length);
				$('#applicant_unique_head').html('Applicant '+ applicant_list_unique_JSON[0].first_name +' '+ applicant_list_unique_JSON[0].last_name +' Detail View');
				$('#app_name').html(applicant_list_unique_JSON[0].first_name +' '+ applicant_list_unique_JSON[0].last_name);
				$('#app_addr').html(applicant_list_unique_JSON[0].zip);
				$('#store_name').html(applicant_list_unique_JSON[0].store_name);
				if(db_resume_id != null)
				{
				var js_resume_id = db_resume_id.split(",");
				var js_file_name = db_file_name.split(",");
				var js_timestamp = db_timestamp.split(",");
					for(var i=0;i<js_resume_id.length;i++)
					{
						if(js_resume_id[i] !="")
						$('#div_resume_div').append('<div class="col-lg-6" style="background-color:#f2f2f2;border:5px solid white;float:left;" ><center><a href="http://career.suncommobile.com/uploads/'+js_file_name[i]+'" target="_blank">'+
														'<i class="zmdi zmdi-file zmdi-hc-4x"></i></a></center>'+
													'</div>'+
													'<div class="col-lg-6" style="float:left;">'+
														'<h5>Resume</h5>'+
														'<p style="font-size:12px;">Uploaded At:'+js_timestamp[i]+'</p>'+
														'<p style="font-size:12px;color:blue;cursor: pointer;" class="deleteResume" data-applicant-id="'+applicant_list_unique_JSON[0].applicant_id+'" id="'+js_resume_id[i]+'"><i class="zmdi zmdi-delete" style="padding:5px;"></i>delete resume</p>'+
													'</div>');
					}			
				}
				$("#save_resume").attr("data-applicant_id",applicant_list_unique_JSON[0].applicant_id);
				if(applicant_list_unique_JSON[0].close_by_store_id =='')
				{
					store_id_for_dropdown = '0000';
				}
				else
				{
					store_id_for_dropdown = applicant_list_unique_JSON[0].close_by_store_id;
				}
				status_for_radio = applicant_list_unique_JSON[0].active;
				position_job_id = applicant_list_unique_JSON[0].position_job_id;
				applcant_id_for_location_update = applicant_list_unique_JSON[0].applicant_id;
				reference_first_name = applicant_list_unique_JSON[0].reference_fname;
				reference_last_name = applicant_list_unique_JSON[0].reference_lname;
				reference_phone_number = applicant_list_unique_JSON[0].reference_phone;
				$.when(getApprovalStepsDetails()).done(function(){
						displayApprovalStepsDetails();
				});					
			});
		});
	}
	
	function getApplicantUniqueDetails(applicant_id)
	{
		return $.ajax({
			url:'controller/index1.php?action=getApplicantUniqueDetails&applicant_id='+applicant_id,
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					applicant_list_unique_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getApplicantUniqueDetails - Error - line 319"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	$(document).on('click','.viewLikeUser',function(){
		//alert($(this).attr('id'));
		var applicant_id = $(this).attr('id');
		$('#likedModal').modal('toggle');
		$.when(getApplicantLikeDetails(applicant_id)).done(function(){
			var table = $('#view_applicant_like').DataTable();
			table.destroy();
			$('#view_applicant_like').css("width","100%");
			dispApplicantLikeDetails(applicant_like_JSON);
			$('[data-toggle="tooltip"]').tooltip();		
		});		
	});
	
	function getApplicantLikeDetails(applicant_id)
	{
		return $.ajax({
			url:'controller/index1.php?action=getApplicantLikeDetails&applicant_id='+applicant_id,
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					applicant_like_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getApplicantLikeDetails - Error - line 376"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function dispApplicantLikeDetails(dataJSON)
	{
		//console.log(dataJSON);
		$('#view_applicant_like').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [		
				{ "mDataProp": "name" },
				{ 
					"mDataProp": function ( data, type, full, meta) {
						if(data.is_like =='0')
						{
							return 'DisLiked';
						}
						else
						{
							return 'Liked';
						}							
					}
				},			
			],
			dom: 'tp',
		});
	}

	$(document).on('click','#ApplicantChangeLocation',function(){
		$('#change_location_modal').modal('show');
		if(store_id_for_dropdown == '0000')
		{
			$('#select_store').val("");
		}
		else
		{
			$('#select_store').val(store_id_for_dropdown);
		}
	});

	function getStoreDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getStoreDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					store_Details = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getStoreDetails - Error - line 427"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	$('#save_location_button').click(function(){
		if($('#select_store').val()=='')
		{
			$("#location_unique_head_div").fadeTo(2000, 500).slideUp(500, function(){
				$("#location_unique_head_div").slideUp(500);
			});				
		}
		else
		{
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveLike","applicant_id":applcant_id_for_location_update,"mode" : "updateApplicantLoc","close_by_store_id":$('#select_store').val()},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success)
				{
					//refreshAfterView(applicant_id);
					$("#applicant_unique_head_div").fadeTo(2000, 500).slideUp(500, function(){
						$("#applicant_unique_head_div").slideUp(500);
					});					
					$('#change_location_modal').modal('hide');
					displayApplicantUniqueDetailsLoc(applcant_id_for_location_update);
					$('#resume_txt').html('');
				}
				else
				{
					alert("Failed to update");
				} 

			});
			request.fail(function (jqXHR,textStatus,errorThrown)
			{
				alert("Failed to update");
			}); 			
		}
	});
	
	function displayApplicantUniqueDetailsLoc(applicant_id)
	{
		//alert(applicant_id);
		$.when(getApplicantUniqueDetails(applicant_id)).done(function(){
			$('#applicant_unique_head').html('Applicant '+ applicant_list_unique_JSON[0].first_name +' '+ applicant_list_unique_JSON[0].last_name +' Detail View');
			$('#app_name').html(applicant_list_unique_JSON[0].first_name +' '+ applicant_list_unique_JSON[0].last_name);
			$('#app_addr').html(applicant_list_unique_JSON[0].zip);
			$('#store_name').html(applicant_list_unique_JSON[0].store_name);
			store_id_for_dropdown = applicant_list_unique_JSON[0].close_by_store_id;
			applcant_id_for_location_update = applicant_list_unique_JSON[0].applicant_id;
			applicant_list_JSON[row_id_for_refresh].store_name = applicant_list_unique_JSON[0].store_name;
			var table = $('#view_applicant_list').DataTable();
			//console.log(table.cell(row_id_for_refresh,1).data());
			table.cell(row_id_for_refresh,1).data(applicant_list_unique_JSON[0].store_name);
			//table.destroy();
			//dispApplicantListDetails(applicant_list_JSON);
			
		});
	}	
	
	$(document).on('click','.upload_button',function(){
		$('#resume_uploads').click();
	});
	
    $('input[type="file"]').change(function(e){
		var fileName = e.target.files[0].name;
		$('#resume_txt').html(fileName);
    });
	
	$(document).on('click','#save_resume',function(){
		var applicant_resume_insert_id = $(this).attr("data-applicant_id");
		var input = document.getElementById('resume_uploads').files[0];
		//console.log(input.files);
		//alert(applicant_resume_insert_id);
		//console.log($('#resume_uploads').val());
		var ofile=document.getElementById('resume_uploads').files[0];
		var formdata = new FormData();
		formdata.append("mFile",ofile);
		formdata.append("action","saveResume");
		formdata.append("applicant_id",applicant_resume_insert_id);
		formdata.append("mode","insert");
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: formdata,
				contentType: false,
				processData: false,
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success)
				{
					$("#applicant_unique_head_div").fadeTo(2000, 500).slideUp(500, function(){
						$("#applicant_unique_head_div").slideUp(500);
					});	
					displayAfterResumeUpdate(applicant_resume_insert_id);
					$('#resume_txt').html('');
				}
				else
				{
					alert("Failed to update");
				} 
			});

	});	
	
	$(document).on('click','.deleteResume',function(){
		var resume_id = $(this).attr("id");
		var applicant_id = $(this).attr("data-applicant-id"); 
		//alert($(this).attr("id"));		
		//$('#div_resume_div').html('');
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveResume","a_resume_id":resume_id,"mode" : "delete"},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success)
				{
					$("#applicant_unique_head_div").fadeTo(2000, 500).slideUp(500, function(){
						$("#applicant_unique_head_div").slideUp(500);
					});	
					displayAfterResumeUpdate(applicant_id);
					$('#resume_txt').html('');
				}
				else
				{
					alert("Failed to update");
				} 
			});		
	});
	
	function displayAfterResumeUpdate(applicant_id)
	{
		$.when(getApplicantUniqueDetails(applicant_id)).done(function(){
			var db_resume_id = applicant_list_unique_JSON[0].resume_id;
			var db_file_name = applicant_list_unique_JSON[0].file_name;
			var db_timestamp = applicant_list_unique_JSON[0].timestamp;
			var js_resume_id = db_resume_id.split(",");
			var js_file_name = db_file_name.split(",");
			var js_timestamp = db_timestamp.split(",");
			//console.log(js_resume_id.length);
			$('#div_resume_div').html('');
			for(var i=0;i<js_resume_id.length;i++)
			{
				if(js_resume_id[i] !="")
				$('#div_resume_div').append('<div class="col-lg-6" style="background-color:#f2f2f2;border:5px solid white;float:left;" ><center><a href="http://career.suncommobile.com/uploads/'+js_file_name[i]+'" target="_blank">'+
												'<i class="zmdi zmdi-file zmdi-hc-4x"></i></a></center>'+
											'</div>'+
											'<div class="col-lg-6" style="float:left;">'+
												'<h5>Resume</h5>'+
												'<p style="font-size:12px;">Uploaded At:'+js_timestamp[i]+'</p>'+
												'<p style="font-size:12px;color:blue;cursor: pointer;" class="deleteResume" data-applicant-id="'+applicant_list_unique_JSON[0].applicant_id+'" id="'+js_resume_id[i]+'"><i class="zmdi zmdi-delete" style="padding:5px;"></i>delete resume</p>'+
											'</div>');
			}
			$("#save_resume").attr("data-applicant_id",applicant_list_unique_JSON[0].applicant_id);
		});		
	}
	
	function getProcessStepsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getProcessStepsDetails',
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					process_steps_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getProcessStepsDetails - Error - line 376"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	$(document).on('click','.zmdi-thumb-down',function(){
		//alert($(this).attr("data-head"));
		var head = $(this).attr("data-head");
		if(head == "Resume")
		{
			
		}
		else if(head == "Job Fit Survey")
		{
			jobFitSurvey(head);
		}
		else if(head == "Interviewed")
		{
			Interviewed(head);
		}
		else if(head == "Interview Notes")
		{
			interviewNotes(head);
		}
		else if(head == "Video")
		{
			video(head);
		}
		else if(head == "Next Step")
		{
			nextStep(head);
		}
	});
	
	function jobFitSurvey(heading)
	{
		$('#application_steps_footer').show();
		$('#application_steps_head').html(heading);
		$('#application_steps_body').html('');
		$('#application_steps_body').html('<div class="col-md-12">'+
													'<div class="row form-group">'+
														'<div class="col col-md-3">'+
															'<label class=" form-control-label">Status</label>'+
														'</div>'+
														'<div class="col-12 col-md-9">'+
															'<select name="JFS_status" id="JFS_status" class="form-control">'+
																'<option value="">-- Please Select One --</option>'+
																'<option value="1">Completed</option>'+
															'</select>'+
														'</div>'+
													'</div>'+
												'</div>');
		$('#application_steps').modal('show');
	}
	
	function Interviewed(heading)
	{
		$('#application_steps_footer').show();
		$('#application_steps_head').html(heading);
		$('#application_steps_body').html('');
		$('#application_steps_body').html('<div class="col-md-12">'+
													'<div class="row form-group">'+
														'<div class="col col-md-3">'+
															'<label class=" form-control-label">Status</label>'+
														'</div>'+
														'<div class="col-12 col-md-9">'+
															'<select name="interviewed_status" id="interviewed_status" class="form-control">'+
																'<option value="">-- Please Select One --</option>'+
																'<option value="1">Completed</option>'+
															'</select>'+
														'</div>'+
													'</div>'+
												'</div>');		
		$('#application_steps').modal('show');
	}

	function interviewNotes(heading)
	{
		$('#application_steps_footer').show();
		$('#application_steps_head').html(heading);
		$('#application_steps_body').html('');
		$('#application_steps_body').html('<div class="col-md-12">'+
													'<div class="row form-group">'+
														'<div class="col col-md-3">'+
															'<label class=" form-control-label">Status</label>'+
														'</div>'+
														'<div class="col-12 col-md-9">'+
															'<select name="interviewNotes_status" id="interviewNotes_status" class="form-control">'+
																'<option value="">-- Please Select One --</option>'+
																'<option value="1">Completed</option>'+
															'</select>'+
														'</div>'+
													'</div>'+
												'</div>');		
		$('#application_steps').modal('show');
	}

	function video(heading)
	{
		$('#application_steps_footer').show();
		$('#application_steps_head').html(heading);
		$('#application_steps_body').html('');
		$('#application_steps_body').html('<div class="col-md-12">'+
													'<div class="row form-group">'+
														'<div class="col col-md-3">'+
															'<label class=" form-control-label">Status</label>'+
														'</div>'+
														'<div class="col-12 col-md-9">'+
															'<select name="video_status" id="video_status_status" class="form-control">'+
																'<option value="">-- Please Select One --</option>'+
																'<option value="1">Completed</option>'+
															'</select>'+
														'</div>'+
													'</div>'+
												'</div>');		
		$('#application_steps').modal('show');
	}

	function nextStep(heading)
	{
		$('#application_steps_footer').show();
		$('#application_steps_head').html(heading);
		$('#application_steps_body').html('');
		$('#application_steps_body').html('<div class="col-md-12">'+
													'<div class="row form-group">'+
														'<div class="col col-md-3">'+
															'<label class=" form-control-label">Status</label>'+
														'</div>'+
														'<div class="col-12 col-md-9">'+
															'<select name="nextstep_status" id="nextstep_status_status" class="form-control">'+
																'<option value="">-- Please Select One --</option>'+
																'<option value="1">Completed</option>'+
															'</select>'+
														'</div>'+
													'</div>'+
												'</div>');		
		$('#application_steps').modal('show');
		//console.log();
	}

	$(document).on('click','#application_steps_save',function(){
		if($('#application_steps_form select option:selected').val() == "")
		{
			alert("Status Must be selected");
		}
		else
		{
			//var dataForm = $('#application_steps_form').serializeObject();
			var dataForm = $('#application_steps_form')[0];
			var formdata = new FormData(dataForm);
			let jsonObject = {};

			for (const [key, value]  of formdata.entries()) {
				jsonObject[key] = value;
			}			
			//console.log(jsonObject);
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveApplicantSteps","data":jsonObject,"mode":"add","type":$('#application_steps_head').html(),"applicant_id":applcant_id_for_location_update},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success)
				{
					$("#applicant_steps_div").fadeTo(2000, 500).slideUp(500, function(){
						$("#applicant_steps_div").slideUp(500);
					});	
					if($('#application_steps_head').html() != "Next Step")
					{
						$('#application_steps').modal('hide');
					}
					displayProcessSteps(applcant_id_for_location_update);					
					if($('#application_steps_head').html() == "Next Step")
					{
						getDMUID(store_id_for_dropdown);
					}
				}
				else
				{
					$("#applicant_steps_div_error").fadeTo(2000, 500).slideUp(500, function(){
						$("#applicant_steps_div_error").slideUp(500);
					});						
					$('#application_steps').modal('hide');
				} 
			});			
		}
	});
	
	function getProcessStepsThumbsDetails(applicant_id)
	{
		return $.ajax({
			url:'controller/index1.php?action=getProcessStepsThumbsDetails&applicant_id='+applicant_id,
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					applicant_thumbs_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getProcessStepsThumbsDetails - Error - line 319"); 
			console.log('something bad happened'); }
		}) ;
	}

	function displayProcessSteps(applcant_id_for_location)
	{
		var j=0;
		$.when(getProcessStepsThumbsDetails(applcant_id_for_location)).done(function(){
			var a = [];
			a[0] = applicant_thumbs_JSON[0].c1;
			a[1] = applicant_thumbs_JSON[0].c2;
			a[2] = applicant_thumbs_JSON[0].c3;
			a[3] = applicant_thumbs_JSON[0].c4;
			a[4] = applicant_thumbs_JSON[0].c5;
			$('#process_steps').html('');
			for(var i=0;i<process_steps_JSON.length;i++)
			{
				if(i>0)
				{
					if(a[j] == 0)
					{
					$('#process_steps').append('<div class="col-lg-2  border-center" style="float:left;background:transparent;z-index:1;">'+
													'<center><i class="zmdi zmdi-thumb-down zmdi-hc-2x" data-head="'+process_steps_JSON[i].step+'" style="border:1px solid #B10305;border-radius:50%;padding:5px;background:#B10305;color:white;z-index:-1;"></i><br>'+process_steps_JSON[i].step+'</center>'+
											'</div>');
					}
					else
					{
					$('#process_steps').append('<div class="col-lg-2  border-center" style="float:left;background:transparent;z-index:1;">'+
													'<center><i class="zmdi zmdi-thumb-up zmdi-hc-2x" data-head="'+process_steps_JSON[i].step+'" style="border:1px solid rgb(31,174,154);border-radius:50%;padding:5px;background:rgb(31,174,154);color:white;z-index:-1;"></i><br>'+process_steps_JSON[i].step+'</center>'+
											'</div>');							
					}
					j++;
				}
				else
				{
				$('#process_steps').append('<div class="col-lg-2  border-center" style="float:left;background:transparent;z-index:1;">'+
												'<center><i class="zmdi zmdi-thumb-up zmdi-hc-2x" data-head="'+process_steps_JSON[i].step+'" style="border:1px solid rgb(31,174,154);border-radius:50%;padding:5px;background:rgb(31,174,154);color:white;z-index:-1;"></i><br>'+process_steps_JSON[i].step+'</center>'+
										'</div>');						
				}
			}
		});				
	}
	
	$(document).on('click','#ApplicantChangeStatus',function(){
		$('#application_change_status').modal('show');
		$("input[name=status_change][value='"+status_for_radio+"']").prop("checked",true);
	});
	
	$('#application_status_save').click(function(){
		//console.log($('#status_change:checked').val());
		var status_val = $('#status_change:checked').val();
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveLike","applicant_id":applcant_id_for_location_update,"mode" : "updateApplicantStatus","active":$('#status_change:checked').val()},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success)
				{
					status_for_radio = $('#status_change:checked').val();
					displayAfterStatusUpdate();
				}
				else
				{
					alert("Failed to update");
				} 

			});
			request.fail(function (jqXHR,textStatus,errorThrown)
			{
				alert("Failed to update");
			}); 
	});
	
	function displayAfterStatusUpdate()
	{		
		var table = $('#view_applicant_list').DataTable();
		$('#application_change_status').modal('hide');
		$("#applicant_steps_div").fadeTo(2000, 500).slideUp(500, function(){
			$("#applicant_steps_div").slideUp(500);
		});			
		table.destroy();
		$.when(getApplicantListDetails()).done(function(){
					dispApplicantListDetails(applicant_list_JSON);
					$('[data-toggle="tooltip"]').tooltip();
		});
	}
	
	
	
	$(document).on('click','#ApplicantChangePosition',function(){
		$('#application_change_position').modal('show');
		$("input[name=status_job_position][value='"+position_job_id+"']").prop("checked",true);
	});
	
	$('#application_position_save').click(function(){
		//console.log($('#status_change:checked').val());
		var status_val = $('#status_job_position:checked').val();
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveLike","applicant_id":applcant_id_for_location_update,"mode" : "updateApplicantPosition","position_job_id":$('#status_job_position:checked').val()},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success)
				{
					position_job_id = $('#status_job_position:checked').val();
					displayAfterPositionUpdate();
				}
				else
				{
					alert("Failed to update");
				} 

			});
			request.fail(function (jqXHR,textStatus,errorThrown)
			{
				alert("Failed to update");
			}); 
	});
	
	function displayAfterPositionUpdate()
	{		
		var table = $('#view_applicant_list').DataTable();
		$('#application_change_position').modal('hide');
		$("#applicant_steps_div").fadeTo(2000, 500).slideUp(500, function(){
			$("#applicant_steps_div").slideUp(500);
		});			
		table.destroy();
		$.when(getApplicantListDetails()).done(function(){
					dispApplicantListDetails(applicant_list_JSON);
					$('[data-toggle="tooltip"]').tooltip();
		});
	}

	function getCarerAccessRidDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getCarerAccessRidDetails&rid='+$('#rid').val(),
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					access_Rid_Details = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getCarerAccessRidDetails - Error - line 28"); 
			console.log('something bad happened'); }
		}) ;
	}	
	
	$(document).on('click','#ApplicantAddReference',function(){
		$('#application_change_reference').modal('show');
		//$('#reference_fname').val(reference_first_name);
		//$('#reference_lname').val(reference_last_name);
		//$('#reference_phone').val(reference_phone_number);	
		//if(reference_first_name == '')
		//{
			reference_mode = "add";
		//}
		//else
		//{
			//reference_mode = "update";
		//}
		$('#reference_fname').val('');
		$('#reference_lname').val('');
		$('#reference_phone').val('');
	});
	
	
	
	$('#application_reference_save').click(function(){
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveLike","applicant_id":applcant_id_for_location_update,"mode" : "updateApplicantreference",
						"reference_fname":$('#reference_fname').val(),"reference_lname":$('#reference_lname').val(),"reference_phone":$('#reference_phone').val(),
						"op_flag":reference_mode},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success)
				{
					//position_job_id = $('#status_job_position:checked').val();
					//displayAfterPositionUpdate();
					$('#application_change_reference').modal('hide');
					$("#applicant_steps_div").fadeTo(2000, 500).slideUp(500, function(){
						$("#applicant_steps_div").slideUp(500);
					});					
					reference_first_name = $('#reference_fname').val();
					reference_last_name = $('#reference_lname').val();
					reference_phone_number = $('#reference_phone').val();					
				}
				else
				{
					alert("Failed to update");
				} 

			});
			request.fail(function (jqXHR,textStatus,errorThrown)
			{
				alert("Failed to update");
			}); 		
	});
	
	function getDMUID(sidForDM)
	{
		return $.ajax({
			url:'controller/index1.php?action=getDMUID&sid='+sidForDM,
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				getDMUID_JSON = js.details;
				if (js.success == true)
				{
					getDMUID_JSON = js.details;
					//console.log(getDMUID_JSON);
					$('#application_steps_body').html('');
					$('#application_steps_footer').hide();
					for (var i=0;i<getDMUID_JSON.length;i++)
					{
						var disp_email;
						if(getDMUID_JSON[i].email_flag == 1)
						{
							disp_email = "True";
							callSendEmail(getDMUID_JSON[i],"user");
						}
						else
						{
							disp_email = "False";
						}
						$('#application_steps_body').append('<div class="col-md-12">'+
																	'<div class="row form-group">'+
																		'<div class="col col-md-3">'+
																			'<label class=" form-control-label">Name</label>'+
																		'</div>'+
																		'<div class="col-12 col-md-9">'+
																			'<label class=" form-control-label">'+getDMUID_JSON[i].name+'</label>'+
																		'</div>'+
																	'</div>'+
																'</div>');	
	/* 					$('#application_steps_body').append('<div class="col-md-12">'+
																	'<div class="row form-group">'+
																		'<div class="col col-md-3">'+
																			'<label class=" form-control-label">Email</label>'+
																		'</div>'+
																		'<div class="col-12 col-md-9">'+
																			'<label class=" form-control-label">'+getDMUID_JSON[0].mail+'</label>'+
																		'</div>'+
																	'</div>'+
																'</div>');	
						$('#application_steps_body').append('<div class="col-md-12">'+
																	'<div class="row form-group">'+
																		'<div class="col col-md-3">'+
																			'<label class=" form-control-label">Is Email </label>'+
																		'</div>'+
																		'<div class="col-12 col-md-9">'+
																			'<label class=" form-control-label">'+disp_email+'</label>'+
																		'</div>'+
																	'</div>'+
																'</div>');	 */	
					}
				}
				else if(js.success == "check")
				{
					callSendEmail(getDMUID_JSON,"admin");
					$('#application_steps_body').html('');
					$('#application_steps_footer').hide();	
					$('#application_steps_body').append('<div class="col-md-12">'+
																'<div class="row form-group">'+
																	'<div class="col col-md-3">'+
																		'<label class=" form-control-label">Name</label>'+
																	'</div>'+
																	'<div class="col-12 col-md-9">'+
																		'<label class=" form-control-label">'+getDMUID_JSON[0].name+'</label>'+
																	'</div>'+
																'</div>'+
															'</div>');	
					/* $('#application_steps_body').append('<div class="col-md-12">'+
																'<div class="row form-group">'+
																	'<div class="col col-md-3">'+
																		'<label class=" form-control-label">Email</label>'+
																	'</div>'+
																	'<div class="col-12 col-md-9">'+
																		'<label class=" form-control-label">'+getDMUID_JSON[0].email+'</label>'+
																	'</div>'+
																'</div>'+
															'</div>'); */	
				}
				else
				{
					$('#application_steps_body').html('');
					$('#application_steps_footer').hide();	
					$('#application_steps_body').append('<div class="col-md-12">'+
																'<div class="row form-group">'+
																	'<div class="col col-md-3">'+
																		'<label class=" form-control-label">Error! Mail to:</label>'+
																	'</div>'+
																	'<div class="col-12 col-md-9">'+
																		'<label class=" form-control-label">vkumar@suncommobile.com</label>'+
																	'</div>'+
																'</div>'+
															'</div>');					
				}
        },		
		error: function() {
			console.log("applicant_list - getDMUID - Error - line 1179"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function getApprovalStepsDetails()
	{
		var Ajax_rid = $('#rid').val();
		return $.ajax({
			url:'controller/index1.php?action=getApprovalStepsDetails&rid='+Ajax_rid+'&applicant_id='+applcant_id_for_location_update,
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					approval_steps_Details = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getApprovalStepsDetails - Error - line 1179"); 
			console.log('something bad happened'); }
		}) ;
	}

	function callSendEmail(JSON,flag)
	{
		if(flag == "user")
		{
			var subject = JSON.subject;
			var body = JSON.body;
			//var to = JSON.mail;
			//console.log(to);
			//console.log(subject);
			//console.log(body);
			var to = "vkumar@suncommobile.com";
			var Success;
			return $.ajax({
				url:'controller/index1.php?action=sendEmail&to='+to+'&subject='+subject+'&body='+body+'&applicant_id='+applcant_id_for_location_update,
				type:'POST',
				success:function(data){
					var js_success = data;  
					if (js_success == 0)
					{
						$('#application_steps_body').append('<div class="col-md-12">'+
																	'<div class="alert alert-success" style="text-align:center;padding:5px;">'+
																		'Mail Has Been Sent to:'+to+'</div>'+
															'</div>');						
					}
					else
					{
						$('#application_steps_body').append('<div class="col-md-12">'+
																	'<div class="alert alert-danger" style="text-align:center;padding:5px;">'+
																		'Mail Not Sent Contact: Admin@suncommobile.com'+
																'</div>'+
															'</div>');						
					} 
			},		
			error: function() {
				console.log("applicant_list - getApprovalStepsDetails - Error - line 1179"); 
				console.log('something bad happened'); }
			}) ;
		}
		else
		{
			var subject = "Admin Test";
			var body = "Admin Test For Portal";
			//var to = JSON.mail;
			//console.log(to);
			//console.log(subject);
			//console.log(body);
			var to = "vkumar@suncommobile.com";
			var Success;
			return $.ajax({
				url:'controller/index1.php?action=sendEmail&to='+to+'&subject='+subject+'&body='+body+'&applicant_id='+applcant_id_for_location_update,
				type:'POST',
				success:function(data){
					var js_success = data;  
					if (js_success == 0)
					{
						$('#application_steps_body').append('<div class="col-md-12">'+
																	'<div class="alert alert-success" style="text-align:center;padding:5px;">'+
																		'Mail Has Been Sent to:'+to+'</div>'+
															'</div>');						
					}
					else
					{
						$('#application_steps_body').append('<div class="col-md-12">'+
																	'<div class="alert alert-danger" style="text-align:center;padding:5px;">'+
																		'Mail Not Sent Contact: Admin@suncommobile.com'+
																'</div>'+
															'</div>');						
					} 
			},		
			error: function() {
				console.log("applicant_list - getApprovalStepsDetails - Error - line 1179"); 
				console.log('something bad happened'); }
			}) ;			
		}
	}

	function getHiringStepsDetails(applicant_id)
	{
		return $.ajax({
			url:'controller/index1.php?action=getHiringStepsDetails&applicant_id='+applicant_id,
			type:'POST',
			success:function(data){
				var js = $.parseJSON(data);  
				if (js.success == true)
				{
					hiring_steps_list_JSON = js.details;
				}
				else
				{
				}
        },		
		error: function() {
			console.log("applicant_list - getHiringStepsDetails - Error - line 1418"); 
			console.log('something bad happened'); }
		}) ;
	}	
	
	$('#hiring_step_clear').click(function(){
		$('#select_hiring_step').val('');
	});
	
	$('#hiring_step_save').click(function(){
		if($('#select_hiring_step').val() == '')
		{
			$("#hiring_step_danger").html('Hiring Step must be provided');
			$("#hiring_step_danger").fadeTo(2000, 500).slideUp(500, function(){
				$("#hiring_step_danger").slideUp(500);
			});				
		}
		else
		{
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveLike","applicant_id":applcant_id_for_location_update,"mode" : "updateHiringSteps","hiring_step_id":$('#select_hiring_step').val()},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success==true)
				{
					$("#hiring_step_success").fadeTo(2000, 500).slideUp(500, function(){
						$("#hiring_step_success").slideUp(500);
					});	
					$('#select_hiring_step').val('');
					hiringStepDisp(applcant_id_for_location_update);
				}
				else if(js.success=="Duplicate")
				{
					$("#hiring_step_danger").html(js.msg);
					$("#hiring_step_danger").fadeTo(2000, 500).slideUp(500, function(){
						$("#hiring_step_danger").slideUp(500);
					});	
				}				
				else
				{
					alert("Failed to update");
				} 

			});
			request.fail(function (jqXHR,textStatus,errorThrown)
			{
				alert("Failed to update");
			}); 			
		}
	});
	
	function hiringStepDisp(applicant_id)
	{
		$.when(getHiringStepsDetails(applicant_id)).done(function(){
			var flag_enable = 0;
			$('#select_hiring_step').html('');
			$('#append_hiring_details').html('');
			$('#append_hiring_details').hide();
			$('#append_hiring_details').append('<thead><tr><th style="font-size:12px;">Step Name</th><th style="font-size:12px;">User Name</th><th style="font-size:12px;">Time</th></tr></thead>');
			$('#select_hiring_step').append('<option value="">-- Please select one --</option>');
			for(var i=0;i<hiring_steps_list_JSON.length;i++)
			{
				if(hiring_steps_list_JSON[i].flag=='active')
				{
					$('#select_hiring_step').append('<option value="'+hiring_steps_list_JSON[i].hiring_step_id+'">'+hiring_steps_list_JSON[i].step_name+'</option>');
				}
				else
				{
					flag_enable = 1;
					$('#append_hiring_details').append('<tr><td>'+hiring_steps_list_JSON[i].step_name+'</td>'+
						'<td>'+hiring_steps_list_JSON[i].name+'</td>'+
						'<td>'+hiring_steps_list_JSON[i].time+'</td></tr>');
				}
			}	
			if(flag_enable==1)
			{
				$('#append_hiring_details').show();
			}
		});		
	}
	
 	$(document).on('click','.approval_steps_save',function(){
		//console.log("HI");
		//console.log($(this).attr('id'));
		var drop_id = "approval_steps_"+$(this).attr('id');
		console.log($('#'+drop_id).val());
		if($('#'+drop_id).val()=="")
{
			if($('#div_approval_steps').hasClass("alert-success"))
			{
				$('#div_approval_steps').removeClass("alert-success");
				$('#div_approval_steps').addClass("alert-danger");
			}			
			$('#div_approval_steps').html("Steps Must be Selected");
			//$('#div_approval_steps').show();
			$("#div_approval_steps").fadeTo(2000, 500).slideUp(500, function(){
				$("#div_approval_steps").slideUp(500);
			});				
		}
		else
		{
			request = $.ajax({
				type: 'POST',
				url: "index.php",
				data: {"action":"saveLike","applicant_id":applcant_id_for_location_update,"mode" : "updateApprovalSteps","approval_step_id":$(this).attr('id'),"decision":$('#'+drop_id).val()},
				});
			request.done(function (response){
				var js = $.parseJSON(response);
				//console.log(js);
				if(js.success==true)
				{
					$('#div_approval_steps').html(js.msg);
					if($('#div_approval_steps').hasClass("alert-danger"))
					{
						$('#div_approval_steps').removeClass("alert-danger");
						$('#div_approval_steps').addClass("alert-success");
					}
					//$('#div_approval_steps').show();
					$("#div_approval_steps").fadeTo(2000, 500).slideUp(500, function(){
						$("#div_approval_steps").slideUp(500);
					});	
					//hiringStepDisp(applcant_id_for_location_update);
					$.when(getApprovalStepsDetails()).done(function(){
						displayApprovalStepsDetails();
					});						
				}
				else
				{
					alert("Failed to update");
				} 

			});
			request.fail(function (jqXHR,textStatus,errorThrown)
			{
				alert("Failed to update");
			}); 			
		}
	
	}); 
	
/* 	$('.approval_steps_save').click(function(){
		alert("hi");
	});
 */
 
	function displayApprovalStepsDetails()
	{
		$('#approval_steps_div').html('');
		var visited_steps_falge=0;
		var visited_steps_falge_name = 0;
		for(var i=0;i<approval_steps_Details.length;i++)
		{
			
			if(approval_steps_Details[i].status_flag == "Inactive")
			{
				var status_decision;
				if(approval_steps_Details[i].decision==0)
				{
					status_decision ="Approved";
				}
				else
				{
					status_decision ="Hold";
				}
				if(visited_steps_falge_name ==0)
				{
					$('#approval_steps_div').append('<div class="col-md-12" style="padding:0px;font-size:12px;color:white;"><div class="col-md-4" style="float:left;padding:2px;background:#333;">Title</div><div class="col-md-4" style="float:left;padding:2px;background:#333;">Action</div><div class="col-md-4" style="float:left;padding:2px;background:#333;">User</div></div>');
					visited_steps_falge_name=1;
				}
				$('#approval_steps_div').append('<div class="col-md-12" style="padding:0px;padding-top:5px;font-size:12px;min-height:35px;"><div class="col-md-4" style="float:left;padding:2px;">'+approval_steps_Details[i].title+'</div><div class="col-md-4" style="float:left;padding:2px;">'+status_decision+'</div><div class="col-md-4" style="float:left;padding:0px;">'+approval_steps_Details[i].name+'</div></div>');
				$('#approval_steps_div').append('<hr>');
			}
			
		}					
		for(var i=0;i<approval_steps_Details.length;i++)
		{
			
			if(approval_steps_Details[i].status_flag == "Active")
			{
				if(visited_steps_falge ==0)
				{
					$('#approval_steps_div').append('<div class="col-md-12" style="padding:0px;"><div class="col-md-6" style="float:left;padding:2px;">Title</div><div class="col-md-6" style="float:left;padding:2px;">Action</div></div>');
					visited_steps_falge=1;
				}
/* 							console.log(approval_steps_Details[i].status_flag);
				console.log(approval_steps_Details[i].canapprove); */
				if(approval_steps_Details[i].canapprove == "yes")
				{
					$('#approval_steps_div').append('<div class="col-md-12" style="padding:0px;padding-top:5px;"><div class="col-md-6" style="float:left;padding:2px;">'+approval_steps_Details[i].title+'</div><div class="col-md-5" style="float:left;padding:2px;"><select style="padding:0px 5px;width:100%" id="approval_steps_'+approval_steps_Details[i].approval_step_id+'"><option value="">Select one</option><option value="0">Approved</option><option value="1">Hold</option></select></div><div class="col-md-1" style="float:left;padding:0px;"></div><i class="fa fa-floppy-o approval_steps_save" id="'+approval_steps_Details[i].approval_step_id+'" aria-hidden="true"></i></div></div>');
				}
				else
				{
					$('#approval_steps_div').append('<div class="col-md-12" style="padding:0px;padding-top:5px"><div class="col-md-6" style="float:left;padding:2px;">'+approval_steps_Details[i].title+'</div><div class="col-md-6" style="float:left;padding:2px;">N/A</div></div>');
				}
			}
		}
		$('#approval_steps_div').append('<div class="col-md-12" style="padding:5px;text-align:center;margin-top:5px;"><div class="alert alert-danger" id="div_approval_steps" style="padding:2px;display:none;">Steps Must be Properly Selected</div></div>');
				
	}
});

