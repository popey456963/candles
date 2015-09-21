var store = new Persist.Store("DataStore");

var items = ['Scented Candle', 'Diffuser', 'Tea-Light']
var prices = ['14.22', '12.11', '2.23']
var data = {}


function testFirstRun() {
    console.groupCollapsed("Test Run");
    for (i = 0; i < items.length; i++) {
        var dataValue = items[i]
        store.get(dataValue, function(ok, val) {
            if (ok) {
                console.log(dataValue + " = " + val);
                if (val == "null" || val == "NaN" || val == null || val == "Null" || val == "0" || val == 0) {
                    store.set(items[i], 0);
                }
            }
        });
    }
    console.groupEnd();
}

testFirstRun();


function updateValues() {
    var totalItems = 0

    console.groupCollapsed("Basket-Items");

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