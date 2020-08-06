import numpy as np
import cv2
import os

def pictureList( plantName ) :
	path = "/var/www/html/dvaseFolder/learnSetImage/" + plantName
	pictureList = os.listdir( path )
	pictureList.insert( 0, plantName )

	return pictureList

def plantsList() :
	path = "/var/www/html/dvaseFolder/learnSetImage/"
	plantsList = os.listdir( path )

	print( plantsList )

	return plantsList

def imageMatching( image_path1, image_path2 ) :
    difference = 0

    image1 = cv2.imread( image_path1, cv2.IMREAD_GRAYSCALE )
    image2 = cv2.imread( image_path2, cv2.IMREAD_GRAYSCALE )
    res = None

    orb = cv2.ORB()
    kp1, des1 = orb.detectAndCompute( image1, None )
    kp2, des2 = orb.detectAndCompute( image2, None )

    bf = cv2.BFMatcher( cv2.NORM_HAMMING2, crossCheck = True )
    ## test case ##
    """
    clusters = np.array( [des1] )
    bf.add( clusters )

    bf.train()

    matches = bf.match( des2 )
    ##
    """
    matches = bf.match( des1, des2 )

    matches = sorted( matches, key = lambda x:x.distance )

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

    res = cv2.drawMatches( image1, kp1, image2, kp2, matches[:10], res, flags = 0 )


  #  cv2.imshow( "Matched", res )
  #  cv2.waitKey(0)
    cv2.destroyAllWindows()
    return difference

plantsList = plantsList()

setList = []

for i in plantsList :
    tempList = pictureList( i )
    setList.append( tempList )

fileName = "/var/www/html/dvaseFolder/test.jpg"

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
    for result in scoreList[:Constants.TOP_SCORES] :
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

    print( finalResult[0][0] )
