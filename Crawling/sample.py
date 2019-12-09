from random import randint
import random

array = [19009, 19010, 19013, 19014, 19015, 
         19016, 19017, 19018, 19019, 19020, 
         19021, 19022, 19023, 19024, 19025, 
         19026, 19027]

time = ["'08:50:","'08:51:","'08:52:","'08:53:","'08:54:","'08:55:","'08:56:","'08:57:",
        "'08:58:","'08:59:","'09:00:","'09:01:","'09:02:","'09:03:"]

time2 = ["'17:50:","'17:51:","'17:52:","'17:53:","'17:54:","'17:55:","'17:56:","'17:57:",
        "'17:58:","'17:59:","'18:00:","'18:01:","'18:02:","'18:03:"]



for elem in array:
    for i in range(1,2):
        result = "INSERT INTO 근태관리 VALUES ('2019-12-"
        # if (i < 10):
        #     result = result + "0"
        # result = result + str(i) + "', "
        result = result + "12', "
        result = result + str(elem) + ", "
        

        result = result + random.sample(time, 1)[0]
        s = int(randint(0,59))
        if (s < 10):
            result = result + "0"
        result = result + str(s) + "',"

        result = result + random.sample(time2, 1)[0]
        s = int(randint(0,59))
        if (s < 10):
            result = result + "0"
        result = result + str(s) + "');"
        print(result)

    

for i in range(1,100):
    x = randint(0,60)
    if (x < 10):
        print(x)