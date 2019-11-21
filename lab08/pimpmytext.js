function ex3(){
    alert("Hello, world!");
}

function ex4(){
    var txt = document.getElementById("txt");
    txt.style.fontSize = "24pt";
}

function ex5(){
    var txt = document.getElementById("txt");
    var bling = document.getElementById("bling");

    if(bling.checked === true){
        txt.style.fontWeight = "bold";
        txt.style.color = "green";
        txt.style.textDecoration = "underline";
        document.body.style.background = "url(https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg)";
    }
    else{
        txt.style.fontWeight = "normal";
        txt.style.color = "black";
        txt.style.textDecoration = "none";
        document.body.style.backgroundImage = "none";
    }
}

function ex6(){
    var txt = document.getElementById("txt");
    var snoopify = document.getElementById("snoopify");

    txt.value = txt.value.toUpperCase();
    txt.value = txt.value.split(".").join("-izzle.");
}

function ex7(){
    var txt = document.getElementById("txt");
    if(!txt.style.fontSize){
        txt.style.fontSize = "12pt";
    }
    else{
        txt.style.fontSize = parseInt(txt.style.fontSize) + 2 + "pt";
    }
}

function timer(){
    setInterval(ex7,500);
}

function ex9_1(){
    var tval = document.getElementById("txt").value;
    for(var i = 0 ; i < tval.length ; i++){
        if("aeiouAEIOU".includes(tval[i])){           
            tval = tval.substring(i,tval.length) + tval.substring(0,i);             
            break;
        }
    }
    document.getElementById("txt").value = tval + "ay";
}

function ex9_2(){
    var txt = document.getElementById("txt");
    var tmp = txt.value.split(" ");
    for(var i=0;i<tmp.length;i++){
        if(tmp[i].length >= 5){
            tmp[i] = "Malkovich"
        }
    }
    txt.value = tmp.join(" ");
}

function pageLoad(){
    document.getElementById("bigger").onclick = timer;
    document.getElementById("bling").onchange = ex5;
    document.getElementById("snoopify").onclick = ex6;
    document.getElementById("igpay").onclick = ex9_1;
    document.getElementById("malko").onclick = ex9_2;
}

window.onload = pageLoad;