function showLarge(thumb){
    console.log(thumb);
    var pic_name = thumb.src;
    console.log(pic_name);
    var splitted = pic_name.split(".");
    var large_name = splitted[0] + "-large.jpg";
    $("#large_photo").attr("src", large_name);
    $("div.thumbnails img").removeClass("selected");
    $(thumb).addClass("selected");
}
function searchEngine(){
    let text = document.querySelector("#input-form").value;
    let ph = document.querySelectorAll(".thumbnails img");
    let photos = [];
    for(let i of ph){
        let new_i = i.outerHTML;
        let splitted = new_i.split("/");
        let new_ii = splitted[1];
        let splitted_2 = new_ii.split(".");
        let new_iii = splitted_2[0];
        photos.push(new_iii);
    }
    for(let j = 0; j < photos.length; j++){
        if (photos[j].includes(text) == true){
            ph[j].className = "";
        }
        else{
            ph[j].className = "search-hide";
        }
    }
}
document.querySelector("#input-form").addEventListener('input', function(){searchEngine()});