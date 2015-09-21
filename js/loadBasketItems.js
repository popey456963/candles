function loadBasketItems() {

	element = document.getElementById("tableDiv");
	element.innerHTML = ""

	console.groupCollapsed("Display-Basket");

	console.log(items);

	totalPrice = 0

	tableData = "<table><thead><tr><th data-field='name'>Item Name</th><th data-field='price'>Item Price</th></tr></thead><tbody>"
	for (i = 0; i < items.length; i++) {
		console.log(items[i] + " = " + data[items[i]]);
		tableData += "<tr><td>" + items[i] + " - " + data[items[i]] + "</td><td>£" + parseFloat(Math.round(String(parseFloat(prices[i]) * parseFloat(data[items[i]])) * 100) / 100).toFixed(2) + "</td></tr>"
		totalPrice += parseFloat(prices[i]) * parseFloat(data[items[i]])
	}
	tableData += "<tr><td></td><td><b>Total: </b>£" + parseFloat(Math.round(totalPrice * 100) / 100).toFixed(2); + "</td></tr></tbody></table>"

	element.innerHTML = tableData

	console.groupEnd();
}