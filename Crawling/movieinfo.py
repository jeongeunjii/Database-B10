import requests
from bs4 import BeautifulSoup

moviecodes = ['81581','82377','79313','82379','82530','82463','81895','82427','81945','82516','82487','82257','82481','82014', '82618', '82481', '81914', '82493', '82497', '82463','82014', '82618', '82481', '82544', '82702']
moviecodes = list(set(moviecodes))

array = [[] for i in range(200)]

def movieinfo(moviecode, size) :
    url='http://www.cgv.co.kr/movies/detail-view/?midx='+moviecode
    respose = requests.get(url)
    html = respose.text
    soup = BeautifulSoup(html, 'html.parser')
    movie = soup.find('div', class_='box-contents')
    title = movie.find('div', class_='title')
    title = title.find('strong')
    array[size].append(moviecode)
    array[size].append(title.get_text())
    specs = movie.find('div', class_='spec')
    genres = specs.find_all('dt')
    specs = specs.find_all('dd')
    

    for genre in genres:
        if (genre.get_text()[0]=='장'):
            array[size].append(genre.get_text())


    for i in range(0, len(specs)-1):
        if (specs[i].find('a')==None):
            spec = specs[i].get_text().strip()
            array[size].append(spec)
            continue
        
        
        link = specs[i].find('a')
        link = link.get_text()
        array[size].append(link)
size = 0
for moviecode in moviecodes:
    movieinfo(moviecode, size)
    size = size+1

for k in range(0,len(array)):
    if (array[k] != []):
        x = array[k]
        if (len(x)>8):
            x = x[0:8]
        temp = x[2:8]
        x = x[0:2]
        rate = temp[5].split(',')
        rate.pop()
        temp.pop()
        x.append(rate[0])
        x.append(rate[1].replace('\xa0',''))
        x.append(temp[0].replace('\xa0','').replace('장르 :',''))
        x.append(temp[1])
        x.append(temp[3])
        array[k] = x
        # print(array[k])


def makecode(str):
    if (str=='전체'):
        return 'A'
    elif (str=='12세 이상'):
        return 'B'
    elif (str=='15세 이상'):
        return 'C'
    elif (str=='청소년 관람불가'):
        return 'D'

def splitcomma(str):
    result = str.split(',')
    result = result[0]
    return result



for info in array:
    if (info!=[]):
        print("INSERT INTO 영화 VALUES ("+info[0]+",'"+info[1]+"','"+makecode(info[2])+"','"+info[3]+"','"+splitcomma(info[4])+"','"+info[5]+"','"+info[6]+"');")

