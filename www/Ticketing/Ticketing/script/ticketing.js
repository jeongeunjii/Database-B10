function isEmpty(str){
    if(typeof str == "undefined" || str == null || str == "")
        return true;
    else
        return false ;
}

function reload(pcity,poffice,pdate,pmovie) {
  if (isEmpty(pcity)) { pcity = ""; }
  else if (String(pcity).length < 2) { pcity = "0" + pcity; }
  if (isEmpty(poffice)) { poffice = ""; }
  else {
    while (String(poffice).length < 4) {
        poffice = "0" + poffice;
    }
  }
  if (isEmpty(pdate)) { pdate = ""; }
  if (isEmpty(pmovie)) { pmovie = ""; }

  location.href="ticketing.php?city="+pcity+"&office="+poffice+"&date="+pdate+"&movie="+pmovie;
}

var today = new Date();

function editDate() {
  if (isEmpty(Dcity)) { Dcity = ""; }
  if (isEmpty(Doffice)) { Doffice = ""; }
  if (isEmpty(Ddate)) { Ddate = ""; }
  if (isEmpty(Dmovie)) { Dmovie = ""; }

  var curMonDiv = document.getElementById('currentMonth');
  var lastDate = new Date(today.getFullYear(),today.getMonth()+1,0);
  curMonDiv.innerHTML = "<p>" + (today.getMonth() + 1) + "월 </p>";
  for (i=1; i<lastDate.getDate(); i++) {
    var Dvalue = today.getFullYear() + "-" + (today.getMonth() + 1) +"-"+ i;
    if (i < today.getDate()) {
      curMonDiv.innerHTML += '<div/><p>'+i+'</p></div>';
    }
    else {
      if (Ddate != "" && Ddate == Dvalue) {
        curMonDiv.innerHTML += '<div class = "selec" onClick= "javascript:reload(\'' + Dcity +"\',\'"+ Doffice +"\',\'"+ Dvalue +"\',\'"+ Dmovie + '\');"/><p>'+i+'</p></div>';
      }
      else {
        curMonDiv.innerHTML += '<div onClick= "javascript:reload(\'' + Dcity +"\',\'"+ Doffice +"\',\'"+ Dvalue +"\',\'"+ Dmovie + '\');"/><p>'+i+'</p></div>';
      }
    }
   }
}

function next(poffice,pdate,pmovie){
  if (isEmpty(poffice) || isEmpty(pdate) || isEmpty(pmovie)) {
    alert ("선택사항을 모두 선택해주세요.");
  }
  else {
    while (String(poffice).length < 4) {
        poffice = "0" + poffice;
    }
    location.href="time.php?office="+poffice+"&date="+pdate+"&movie="+pmovie;
  }
}

window.onload = editDate;
