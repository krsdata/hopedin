var allQuestions = [{question:"What is the color of the sky?", answer:["blue","yellow", "red",'Green'],correctAnswer:["yellow",1],selected:""},
                    {question:"What is the opposite of up?",answer:["down","sideways", "circle",'Straight'],correctAnswer:["down",1],selected:""},
					{question:"What is the first number?",answer:["1","5", "7",'2'],correctAnswer:["1",1],selected:""}];


$(document).ready(function(){	
$("#nextbtn").hide();
$('#btnskip').hide();
$("#btnvalid").hide();
$("#back").hide();
var i = 0;
var b;
var total = []
var finalResult = 0;   
var result = 0;
var selected;
   
function changeQuestion(){
    var j = 0;
	$("#titleQuestion").html(allQuestions[i].question.toString());
    $("#titleQuestion").hide().fadeIn('slow');
    //changes question title
	$("#radios").empty().hide();
	for( answers in allQuestions[i].answer){ //loops through array and dynamically adds answer values to radio buttons
		var radioBtn = $('<input type="radio" class="radios" name="btnAnswers" value="'+ allQuestions[i].answer[j] + '" /><label for ="secondbtn">' 
		                 + allQuestions[i].answer[j] + '</label>');
        radioBtn.appendTo('#radios');
     j++
	}
    $('#radios').fadeIn("slow");
	if(allQuestions[i].selected != "")
	{
		$('input[value = "'+ allQuestions[i].selected + '"]').prop('checked',true);
		
	};
	return true;
};
//End changeRadio Options
    
    //Begin backRadio Options - Loops through allQuestions array and dispays answers in radios     
function backQuestion(){
    var j = 0;
	$("#titleQuestion").html(allQuestions[i-1].question.toString());
    $("#titleQuestion").hide().fadeIn('slow');
    //changes question title
	$("#radios").empty();
    $("#radios").hide();
	for( answers in allQuestions[i-1].answer){ //loops through array and dynamically adds answer values to radio buttons
		var radioBtn = $('<input type="radio" class="radios" id="'+ allQuestions[i-1].answer[j] + '" name="btnAnswers" value="'+ allQuestions[i-1].answer[j] + '" /><label for ="secondbtn">' 
		                 + allQuestions[i-1].answer[j] + '</label>');
        radioBtn.appendTo('#radios');
     j++
	}
	i--;
    $('#radios').fadeIn("slow");
	if(i == 0){
		$("#back").hide();
	}
	 return true;
	 
	};
//End backQuestion Options

$(document).on('change', 'input', function(){
    var checked = $("input[name = btnAnswers]:checked").val();
    allQuestions[i].selected = checked;
    selected = allQuestions[i].selected;
	if(i <= allQuestions.length-1){
    if(this.value == allQuestions[i].correctAnswer[0]){
	   b = allQuestions[i].correctAnswer[1];
	   total[i] = parseInt(b);
	}else{
		
		total[i] = -parseInt(allQuestions[i].correctAnswer[2]);
	}
	result = total.reduce(function(a,b){
		return a+b;
	})
	//console.log(total)
	console.log(result);
	}
});


$("#begin").click(function(){
	var exams=$("#begin-select").val();
	if(exams=='')
	{
		alert('Select a exam paper!');
		return false;
	}
	else 
	{
		$.ajax({
			url:"process/process.php?action=Get_all_questions",
			type:"POST",
			data:{'exam':exams},
			async: false,
			dataType:'json',
			success:function(data)
			{
				if(data.result==1)
				{
					allQuestions=data.series;
					result = 0;
					$("#nextbtn").show();
					$('#btnskip').show();
					$("#begin-select").hide();
					$("#begin").hide();
					for(var h = 0; h <= allQuestions.length-1; h++){
						allQuestions[h].selected = "";
					}
					changeQuestion(); 
				}
				else 
				{
					alert('Error! Questions not found.');
					return false;
				}
			}
			
		}); 
		
	}
	
	
});
$('#btnskip').click(function(){
	total[i] = -parseInt(allQuestions[i].correctAnswer[1]);
	result = total.reduce(function(a,b){
		return a+b;
	});
	i++;
	if(i <= allQuestions.length-1){
	    changeQuestion();
	}else{
		$("#radios").empty();
		$("#titleQuestion").html("You scored "+ result + " points!!");
		i=0;
		j=0;
		total=[];
		result=0;
		$("#nextbtn").hide();
		$('#btnskip').hide();
		$("#back").hide();
		$("#begin").show();
		
	}
});
$("#nextbtn").click(function(){
	
	if(i >= 0){
		$("#back").show();
	}
    if($("input[name = btnAnswers]:checked").length > 0){
        i++;
	if(i <= allQuestions.length-1){
	    changeQuestion();
	}else{
		$("#radios").empty();
		$("#titleQuestion").html("You scored "+ result + " points!!");
		i=0;
		j=0;
		total=[];
		result=0;
		$("#nextbtn").hide();
		$('#btnskip').hide();
		$("#back").hide();
		$("#begin").show();
		
	}
}else{
	alert('Please select an answer to continue.');
    //$("#btnvalid").fadeIn(800).fadeOut(1100);
}
});
    
$("#back").click(function(){
   backQuestion();
   $('input[value = "'+ allQuestions[i].selected + '"]').prop('checked',true);
  // i--;
});

   
//jquery close bracket	
});