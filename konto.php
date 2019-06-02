<?php

  session_start();
  if((!isset($_SESSION['zalogowany'])))
  {
	  header('Location: index.php');
	  exit();
  }
?>

<! DOCTYPE HTML>
<HTML LANG = "pl">
<HEAD>
  <META CHARSET = "utf-8" />
  <TITLE>Moje spółki</TITLE>
  <link href="style.css" rel="stylesheet" type="text/css" />
</HEAD>

<BODY>
  <?php
    include 'navbar.php';
  ?>	
<?php

	echo "<p>Witaj ".$_SESSION['username'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
	echo $_SESSION['zloto'];
?>	
</BODY>
</HTML>  