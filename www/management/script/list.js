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