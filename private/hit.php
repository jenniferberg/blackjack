<?php
require_once("session.php");
require_once("functions.php");

//Retrieve the deck, the player's current hand, and the dealer's current hand from the session
$deck = $_SESSION["deck"];
$playerHand = $_SESSION["playerHand"];
$dealerHand = $_SESSION["dealerHand"];
$dealerCard1 = $_SESSION["dealerHand"][0];
$dealerCard2 = $_SESSION["dealerHand"][1];

//Calculate the sums of the player's current hand and the dealer's current hand
$playerTotal = sumOfCards(0, $playerHand, "Player");	
$dealerTotal = sumOfCards(0, $dealerHand, "Dealer");	

//Add a new card to the player's hand and remove it from the deck
$playerHand[] = array_shift($deck);

//Calculate the new sum of the player's hand
$playerTotal = sumOfCards(0, $playerHand, "Player");
	

//Reset the session deck and playerHand variables to the new values
$_SESSION["playerHand"] = $playerHand;
$_SESSION["deck"] = $deck;

//Determine the current status of the game
initialStatus();
?>
<div class="banner" id="dealerBanner">
	<div class="label">Dealer Hand</div>
	<div class="score"></div>
</div>
<div class="cards">
	<?php if($dealerTotal == 21){
			echo "<div class=\"picture\" id=\"{$dealerCard1}\"></div>";
		}else {
			echo "<div class=\"backOfCard\"></div>";
		}
	?>
	<div class="picture" id="<?php echo $dealerCard2; ?>"></div>
</div>
<div class="label" id="message"><?php echo initialStatus(); ?></div>
<div class="cards" id="playerCards">
	<?php
		foreach($playerHand as $card){
			echo "<div class=\"picture\" id=\"{$card}\"></div>";
		}
	?>
</div>
<div class="banner" id="playerBanner">
	<div class="label">Player Hand</div>
	<div class="score">Score: <?php echo $playerTotal; ?></div>
	<input type="hidden" id="playerTotal" value="<?php echo $playerTotal; ?>"></input>
</div>

