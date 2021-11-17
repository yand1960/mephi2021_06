$(document).ready(function(){
            $("#btn").click(function(){
                let reader = new FileReader();
                let file = $("#fileReader").get(0).files[0];
                reader.onload = function(result){
                    $("#img").attr("src", result.target.result);
                };
                reader.readAsDataURL(file);
            });

            $("#btn-cancel").click(function(){
                table = document.getElementById("out")
                table.innerHTML = "";
                index1 = document.getElementById("point1");
                index1.style.visibility = "hidden";
                index2 = document.getElementById("point2");
                index2.style.visibility = "hidden";
                prevX = null;
            });
            $("#btn-cancel-last").click(function(){
                table = document.getElementById("out")
                table.innerHTML = "";
                if (current = 1) {
                    index2 = document.getElementById("point2");
                    index2.style.visibility = "hidden";
                    current = 2;
                } else {
                    index1 = document.getElementById("point1");
                    index1.style.visibility = "hidden";
                    current = 1;
                }
                prevX = beforePrevX;
                prevY = beforePrevY;
            });
        });
