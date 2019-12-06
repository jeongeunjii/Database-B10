function Createseatp() {
  var seatP = document.getElementById("seatP");
  var str = "좌석 : <br/>";
  for(var i=0; i <seatArr.length; i++) {
    str = str + seatArr[i] + "<br/>";
  }
  seatP.innerHTML = str;
}

function posting() {
  var disDiv = document.getElementById("seatsDiv");
  var str = '';
  for (var i=0; i<seatArr.length; i++) {
    str = str + '<input type="hidden" name="seats[]" value="'+ seatArr[i] +'"/>';
  }
  disDiv.innerHTML = str;
}

function start() {
  Createseatp();
  posting();
}

window.onload = start;
