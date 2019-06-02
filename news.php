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
  <TITLE>News</TITLE>
  <link href="style.css" rel="stylesheet" type="text/css" />
</HEAD>

<BODY>
  <?php
    include 'navbar.php';
  ?>	
<p>news</p>	
</BODY>
</HTML>  