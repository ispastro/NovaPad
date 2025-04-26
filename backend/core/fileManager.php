<?php

class FileManager{
// one one can directly touch these outside they are safe 
    private $basePath; // this stores  the main file
    private $versionPath; // this one stores the back up or old versions 


    public function  __construct($basePath, $versionPath){
        $this->basePath =$basePath;
        $this->version=$versionPath;

    }

    public function  save($fileName, $content){
        $filePath =$this->basePath.'/'.$fileName;
        if(file_exists($filePath)){
            $this->saveVersion($fileName);   
        }
        // 
        return file_put_contents($filePath,$content)!==false;


    }




    // reads the contents of the file
    public function load($fileName){
        $filePath =$this->basepath.'/'.$fileName;

        return file_exists($filePath)?file_get_contents($filePath):false;
    }

    // delets the file

    public function delete($fileName){
        $filePath =$this->basePath.'/'.$fileName;  // links the basefile with the file name
         return file_exists($filePath)?unlink($filePath):false;   // this check the file and if it exists it delets it 
    }



    // the following this all of the files 


    public function listFiles(){

        // scandir is built in php function to rerieve the files inside the folder
        // array_diff removes . and .. which are means of current and parent folder
       $files = array_diff(scandir(basePath),['.',".."]);  
       return array_values($files); //this one reindexes the array


    }


    public function saveVersion($fileName){
        $filePath =$this->basePath.'/'.$fileName;
        $versionFolder =$this->versionFolder .'/'.pathinfo($fileName,PATHINFO_FILENAME);


        if(!is_dir($versionFolder)){
          mkdir($versionFolder, 777, true);

        }
        $timestamp=date(Y-m-d_H-i-s);
        copy($filePath,$versionFolder.'/'.$timestamp .'html')


    }






}