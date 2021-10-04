const images = [
    {src: "april-meyer.jpg", name: "April Meyer"}, 
    {src: "david-alexander.jpg", name: "David Alexander"}, 
    {src: "mark-hanson.jpg", name: "Mark Hanson"}, 
    {src: "melissa-kerr.jpg", name: "Melissa Kerr"}]

const onImageClick = (e) => {

    const targetElement = e.currentTarget

    Array.from(smallImages.children).forEach(
        element => {
            element == targetElement ? 
            element.children[0].classList.add("small-image-border") : 
            element.children[0].classList.remove("small-image-border")
    })
    
    const image = targetElement.children[0].getAttribute("src").split(".")

    const largeImage = image[0] + "-large." + image[1]

    imageHolder.setAttribute("src", largeImage)
}

const onInputChange = (e) => {

    const inputText = e.target.value

    const filteredImages = imageElements.filter(element => element.children[1].innerText.toLowerCase().startsWith(inputText))

    smallImages.replaceChildren(...filteredImages)
}

const setup = () => {
    return images.map(image => {
        const imageBox = document.createElement("div")
        imageBox.className = "small-image-box"
        
        const img = document.createElement("img")
        img.src = "public/images/" + image.src

        const name = document.createElement("p")
        name.innerText = image.name

        imageBox.append(img, name)

        imageBox.addEventListener('click', onImageClick, false)

        return imageBox
    })
}

const imageElements = setup()

imageElements[0].children[0].classList.add("small-image-border")

const imageHolder = document.getElementById("large-image")

const smallImages = document.getElementById("small-img-container")

smallImages.append(...imageElements)

document.getElementById("large-image").src = "public/images/" + images[0].src

document.getElementById("search").addEventListener('input', onInputChange, false)