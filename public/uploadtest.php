<!DOCTYPE html>
<html>
<body>

<!-- this is a simple file uploader which you can use to test uploading files
for example nginx default configs (meta settings) might not play nice with animated gifs
so if you can upload gif with the normal uploader, but not an animated one it might be
because of your nginx setup and not the php uploader itself
-->

<form action="uploadtest.php" method="post" enctype="multipart/form-data">
  <input type="file" name="upfile" required>
  <input type="submit" value="Upload" name="submit">
</form>

<?php
// (A) MOVE UPLOADED FILE TO DESTINATION
$source = $_FILES["upfile"]["tmp_name"];
$destination = $_FILES["upfile"]["name"];
move_uploaded_file($source, $destination);

?>

</body>
</html>
