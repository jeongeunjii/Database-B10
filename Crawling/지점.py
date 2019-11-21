import requests
from bs4 import BeautifulSoup
import time

html = open('page.txt', 'r', encoding='UTF8').read()
soup = BeautifulSoup(html, 'html.parser')

areas = soup.find_all('div',class_='area')
branch = [[] for i in range(164)]
i=0
size = 0
for area in areas:
	datas = area.find_all('a')
	for data in datas:
		name = data.get_text()
		href = data.get('href').replace('/theaters/?','')
		array = href.split('&')
		array.pop()
		array.append(name)
		branch[size].append(array[0].replace("areacode=",""))
		branch[size].append(array[1].replace("theaterCode=",""))
		branch[size].append(array[2])
		size = size + 1
size = 0
for index in branch:
	url = 'http://www.cgv.co.kr/theaters/?areacode='+index[0]+'&theaterCode='+index[1]+'&date=20191114'
	respose = requests.get(url)
	html = respose.text
	soup = BeautifulSoup(html, 'html.parser')
	for br in soup.find_all("br"):
		br.replace_with("=")
	info = soup.find('div',class_='theater-info')
	location = info.find('strong').get_text().replace('위치/주차 안내  >','')
	array = location.split('=')
	branch[size].append(array[0])
	if(array[-1]!=array[0]):
		branch[size].append(array[1])
	else:
		branch[size].append('')
	branch[size].append('1544-1122')
	size = size + 1
	
for low in branch:
	print("INSERT INTO 지점 VALUES ('"+low[1]+"','"+low[0]+"','"+low[2]+"','"+low[3]+"','"+low[4]+"','"+low[5]+"');")

