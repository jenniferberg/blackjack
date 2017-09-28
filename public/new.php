<?php
require_once("../private/session.php");
require_once("../private/functions.php");

//If the player elects to start a new game or return to the main page, unset all session values
if(isset($_POST["submit"])){
	unset($_SESSION["deck"]);
	unset($_SESSION["showButton"]);
	unset($_SESSION["playerHand"]);
	unset($_SESSION["dealerHand"]);

	if($_POST["submit"] == "Rules"){
		header("Location: index.php");
		exit;
	}
}

//Array of a deck of cards
$deck = array("Spades_A", "Spades_K", "Spades_Q", "Spades_J", "Spades_10", "Spades_9", "Spades_8", "Spades_7", "Spades_6", "Spades_5", "Spades_4", "Spades_3", "Spades_2", "Hearts_A", "Hearts_K", "Hearts_Q", "Hearts_J", "Hearts_10", "Hearts_9", "Hearts_8", "Hearts_7", "Hearts_6", "Hearts_5", "Hearts_4", "Hearts_3", "Hearts_2", "Clubs_A", "Clubs_K", "Clubs_Q", "Clubs_J", "Clubs_10", "Clubs_9", "Clubs_8", "Clubs_7", "Clubs_6", "Clubs_5", "Clubs_4", "Clubs_3", "Clubs_2", "Diamonds_A", "Diamonds_K", "Diamonds_Q", "Diamonds_J", "Diamonds_10", "Diamonds_9", "Diamonds_8", "Diamonds_7", "Diamonds_6", "Diamonds_5", "Diamonds_4", "Diamonds_3", "Diamonds_2");

//Shuffle the deck
shuffle($deck);

//Set the session deck to the new shuffled deck
$_SESSION["deck"] = $deck;

//Create empty arrays of the player's hand and dealer's hand
$playerHand = array();
$dealerHand = array();

//Deal the initial hand to the player and dealer
dealInitialHand();

//Set the session player and dealer arrays to the new arrays that contain the dealt cards
$_SESSION["playerHand"] = $playerHand;
$_SESSION["dealerHand"] = $dealerHand;

//Calculate the sums of the player's hand and the dealer's hand
$playerTotal = sumOfCards(0, $playerHand, "Player");
$dealerTotal = sumOfCards(0, $dealerHand, "Dealer");


$playerCard1 = $_SESSION["playerHand"][0];
$playerCard2 = $_SESSION["playerHand"][1];
$dealerCard1 = $_SESSION["dealerHand"][0];
$dealerCard2 = $_SESSION["dealerHand"][1];

//Reset the session deck to be equal to the new deck that has removed the inital dealt cards
$_SESSION["deck"] = $deck;

//Determine the current status of the game
initialStatus();
$warning = "WARNING:  Selecting Rules will end this game. Are you sure you want to quit?";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>BLACKJACK</title>
	<script src="../private/ajax.js"></script>
	<link href="stylesheets/styles.css" rel="stylesheet" type="text/css"></link>
</head>
<body>
<div class="body">
<div class="top">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
	<div class="left">
		<input class="buttons" id="rules-button" name="submit" type="submit" value="Rules" onclick="return confirm('<?php echo $warning; ?>');"></input>
		<input class="buttons" id="new-button" name="submit" type="submit" value="New Game"></input>
	</div>
	</form>	
	<div id="title">BLACKJACK</div>
	<div class="right">
		<button class="buttons" id="hit-button" name="hit" value="Hit"<?php echo $_SESSION["showButton"]?>>Hit</button>
		<button class="buttons" id="stay-button" name="stay" value="Stay"<?php echo $_SESSION["showButton"]?>>Stay</button>
	</div>
</div>

<div class="table" id="table">
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
		<div class="picture" id="<?php echo $playerCard1; ?>"></div>
		<div class="picture" id="<?php echo $playerCard2; ?>"></div>
	</div>
	<div class="banner" id="playerBanner">
		<div class="label">Player Hand</div>
		<div class="score">Score: <?php echo $playerTotal; ?></div>
		<input type="hidden" id="playerTotal" value="<?php echo $playerTotal; ?>"></input>
	</div>
</div>
</div>
</body>
</html>
<script>
	var hitButton = document.getElementById("hit-button");
	hitButton.addEventListener("click", hit);

	var stayButton = document.getElementById("stay-button");
	stayButton.addEventListener("click", stay);	
	
</script>