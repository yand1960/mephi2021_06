function showLarge(thumb) {
    const pic_name = thumb.src;
    const splitted = pic_name.split(".");
    document.getElementById("large_photo").src = splitted[0] + "-large." + splitted[1];
    for (element of document.getElementsByClassName("thumbnails")[0].children) {
        element.classList.remove("selected")
    }
    thumb.classList.add("selected");
}

let images;

function Init() {
    images = document.querySelectorAll("div.thumbnails img");
    getImages()
    getCurrencyInfo()
}

function filterOnChange(filterString) {
    if (filterString === "") {
        images.forEach((child) => {
            child.style.display = null
        })
        return;
    }
    images.forEach((child) => {
        let name = child.src.split("/");
        name = name[name.length - 1];
        if (!name.startsWith(filterString)) {
            child.style.display = "none"
        } else {
            child.style.display = null
        }
    })
}

function getImages() {
    // fetch('http://127.0.0.1:80/WebApp/api/image_service.php', {method: 'GET'})
    fetch('api/image_service.php', {method: 'GET'})
        .then(response => response.json())
        .then(json => {
            const myDiv = document.querySelector('.thumbnails');
            let first = true
            json.forEach(img => {
                const image = document.createElement('img');
                if (first) {
                    image.classList.add('selected')
                    first = false
                }
                image.alt = ''
                image.dataset.capture = img.capture
                image.src = img.url
                image.onclick = () => showLarge(image)
                myDiv.appendChild(image)
            })
            const splitted = json[0].url.split('.')
            const largeSrc = splitted[0] + '-large.' + splitted[1];
            const largeDiv = document.querySelector('div.large-photo');
            const largeImage = document.createElement('img');
            largeImage.src = largeSrc;
            largeImage.id = 'large_photo'
            largeDiv.appendChild(largeImage)
        })
}
function getCurrencyInfo(){
    fetch('https://www.cbr-xml-daily.ru/daily_json.js').then(response=>response.json()).then(resJson=>{
        let {USD, EUR, GBP} = resJson["Valute"]
        let currency = [USD,EUR,GBP]
        let infoDiv = document.querySelector('.info');
        currency.forEach(item=>{
            let elem = document.createElement('div')
            elem.innerText = `${item['CharCode']}: ${item['Value']}`
            infoDiv.appendChild(elem)
        })
    })
}