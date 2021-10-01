let images;
let msg;

function filterPhotos(input) {
    let isTargetImage = false;
    let inputLowercased = input.toLowerCase()
    
    images.forEach(
        (img) => {
        let path = img.src.split("/")
        const name = path.pop();

        if (!name.startsWith(inputLowercased)) {
            img.style.display = "none";
        } else {
            isTargetImage = true;
            img.style.display = null;
        }
    });

    if (isTargetImage) {
        isTargetImage = false
        msg.style.visibility = 'hidden';
    } else {
        msg.style.visibility = 'visible';
    }
};

function showLarge(thumb) {
    const pic_name = thumb.src;
    const splitted = pic_name.split(".");
    document.getElementById("large_photo").src = splitted[0] + "-large." + splitted[1];
    for (element of document.getElementsByClassName("thumbnails")[0].children) {
        element.classList.remove("selected")
    }
    thumb.classList.add("selected");
}

document.addEventListener('DOMContentLoaded', () => {
    images = document.querySelectorAll("div.thumbnails > img");
    msg = document.querySelector("div.thumbnails > div");
});