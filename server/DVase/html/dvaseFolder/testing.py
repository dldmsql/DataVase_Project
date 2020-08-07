"""
import numpy as np
import cv2
from matplotlib import pyplot as plt

img1 = cv2.imread('/var/www/html/dvaseFolder/learnSetImage/SANSEVIERIA/sansevieria1',0)
img2 = cv2.imread('/var/www/html/dvaseFolder/learnSetImage/SANSEVIERIA/sansevieria2',0)

# Initiate SIFT detector
sift = cv2.xfeatures2d.SIFT_create()

# find the keypoints and descriptors with SIFT
kp1, des1 = sift.detectAndCompute(img1,None)
kp2, des2 = sift.detectAndCompute(img2,None)

# FLANN parameters
FLANN_INDEX_KDTREE = 0

index_params = dict(algorithm = FLANN_INDEX_KDTREE, trees = 5)
search_params = dict(checks=50)   # or pass empty dictionary

flann = cv2.FlannBasedMatcher(index_params,search_params)

matches = flann.knnMatch(des1,des2,k=2)

print( matches )
"""

"""
import numpy as np
import cv2
from matplotlib import pyplot as plt

img1 = cv2.imread('/var/www/html/dvaseFolder/learnSetImage/SANSEVIERIA/sansevieria1',0)
img2 = cv2.imread('/var/www/html/dvaseFolder/learnSetImage/SANSEVIERIA/sansevieria2',0)

sift = cv2.xfeatures2d.SIFT_create()

kp1, des1 = sift.detectAndCompute(img1,None)
kp2, des2 = sift.detectAndCompute(img2,None)

bf = cv2.BFMatcher()

matches = bf.knnMatch(des1,des2, k=2)

print( matches )

"""


import numpy as np
import cv2

img1 = cv2.imread('/var/www/html/dvaseFolder/learnSetImage/SANSEVIERIA/sansevieria1.jpg',0)
img2 = cv2.imread('/var/www/html/dvaseFolder/learnSetImage/SANSEVIERIA/sansevieria2.jpg',0)

orb = cv2.ORB_create()

kp1, des1 = orb.detectAndCompute(img1,None)
kp2, des2 = orb.detectAndCompute(img2,None)

bf = cv2.BFMatcher(cv2.NORM_HAMMING, crossCheck=True)

matches = bf.match(des1,des2)

matches = sorted(matches, key = lambda x:x.distance)

print( matches )


"""
import cv2
import numpy as np
from matplotlib import pyplot as plt

img = cv2.imread('/var/www/html/dvaseFolder/learnSetImage/SANSEVIERIA/sansevieria1')
                                             # image.png 로드
cv2.imshow('image', img)
                                                # 타이틀바 이름을 image로 하여 이미지를 띄움
img = cv2.imread('image.png', cv2.IMREAD_GRAYSCALE)                         # image.png를 gray컬러로 변환
img = cv2.resize(img, None, fx=1/2, fy=1/2, interpolation=cv2.INTER_AREA)   # image.png를 절반으로 줄이기

cv2.imwrite('conv_img.png', img)                                            # image.png를 절반의 크기의 gray컬러로 이미지 저장

conv_img = cv2.imread('conv_img.png')                                       # 변환하여 저장된 conv_img.png 로드

cv2.imshow('conv_image', conv_img)                                          # conv_img.png 띄우기

cv2.waitKey(0)                                                              # 대기시간(ms), 0일 경우 아무키나 누르게되면 다음줄 실행
cv2.destroyAllWindows()                                                     # 모든 윈도우 닫기
"""
