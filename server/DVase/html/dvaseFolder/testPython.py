import numpy as np
import cv2
import os
from PIL import Image
# 해당 식물 사진들을 모아두는 리스트를 만들고 반환하는 함수
def pictureList( plantName ) :
	path = "/var/www/html/dvaseFolder/learnSetImage/" + plantName
	pictureList = os.listdir( path )		# 사진 파일 이름을 불러옴
	pictureList.insert( 0, plantName )		# 리스트의 형태 = [ "식물 이름", 사진1, 사진2, .... ] : 이 리스트가 어떤 식물의 리스트인지 판단하기 위해

	return pictureList
# 조사해둔 식물들의 이름 리스트를 만들고 반환하는 함수
def plantsList() :
	path = "/var/www/html/dvaseFolder/learnSetImage/"
	plantsList = os.listdir( path )		# 폴더 이름 = 식물의 영문 이름

	return plantsList
# 두 개의 사진을 인자로 받아 유사도를 측정하는 함수
def imageMatching( image_path1, image_path2 ) :
    difference = 0		# 유사도를 의미하는 변수

    img1 = cv2.imread(image_path1,0)		# opencv를 통해 사진 로딩
    img2 = cv2.imread(image_path2,0)

    orb = cv2.ORB_create()

    kp1, des1 = orb.detectAndCompute(img1,None)
    kp2, des2 = orb.detectAndCompute(img2,None)

    bf = cv2.BFMatcher(cv2.NORM_HAMMING, crossCheck=True)

    matches = bf.match(des1,des2)

    matches = sorted(matches, key = lambda x:x.distance)

    lengthCount = len( matches )		# 유사도를 연결한 선의 개수, 이 개수가 적을수록 비슷한 부분이 당연히 적다는 의미가 됨
    if lengthCount > 30 :
        lengthCount = 30

    for i in range( lengthCount ) :
        difference = difference + matches[i].distance			# 유사거리 = 비슷한 특징을 가진 부분끼리 연결되어 있는 선의 길이, 이 길이가 적당할 수록 유사도가 높음

    difference = difference / lengthCount		# 유사도 = 모든 유사 거리의 합 / 유사 거리의 개수
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

plantsList = plantsList()			# 식물 리스트를 가져옴

setList = []			# 식물 리스트들을 담아두는 일시적인 리스트

for i in plantsList :
    tempList = pictureList( i )
    setList.append( tempList )		# 모든 식물에 대한 정보를 setList에 넣는 부분

originName = "/var/www/html/dvaseFolder/uploads/identified2.jpg"		# 안드로이드에서 찍은 사진의 경로 및 이름
fileName = "/var/www/html/dvaseFolder/uploads/identified.jpg"			# 크기를 수정해 저장할 1차 가공된 사진의 경로 및 이름

image = Image.open( originName )
resize_image = image.resize( (480, 480) )
resize_image.save( fileName )		# 샘플 사진들과 정확한 비교를 위해 샘플 사진의 크기인 480px X 480px 의 크기로 만들어서 다시 저장

scoreList = []			# 모든 샘플과 비교한 후 나온 유사도를 저장할 리스트

if fileName != "" :				# 정상적인 파일 이름으로 프로그램이 실행될 경우,
    for plants in setList :		# 첫 번째 요소는 이름이었으므로 이름으로 취급, 그 외에는 모두 사진이었으므로 사진을 비교하는 작업을 거침
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
                scoreList.append( temp )			# 사진을 비교하는 작업 후 얻은 유사도들을 scoreList에 저장
    scoreList.sort( key = lambda x:x[1] )			# 모든 유사도 비교가 끝나면 이 scoreList를 내림차순으로 정렬해 유사도가 높은 것이 낮은 인덱스를 갖도록 함

    finalResult = []			# 최종 결과를 담을 리스트
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
            finalResult.append( temp )		# 위 유사도를 담은 리스트에서 상위 15개만 가져온 다음, 그 15개의 사진들이 가리키는 식물들 중, 가장 많은 것이 낮은 인덱스로 되게 설정

    print( finalResult[0][0] )			# 최종적으로 가장 유사도가 높은 사진들 중 가장 많이 나온 식물의 영어이름이 출력되게 됨
