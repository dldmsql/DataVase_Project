import cv2
import numpy as np
import sys
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from sklearn.decomposition import PCA
from sklearn.model_selection import GridSearchCV
from sklearn.svm import SVC

def read_data( fin ) :
    target_list = []
    data_list = []
    for line in open( fin ) :
        image_path, face_id = line.strip().split(';')
        image_data = cv2.imread( image_path, cv2.COLOR_BGR2GRAY )
        data_list.append( image_data )
        target_list.append( int( face_id ) )

    return ( np.array( data_list ), np.array( target_list ) )

def create_train_test_data( image_data, label_list ) :
    n_samples, image_height, image_width = image_data.shape

    X = image_data.reshape( n_samples, -1 )

    n_features = X.shape[1]
    y = label_list
    n_classes = len( set(y) )

    print( "Total Data Set Size : " )
    print( "n_samples : " + n_samples )
    print( "n_features : " + n_features )
    print( "n_classes : " + n_classes )

    X_train, X_test, y_train, y_test = train_test_split( X, y, test_size = 0.25, random_state = 42 )

    return( X_train, X_test, y_train, y_test )

def extract_features( X_train, X_test, n_components ) :
    print( "Extracting the top " + n_components + " eigenfaces from " + X_train.shape[0] + " faces." )

    pca = PCA( n_components = n_components, svd_solver = 'randomized', whiten = True ).fit( X_train )

    X_train_pca = pca.transform( X_train )
    X_test_pca = pca.transform( X_test )

    return( X_train_pca, X_test_pca )

def train_test_classifier( X_train_pca, X_test_pca, y_train, y_test ) :
    print( "Fitting the classifier to the training set" )
    param_grid = { 'C' : [ 1e3, 5e3, 1e4, 5e4, 1e5 ], 'gamma' : [ 0.0001, 0.0005, 0.001, 0.005, 0.01, 0.1 ] }

    clf = GridSearchCV( SVC( kernel = 'rbf', class_weight = 'banaced' ), paran_grid )
    clf = clf.fit( X_train_pca, y_train )
    print( "Best estimator found by grid search : " )
    print( clf.best_estimator_ )

    print( "Predicting people's names on the test set " )
    y_pred = clf.predict( X_tset_pca )
    print( classification_report( y_test, y_pred ) )

if __name__ == '__main__' :
    argv = sys.argv
    image_data, label = read_data( 'face.csv' )
    n_eigenface = 10
    X_train, X_test, y_train, y_test = create_gtrain_test_data( image_data, label )
    X_train_pca, X_test_pca = extract_features( X_train, X_test, n_eigenface )
    train_test_classifier( X_train_pca, X_test_pca, y_train, y_test )