-- 지점 주소 넣어주세요 INSERT INTO 지점 VALUES(2,'안산', '경기도', '안산시', '단원구',NULL, '광덕대로', 194, '고잔동, NC백화점 A관 6층', 15441122);

-- 지점 주소 넣어주세요 INSERT INTO 지점 VALUES(3,'시흥', '경기도', '시흥시', NULL ,NULL, '복지로', 90, '대야동', 15441122);

-- 지점 주소 넣어주세요 INSERT INTO 지점 VALUES(4,'배곧', '경기도', '시흥시', NULL ,NULL, '서울대학로 278번길', 61, '베니스스퀘어 7층', 15441122);

INSERT INTO 메인코드 VALUES('A', '상영관종류코드');
INSERT INTO 메인코드 VALUES('B', '예매상태코드');
INSERT INTO 메인코드 VALUES('C', '영화등급코드');
INSERT INTO 메인코드 VALUES('D', '품목취소코드');
INSERT INTO 메인코드 VALUES('E', '근태상태코드');
INSERT INTO 메인코드 VALUES('F', '휴가종류코드');
INSERT INTO 메인코드 VALUES('G', '점검종류코드');
INSERT INTO 메인코드 VALUES('H', '점검상태코드');
INSERT INTO 메인코드 VALUES('I', '설비상태코드');
INSERT INTO 메인코드 VALUES('J', '주문코드');

INSERT INTO 서브코드 VALUES('A', 'A', '4D');
INSERT INTO 서브코드 VALUES('A', 'B', '3D');
INSERT INTO 서브코드 VALUES('A', 'C', '2D');
INSERT INTO 서브코드 VALUES('A', 'D', 'IMAX');
INSERT INTO 서브코드 VALUES('B', 'A', '정상');
INSERT INTO 서브코드 VALUES('B', 'B', '일부취소');
INSERT INTO 서브코드 VALUES('B', 'C', '전체취소');

INSERT INTO 서브코드 VALUES('D', 'A', 'Y');
INSERT INTO 서브코드 VALUES('D', 'B', 'N');
INSERT INTO 서브코드 VALUES('E', 'A', '정상');
INSERT INTO 서브코드 VALUES('E', 'B', '결근');
INSERT INTO 서브코드 VALUES('E', 'C', '휴가');
INSERT INTO 서브코드 VALUES('E', 'D', '조퇴');
INSERT INTO 서브코드 VALUES('E', 'E', '출장');
INSERT INTO 서브코드 VALUES('E', 'F', '지각');
INSERT INTO 서브코드 VALUES('F', 'A', '유급');
INSERT INTO 서브코드 VALUES('F', 'B', '무급');
INSERT INTO 서브코드 VALUES('G', 'A', '진행중');
INSERT INTO 서브코드 VALUES('G', 'B', '종료');
INSERT INTO 서브코드 VALUES('G', 'C', '점검전');
INSERT INTO 서브코드 VALUES('H', 'A', '정상');
INSERT INTO 서브코드 VALUES('H', 'B', '오작동');
INSERT INTO 서브코드 VALUES('H', 'C', '파손');
INSERT INTO 서브코드 VALUES('I', 'A', '양호');
INSERT INTO 서브코드 VALUES('I', 'B', '청소필요');
INSERT INTO 서브코드 VALUES('J', 'A', '주문완료');
INSERT INTO 서브코드 VALUES('J', 'B', '미주문');

INSERT INTO 회원 VALUES('ID1', 'password1', '홍', '길동', '1995-01-06', 01022591271);
INSERT INTO 회원 VALUES('ID2', 'password2', '김', '재영', '1996-02-07', 01056562238);
INSERT INTO 회원 VALUES('ID3', 'password3', '이', '동건', '1997-03-08', 01044783249);

-- 예매에서 상영정보번호가 1이므로 구현하신 번호로 수정바랍니다

INSERT INTO 예매 VALUES(1234,'ID2', 1, 2, 2, 'card', NULL, 10000*2+8000*2, '2019-11-20 12:33:50', 'C');
INSERT INTO 품목 VALUES(1234, 'A',1,'A'); 
INSERT INTO 품목 VALUES(1234, 'A',2,'A');
INSERT INTO 품목 VALUES(1234, 'A',3,'A');
INSERT INTO 품목 VALUES(1234, 'A',4,'A');

INSERT INTO 예매 VALUES(123,'ID1', 1, 2, 3, 'card', '통신사', (10000*2+8000*3)*0.8, '2019-11-20 19:30:59', 'A');
INSERT INTO 품목 VALUES(123, 'A',1,'B'); 
INSERT INTO 품목 VALUES(123, 'A',2,'B');
INSERT INTO 품목 VALUES(123, 'A',3,'B');
INSERT INTO 품목 VALUES(123, 'A',4,'B');
INSERT INTO 품목 VALUES(123, 'A',5,'B');

INSERT INTO 예매 VALUES(12345, 'ID3', 1, 2, 3, 'point', '쿠폰', (10000*2+8000*3)*0.5, '2019-11-20 15:30:59', 'B');
INSERT INTO 품목 VALUES(12345, 'B',3,'A'); 
INSERT INTO 품목 VALUES(12345, 'B',4,'A');
INSERT INTO 품목 VALUES(12345, 'B',5,'A');
INSERT INTO 품목 VALUES(12345, 'A',6,'B');
INSERT INTO 품목 VALUES(12345, 'A',7,'B');

INSERT INTO 직원관리 VALUES(19010, '김', '미소', '운영지원팀', '알바생', '고객응대','A', '1999-01-05', 01045229342, '경기도', '안산시', '상록구', '사2동', '감골로', 35, '203동 402호', 'arbeit@naver.com',160,0,'비정규직'); 
INSERT INTO 직원관리 VALUES(19011, '박', '정리', '운영지원팀', '알바생', '청소', 'A', '2000-04-01', 01065332972,'경기도','안산시','단원구','가나동', '동산로', 123, '303동 604호', 'clean1@naver.com', 120,0, '비정규직');
INSERT INTO 직원관리 VALUES(19001, '김', '재영', '인사팀', '사원', '인사관리', 'A', '1995-01-02', 01023229812, '경기도', '안산시', '상록구','사2동', '감골로', 83, '101동 101호', 'kjyl95718@naver.com', 220, 11, NULL);
INSERT INTO 직원관리 VALUES(19002, '이', '준수', '재무팀', '사원', '재무회계', 'B', '1996-02-05', 01032531123,'경기도','안산시','단원구','나다동','광덕대로', 192,'201동 204호', 'wodud95718@naver.com', 230, 11, NULL);
INSERT INTO 직원관리 VALUES(18002, '홍', '길동', '마케팅', '대리', '성과관리','A', '1992-07-12', 01099423921,'경기도','안산시','상록구','본오동','샘골로7길', 12, '402동502호', 'asdfzxcv1@naver.com',220,12,NULL);
INSERT INTO 직원관리 VALUES(16013, '박', '준영', '마케팅', '부장', '전략수립', 'C', '1989-05-22', 01054201823,'경기도','안산시','단원구','광덕동','동산로',268,'101동 203호', 'confuseTT@daum.net',210,16,'19년말 퇴사예정');
INSERT INTO 직원관리 VALUES(17022, '신', '사장', NULL,'영업원','카페사장',NULL,'1991-06-12', 01023963293, '경기도','안산시','상록구','사2동','감골로',43,'503동 203호', 'cafe24@naver.com',0,0,NULL);
INSERT INTO 직원관리 VALUES(18006, '최', '설비', '기술지원팀','사원','기기점검','A','1989-09-11', 01064268743, '경기도','안산시','상록구','건동','건건8길',10,'709동 305호', 'fix24@gmail.com',200,11,NULL);

INSERT INTO 급여관리 VALUES(19010,'2019-09-05', '2019-09-05', 1450000, 60000, 70000, 70000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1650000, NULL);
INSERT INTO 급여관리 VALUES(19011,'2019-09-05', '2019-09-05', 1150000, 40000, 50000, 50000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1290000, NULL);
INSERT INTO 급여관리 VALUES(19001,'2019-09-05', '2019-09-05', 2500000, 300000, 100000, 80000, 200000, 50000, 100000, 200000, 50000, 50000, 50000, 30000, 5000, 2745000, NULL);
INSERT INTO 급여관리 VALUES(19002,'2019-09-05', '2019-09-05', 2500000, 600000, 300000, 100000, 150000, 100000, 110000, 220000, 60000, 60000, 60000, 40000, 10000, 3190000, NULL);
INSERT INTO 급여관리 VALUES(18002,'2019-09-05', '2019-09-05', 3000000, 500000, 400000, 150000, 200000, 0, 120000, 230000, 60000, 80000, 80000, 50000, 60000, 3570000, NULL);
INSERT INTO 급여관리 VALUES(16013,'2019-09-05', '2019-09-05', 4500000, 200000, 200000, 50000, 300000, 0, 130000, 240000, 70000, 90000, 80000, 50000, 70000, 4520000, NULL);
INSERT INTO 급여관리 VALUES(18006,'2019-09-05', '2019-09-05', 2200000, 100000, 100000, 50000, 150000, 0, 70000, 80000, 60000, 80000, 70000, 40000, 50000, 2150000, NULL);

INSERT INTO 근태관리 VALUES('2019-11-10', 19001, 'A', '2019-11-10 08:55:59', '2019-11-10 18:10:15', NULL);
INSERT INTO 근태관리 VALUES('2019-11-10', 19002, 'B', NULL, NULL , '결근');
INSERT INTO 근태관리 VALUES('2019-11-07', 16013, 'F', '2019-11-07 11:10:20', '2019-11-07 18:00:30', '교통체증_지각');
INSERT INTO 근태관리 VALUES('2019-11-08', 18002, 'E', '2019-11-08 10:30:56', '2019-11-08 13:05:32' , '안산출장_오후');

INSERT INTO floor업무관리 VALUES(19010, '안산_상영관입구', '고객응대', NULL);
INSERT INTO floor업무관리 VALUES(19011, '안산_스태프실', '청소', NULL);
INSERT INTO floor업무관리 VALUES(19001, '서울_경영지원실', '안산_관리파견', NULL);
INSERT INTO floor업무관리 VALUES(19002, '서울_경영지원실', '회계장부검토', NULL);
INSERT INTO floor업무관리 VALUES(18002, '서울_경영지원본부', '우수사원검토', NULL);
INSERT INTO floor업무관리 VALUES(16013, '서울_경영지원본부', '혁신기획', NULL);
INSERT INTO floor업무관리 VALUES(18006, '서울_경영지원본부', '안산_관리파견', NULL);

INSERT INTO 인사고과관리 VALUES(19001,'2019-11-01', 100, 85, 90, 80, 100, 90, '우수사원');
INSERT INTO 인사고과관리 VALUES(19002,'2019-11-01', 80, 85, 85, 90, 75, 85, NULL);
INSERT INTO 인사고과관리 VALUES(18002,'2019-11-01', 80, 75, 90, 95, 80, 85, NULL);
INSERT INTO 인사고과관리 VALUES(16013,'2019-11-01', 95, 90, 100, 85, 95, 90, '우수사원');


INSERT INTO 휴가관리 VALUES(19001, '2019-07-13', '2019-07-18', 'A', '유급_연가', NULL);
INSERT INTO 휴가관리 VALUES(19002, '2019-10-11', '2019-10-18', 'B', '무급_병가', NULL );
INSERT INTO 휴가관리 VALUES(18002, '2019-11-01', '2019-11-03', 'B', '무급_무단', NULL);
INSERT INTO 휴가관리 VALUES(16013, '2019-09-13', '2019-09-16', 'A', '유급_경조', NULL);

INSERT INTO 물품 VALUES('커피');
INSERT INTO 물품 VALUES('팝콘옥수수');
INSERT INTO 물품 VALUES('콜라');
INSERT INTO 물품 VALUES('오징어');
INSERT INTO 시설물 VALUES('카페');
INSERT INTO 시설물 VALUES('매표소');
INSERT INTO 시설물 VALUES('매점');
INSERT INTO 시설물 VALUES('스태프실');

INSERT INTO 재고관리 VALUES(2,1,1,17022,43,365,1,1,1200,600,'A');
INSERT INTO 재고관리 VALUES(2,1,1,17022,43,365,1,2,1200,600,'B');

INSERT INTO 시설물관리 VALUES(2,3,18006,'C','2019-09-01 11:30:00','A', '2019-10-01 11:30:00', '2019-10-03 11:30:00');
INSERT INTO 시설물관리 VALUES(2,3,18006,'A','2019-10-01 11:50:00','B', '2019-10-01 11:30:00', '2019-10-03 11:30:00');
INSERT INTO 시설물관리 VALUES(2,3,18006,'B','2019-10-03 09:30:00','A', '2019-11-03 09:30:00', '2019-11-05 09:30:00');
INSERT INTO 시설물관리 VALUES(2,3,18006,'C','2019-10-03 09:30:00','A', '2019-11-03 09:30:00', '2019-11-05 09:30:00');
INSERT INTO 시설물관리 VALUES(2,3,18006,'B','2019-11-03 09:35:38','A', '2019-12-03 09:35:38', '2019-12-05 09:35:38');

INSERT INTO 청결관리 VALUES(2,4,19011,'2019-11-10 09:30:00','B');
INSERT INTO 청결관리 VALUES(2,4,19011,'2019-11-10 13:30:00','A');
INSERT INTO 청결관리 VALUES(2,4,19011,'2019-11-10 17:30:00','B');
INSERT INTO 청결관리 VALUES(2,4,19011,'2019-11-10 21:30:00','A');