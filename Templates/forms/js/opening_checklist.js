$(document).ready(function () {
	$('#pleaseWaitDialog').modal('toggle');
	var opening_checklist_JSON = [];
	$.when(getOpeningChecklistView()).done(function(){
		dispOpeningChecklistView();
		
	});
	
	function getOpeningChecklistView()
	{
		return $.ajax({
			url:'controller/index1.php?action=getOpeningChecklistView&record_id='+$('#record_id').val(),
			type:'POST',
			success:function(data){
				opening_checklist_JSON = $.parseJSON(data);							
        },		
		error: function() {
			console.log("opening_checklist - getOpeningChecklistView - Error - line 17"); 
			console.log('something bad happened');
		}
		}) ;
	}
	
	function dispOpeningChecklistView()
	{
		var disp_QA="";
		for(var i=0;i<opening_checklist_JSON.length;i++)
		{
			disp_QA=disp_QA+'<div class="form-group row" style="margin-bottom:5px;">'+
				'<label for="example-date-input" class="col-8 col-form-label">'+opening_checklist_JSON[i].question +'</label>'+
				'<div class="col-4">'+
				'<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;">'+	opening_checklist_JSON[i].answer +
				'</label>'+						
				'</div>'+
				'</div>';
		}
		$('#disp_opening_checklist_answer').html(disp_QA);
		setTimeout(function(){
		$('#pleaseWaitDialog').modal('toggle');
		},1000);
	}
});
						
							
                              
                              
                            
						
						
							