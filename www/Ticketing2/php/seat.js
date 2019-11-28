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
}

// 0 means adult and 1 means teen
function tiket(kind,sign) {
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
}

function posting (ptime, adultPrice, teenPrice) {
  var payDiv = document.getElementById("payB");
  var cs = document.getElementsByClassName("customerSelect");
  if (cs.length == numOfTiket) {
    str = '<p>인원</p> <p>일반 : ' + adult + '명, 청소년 : ' + teen + '명</p>'+
          '<p>가격</p> <p>일반 : ' + adultPrice*adult + '원, 청소년 : ' + teenPrice*teen + '원</p>'+
          '<form class="payPost" action="pay.php" method="post">' +
    			'<input type="hidden" name="time" value= "'+ ptime +'"/>' +
    			'<input type="hidden" name="adult" value="'+ adult +'"/>' +
    			'<input type="hidden" name="teen" value="'+ teen +'"/>';
    for (var i=0; i<numOfTiket; i++) {
      str = str + '<input type="hidden" name="seats[]" value="'+ cs[i].getAttribute('id') +'"/>';
    }
    str = str + '<button type="submit">결제</button> </from>';
    payDiv.innerHTML = str;
  }
  else {
    alert ("error! Please press F5 and try it again.");
  }
}
