<?php

include "controller/session.php";

$page_header = "";

include "base.php";
include "controller/quiz_controller.php";
$data = json_decode($json_response, true);
$is_score_board = $data["is_score_board"];

function capitalize($value){
	$words = explode('_', $value);
    $titleCaseWords = array_map('ucfirst', $words);
    $titleCaseString = implode(' ', $titleCaseWords);
    return $titleCaseString;
}

function get_option_val($idx){
	$option_val = array("a", "b", "c", "d");
	return $option_val[$idx];	
}

if ($is_score_board) {
	$error_message = "Email or password doesn't match.";
    $encoded_error_message = urlencode($error_message);
    header("location: /score_board.php?error=$encoded_error_message");
    exit();
}else{
	$question = $data["question"];
	$options = $data["options"];
	$uuid = $data["uuid"];
	$question_type = $data["question_type"];
	$question_number = $data["question_number"];
}

?>
<body class="playquiz">
<div class="quiz-round-title"><?php echo capitalize($question_type)?> </div>
<h1 class="play_now"></h1>
<form method="post" action="" id="id_quiz_form">

	<div class="main-content">
		<div class="margin-panel">
			<!-- <div class="quiz-round-title"><?php echo capitalize($question_type)?> </div> -->
			<input type="hidden" name="uuid" value="<?php echo $uuid ?>" />
			<p class="question-text">  <?php echo " ".$question_number?><?php echo ") "?><?php echo  $question ?> </p>
			<h4 id="timer">30 sec</h4>
	<script>
    let Timeleft = 30;  // Set the initial countdown value
    const timerElement = document.getElementById('timer');
    const quizForm = document.getElementById('id_quiz_form');
    function updateTimer() {
        timerElement.textContent = ` ${Timeleft} sec`;

        if (Timeleft=== 0) {
            clearInterval(timerInterval);
            // timerElement.textContent = 'Time up oops!...';
            submitForm();
              // Call the function to submit the form
        } else {
            Timeleft--;
        }
    }

    function submitForm() {
        quizForm.submit();  // Submit the form
    }

    const timerInterval = setInterval(updateTimer, 1000);
</script>
			<ul class="no-list option-list">
		    	<?php
		    		foreach ($options as $index => $option) {
				      $list_tag = '<li class="keep-margin"> <input type="radio" id="id_option_' . get_option_val($index) . '" name="selected_option" value="' . get_option_val($index) . '"> <label class="highlight-green" for="id_option_' . get_option_val($index) . '">' . $option . '</label></li>';
				      echo $list_tag;
					}
		    	?>
		    </ul>
		</div>

	</div>
    <input class="submit-button" type="submit" value="Submit" />
</form>
</body>
	