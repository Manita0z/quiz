<?php

$page_header = "";
include "controller/session.php";
include "base.php";
if ($_SERVER["REQUEST_METHOD"] == "GET"){
	$param = isset($_GET['param']) ? $_GET['param'] : '';
	
	if ($param == "run"){
		$query = "INSERT INTO user (name, email, uuid) VALUES ('example_user', 'user@example.com', 'hashed_password'); ";
		// run_query($query);
		$query = "select name, email, uuid from user";
		$result = run_select_query($query);
		foreach ($result as $row){
			foreach ($row as $key => $value){
				echo "$key: $value<br>";
			}
		}
		
	}
}



?>
<div class="home_header">
<!-- <h1>Home Page</h1> -->
</div>
<div class="homepage">
		If you want to play quiz you need to follow the rules. Click next button below.
       <br>
<div id=nextbutton>
        
<button class="popup-button" onclick="openPopup()" >Next</button>
</div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz rule popup</title>
</head>
<body class="home_main">
    <div id="popup" class="popup-container">
        <h2>These are rules</h2>
        <p>
		1. There are two rounds.</br>
	2. First round contains two questions each carrying 10 marks.</br>
	3. If user gains minimum 10 marks can go to next round.</br>
	4. Second round contains 8 questions carrying 10 marks each.</br>
	5. Timer of 30 seconds is provided if user is unable to answer next question will appear.</br>
		</p>
        <div class="home-playnow">
        <button onclick="closePopup()">
		<form class="home_page" action="play_quiz.php">
	<input class="submit-button-home" type="submit" value="Play Now"/>
	<!-- <button>Play Now</button> -->
	</form>		
	</button>
        </div>

    <!-- Overlay Background -->
    <div id="overlay" class="overlay"></div>

    <script>
        function openPopup() {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }
		function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</body>
</html>