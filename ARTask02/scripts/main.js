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
document.addEventListener('DOMContentLoaded', function() {
    images = document.querySelectorAll("div.thumbnails img");
}, false);

function filterOnChange(filterString) {
    if (filterString === "") {
        images.forEach((child) => {
            child.style.display = null
        })
        return;
    }
    images.forEach((child) => {
        let splitted = child.src.split("/");
        let name = splitted[splitted.length - 1];
        if (!name.startsWith(filterString)) {
            child.style.display = "none"
        } else {
            child.style.display = null
        }
    })
}