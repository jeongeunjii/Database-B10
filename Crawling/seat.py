labels = ['A','B','C','D','E','F','G','H','I','J','K','L','M']

for label in labels:
    for i in range(1,19):
        if ( (label == 'A' and i == 1) or (label == 'M' and i == 13 or label == 'M' and i == 14)):
            next
        else:
            print("INSERT INTO 상영관 VALUES ('0211','1관','C',231,'"+label+"',"+str(i)+");")


for label in labels:
    for i in range(4,17):
        if ( (label == 'A' and i == 4) or (label == 'M' and i == 12 or label == 'M' and i == 13 or label == 'M' and i == 16)):
            next
        else:
            print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'"+label+"',"+str(i)+");")

print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'K',1);")
print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'K',2);")
print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'K',3);")
print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'L',1);")
print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'L',2);")
print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'L',3);")
print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'M',2);")
print("INSERT INTO 상영관 VALUES ('0211','2관','C',173,'M',3);")


for label in labels:
    for i in range(1,19):
        if ( (label == 'A' and i == 18) or (label == 'B' and i == 1) or (label == 'H' and i == 1) or (label == 'M' and i == 13) or (label == 'M' and i == 14)):
            next
        else:
            print("INSERT INTO 상영관 VALUES ('0211','3관','C',229,'"+label+"',"+str(i)+");")

labels = ['A','B','C','D','E','F','G','H','I','J','K']

for label in labels:
    for i in range(1,13):
        print("INSERT INTO 상영관 VALUES ('0211','4관','A',132,'"+label+"',"+str(i)+");")


labels = ['A','B','C','D','E','F','G','H','I','J','K','L','M', 'N']

for label in labels:
    for i in range(1,19):
        if ( (label == 'A' and i == 18) or (label == 'C' and i == 1) or (label == 'I' and i == 1) or (label == 'N' and i == 13) or (label == 'N' and i == 14)):
            next
        else:
            print("INSERT INTO 상영관 VALUES ('0211','5관','C',147,'"+label+"',"+str(i)+");")

labels = ['A','B','C','D','E','F','G','H','I','J','K','L','M']

for label in labels:
    for i in range(4,17):
        if ( (label == 'A' and i == 4) or (label == 'M' and i == 12 or label == 'M' and i == 13 or label == 'M' and i == 16)):
            next
        else:
            print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'"+label+"',"+str(i)+");")

print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'K',1);")
print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'K',2);")
print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'K',3);")
print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'L',1);")
print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'L',2);")
print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'L',3);")
print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'M',2);")
print("INSERT INTO 상영관 VALUES ('0211','6관','C',173,'M',3);")



labels = ['A','B','C','D','E','F','G','H','I','J','K','L','M', 'N']

for label in labels:
    for i in range(1,19):
        if ( (label == 'A' and i == 1) or (label == 'I' and i == 18) or (label == 'N' and i == 13) or (label == 'N' and i == 14)):
            next
        else:
            print("INSERT INTO 상영관 VALUES ('0211','7관','C',248,'"+label+"',"+str(i)+");")


labels = ['A','B','C','D','E','F','G','H','I','J','K','L','M']

for label in labels:
    for i in range(1,14):
        if ( (label == 'A' and i == 13) or (label == 'M' and i == 12 or label == 'M' and i == 13) ):
            next
        else:
            print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'"+label+"',"+str(i)+");")

print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'K',14);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'K',15);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'K',16);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'L',14);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'L',15);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'L',16);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'M',14);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'M',15);")
print("INSERT INTO 상영관 VALUES ('0211','8관','C',175,'M',16);")
