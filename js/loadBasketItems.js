function loadBasketItems() {
	element = document.getElementById("basketStuff");
	element.innerHTML = ""

	console.group("Display-Basket");

	console.log(items);

	for (i = 0; i < items.length; i++) {
		console.log(items[i] + " = " + data[items[i]]);
		line = items[i] + " = " + data[items[i]]
		sellItem = "<button onclick='sellItem(items[i])'>Sell</button>"
		linebreak = "<br /><br />"
		element.innerHTML += line + sellItem + linebreak
	}

	console.groupEnd();
}