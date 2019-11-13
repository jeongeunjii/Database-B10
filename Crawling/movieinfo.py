import requests
from bs4 import BeautifulSoup

moviecodes = ['82463','81895','82427','81945','82516','82487','82257']

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
print(array)

#영화번호','제목','영화등급코드','상영시간','장르','감독', '배우'