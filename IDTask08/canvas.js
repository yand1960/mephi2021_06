//var canvas = document.querySelector('canvas');

$(document).ready(function(){
    $("#btn2").click(function(){
        var reader = new FileReader();
        var file = $("#filePicker").get(0).files[0];
        console.log(file);
        reader.onload = function(result){
            console.log(result);
            $("#img1").attr("src", result.target.result);
        };
        reader.readAsDataURL(file);
    });
});

var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

var img2 = document.getElementById("img1");
img2.onload = drawImageActualSize;
function drawImageActualSize() {
  canvas.width = this.naturalWidth;
  canvas.height = this.naturalHeight;
  ctx.drawImage(this, 0, 0);
  ctx.drawImage(this, 0, 0, this.width, this.height);
}

var Points = [];
var lineLen = 0;
var lineSm = 0;
var Update = ()=>{
    ctx.beginPath();
    Points.forEach((point, index, arr) => {
        if((arr.length > 1)&&(index == 0)){
            ctx.moveTo(point.x, point.y);
            ctx.lineTo(arr[index + 1].x, arr[index + 1].y);

            lineLen = (Math.sqrt(Math.abs(Math.pow((arr[index + 1].x-point.x),2)+Math.pow((arr[index + 1].y-point.y),2))));
            document.getElementById("lineLen").innerHTML = lineLen.toFixed(0);
            lineSm = (lineLen / (96/2.54)).toFixed(2);
            document.getElementById("lineSm").innerHTML = lineSm;
            Points = [];          
        }  
    });

    ctx.strokeStyle = 'rgb(255, 0, 0)';
    ctx.stroke();  

}

canvas.addEventListener("click", e=> {
    Points.push({x: e.offsetX, y: e.offsetY});
    ctx.fillStyle = "green";
    Points.forEach((point, index, arr) => {
        ctx.beginPath();
        ctx.arc(point.x, point.y, 2, 0, 2 * Math.PI);
        ctx.fill();
    });
    Update(); 
})
Update();

