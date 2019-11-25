function home() {
    var home = document.getElementById("home");
    home.addClass('selected');

    var ticketing = document.getElementById("ticketing");
    ticketing.removeClass('selected');

    var login = document.getElementById("login");
    login.removeClass('selected');

    var join = document.getElementById("join");
    join.removeClass('selected');
}

function ticketing() {
    var home = document.getElementById("home");
    home.removeClass('selected');

    var ticketing = document.getElementById("ticketing");
    ticketing.addClass('selected');

    var login = document.getElementById("login");
    login.removeClass('selected');

    var join = document.getElementById("join");
    join.removeClass('selected');
}

function login() {
    var home = document.getElementById("home");
    home.removeClass('selected');

    var ticketing = document.getElementById("ticketing");
    ticketing.removeClass('selected');

    var login = document.getElementById("login");
    login.addClass('selected');

    var join = document.getElementById("join");
    join.removeClass('selected');
}

function join() {
    var home = document.getElementById("home");
    home.removeClass('selected');

    var ticketing = document.getElementById("ticketing");
    ticketing.removeClass('selected');

    var login = document.getElementById("login");
    login.removeClass('selected');

    var join = document.getElementById("join");
    join.addClass('selected');
}