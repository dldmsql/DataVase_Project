import numpy as np
import cv2
import os
from PIL import Image

def pictureList( plantName ) :
	path = "/var/www/html/dvaseFolder/learnSetImage/" + plantName
	pictureList = os.listdir( path )
	pictureList.insert( 0, plantName )

	return pictureList

def plantsList() :
	path = "/var/www/html/dvaseFolder/learnSetImage/"
	plantsList = os.listdir( path )

	return plantsList

def imageMatching( image_path1, image_path2 ) :
    difference = 0

    img1 = cv2.imread(image_path1,0)
    img2 = cv2.imread(image_path2,0)

    orb = cv2.ORB_create()

    kp1, des1 = orb.detectAndCompute(img1,None)
    kp2, des2 = orb.detectAndCompute(img2,None)

    bf = cv2.BFMatcher(cv2.NORM_HAMMING, crossCheck=True)

    matches = bf.match(des1,des2)

    matches = sorted(matches, key = lambda x:x.distance)

    lengthCount = len( matches )
    if lengthCount > 30 :
        lengthCount = 30

    for i in range( lengthCount ) :
        difference = difference + matches[i].distance

    difference = difference / lengthCount
    #print( difference )

    """
    res = cv2.drawMatches( image1, kp1, image2, kp2, matches[:50], res,
                singlePointColor = (0, 255, 0), matchColor = (255, 0, 0), flags = 0 )
    """
    # flags : 0(모든 특징), 2(일치하는 특징만)
    # singlePointColor : 개인이 가진 특징을 표시하는 색상
    # matchColor : 두 사진의 공통된 특징을 이어줄 선의 색상
    # matches[:숫자] : : 총 몇 개의 공통된 특징을 찾아서 보여줄 것이지 숫자를 지정할 수 있음

    #res = cv2.drawMatches( image1, kp1, image2, kp2, matches[:10], res, flags = 0 )


  #  cv2.imshow( "Matched", res )
  #  cv2.waitKey(0)
    #cv2.destroyAllWindows()
    return difference

plantsList = plantsList()

setList = []

for i in plantsList :
    tempList = pictureList( i )
    setList.append( tempList )

originName = "/var/www/html/dvaseFolder/uploads/identified2.jpg"
fileName = "/var/www/html/dvaseFolder/uploads/identified.jpg"

image = Image.open( originName )
resize_image = image.resize( (480, 480) )
resize_image.save( fileName )

scoreList = []

if fileName != "" :
    for plants in setList :
        isFirst = True
        title = ""
        for pict in plants :
            if isFirst :
                title = pict
                isFirst = False
            else :
                path = "/var/www/html/dvaseFolder/learnSetImage/" + title + "/" + pict
                score = imageMatching( path, fileName )
                temp = [ title, score ]
                scoreList.append( temp )
    scoreList.sort( key = lambda x:x[1] )

    finalResult = []
    for result in scoreList[:15] :
        isLoop = True
        temp = []
        plantsName = result[0]
        for final in finalResult :
            if final[0] == plantsName :
                final[1] += 1
                isLoop = False
                break
        if isLoop :
            temp.append( plantsName )
            temp.append( 0 )
            finalResult.append( temp )

    print( finalResult[0][0][:-2] )
