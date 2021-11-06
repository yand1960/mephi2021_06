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
            if (myImg.style.visibility === "hidden")
                myImg.style.visibility = "visible"

            myImg.animate([
                // keyframes
                {
                    transform: 'translateX(+100em) scale(10%) rotate(360deg)'
                },
                {
                    transform: 'translateX(0) scale(100%)'
                }
            ], {
                // timing options
                duration: 750,
                iterations: 1,
                delay: 0
            })
            // Не успел найти способ переиспользовать анимацию на keyframes из css

            const meta = document.getElementById('image_meta')
            meta.innerHTML = ''

            let nameElem = document.createElement('h3')
            nameElem.innerText = `Описание: ${name}`
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
    document.querySelector(".popup").addEventListener('click', (e) => {
        if (e.target !== e.currentTarget) return
        popUpHide()
    })
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
            myDiv.innerHTML = ''
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
            infoDiv.innerHTML = ''
            currency.forEach(item => {
                let elem = document.createElement('div')
                elem.innerText = `${item['CharCode']}: ${item['Value']}`
                infoDiv.appendChild(elem)
            })
        })
}


function popUpShow() {
    document.querySelector('.popup').style.display = null
}

function popUpHide() {
    document.querySelector('.popup').style.display = 'none'

}

let imageBlobUrl

function makePreview(e) {
    var file = e.target.files[0]
    // Load the image
    var reader = new FileReader()
    reader.onload = function (readerEvent) {
        var image = new Image()
        image.onload = function (imageEvent) {

            // Resize the image
            var canvas = document.createElement('canvas'),
                max_size = 130,
                width = image.width,
                height = image.height
            if (width > height) {
                if (width > max_size) {
                    height *= max_size / width
                    width = max_size
                }
            } else {
                if (height > max_size) {
                    width *= max_size / height
                    height = max_size
                }
            }
            canvas.width = width
            canvas.height = height
            canvas.getContext('2d').drawImage(image, 0, 0, width, height)
            imageBlobUrl = canvas.toDataURL('image/jpeg')
            document.querySelector('.preview').src = imageBlobUrl
        }
        image.src = readerEvent.target.result
    }
    reader.readAsDataURL(file)
}
