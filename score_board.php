<?php

if (isset($_GET['error'])){
    $error_message = urldecode($_GET['error']);
}
if (isset($_GET['success'])){
    $success_message = urldecode($_GET['success']);
}

$page_header = "Quiz Score Board";

include "controller/session.php";
$page_header = "";

include "base.php";

function get_quiz_id_array($user_id){
	$query = "select id from quiz where user_id=" . $user_id . " order by id desc;" ;
	$query_result = run_select_query($query);
	$quiz_id_array = array();
	foreach ($query_result as $res){
		array_push($quiz_id_array, $res["id"]);
	}
	return $quiz_id_array;
}

function get_score_from_quiz($user_id, $quiz_id){
	$query = "select created_on, score from quiz where id=" . $quiz_id . ";";
	$query_result = run_select_query($query, $single=true);
	if ($query_result["score"] == null){
		$score_sum_query = "select SUM(score) as total_score from asked_question where quiz_id=" .$quiz_id . " and user_id=" . $user_id . ";";
		$sum_query_result = run_select_query($score_sum_query, $single=true);
		$score = $sum_query_result["total_score"];

		$update_quiz_query = "update quiz set score=" . $score . " where id=" . $quiz_id . ";";
		run_query($update_quiz_query);
	}else{
		$score = $query_result["score"];
	}
	
	return $score;
}
$quiz_id_array = get_quiz_id_array($user["id"]);
$last_quiz_id = $quiz_id_array[0];

$score = get_score_from_quiz($user["id"], $last_quiz_id);

?>
<body class="scorebackground">
	<h1 class="score"></h1>
	<div class="score-style">
        <br>
		<div class="score-title">You Scored 
        <div class="score-number"> <?php echo $score ?> </div>	
        </div>
</div>
<div class="logout">
<a href="play_quiz.php" >Play Again</a>
</div>
<br>
<br>
<?php
// Sample participant details
$participantName = 'user';
$quizScore = $score;
$dateCompleted = date("F j, Y");
// Function to generate a certificate
function generateCertificate($name, $score, $date) {
    // Certificate HTML template
    if ($score>=70)
    {
    $certificateHTML = "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Quiz Certificate</title>
    </head>
    <body class='certificate'>
        <div class='certificate-quiz'>
            <div class='title-certificate'>Certificate of Achievement</div>
            <div class='content-certificate'>
                This is to certify that <span class='certificate-name'>$name</span> has successfully completed the quiz<br>
                and achieved a score of <span class='certificate-name'>$score</span>.
                <br><br>
                Date: $date
            </div>
        </div>
    </body>
    </html>
    ";
    
    return $certificateHTML;
}
}

// Generate certificate
$certificate = generateCertificate($participantName, $quizScore, $dateCompleted);

// Output the certificate
echo $certificate;
?>
  <!-- <div class="certificate">
    <a  href="certificate.php" >Certificate  </a>
</div> -->
 </body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Feedback</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body >
    <div class="feedback-section">
    <h1 >Feedback section</h1>
    <form id="feedbackForm">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="feedback">Feedback:</label><br>
        <textarea id="feedback" name="feedback" rows="4" required></textarea><br>
        <button type="submit">Submit Feedback</button>
    </form>

    <div id="confirmation"></div>
<script>
	document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const feedbackData = {};
    formData.forEach((value, key) => {
        feedbackData[key] = value;
    });
    console.log('Feedback submitted:', feedbackData);
    const confirmationDiv = document.getElementById('confirmation');
    confirmationDiv.innerText = 'Thank you for your feedback!';
    confirmationDiv.style.display = 'block';
    event.target.reset();
});
</script>
<div>
</body>
</html>
