<?php
require_once("../private/session.php");
require_once("../private/functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>BlackJack</title>
	<script src="../private/ajax.js"></script>
	<link href="stylesheets/styles.css" rel="stylesheet" type="text/css"></link>
</head>
<body>
<div class="body">
<div class="top">
	<form method="POST" action="<?php echo htmlspecialchars("new.php") ?>">
	<div class="left">
		<button class="buttons" id="rules-button" name="submit" type="submit" value="Rules" disabled>Rules</button>
		<input class="buttons" id="new-button" name="submit" type="submit" value="New Game"></input>
	</div>		
	</form>
	<div id="title">BLACKJACK</div>
	<div class="right">
		<button class="buttons" id="hit-button" name="hit" value="Hit" disabled>Hit</button>
		<button class="buttons" id="stay-button" name="stay" value="Stay" disabled>Stay</button>
	</div>
</div>

<div class="table" id="table">
	<div class="banner">
		<div class="label">Rules</div>
	</div>
	<div id="rules">
	<div id="sectionHeader">Object/Determined Winner</div>The object of the game is to achieve Blackjack (a score of exactly 21 points), or as close to 21 points as possible without going over.
		Going over 21 points results in a Bust, which is an immediate loss.  
		If neither person scores a Blackjack or Busts, then the person with the highest number of points will win.
		In the event of a tie, the dealer wins.
		<br /><br />
	<div id="sectionHeader">Card Values</div>
	<ul>
		<li>All numbered cards are worth their numbers in points (e.g. the 4 of Hearts = 4 points).</li>
		<li>Face cards (Jack, Queen, and King) are worth 10 points each.</li>
		<li>Aces are worth either 11 points or 1 point, whichever optimizes the score or prevents a Bust.</li>
	</ul>	
	<div id="sectionHeader">Instructions</div>
	<ul>
		<li>Begin by selecting "New Game". Two cards will be dealt to the player and the dealer. One of the dealer's cards will be hidden from view.</li>
		<li>If either person is initially dealt a Blackjack, the game is over and the person with Blackjack immediately wins.</li>
		<li>If neither person has Blackjack, the player has the option to either Hit or Stay. </li>
		<li>Choosing to Hit will result in the player being dealt a new card. 
			The player can continue to Hit until her/his score is greater than or equal to 21. If the player achieves a Blackjack, s/he automatically wins. 
			If the player Busts, the dealer wins.</li>
		<li>If the player has a score less than 21 but does not want another card, the player must choose to Stay.</li>
		<li>Once the player has chosen to Stay, the dealer will reveal its cards.  If the dealer has a score of 17 or more, it will automatically Stay. Otherwise, it will hit
			until its score is greater than or equal to 17.</li>
	</ul>
	</div>
</div>
</div>
</body>
</html>