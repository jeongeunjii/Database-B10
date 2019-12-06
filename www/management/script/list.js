function addlist() {
    var add = document.getElementById("add");
    if (add.style.display == "none"){
        add.style.display = "initial";
    }else {
        add.style.display = "none";
    }

    var add = document.getElementById("edit");
    if (add.style.display != "none"){
        add.style.display = "none";
    }

    var add = document.getElementById("delete");
    if (add.style.display != "none"){
        add.style.display = "none";
    }
}

function editlist() {
    var add = document.getElementById("edit");
    if (add.style.display == "none"){
        add.style.display = "initial";
    }else {
        add.style.display = "none";
    }

    var add = document.getElementById("add");
    if (add.style.display != "none"){
        add.style.display = "none";
    }

    var add = document.getElementById("delete");
    if (add.style.display != "none"){
        add.style.display = "none";
    }
}

function deletelist() {
    var add = document.getElementById("delete");
    if (add.style.display == "none"){
        add.style.display = "initial";
    }else {
        add.style.display = "none";
    }

    var add = document.getElementById("add");
    if (add.style.display != "none"){
        add.style.display = "none";
    }

    var add = document.getElementById("edit");
    if (add.style.display != "none"){
        add.style.display = "none";
    }
}


function showinfo(arg1, arg2) {
    var info = document.getElementById("info");
    var p1 = document.getElementById("p1");
    var p2 = document.getElementById("p2");
    var p3 = document.getElementById("p3");    
    var p4 = document.getElementById("p4");


    for (var i=0; i<arg2.length; i++) {
        if (arg2[i][0] == arg1) {
            p1.innerHTML = "이름 : " + String(arg2[i][1]);
            p2.innerHTML = "출석일수 : " + String(arg2[i][2]);
            p3.innerHTML = "지각횟수 : " + String(arg2[i][3]);
            if ( String(arg2[i][4]) != "NO staff"){
                p4.innerHTML = "현재업무 : " + String(arg2[i][4]);
            } else {
                p4.innerHTML = "";
            }
            
        }
    }
    
    if (info.style.display == "none"){
        info.style.display = "initial";
    }else {
        info.style.display = "none";
    }
}



function windo() {
    var info = document.getElementById("info");
    info.style.display = "none";
}