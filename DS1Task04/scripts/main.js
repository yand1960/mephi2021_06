function showLarge(thumb) {
    console.log(thumb);
    var pic_name = thumb.src;
    console.log(pic_name);
    var splitted = pic_name.split(".");
    const pathLength = splitted.length;
    var large_name = splitted[pathLength-2] + "-large." + splitted[pathLength-1];
    console.log(large_name);
    document.getElementById("large_photo").src = large_name;
    for(element of document.getElementsByClassName("thumbnails")[0].children) {
        element.classList.remove("selected");
    }
    thumb.classList.add("selected");
    // $("#large_photo").attr("src", large_name);
    // $("div.thumbnails img").removeClass("selected");
    // $(thumb).addClass("selected");
}

function getContent() {
    var url = "api/image_service.php";
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.onload = function() {
        let result = xhr.responseText;
        let images = JSON.parse(result);
        let out = "";
        for(pict of images) {
            out += `<img src='${pict.url}' onclick='showLarge(this);' />`;
        }
        document.getElementById("thumbnails").innerHTML = out;
        const pathLength = splitted.length;
        var large_name = splitted[pathLength-2] + "-large." + splitted[pathLength-1];
        document.getElementById("large_photo").src = large_name;
        document.getElementById("large_photo").style.display = "";
    }
    xhr.send();

    var currencyUrl = "https://www.cbr-xml-daily.ru/daily_json.js";
    var currencyRequest = new XMLHttpRequest();
    currencyRequest.open("GET", currencyUrl);
    currencyRequest.onload = function() {
    
        let response = JSON.parse(currencyRequest.responseText);
        const usd = response.Valute.USD.Value;
        const eur = response.Valute.EUR.Value;
        const gbp = response.Valute.GBP.Value;
        let currencies = `<p>Курс валют: USD: ${usd}, EUR: ${eur}, GBP: ${gbp}</p>`;
        document.getElementById("CBR_values").innerHTML = currencies;
    }
    currencyRequest.send();
}