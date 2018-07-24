$(document).ready(function() {
	var usersDetails_JSON = [];
	var storeList_JSON = [];
	var user_id ="";
	$.when(getUsersViewsDetails()).done(function(){				
		dispUsersDetails(usersDetails_JSON);
		$.when(getEditUsersStore()).done(function(){
			dispDropDown();
		});
		$('[data-toggle="tooltip"]').tooltip();
		
	});
	
	function getUsersViewsDetails()
	{
		return $.ajax({
			url:'controller/index1.php?action=getUsersViewsDetails',
			type:'POST',
			success:function(data){
				usersDetails_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("users - getUsersViewsDetails - Error - line 23"); 
			alert('something bad happened'); }
		}) ;
	}
	
	function getEditUsersStore()
	{
		return $.ajax({
			url:'controller/index1.php?action=getEditUsersStore',
			type:'POST',
			success:function(data){
				storeList_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("users - getEditUsersStore - Error - line 23"); 
			alert('something bad happened'); }
		}) ;
	}

	function dispDropDown()
	{
		var index;
		$('#edit_user_store').html('');
		$("#edit_user_store").append('<option value="0000">Home Office</option>');
		for(index=0;index < storeList_JSON.length;index++)
		{			
			 $("#edit_user_store").append('<option value="' + storeList_JSON[index].store_id + '">' + storeList_JSON[index].store_name + '</option>');
		}
		 $('#edit_user_store').selectpicker('refresh');
	}	
	
	function dispUsersDetails(dataJSON)
	{
		$('#view_users_details').dataTable( {
			"aaSorting":[],
			"aaData": dataJSON,
			"aoColumns": [
				{ "mDataProp": "employee_name" },
				{ "mDataProp": "mail" },
				{ "mDataProp": "role" },
				{ "mDataProp": "Status" },
				{ "mDataProp": "phonenumber" },
				{ "mDataProp": "Store" },				
				{ 
					"mDataProp": function ( data, type, full, meta) {
						return '<a id="'+ meta.row +'" class="btn usersBtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit '+data.employee_name+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
					} 
				}, 
			],
			dom: 'Bflrtip',
			buttons: [
            {
                extend: 'excelHtml5',
                title: 'Users Details',
				exportOptions: {
                    columns: [  0, 1 , 2 , 3 , 4 , 5 ]
                },
				"text":'<i class="fa fa-file-excel-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Click to export info in Excel"></i>',	
			},
            {
                extend: 'pdfHtml5',
                title: 'Users Details',
				exportOptions: {
                    columns: [  0, 1 , 2 , 3 , 4 , 5 ]
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
					//$newButton = $('<input type = "button" class="fa-input storesBtnnew" value="&#xf067;" data-toggle="tooltip" data-placement="top" title="Click to Add New Store" />');
					$('#view_users_details_filter').append($clearButton);
			
			},
			 "createdRow": function( row, data, dataIndex){
				 
                if( data.Status == 'InActive'){
					//alert("hi");
                    $(row).css('background-color','#ff4500');				
                }
            }			
		});
		//var height = $('#view_users_details').height();
		$('#tab_edit').height(3800);
		return true;
	}
	
	$(document).on('click','.usersBtnEdit',function ()
	{
		$('#tab_edit').height(400);
		$("#tab_li_a_edit").removeClass("disabled");
		$("#tab_li_a_edit").click();
		var id = $(this).attr('id');	
		//console.log(usersDetails_JSON[id].Store);
		user_id = usersDetails_JSON[id].uid;
		$('#edit_user_store').selectpicker('val',usersDetails_JSON[id].Store_id);
		$('#employee_name').html("Employee Name : " + usersDetails_JSON[id].employee_name);
		$('#BtnClearPortalLock').attr("data-uid",user_id);
		$("input[name=edit_user_status][value='"+usersDetails_JSON[id].Status_id+"']").prop("checked",true);
	});
	
	$(document).on('click','#back_users_details',function ()
	{
		$("#tab_li_a_edit").addClass("disabled");
		$("#tab_li_a_list").click();
		var height = $('#view_users_details').height();
		$('#tab_edit').height(3800);
	});
	
/* 	$(document).on('click','#tab_li_a_list',function ()
	{
		$("#tab_li_a_edit").addClass("disabled");
		$("#tab_li_a_list").click();
	}); */
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		if( $(this).attr('id') == 'tab_li_a_list')
		{
			$("#tab_li_a_edit").removeClass("active");
			$("#tab_li_a_edit").addClass("disabled");
			//var height = $('#view_users_details').height();
			$('#tab_edit').height(3800);
		}
	});
	
	var $tabs = $('ul.nav-tabs');

	// show the appropriate tab content based on url hash
	if (window.location.hash) {
	  showFormPane(window.location.hash);
	  makeTabActive($tabs.find('a[href="' + window.location.hash + '"]').parent());
	}

	// function to show/hide the appropriate content page
	function showFormPane(tabContent, paneId) {
	  var $paneToHide = $(tabContent).find('div.content-pane').filter('.is-active'),
		$paneToShow = $(paneId);

	  $paneToHide.removeClass('is-active').addClass('is-animating is-exiting');
	  $paneToShow.addClass('is-animating is-active');

	  $paneToShow.on('transitionend webkitTransitionEnd', function() {
		$paneToHide.removeClass('is-animating is-exiting');
		$paneToShow.removeClass('is-animating').off('transitionend webkitTransitionEnd');
	  });
	}

	// change active tab
	function makeTabActive($tab) {
	  $($tab).parent().addClass('active').siblings('li').removeClass('active');
	}

	// show/hide the tab content when clicking the tab button
	$tabs.on('click', 'a', function(e) {
	  e.preventDefault();

	  makeTabActive($(this));
	  showFormPane($(this).closest('.container'), this.hash);
	});
	
	
	
	$('#save_users_details').click(function(e){
		if( $('#edit_user_status').val()=='')
		{
			$.notify({
					message: "Status must be provided"
				},{
					type: 'danger'
				});
		}
		else if( $('#edit_user_store').val()=='')
		{
			$.notify({
					message: "Store name must be provided"
				},{
					type: 'danger'
				});
		}
		else
		{
		 var data = [];
			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveUsers","mode":"update","uid":user_id,"store_id":$('#edit_user_store').val(),
						"status":$('#edit_user_status:checked').val()
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
						refreshUsersDetails();
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
	function refreshUsersDetails()
	{
		$.when(getUsersViewsDetails()).done(function(){
			var table = $('#view_users_details').DataTable();
			$('#tab_li_a_list').click();
			table.destroy();
			dispUsersDetails(usersDetails_JSON);
			$('[data-toggle="tooltip"]').tooltip();
		});
	}
	$('#BtnClearPortalLock').click(function(){
		//console.log($('#BtnClearPortalLock').attr('data-uid'));
			request = $.ajax({
				url: 'index.php',
				data: {"action": "saveUsers","mode":"clearFlood","uid":$('#BtnClearPortalLock').attr('data-uid')
					},
				type: 'POST',
			});
			request.done(function (response){
					var js = $.parseJSON(response);
					if(js.success)
					{
						if(js.flag == 0)
						{
							$.notify({
								// options
								message: js.msg
							},{
								// settings
								type: 'success'
							});
						}
						else
						{
							$.notify({
								// options
								message: js.msg
							},{
								// settings
								type: 'warning'
							});							
						}
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
	});
});

