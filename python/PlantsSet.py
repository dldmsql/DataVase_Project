import os
import Constants

class PlantsSet :

    def __init__( self ) :
        pass

    def pictureList( self, plantName ) :
        path = Constants.BASE_PATH + plantName
        pictureList = os.listdir( path )
        pictureList.insert( 0, plantName )
        
        return pictureList

    def plantsList( self ) :
        path = Constants.BASE_PATH
        plantsList = os.listdir( path )

        return plantsList
