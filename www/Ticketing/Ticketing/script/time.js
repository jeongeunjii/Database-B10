function next(ptime){
  if (typeof ptime == "undefined" || ptime == null || ptime == "") {
    alert ("상영정보를 선택해주세요.");
  }
  else {
    location.href="seat.php?time="+ptime;
  }
}
