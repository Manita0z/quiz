<body class="login">
    <h1 class="login-title">Login Page</h1>
    <div class="link-to-home">
<a href="index.php">Home</a>
</div>
<form class="form-class" method="post" action="/controller/login_controller.php">
    <p style="color:red;"><?php echo $error_message ?></p>
    <p style="color:green;"><?php echo $success_message ?></p>
    <label for="email">Email:</label>
    <input class="input-class" type="text" name="email" required>
    <br>
    <label for="password">Password:</label>
    <input class="input-class" type="password" name="password" required>
    <br>
    <input class="input-class submit-button" type="submit" value="Submit">
<p>Haven't registered yet?<p>
    <a href="register.php">Register</a>
</form>
</body>