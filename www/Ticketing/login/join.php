<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/fav.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../common/css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/join.css" >
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <title>회원가입 | 회원서비스</title>
</head>
<body>
    <header>
        <a href="../index.php"><img src="../img/logo.png" alt="logo"></a>
    </header>

    <nav>
        <ul>
            <li id="home"><a href="../index.php">HOME</a></li>
            <li id="movie"><a href="../movie/movie.php">영화</a></li>
            <li id="ticketing"><a href="../Ticketing/ticketing.php">예매</a></li>
            <?php
                if (isset($_SESSION['customer_id'])) {
            ?>
                    <li id="mypage"><a href="../Mypage/Mypage.php">마이페이지</a></li>
            <?php
                } else {
            ?>
                    <li id="login"><a href="../login/login.php">로그인</a></li>
            <?php
                }
            ?>
            
        </ul>
    </nav>

    <section>
      <div class="wrap">
          <h1>회원가입</h1> <hr/>
          <form action="php/join.php" method="post" id="join">
            <p>ID</p><input type="text" name="id" /><br/>
            <p>비밀번호</p><input type="password" name="ps" /><br/>
            <p>이름 (Last)</p><input type="text" name="laName" /><br/>
            <p>이름 (First)</p><input type="text" name="fiName" /><br/>
            <p id="birth">생일</p> <br/>
            <p>년</p><input type="text" name="year" /><br>
            <p>월</p><input type="text" name="mon" /><br>
            <p>일</p><input type="text" name="day" /><br>
            <p>전화번호</p><input type="text" name="hp" /><br>
            * "-"를 제외하고 작성해주세요. <br/>
            <hr id="hr"/>
            <input type="submit" value="등록" class="submit">
          </form>
      </div>
    </section>

    <footer>
        <div>
            <div id="foot_img">
                <img src="../img/logo.png" width="120px">
            </div>
            <div id="foot_p">
                <p>경기도 안산시 상록구 한양대학로 55</p>
                <p>개발자 | 정은지,김재영,박예림,이재원,윤성주 |</p>
                <p>&copy;10PLEX.All Rights Reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>
