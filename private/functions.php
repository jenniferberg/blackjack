<?php
//Function to deal the initial hand:
	//Select the top 4 cards from the deck and remove them from the array.
	//Deal the cards to the player and dealer hands (adding to the respective arrays) 
	//in alternating order (1st and 3rd cards go to the player, 2nd and 4th cards go to the dealer).
function dealInitialHand(){
	global $deck;
	global $playerHand;
	global $dealerHand;
	
	for($i = 1; $i < 5; $i++){
		$card = "card{$i}";
		$$card = array_shift($deck);
		($i % 2 == 1) ? $playerHand[] = $$card : $dealerHand[] = $$card;
		
		//once hand is dealt, remove suit name and underscore from the card name, in order to retrieve the card value
		$$card = str_replace("_", "", strchr($$card, "_"));
		}
}

//Function to count the number of aces in a person's hand.
	//This will be used later in the sumOfCards funtion to determine if the person's 
	//hand total should value Aces at 1 or 11 points
function checkAces($array){
	$count = 0;
	foreach ($array as $card){
		$card = str_replace("_", "", strchr($card, "_"));
		($card == "A") ? $count += 1 : $count;
	}
	return $count;
}

//Function to find the values of the cards and total value of the person's (player or dealer) hand
function sumOfCards($currentTotal, $array, $person){
	//Set initial values for cards
	foreach ($array as $card){
		//Remove the card's suit to retrieve its value
		$card = str_replace("_", "", strchr($card, "_"));

		switch($card){
		case "K":
		case "Q":
		case "J":
			$card = 10;
			break;
		case "A":
			$card = 1; 
			//Set initial Ace value to 1. The value will be increased by 10 later if it produces an optimal score
			break;
		default:
			$card = (int)$card;
		}			
		$currentTotal += $card;
	}
	
	//If the person has aces and current total points is <= 11, add 10 points to make the value
		//of one Ace = 11, instead of 1, to optimize the total points
	if(checkAces($array) > 0){
		while ($currentTotal <= 11){
			$currentTotal = $currentTotal + 10;
		}
	}

	return $currentTotal;
}
	

//Function to determine the initial and mid-game status of the game.
	//If either player has BlackJack or busts, the game is over.
	//Otherwise, allow the player to Hit or Stay.
	//Create a variable showButton to determine if the Hit and Stay buttons should be visible
function initialStatus(){
	global $playerTotal;
	global $dealerTotal;
	
	$status = "";
	if ($playerTotal == 21){
		$status = "Blackjack! You win!";
		$showButton = " disabled";
	}elseif ($dealerTotal == 21){
		$status = "Dealer has Blackjack! You lose!";
		$showButton = " disabled";
	}elseif ($playerTotal >= 22){
		$status = "Bust! You lose!";
		$showButton = " disabled";
	}else {
		$status = "Hit or Stay?";
		$showButton = "";
	}
	$_SESSION["showButton"] = $showButton;
	return $status;
}
	
//Function to determine the winner of the game
function winner(){
	global $playerTotal;
	global $dealerTotal;
	
	$status = "";
	if ($dealerTotal >= 22){
		$status = "Dealer Busts! You win!";
		$showButton = " disabled";
	}elseif ($playerTotal == $dealerTotal){
		$status = "Tie goes to the dealer. You lose!";
	}elseif ($playerTotal > $dealerTotal){
		$status = "You win!";
	}else {
		$status = "You lose!";
	}
	return $status;
}


