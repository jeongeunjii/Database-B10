var adult = 0;
var teen = 0;
var numOfTiket = adult + teen;

function selec(id) {
  var cs = document.getElementsByClassName("customerSelect")
  var seat = document.getElementById(id);
  if (seat.className == "seat") {
    if (cs.length < numOfTiket) {
      seat.className = "customerSelect";
    }
  }
  else {
    seat.className = "seat";
  }
  posting();
}
// 0 means adult and 1 means teen
function tiket(kind, sign) {
  if ((adult+teen)>=5 && sign>0) {
    return ;
  }
  if ((adult == 0 && kind == 0 && sign<0) || (teen == 0 && kind == 1 && sign<0)) {
    return ;
  }
  if (kind == 0) {
    adult = adult + sign;
    numOfTiket = adult + teen;
    document.getElementById("numOfAdult").innerHTML = adult;
  }
  else {
    teen = teen + sign;
    numOfTiket = adult + teen;
    document.getElementById("numOfTeen").innerHTML = teen;
  }
  posting();
}


function posting() {
  var payDiv = document.getElementById("payB");
  var cs = document.getElementsByClassName("customerSelect");
  str = '<div><form class="payPost" action="pay.php" method="get">' +
  '<input type="hidden" name="time" value= "'+ ptime +'"/>' +
  '<input type="hidden" name="adult" value="'+ adult +'"/>' +
  '<input type="hidden" name="teen" value="'+ teen +'"/>';

  if (cs.length == numOfTiket && !(adult==0 && teen ==0)) {
    str = str + '<button type="submit">결제</button>';
    for (var i=0; i<numOfTiket; i++) {
      str = str + '<input type="hidden" name="seats[]" value="'+ cs[i].getAttribute('id') +'"/>';
    }
  }
  else {
    str = str + '<button type="button">결제</button>';
  }

  str = str +'</form></div><p>일반 : ' + adult + '명, 청소년 : ' + teen + '명</p>'+
            '<p>가격 : ' + (adultPrice*adult + teenPrice*teen) + '원</p>';
  payDiv.innerHTML = str;
}
