$(document).ready(function () { 
	var closing_checklist_JSON = [];
	$('#pleaseWaitDialog').modal('toggle');	
	$.when(getClosingChecklistView()).done(function(){
		dispClosingChecklistView();
	});
	
	function getClosingChecklistView()
	{
		return $.ajax({
			url:'controller/index1.php?action=getClosingChecklistView&record_id='+$('#record_id').val(),
			type:'POST',
			success:function(data){
				closing_checklist_JSON = $.parseJSON(data);     
        },		
		error: function() {
			console.log("closing_checklist - getClosingChecklistView - Error - line 17"); 
			console.log('something bad happened'); }
		}) ;
	}
	
	function dispClosingChecklistView()
	{
		var disp_QA="";
		for(var i=0;i<closing_checklist_JSON.length;i++)
		{
			disp_QA=disp_QA+'<div class="form-group row" style="margin-bottom:5px;">'+
				'<label for="example-date-input" class="col-8 col-form-label">'+closing_checklist_JSON[i].question +'</label>'+
				'<div class="col-4">'+
				'<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;">'+	closing_checklist_JSON[i].answer +
				'</label>'+						
				'</div>'+
				'</div>';
		}
		$('#disp_closing_checklist_answer').html(disp_QA);
		setTimeout(function(){
		$('#pleaseWaitDialog').modal('toggle');
		},1000);
	}
});
						
							
                              
                              
                            
						
						
							