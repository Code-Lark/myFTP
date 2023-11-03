<?php
function formatSize($size)
{
    $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    if ($size == 0) {
        return ('n/a');
    } else {
        return (round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
    }
}

$filePath = $_GET['filePath'];
//echo $filePath;
$list = scandir($filePath);
$listObj = [];

for ($i = 2; $i < count($list); $i++) {
    $path=$filePath . '/' . $list[$i];
    $suffix=substr(strrchr($list[$i], '.'), 1);
    if (empty($suffix)){
        $suffix='文件夹';
    }
    $obj = array(
        "name" => $list[$i],
        "type"=>$suffix,
        "size"=>formatSize(filesize($path)),
        "link"=>$suffix=='文件夹'? '/myFTP/index.html?dir='.$path:$path
    );

    array_push($listObj,$obj);
}

echo json_encode($listObj,JSON_UNESCAPED_UNICODE);

































