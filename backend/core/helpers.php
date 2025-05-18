<?php

// this function sends the json response to the client with the given status, message and data
// it also sets the content type to application/json  which means the clieant will expect a json response 
function jsonResponse($status, $message, $data=[] , $httpCode=200){
    http_response_code($httpCode);
    header('content-type:application/json');
    echo json_encode([
        'status' => $status, 
        'message' => $message, 
        'data' => $data]);

    exit;

}






// this function removes wierd characters from the file name and replaces them with _
function sanitizeFileName($fileName){
    $fileName=preg_replace('/[^a-zA-Z0-9-_\.]/','_',$fileName);
}

?>







