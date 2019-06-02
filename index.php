<?php

  session_start();
  if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == TRUE))
  {
	  header('Location: konto.php');
	  exit();
  }
?>

<! DOCTYPE HTML>
<HTML LANG = "pl">
<HEAD>
  <META CHARSET = "utf-8" />
  <TITLE>Logowanie</TITLE>
  <link href="style.css" rel="stylesheet" type="text/css" />
</HEAD>

<BODY>
  <?php
    include 'navbar.php';
  ?>	
	
	
	  
      <div id = "content">
	    <div class = "title">
		  <p>Zawartość serwisu dostępna tylko dla zalogowanych użytkowników</p>
		</div>
		<form action = "zaloguj.php" method = "post">
		<div class = "content2">
		  
		  <table class = "tableLog">
		    <tr>
			  <td>Login:</td>
			  <td><input type = "text" name = "login" class = "input"/></td>
            </tr>			  
			<tr>
			  <td>Hasło:</td>
			  <td><input type = "password" name = "haslo" class = "input" /></td>
			</tr>
			</table>
			  <div class = "inputs">
			    <input type = "submit" value = "Zaloguj się" />
			  </div>	
		  </form>
		  <form action = "rejestracja.php" method = "post">
		    <div class = "inputs">
			  <input type = "submit" value = "Rejestracja" />
			</div>  
		  </form>
		</div>	
		<div class = "title">
			<?php
			  if(isset($_SESSION['blad'])) {
				  echo $_SESSION['blad'];
			  }
			?>
		</div>	
	  </div>
	  <div id = "footer">
	  
      </div>	  
	

</BODY>
</HTML>  