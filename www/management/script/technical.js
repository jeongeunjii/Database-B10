function assign(arg) {
    var assign = document.getElementById("assign");
    if (assign.style.display == "none"){
        assign.style.display = "initial";
    }else {
        assign.style.display = "none";
    }

    document.getElementById("facility").value = arg;
}

function windo() {
    var assign2 = document.getElementById("assign");
    assign2.style.display = "none";
}