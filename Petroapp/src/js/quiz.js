var quizAnswerVar = 0;
var firstRun = true;

var prevQuestionId = 0;
var prevCorrAnswer = 0;
var prevWrong1Answer = 0;
var prevWrong2Answer = 0;
var prevWrong3Answer = 0;

$(function()// execute once the DOM has loaded
{
	$("#btnQuiz").click(function(event) {
	console.log("skal skjule quizzcontent");
	$(".quizAnswer").hide();
});
});










function quizAnswer(answer) {
	/**
	 *
	 * check previous answer -js -ok
	 * 	if "start", 
	 * if not defined, userid, groupid,
	 * 	 hente info fra cookies -js - ok
	 * end if
	 *
	 * get first question
	 * else
	 * set answer to db
	 if not last qst,
	 * get next question
	 *end
	 *
	 *
	 *
	 *
	 *
	 */
	if (answer === "start") {
		firstRun = false;
		console.log(groupId);
		console.log(userId);
		$(".quizStart").hide();
		
		if (typeof groupId==='undefined'|| typeof userId==='undefined')
		{
			getAllCookies();
		console.log("all cookies are eaten [.___.] down")
		}

	} else {
		var lastAnswer = parseInt(answer);
		var lastAnswerIndex = -1;

		switch (lastAnswer) {
		case prevCorrAnswer:
			console.log("correct answer");
			lastAnswerIndex = 0;
			break;
		case prevWrong1Answer:
			console.log("quiz_answ_wrong1");
			lastAnswerIndex = 1;
			break;
		case prevWrong2Answer:
			console.log("quiz_answ_wrong2");
			lastAnswerIndex = 2;
			break;
		case prevWrong3Answer:
			console.log("quiz_answ_wrong3");
			lastAnswerIndex = 3;
			break;

		}
		if (prevCorrAnswer === lastAnswer) {
			console.log("Correct");
		} else {
			console.log("wrong");
		}
	}
	var data;
	if (firstRun == true) {
		data = {
			"userId" : userId,
			"groupId" : groupId,
			"questionId" : prevQuestionId,
			"answer" : -1
		};
	} else {
		data = {
			"userId" : userId,
			"groupId" : groupId,
			"questionId" : prevQuestionId,
			"answer" : lastAnswerIndex
		};
	}
	data = $(this).serialize() + "&" + $.param(data);
	$.ajax({
		type : "GET",
		contentType : "application/json; charset=utf-8",
		dataType : "json",
		url : "quizGetQuestion.php", //Relative or absolute path to response.php file
		data : data,
		success : function(data) {
			console.log("success");
			console.log(data[0]);
			
			var finished = data[0].quiz_finished;
			console.log(finished);
			if (finished == "true") {
				//alert("Du er ferdig");
				$(".quizQuestion").hide();
				$(".quizAnswer").html("");
				$(".quizAnswer").html("<strong> Du er ferdig. du fikk "+ data[0].quiz_correct + " antall rette svar</strong>");
					
				
				
				
			}

			prevQuestionId = data[0].quiz_id;

			//sort the data random and keep track of correct answer.
			var arr = [data[0].quiz_answ_corr, data[0].quiz_answ_wrong1, data[0].quiz_answ_wrong2, data[0].quiz_answ_wrong3];
			var unsortedAnswers = shuffle(arr);

			prevCorrAnswer = unsortedAnswers.indexOf(data[0].quiz_answ_corr) + 1;
			prevWrong1Answer = unsortedAnswers.indexOf(data[0].quiz_answ_wrong1) + 1;
			prevWrong2Answer = unsortedAnswers.indexOf(data[0].quiz_answ_wrong2) + 1;
			prevWrong3Answer = unsortedAnswers.indexOf(data[0].quiz_answ_wrong3) + 1;

			//add data to html
			$(".quizQuestion").html(data[0].quiz_question);
			$(".quizAnswer1").html(unsortedAnswers[0]);
			$(".quizAnswer2").html(unsortedAnswers[1]);
			$(".quizAnswer3").html(unsortedAnswers[2]);
			$(".quizAnswer4").html(unsortedAnswers[3]);
		},
		error : function(jqXHR, textStatus, errorThrown) {

			console.log("error");
			console.log(jqXHR);
			console.log(textStatus);
			console.log(errorThrown);
		}
	});
	return false;

}

//Fisher-Yates Shuffle
//Code from: http://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array
function shuffle(array) {
	var currentIndex = array.length,
	    temporaryValue,
	    randomIndex;

	// While there remain elements to shuffle...
	while (0 !== currentIndex) {

		// Pick a remaining element...
		randomIndex = Math.floor(Math.random() * currentIndex);
		currentIndex -= 1;

		// And swap it with the current element.
		temporaryValue = array[currentIndex];
		array[currentIndex] = array[randomIndex];
		array[randomIndex] = temporaryValue;
	}

	return array;
}