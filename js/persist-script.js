var store = new Persist.Store("DataStore");

var items = ['Scented Candle', 'Diffuser', 'Tea-Light']
var data = {}

function updateValues() {
  var totalItems = 0

  console.group("Basket-Items");

  for (i = 0; i < items.length; i++) {
    var dataValue = items[i]
    store.get(dataValue, function(ok, val) {
      if (ok)
        console.info(dataValue + ' = ' + val);
      data[dataValue] = val;
      totalItems = totalItems + parseInt(val);
    });
  }
  console.info("Total Items = " + totalItems);

  document.getElementById("basketItems").innerHTML = totalItems;

  console.groupEnd();
}

updateValues();

function buyItem(itemName) {
  amount = parseInt(data[itemName]) + 1;
  store.set(itemName, amount);
  updateValues();
}

function sellItem(itemName) {
  amount = parseInt(data[itemName]) - 1;
  store.set(itemName, amount);
  updateValues();
}