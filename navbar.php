	<div id = "main">
	  <div id = "nav">
	   <a href="wskazniki.php"><div class = "nav_opt">O wskaźnikach</div></a>
	   <a href="news.php"><div class = "nav_opt">News</div></a>
	   <a href="ranking.php"><div class = "nav_opt">Ranking</div></a>
	   <a href="spolki.php"><div class = "nav_opt">Info o spółkach</div></a>
	   <a href="konto.php"><div class = "nav_opt">Moje spółki</div></a>
	   <a href="ustawienia.php"><div class = "nav_opt">Ustawienia</div></a>
	   <?php
	     if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == TRUE))
		 {
			 echo '<a href="logout.php"><div class = "nav_opt">Wyloguj</div></a>';
		 }
	   ?>
	   <div style="clear:both;"></div>
	  </div>
	<script src="jquery-3.4.1.min.js"></script>
	<script>

	$(document).ready(function() {
	var NavY = $('#nav').offset().top;
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('#nav').addClass('sticky');
	} else {
		$('#nav').removeClass('sticky'); 
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	});
	</script>