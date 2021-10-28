<?php
namespace NokNok;
//自带的小数据储存类
class FileUtils
{
    public function writeFile($path, $name, $content)
    {
        $return = false;
        //判断文件是否存在
        if (file_exists($path . $name)) {
            $mFile = fopen($path . $name, "w+");
            $return = fwrite($mFile, $content);
            fclose($mFile);
        } else {
            //创建文件夹
            $dir = iconv("UTF-8", "GBK", $path);
            mkdir($dir, 0777, true);
            $mFile = fopen($path . $name, "w+");
            $return = fwrite($mFile, $content);
            fclose($mFile);
        }

        return $return;
    }

    public function readFile($path, $name)
    {
        $return = false;
        //判断文件是否存在
        if (file_exists($path . $name)) {
            $mFile = fopen($path . $name, "a+");
            $return = fread($mFile, filesize($path . $name));
            fclose($mFile);
        } else {
            //创建文件夹
            $dir = iconv("UTF-8", "GBK", $path);
            mkdir($dir, 0777, true);
            $mFile = fopen($path . $name, "a+");
            $return = fread($mFile, filesize($path . $name));
            fclose($mFile);
        }

        return $return;
    }
}
