function loadBasketItems() {

    element = document.getElementById("tableDiv");
    element.innerHTML = ""

    console.groupCollapsed("Display-Basket");

    console.log(items);

    totalPrice = 0
    unboughtItems = 0

    tableData = "<table><thead><tr><th style='width:15%' data-field='itemnos'>Number of Items</th><th data-field='name'>Item Name</th><th data-field='price'>Item Price</th></tr></thead><tbody>"
    for (i = 0; i < items.length; i++) {
        console.log(items[i] + " = " + data[items[i]]);
        if (data[items[i]] != 0 || data[items[i]] != "0") {
            tableData += "<tr><td>" + data[items[i]] + "<td>" + items[i] + "</td><td>£" + parseFloat(Math.round(String(parseFloat(prices[i]) * parseFloat(data[items[i]])) * 100) / 100).toFixed(2) + "</td></tr>"
            totalPrice += parseFloat(prices[i]) * parseFloat(data[items[i]])
        } else {
            console.log("unboughtItems was called");
            unboughtItems = unboughtItems + 1;
        }
    }

    if (unboughtItems == items.length) {
        tableData += "<tr><td>No Items Were Added to Cart</td><td></td></tr>";
    }

    tableData += "<tr><td></td><td></td><td><b>Total: </b>£" + parseFloat(Math.round(totalPrice * 100) / 100).toFixed(2); + "</td></tr></tbody></table>"

    element.innerHTML = tableData

    console.groupEnd();
}