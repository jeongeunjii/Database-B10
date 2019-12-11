import requests
import copy
from bs4 import BeautifulSoup

date = '20191212'
url = 'http://www.cgv.co.kr/common/showtimes/iframeTheater.aspx?areacode=02&theatercode=0211&date='+date
respose = requests.get(url)
html = respose.text
soup = BeautifulSoup(html, 'html.parser')
movies = soup.find_all('div', class_='col-times')



def makecode(str):
    if (str=='1'):
        return 'A'
    elif (str=='2'):
        return 'B'
    elif (str=='3'):
        return 'C'
    elif (str=='4'):
        return 'D'
    elif (str=='5'):
        return 'E'
    elif (str=='6'):
        return 'F'
    elif (str=='7'):
        return 'G'
    elif (str=='8'):
        return 'H'



moviecode = []
for movie in movies:
    array = []
    code = movie.find('a').attrs['href']
    idxequal = code.find('=')
    code = code[idxequal+1:]
    array.append(code)
    title = movie.find('strong')
    # print(title.get_text().lstrip(), end=' ')
    array.append(title.get_text().lstrip())
    infoes = movie.find_all('i')




    i=0
    for info in infoes:
        info = info.get_text().lstrip()
        info = info.replace(" ", "")
        if (info.find('\n')!=-1):
            index = info.find('\n')
            info = info[:index-1] + info[index+1:]
        if (info.find(',')!=-1):
            index = info.find(',')
            info = info[:index]
        # print (info, end=' ')
        if i!=2:
            array.append(info)
        i = i+1

    tables = movie.find_all('div', class_="type-hall")
    temp = copy.copy(array)


    # moviecode.append(temp[0])                 #영화정보 추가할때 주석빼고 영화코드 movieinfo에 추가
    # print(moviecode)


    for table in tables:
        temp = copy.copy(array)
        infoes = table.find('div', class_="info-hall")
        infoes = infoes.find_all('li')
        i=0
        for info in infoes:
            info = info.get_text().lstrip()
            info = info.replace(" ", "")
            if (info.find('\n')!=-1):
                index = info.find('\n')
                info = info[:index-1] + info[index+1:]
            # print (info, end=' ')
            if i==1:
                temp.append(info)
            i = i+1
            
        infoes = table.find('div', class_="info-timetable")
        infoes = infoes.find_all('li')
        for info in infoes: 
            link = info.find('a')
            # theatername = link.get('data-theatername')
            # remainseat  = link.get('data-seatremaincnt') + '석'
            starttime = info.find('em')
            starttime = starttime.get_text()

            # print(theatername, end=' ')
            # print(remainseat, end=' ') 
            # print(starttime, end=' ')
            temp.append(starttime)

        # print(temp)


        for  i in range(1,len(temp)-4) :
            print("INSERT INTO 영화상영정보 VALUES (NULL, '0211','"+makecode(temp[4][0])+"',"+temp[0]+",'"+date+"','"+temp[4+i]+"','"+temp[3]+"',8000,6000);")


