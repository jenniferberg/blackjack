<?php
require_once("session.php");
require_once("functions.php");

//Retrieve the deck, the player's current hand, and the dealer's current hand from the session
$deck = $_SESSION["deck"];
$playerHand = $_SESSION["playerHand"];
$dealerHand = $_SESSION["dealerHand"];

//Calculate the sums of the player's current hand and the dealer's current hand
$playerTotal = sumOfCards(0, $playerHand, "Player");
$dealerTotal = sumOfCards(0, $dealerHand, "Dealer");	

//So long as the value of the dealer's hand is 17 or less, add a new card 
//to the dealer's hand and remove it from the deck
while ($dealerTotal < 17){
		$dealerHand[] = array_shift($deck);	
		$dealerTotal = sumOfCards(0, $dealerHand, "Dealer");
	}

//Reset the session deck and dealerHand variables to the new values
$_SESSION["dealerHand"] = $dealerHand;
$_SESSION["deck"] = $deck;

?>
<!--
<div id="dealer">
<div>
	Dealer Hand:
	<ul>
		<?php
		foreach($dealerHand as $dealerCard){
			echo "<li>";
			echo $dealerCard;
			echo "</li>";
		}
		?>
	</ul>
	Dealer Total: <?php echo $dealerTotal; ?>
	<br />
</div>
<div id="player"> 
	Player Hand: 
	<ul>
		<?php
		foreach($playerHand as $playerCard){
			echo "<li>";
			echo $playerCard;
			echo "</li>";
		}
		?>
	</ul>
	Player Total: <?php echo $playerTotal; ?>
	<br />
	<br />
	<?php echo winner(); ?>
</div>
</div>

-->


<div class="banner" id="dealerBanner">
	<div class="label">Dealer Hand</div>
	<div class="score">Score: <?php echo $dealerTotal; ?></div>
</div>
<div class="cards">
	<?php 
			foreach($dealerHand as $card){
				echo "<div class=\"picture\" id=\"{$card}\"></div>";
			}
	?>
</div>

<div class="label" id="message"><?php echo winner(); ?></div>
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

