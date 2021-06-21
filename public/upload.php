<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>502</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=yes"/>
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
   </head>
   <style>
      #black-bg {background: linear-gradient(to bottom right, #222222,#2b2b2b) fixed;
         min-height:100vh;}
   </style>
<body>
<div id="black-bg">
        <br>
        <div class="ui inverted center aligned container segment">
            <div class="ui content">
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// folder thingy
$folder = $_POST['folder'];
$dirPath = 'gallery/'.$folder;
$result = mkdir($dirPath);

if ($result == '1') {

echo $dirPath . " has been created<br>";

} else {
echo $dirPath . " has not been created<br>";
}

//$target_dir = "uploads/";
$target_dir = $dirPath."/";
$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "file already exists.<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000*16) {
    echo "your file is too large.<br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "gif"
//&& $imageFileType != "gif" && $imageFileType != "bmp" 
) {
    echo "only GIF files are allowed.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h1>your file was not uploaded.</h1>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";

echo "running mogrify";
        $output = shell_exec("./mogrify.sh $target_file $folder");
 	echo "mogrify ok";

        $previousPage = $_SERVER["HTTP_REFERER"];
        header('Location: '.$previousPage);

    } else {
        echo "there was an error uploading your file.<br>";
    }
}
?>
</div>
</div>
</div>


</body>
