function menu() {
    var menu = document.getElementsByClassName("menu");
    for( var i = 0; i < menu.length; i++ ){ 
        var temp = menu.item(i);
        temp.style.backgroundColor = "rgb(94,94,94)"; 
    }
}