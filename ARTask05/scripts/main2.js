function showLarge(thumb) {
    const picId = thumb.id
    let url, date, name
    fetch(`api/image_info_service_db.php?id=${picId}`, {method: 'GET'})
        .then(response => response.json())
        .then(json => {
            url = json.url
            name = json.name
            date = json.date
            const myImg = document.getElementById('large_photo')
            myImg.src = url

            const meta = document.getElementById('image_meta')
            meta.innerHTML = ''

            let nameElem = document.createElement('h3')
            nameElem.innerText = `Человек на фото: ${name}`
            meta.appendChild(nameElem)
            let dateElem = document.createElement('div')
            dateElem.innerText = `Дата создания: ${date}`
            meta.appendChild(dateElem)
        })

    for (element of document.getElementsByClassName("thumbnails")[0].children) {
        element.classList.remove("selected")
    }
    thumb.classList.add("selected")


}

let images

function Init() {
    images = document.querySelectorAll("div.thumbnails img")
    getImages()
    getCurrencyInfo()
}

function filterOnChange(filterString) {
    if (filterString === "") {
        images.forEach((child) => {
            child.style.display = null
        })
        return
    }
    images.forEach((child) => {
        let name = child.src.split("/")
        name = name[name.length - 1]
        if (!name.startsWith(filterString)) {
            child.style.display = "none"
        } else {
            child.style.display = null
        }
    })
}

function getImages() {
    // fetch('http://127.0.0.1:80/WebApp/api/image_service.php', {method: 'GET'})
    fetch('api/image_service_db.php', {method: 'GET'})
        .then(response => response.json())
        .then(json => {
            const myDiv = document.querySelector('.thumbnails')
            let first = true
            json.forEach(img => {
                const image = document.createElement('img')
                if (first) {
                    image.classList.add('selected')
                    first = false
                }
                image.alt = ''
                // image.dataset.capture = img.capture
                image.src = img[1]
                image.id = img[0]
                image.onclick = () => showLarge(image)
                myDiv.appendChild(image)
            })


            const firstImg = document.querySelector('.thumbnails img')
            showLarge(firstImg)
        })
}

function getCurrencyInfo() {
    fetch('https://www.cbr-xml-daily.ru/daily_json.js')
        .then(response => response.json())
        .then(resJson => {
            let {USD, EUR, GBP} = resJson["Valute"]
            let currency = [USD, EUR, GBP]
            let infoDiv = document.querySelector('.info')
            currency.forEach(item => {
                let elem = document.createElement('div')
                elem.innerText = `${item['CharCode']}: ${item['Value']}`
                infoDiv.appendChild(elem)
            })
        })
}