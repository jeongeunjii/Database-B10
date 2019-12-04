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
            p1.innerHTML = String(arg2[i][1]);
            p2.innerHTML = String(arg2[i][2]);
            p3.innerHTML = String(arg2[i][3]);
            p4.innerHTML = String(arg2[i][4]);
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