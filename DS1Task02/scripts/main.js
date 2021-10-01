function showLarge(thumb) {
    const pic_name = thumb.src;
    const splitted = pic_name.split(".");
    document.getElementById("large_photo").src = splitted[0] + "-large." + splitted[1];
    for (element of document.getElementsByClassName("thumbnails")[0].children) {
        element.classList.remove("selected")
    }
    thumb.classList.add("selected");
}

var images;
var msg;
document.addEventListener('DOMContentLoaded', () => {
    images = document.querySelectorAll("div.thumbnails > img");
    msg    = document.querySelector("div.thumbnails > div");
});

function fiterPhotosByName(input) {
    if (input == "") {
        images.forEach((img) => {
            img.style.display = null;
        });
    }
    let imageFound = false;
    images.forEach((img) => {
        let path = img.src.split("/")
        const name = path.pop();
        if (!name.toLowerCase().startsWith(input.toLowerCase())) {
            img.style.display = "none";
        } else {
            imageFound = true;
            img.style.display = null;
        }

    });

    if (imageFound) {
        msg.style.visibility = 'hidden';
    } else {
        msg.style.visibility = 'visible';
    }
};