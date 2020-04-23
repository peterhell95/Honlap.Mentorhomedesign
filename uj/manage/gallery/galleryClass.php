<?php
require_once ( dirname(  __FILE__). '/../functions/connectionClass.php' );
class galleryClass extends connectionClass{
    public function uploadGallery($image,$description){
        $insert="Insert into gallery (ImageName,Description) values ('$image','$description')";
        $result=$this->query($insert);
        if($result){
            header("Refresh:0");
            echo "Kép sikeresen feltöltve!";
        }
        else
        {
            header("Refresh:0");
            echo "A képet nem sikerült felölteni.";
        }
    }
    public function deleteGallery($imageName){
        
        $insert="DELETE from gallery WHERE ImageName = '$imageName'";
        $result=$this->query($insert);
        if($result){
            header("Refresh:0");
            echo "Kép sikeresen törölve!";
        }
        else
        {
            header("Refresh:0");
            echo "A képet nem sikerült törölni.";
        }
    }
    public function updateGallery($imageName,$description){
        
        $insert="UPDATE gallery SET Description='$description' WHERE ImageName = '$imageName'";
        $result=$this->query($insert);
        if($result){
            header("Refresh:0");
            echo "Kép sikeresen frissitve!";
        }
        else
        {
            header("Refresh:0");
            echo "A képet nem sikerült frissíteni.";
        }
    }
    public function deleteAllGallery(){
        
        $insert="truncate table gallery";
        $result=$this->query($insert);
        if($result){
            header("Refresh:0");
            echo "Képeket sikeresen töröltük!";
        }
        else
        {
            header("Refresh:0");
            echo "A képeket nem sikerült törölni!";
        }
    }
    
    public function listGallery(){
        $select="select * from gallery";
        $result=$this->query($select);
        $count=$result->num_rows;
        if($count< 1){

        }
        else
        {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[]=$row;
            }
            return $rows;
        }
    }
}