<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "../verify_logged_out.php";
	require "../header.php";
?>

<html>
	<head>
		<title>Librarian Login</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css">
		<link rel="stylesheet" type="text/css" href="css/index_style.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
		
		<legend>Librarian Login</legend>
		
			<div class="error-message" id="error-message">
				<p id="error"></p>
			</div>
			
			<div class="icon">
				<input class="l-user" type="text" name="l_user" placeholder="Username" required />
			</div>
			
			<div class="icon">
				<input class="l-pass" type="password" name="l_pass" placeholder="Password" required />
			</div>
			
			<input type="submit" value="Login" name="l_login"/>
			
		</form>
	</body>
	
	<?php
	//isset($l_ user = $_POST["l_ user"]);
	//isset($l_ pass = sha1($_POST['l_ pass']));
	
	$l_user = isset($_POST['l_user']) ? $_POST['l_user'] : '';
	//l_user1 = $_POST['l_user'];
	//$l_ pass = isset($_POST['l_ pass']) ? $_POST['l_ pass'] : '';
	//$l_pass = sha1($_POST['l_pass'])? $_POST['l_pass'] : '';
	//$l_pass1 = sha1($_POST['l_pass']);
	//$l_pass = isset(sha1($l_pass1)) ? $l_pass1 : '';
	$l_pass1 = isset($_POST['l_pass']) ? $_POST['l_pass'] : '';
	$l_pass = sha1($l_pass1);
	//$l_pass = sha1($_POST['l_pass']);
		if(isset($_POST['l_login']))
		{
			$query = $con->prepare("SELECT id FROM librarian WHERE username = ? AND password = ? ;");
			//$query->bind_param("ss", $_POST['l_user'], sha1($_POST['l_pass']));
			//$query->bind_param("ss", $_POST['l_user'], sha1($_POST['l_pass']));
			$query->bind_param("ss", $l_user, $l_pass);
			$query->execute();
			if(mysqli_num_rows($query->get_result()) != 1)
				echo error_without_field("Invalid username/password combination");
			else
			{
				$_SESSION['type'] = "librarian";
				//$_SESSION['id'] = mysqli_fetch_array($result)[0];
				$_SESSION['username'] = $_POST['l_user'];
				//$_SESSION['username'] = $l_user;
				header('Location: home.php');
			}
		}
	?>
	
</html>