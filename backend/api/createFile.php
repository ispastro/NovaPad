<?php



// get the incoming Json data


$data =json_decode(file_get_contents('php://input'), true);

// check if fileNam eis provided

if(!isset($data['fileName'])){
    jsonResponse('error', 'Filename is required');
}

// santize filename (remove bad characters)

$fileName =sanitizeFileName($data['fileName']);

//initialize FileManager


$fileManager =new FileManager(BASE_PATH, VERSION_PATH);
//Check if file already exists

$fullPath =BASE_PATH .'/'.$fileName;

if(file_exists($fullPath)){
  jsonResponse('error', 'File already exists');
}

// create an empty file
if(file_put_contents($fullPath,'')!==false){
    jsonResponse('success','File created successfully.');
}
else{
    jsonResponse('error', 'Failed to create file.');
}


?>