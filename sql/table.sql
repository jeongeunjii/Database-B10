CREATE TABLE ����
(
���Ź�ȣ integer NOT NULL PRIMARY KEY,
ȸ�����̵� varchar(20) NOT NULL,
��������ȣ integer NOT NULL,
����_���� integer,
����_û�ҳ� integer,
������� varchar(10) NOT NULL,
�������� varchar(10),
�Ѱ��� integer NOT NULL,
�������� datetime NOT NULL,
���Ż��� char(1) NOT NULL
);

CREATE TABLE ����
(
������ȣ integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
������ varchar(30) NOT NULL,
Ư����_������_�� varchar(15) NOT NULL,
��_��_�� varchar(10),
��_�� varchar(10),
��_��_�� varchar(10),
���θ� varchar(30) NOT NULL,
�ǹ���ȣ varchar(10) NOT NULL,
���ּ� varchar(40),
��ȭ��ȣ varchar(13) NOT NULL
);

CREATE TABLE �󿵰�
(
�󿵰���ȣ integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
������ȣ integer NOT NULL,
�󿵰��� VARCHAR(10) NOT NULL,
�󿵰������ڵ� CHAR(1) NOT NULL,
�¼��� integer NOT NULL,
�¼���ȣ_�� char(1) NOT NULL,
�¼���ȣ_�� integer NOT NULL
);

CREATE TABLE ��ȭ
(
��ȭ��ȣ integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
���� VARCHAR(20) NOT NULL,
��ȭ����ڵ� char(1) NOT NULL,
�帣 VARCHAR(20) NOT NULL,
����_first VARCHAR(20),
����_family VARCHAR(20) NOT NULL
);

CREATE TABLE ��ȭ������
(
��������ȣ integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
������ȣ integer NOT NULL,
�󿵰���ȣ integer NOT NULL,
��ȭ��ȣ integer NOT NULL,
���� date NOT NULL,
��ȭ���۽ð� time NOT NULL,
��ȭ����ð� time NOT NULL,
���δܰ� integer NOT NULL,
û�ҳ�ܰ� integer
);

CREATE TABLE ǰ��
(
���Ź�ȣ integer NOT NULL,
�¼���ȣ_�� char(1) NOT NULL,
�¼���ȣ_�� integer NOT NULL,
ǰ������ڵ� char(1) NOT NULL
);

CREATE TABLE ȸ��
(
���̵� VARCHAR(20) NOT NULL PRIMARY KEY,
��й�ȣ VARCHAR(20) NOT NULL,
�̸�_�� VARCHAR(20) NOT NULL,
�̸�_�̸� VARCHAR(20) NOT NULL,
���� date NOT NULL,
��ȭ��ȣ varchar(13) NOT NULL
);

CREATE TABLE ��������
(
 ��� integer NOT NULL PRIMARY KEY,
 �̸�_�� varchar(10) NOT NULL,
 �̸�_�̸� varchar(10) NOT NULL,
 �μ� varchar(15) NOT NULL,
 ���� varchar(15) NOT NULL,
 ���� varchar(15) NOT NULL,
 ��Ʈ char(1),
 ������� date NOT NULL,
 ��ȭ��ȣ varchar(13) NOT NULL,
 Ư����_������_�� varchar(10) NOT NULL,
 ��_��_�� varchar(10),
 ��_�� varchar(10),
 ��_��_�� varchar(10),
 ���θ� varchar(20) NOT NULL,
 �ǹ���ȣ varchar(10) NOT NULL,
 ���ּ� varchar(30),
 �̸��� varchar(30),
 ���ٷνð� integer,
 ���� integer,
 ��� varchar(30)
);

CREATE TABLE �޿�����
(
 ��� integer NOT NULL,
 �ͼӳ�� date NOT NULL,
 �������� date,
 �⺻�� integer NOT NULL,
 �߰����� integer,
 �ʰ��ٹ����� integer,
 ���ϱٹ����� integer,
 �󿩱� integer,
 ��Ÿ���� integer,
 ���ο��� integer,
 �ǰ����� integer,
 ����纸�� integer,
 ��뺸�� integer,
 �����ٷμҵ漼 integer,
 �ֹμ� integer,
 ��Ÿ���� integer,
 �������޾� integer NOT NULL,
 ��� varchar(20)
);

CREATE TABLE ���°���
(
 ���� date NOT NULL,
 ��� integer NOT NULL,
 ���»����ڵ� char(1) NOT NULL,
 ��� datetime,
 ��� datetime,
 ��� varchar(20)
);

CREATE TABLE floor��������
(
 ��� integer NOT NULL PRIMARY KEY,
 ����ġ��� varchar(30),
 ������ varchar(20),
 ��� varchar(20)
);

CREATE TABLE �λ�������
(
 ��� integer NOT NULL,
 ������ date,
 �������� integer,
 �����µ� integer,
 �������뵵 integer,
 �������ռ� integer,
 �������� integer,
 ����ũ���� integer,
 ��� varchar(20)
);

CREATE TABLE �ް�����
(
 ��� integer NOT NULL,
 �ް��Ⱓ_from date NOT NULL,
 �ް��Ⱓ_to date NOT NULL,
 �ް������ڵ� char(1) NOT NULL,
 ���� varchar(10),
 ��� varchar(20)
);

CREATE TABLE ������
(
 ������ȣ integer NOT NULL,
 �ü�����ȣ integer NOT NULL,
 ��ǰ��ȣ integer NOT NULL,
 ���������� integer,
 ������� integer,
 �������� integer,
 ���ϼ��� integer,
 ������� integer,
 ������������� integer,
 �ֹ���� integer,
 �ֹ��ڵ� char(1) NOT NULL
);

CREATE TABLE ��ǰ
(
  ��ǰ��ȣ integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
  ��ǰ�� varchar(20) NOT NULL
);

CREATE TABLE �ü���
(
 �ü�����ȣ integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
 �ü����� varchar(20) NOT NULL
);

CREATE TABLE �ü�������
(
 ������ȣ integer NOT NULL,
 �ü�����ȣ integer NOT NULL,
 ���������� integer,
 ���������ڵ� char(1) NOT NULL,
 �����Ͻ� datetime NOT NULL,
 ���˻����ڵ� char(1) NOT NULL,
 �������˱Ⱓ_from datetime,
 �������˱Ⱓ_to datetime
);

CREATE TABLE û�����
(
 ������ȣ integer NOT NULL,
 �ü�����ȣ integer NOT NULL,
 ���������� integer,
 û���Ͻ� datetime, 
 ��������ڵ� char(1) NOT NULL
);

CREATE TABLE �����ڵ�
(
 �����ڵ� char(1) NOT NULL PRIMARY KEY,
 �ڵ尪 varchar(40) NOT NULL
);

CREATE TABLE �����ڵ�
(
 �����ڵ� char(1) NOT NULL,
 �����ڵ� char(1) NOT NULL,
 �ڵ尪 varchar(40) NOT NULL
);