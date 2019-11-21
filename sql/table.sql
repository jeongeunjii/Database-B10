CREATE TABLE 메인코드
(
 메인코드 char(1) NOT NULL PRIMARY KEY,
 코드값 varchar(40) NOT NULL
);

CREATE TABLE 서브코드
(
 메인코드 char(1) NOT NULL,
 서브코드 char(1) NOT NULL,
 코드값 varchar(40) NOT NULL
);

CREATE TABLE 지역
(
지역번호 varchar(4) NOT NULL PRIMARY KEY,
지역명 varchar(30) NOT NULL
);

CREATE TABLE 지점
(
지점번호 varchar(4) NOT NULL PRIMARY KEY,
지역번호 varchar(4) NOT NULL,
지점명 varchar(30) NOT NULL,
주소 varchar(80) NOT NULL,
도로명주소 varchar(80) NOT NULL,
전화번호 varchar(13) NOT NULL
);

CREATE TABLE 상영관
(
상영관번호 varchar(1) NOT NULL PRIMARY KEY,
지점번호 varchar(4) NOT NULL,
상영관명 VARCHAR(10) NOT NULL,
상영관종류코드 CHAR(1) NOT NULL,
좌석수 integer NOT NULL
);

CREATE TABLE 좌석
(
  상영관번호 varchar(4) NOT NULL,
  좌석번호_행 char(1) NOT NULL,
  좌석번호_열 integer NOT NULL
);

CREATE TABLE 영화
(
영화번호 integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
제목 VARCHAR(20) NOT NULL,
영화등급코드 char(1) NOT NULL,
상영시간 VARCHAR(9) NOT NULL,
장르 VARCHAR(20) NOT NULL,
감독_first VARCHAR(20),
감독_family VARCHAR(20) NOT NULL
);

CREATE TABLE 영화상영정보
(
상영정보번호 integer PRIMARY KEY AUTO_INCREMENT,
지점번호 varchar(4) NOT NULL,
상영관번호 VARCHAR(10) NOT NULL,
영화번호 integer NOT NULL,
일자 date NOT NULL,
영화시작시간 varchar(10) NOT NULL,
러닝타임 varchar(8) NOT NULL,
성인단가 integer NOT NULL,
청소년단가 integer
);

CREATE TABLE 예매
(
예매번호 integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
회원아이디 varchar(20) NOT NULL,
상영정보번호 integer NOT NULL,
개수_성인 integer,
개수_청소년 integer,
결제방법 varchar(10) NOT NULL,
할인적용 varchar(10),
총가격 integer NOT NULL,
예매일자 datetime NOT NULL,
예매상태 char(1) NOT NULL
);

CREATE TABLE 품목
(
예매번호 integer NOT NULL,
좌석번호_행 char(1) NOT NULL,
좌석번호_열 integer NOT NULL,
품목취소코드 char(1) NOT NULL
);

CREATE TABLE 회원
(
아이디 VARCHAR(20) NOT NULL PRIMARY KEY,
비밀번호 VARCHAR(20) NOT NULL,
이름_성 VARCHAR(20) NOT NULL,
이름_이름 VARCHAR(20) NOT NULL,
생일 date NOT NULL,
전화번호 varchar(13) NOT NULL
);

CREATE TABLE 직원관리 
(
 지점번호 varchar(4) NOT NULL,
 사번 integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
 이름 varchar(10) NOT NULL,
 부서 varchar(15) NOT NULL,
 생년월일 date NOT NULL,
 전화번호 varchar(13) NOT NULL
);



CREATE TABLE 근태관리
(
 일자 date NOT NULL,
 사번 integer NOT NULL,
 출근 time,
 퇴근 time
);


CREATE TABLE floor업무관리
(
 사번 integer NOT NULL PRIMARY KEY,
 시설물번호 integer,
 상태 boolean
);

CREATE TABLE 기술지원
(
    사번 integer NOT NULL PRIMARY KEY,
    시설물번호 integer,
    상태 boolean
);




CREATE TABLE 물품주문
(
 지점번호 integer NOT NULL,
 물품 varchar(25) NOT NULL,
 주문량 integer NOT NULL
);


CREATE TABLE 시설물
(
 지점번호 varchar(4) NOT NULL,
 시설물번호 integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
 시설물명 varchar(20) NOT NULL
);

CREATE TABLE 시설물관리
(
 지점번호 integer NOT NULL,
 시설물번호 integer NOT NULL,
 점검시간 datetime NOT NULL,
 점검상태 varchar(15) NOT NULL
);

CREATE TABLE 청결관리
(
 지점번호 integer NOT NULL,
 시설물번호 integer NOT NULL,
 청소일시 datetime NOT NULL,
 청결상태 varchar(15) NOT NULL
);




ALTER TABLE 메인코드 CONVERT TO character SET utf8;
ALTER TABLE 서브코드 CONVERT TO character SET utf8;

ALTER TABLE 지역 CONVERT TO character SET utf8;
ALTER TABLE 지점 CONVERT TO character SET utf8;
ALTER TABLE 상영관 CONVERT TO character SET utf8;
ALTER TABLE 좌석 CONVERT TO character SET utf8;
ALTER TABLE 영화 CONVERT TO character SET utf8;
ALTER TABLE 영화상영정보 CONVERT TO character SET utf8;
ALTER TABLE 예매 CONVERT TO character SET utf8;
ALTER TABLE 품목 CONVERT TO character SET utf8;
ALTER TABLE 회원 CONVERT TO character SET utf8;

ALTER TABLE 직원관리 CONVERT TO character SET utf8;
ALTER TABLE 근태관리 CONVERT TO character SET utf8;
ALTER TABLE floor업무관리 CONVERT TO character SET utf8;
ALTER TABLE 기술지원 CONVERT TO character SET utf8;
ALTER TABLE 물품주문 CONVERT TO character SET utf8;
ALTER TABLE 시설물 CONVERT TO character SET utf8;
ALTER TABLE 시설물관리 CONVERT TO character SET utf8;
ALTER TABLE 청결관리 CONVERT TO character SET utf8;

