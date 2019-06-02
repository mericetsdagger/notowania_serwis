<?php

  session_start();

?>

<! DOCTYPE HTML>
<HTML LANG = "pl">
<HEAD>
  <META CHARSET = "utf-8" />
  <TITLE>Formularz rejestracyjny</TITLE>
  <link href="style.css" rel="stylesheet" type="text/css" />
</HEAD>

<BODY>
  <?php
    include 'navbar.php'
  ?>
  <div id = "content">  
  <div class = "content2">
  <div class = "title">
    <p>Formularz rejestracyjny</p>
  </div>	
  <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    <table class = "tableLog">
      <tr>
	    <td>Login: </td>
		<td><input type = "text" name = "login" /></td> 
	  </tr>
	  <tr>	
		<td>Hasło: </td>
		<td><input type = "password" name = "haslo" /></td>
	  </tr>
	  <tr>
	    <td>Powtórz hasło: </td>
		<td><input type = "password" name = "haslo2" /></td>
	  </tr>
      <tr>
		<td>Adres email: </td>
		<td><input type = "text" name = "email" /></td>
	</table>
  <div class = "inputs">	
	<input type = "submit" name = "zatwierdz" value = "Zatwierdź" />
  </div>	
  </form>
  </div>
  </div>
<?php

  $komunikat = $login = $haslo = $haslo2 = $email = "";
  function trimInput($data)
  {
	  $data = trim($data);
	  $data = stripcslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
  }
  
  if(isset($_POST["zatwierdz"]))
  {
	$login = trimInput($_POST['login']);  
	$haslo = trimInput($_POST['haslo']);   
	$haslo2 = trimInput($_POST['haslo2']);  
	$email = trimInput($_POST['email']); 
	
	//walidacje
	if(empty($login) or empty($haslo) or empty($haslo2) or empty($email))
	{
      $komunikat = '<p class="error">Uzupełnij wszystkie pola</p>';
    }
	elseif($haslo != $haslo2)
	{
	  $komunikat = '<p class="error">Hasła się nie zgadzają</p>';
	}
	elseif(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/",$email))
	{
	  $komunikat = '<p class="error">email nie jest poprawny</p>';
	}
	elseif(preg_match('/[^a-z_\-0-9]/i', $login))
	{
	  $komunikat = '<p class="error">login nie jest poprawny</p>';
	}
	elseif(preg_match('/[^a-z_\-0-9]/i', $haslo))
	{
	  $komunikat = '<p class="error">hasło nie jest poprawne</p>';	
	}
	else
	{
      require_once "connect.php";

	  $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	  if ($polaczenie->connect_errno!=0)
	  {
	    echo "Error: ".$polaczenie->connect_errno;
	  }
	  else
	  {
	    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$email = htmlentities($email, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE username='%s' or email='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$email))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow==0)
			{
				if($rezultatI = $polaczenie->query(
				sprintf("insert into users (username, pass, email, zloto) values ('%s', '%s', '%s', 10)",
				mysqli_real_escape_string($polaczenie,$login),
				mysqli_real_escape_string($polaczenie,$haslo),
				mysqli_real_escape_string($polaczenie,$email))))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['username'] = $login;
					$_SESSION['zloto'] = 10;
					$_SESSION['email'] = $email;
					$_SESSION['ver'] = 0;
					header('Location: konto.php');
				}
				else
				{
					$komunikat = '<p class="error">Wystąpił nieoczekiwany błąd</p>';	
				}
				$rezultatI->free_result();
			}
			else
			{
			  $komunikat = '<p class="error">Podany login lub email już istnieją w bazie</p>';	
			}

		}
		$rezultat->free_result();
		$polaczenie->close();
      }

    }		
	echo '<div class = "title">';
	echo $komunikat;
	echo '</div>';

	
  }
?>
</BODY>
</HTML>  