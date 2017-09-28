function stay(){
	var xhr = new XMLHttpRequest();
	xhr.open("GET","../private/stay.php",true);

	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200){ 
			var target = document.getElementById("table");
			target.innerHTML = xhr.responseText;
			
			//Disable the Hit and Stay buttons once the player has chosen to Stay
			document.getElementById("hit-button").disabled = true;
			document.getElementById("stay-button").disabled = true;	
		}
	}
	
	xhr.send();
}


function hit(){
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "../private/hit.php", true);
			
	xhr.onreadystatechange = function (){
		if(xhr.readyState == 4 && xhr.status == 200){
			var target = document.getElementById("table");
			target.innerHTML = xhr.responseText;

			var playerTotal = document.getElementById("playerTotal").value;
			
			//Disable the Hit and Stay buttons only if the player has BlackJack or busts
			if(playerTotal >= 21){
				document.getElementById("hit-button").disabled = true;
				document.getElementById("stay-button").disabled = true;
			}
		}
	}
	
	xhr.send();
}
