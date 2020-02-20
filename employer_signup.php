<?php
echo"Registration <br>";
echo"New Employer to Jon-Hunt System? Register Below<br>"?>
<!doctype html>
<html lang="en">
	<head>
		<title>
			employer_signup
		</title>
	</head>
	<body>
	<form action="employer_signup_post.php"method="POST">
		Account<br>
		<input type="text"name="account"><br>
		
		Password <br>
		<input type="password"name="password"><br>
		
		Phone number<br>
		<input type="text"name="phone"><br>
		
		Email address<br>
		<input type="text"name="mail"><br>
		
		<button type="submit">submit</button>

		
	</form>
	</body>
</html>
