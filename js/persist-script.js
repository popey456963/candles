var store = new Persist.Store("DataStore");

var items = ['Side Log', 'Top Log', 'No Log']
var prices = ['14.22', '12.11', '2.23']
var data = {}


function testFirstRun() {
    console.groupCollapsed("Test-Persist");
    for (i = 0; i < items.length; i++) {
        var dataValue = items[i]
        store.get(dataValue, function(ok, val) {
            if (ok) {
                console.log(dataValue + " = " + val);
                if (val == "null" || val == "NaN" || val == null || val == "Null") {
                    store.set(items[i], 0);
                    console.warn("Something went wrong with " + items[i] + ".  This could just be because this is the first time the user visited the page.")
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
                console.log(dataValue + ' = ' + val);
            data[dataValue] = val;
            totalItems = totalItems + parseInt(val);
        });
    }
    console.log("Total Items = " + totalItems);

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