<?php



$ini_PostSize = preg_replace("/[^0-9,.]/", "", ini_get('post_max_size'))*(1024*1024);
$ini_FileSize = preg_replace("/[^0-9,.]/", "", ini_get('upload_max_filesize'))*(1024*1024);
$maxFileSize = ($ini_PostSize<$ini_FileSize ? $ini_PostSize : $ini_FileSize);
$file = (isset($_FILES["file1"]) ? $_FILES["file1"] : 0);

if(isset($_GET["getsize"])) {
echo $maxFileSize;
exit;

}
if (!$file) { // if file not chosen

    if($file["size"]>$maxFileSize){
        die("ERROR: The File is too big! The maximum file size is ".$maxFileSize/(1024*1024)."MB");
    }
    die("ERROR: Please browse for a file before clicking the upload button");
}
if($file["error"]) {

    die("ERROR: File couldn't be processed");

}
if($file["type"] !== "video/mp4") {

    die("ERROR: You have to select a MP4-File");

}
if(move_uploaded_file($file["tmp_name"], "media/".$file["name"])){
    echo "SUCCESS: The upload of ".$file["name"]." is complete";
} else {
    echo "ERROR: Couldn't move the file to the final location";
}
?>
