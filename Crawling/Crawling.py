import requests
from bs4 import BeautifulSoup

data = '20191204'
url = 'http://www.cgv.co.kr/common/showtimes/iframeTheater.aspx?areacode=02&theatercode=0211&date='+data
respose = requests.get(url)
html = respose.text
soup = BeautifulSoup(html, 'html.parser')
movies = soup.find_all('div', class_='col-times')


for movie in movies:
    print (data, end=' ')
    title = movie.find('strong')
    print(title.get_text().lstrip(), end=' ')
    infoes = movie.find_all('i')
    for info in infoes:
        info = info.get_text().lstrip()
        info = info.replace(" ", "")
        if (info.find('\n')!=-1):
            index = info.find('\n')
            info = info[:index-1] + info[index+1:]
        print (info, end=' ')

    tables = movie.find_all('div', class_="type-hall")
    for table in tables:
        infoes = table.find('div', class_="info-hall")
        infoes = infoes.find_all('li')
        for info in infoes:
            info = info.get_text().lstrip()
            info = info.replace(" ", "")
            if (info.find('\n')!=-1):
                index = info.find('\n')
                info = info[:index-1] + info[index+1:]
            print (info, end=' ')
        
        infoes = table.find('div', class_="info-timetable")
        infoes = infoes.find_all('li')
        for info in infoes:
            link = info.find('a')
            theatername = link.get('data-theatername')
            remainseat  = link.get('data-seatremaincnt') + '석'
            starttime = info.find('em')
            starttime = starttime.get_text()

            print(theatername, end=' ')
            print(remainseat, end=' ') 
            print(starttime, end=' ')
    
    print()
