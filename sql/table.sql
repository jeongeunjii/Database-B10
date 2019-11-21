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
지점번호 varchar(4) NOT NULL,
상영관명 VARCHAR(10) NOT NULL,
상영관종류코드 CHAR(1) NOT NULL,
좌석수 integer NOT NULL,
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
상영관명 VARCHAR(10) NOT NULL,
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
 이름_성 varchar(10) NOT NULL,
 이름_이름 varchar(10) NOT NULL,
 부서 varchar(15),
 직급 varchar(15) NOT NULL,
 직무 varchar(15) NOT NULL,
 파트 char(1),
 생년월일 date NOT NULL,
 전화번호 varchar(13) NOT NULL,
 특별시_광역시_도 varchar(10) NOT NULL,
 구_군_시 varchar(10),
 시_구 varchar(10),
 읍_면 varchar(10),
 도로명 varchar(20) NOT NULL,
 건물번호 varchar(10) NOT NULL,
 상세주소 varchar(30),
 이메일 varchar(30),
 월근로시간 integer,
 연차 integer,
 비고 varchar(20)
);

CREATE TABLE 급여관리
(
 사번 integer NOT NULL,
 귀속년월 date NOT NULL,
 지급일자 date,
 기본급 integer NOT NULL,
 야간수당 integer,
 초과근무수당 integer,
 휴일근무수당 integer,
 상여금 integer,
 기타수당 integer,
 국민연금 integer,
 건강보험 integer,
 장기요양보험 integer,
 고용보험 integer,
 각종근로소득세 integer,
 주민세 integer,
 기타공제 integer,
 최종지급액 integer NOT NULL,
 비고 varchar(20)
);

CREATE TABLE 근태관리
(
 일자 date NOT NULL,
 사번 integer NOT NULL,
 근태상태코드 char(1) NOT NULL,
 출근 datetime,
 퇴근 datetime,
 비고 varchar(20)
);

CREATE TABLE floor업무관리
(
 사번 integer NOT NULL PRIMARY KEY,
 현배치장소 varchar(30),
 현업무 varchar(20),
 비고 varchar(20)
);

CREATE TABLE 인사고과관리
(
 사번 integer NOT NULL,
 평가일자 date,
 근태점수 integer,
 업무태도 integer,
 업무성취도 integer,
 업무적합성 integer,
 고객만족도 integer,
 팀워크형성 integer,
 비고 varchar(20)
);

CREATE TABLE 휴가관리 
(
 사번 integer NOT NULL,
 휴가기간_from date NOT NULL,
 휴가기간_to date NOT NULL,
 휴가종류코드 char(1) NOT NULL,
 사유 varchar(10),
 비고 varchar(20)
);

CREATE TABLE 재고관리
(
 지점번호 integer NOT NULL,
 시설물번호 integer NOT NULL,
 물품번호 integer NOT NULL,
 담당직원사번 integer,
 기존재고량 integer,
 연간수요 integer,
 일일수요 integer,
 연간재고유지비 integer,
 1회_주문비용 integer,
 주문코드 char(1) NOT NULL
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
 점검일시 datetime NOT NULL,
 담당직원사번 integer,
 점검종류코드 char(1) NOT NULL,
 점검상태코드 char(1) NOT NULL,
 정기점검기간_from datetime,
 정기점검기간_to datetime
);

CREATE TABLE 청결관리
(
 지점번호 integer NOT NULL,
 시설물번호 integer NOT NULL,
 청소일시 datetime,
 담당직원사번 integer,
 설비상태코드 char(1) NOT NULL
);

CREATE TABLE 물품
(
  물품번호 integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
  물품명 varchar(20) NOT NULL
);



ALTER TABLE 메인코드 CONVERT TO character SET utf8;
ALTER TABLE 서브코드 CONVERT TO character SET utf8;

ALTER TABLE 지역 CONVERT TO character SET utf8;
ALTER TABLE 지점 CONVERT TO character SET utf8;
ALTER TABLE 상영관 CONVERT TO character SET utf8;
ALTER TABLE 영화 CONVERT TO character SET utf8;
ALTER TABLE 영화상영정보 CONVERT TO character SET utf8;

ALTER TABLE 예매 CONVERT TO character SET utf8;
ALTER TABLE 품목 CONVERT TO character SET utf8;
ALTER TABLE 회원 CONVERT TO character SET utf8;
ALTER TABLE 직원관리 CONVERT TO character SET utf8;
ALTER TABLE 급여관리 CONVERT TO character SET utf8;
ALTER TABLE 근태관리 CONVERT TO character SET utf8;
ALTER TABLE floor업무관리 CONVERT TO character SET utf8;
ALTER TABLE 인사고과관리 CONVERT TO character SET utf8;
ALTER TABLE 휴가관리 CONVERT TO character SET utf8;
ALTER TABLE 재고관리 CONVERT TO character SET utf8;
ALTER TABLE 시설물 CONVERT TO character SET utf8;
ALTER TABLE 시설물관리 CONVERT TO character SET utf8;
ALTER TABLE 청결관리 CONVERT TO character SET utf8;
ALTER TABLE 물품 CONVERT TO character SET utf8;




