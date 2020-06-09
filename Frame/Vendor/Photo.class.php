<?php
namespace Frame\Vendor;

class Photo
{ 
 private $uptypes; 
      
    private $max_file_size;     //上传文件大小限制, 单位BYTE  
    private  $destination_folder; //上传文件路径  
    private $watermark;      //是否附加水印(1为加水印,其他为不加水印);  
     private $watertype;      //水印类型(1为文字,2为图片)  
     private $waterposition;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);  
     private $waterstring;  //水印字符串  
     private $imgpreview;      //是否生成预览图(1为生成,其他为不生成);  
     private $imgpreviewsize;    //缩略图比例  
     
     
     //公共的构造方法
	public function __construct()
	{
        $this->max_file_size = isset($GLOBALS['config']['max_file_size']) ? $GLOBALS['config']['max_file_size'] : 5000000;
        $this->destination_folder = isset($GLOBALS['config']['$destination_folder']) ? $GLOBALS['config']['$destination_folder'] : "./Public/Images/";
        $this->watermark = isset($GLOBALS['config']['watermark']) ? $GLOBALS['config']['watermark'] : 1;
        $this->watertype = isset($GLOBALS['config']['watertype']) ? $GLOBALS['config']['watertype'] : 1;
        $this->waterposition = isset($GLOBALS['config']['waterposition']) ? $GLOBALS['config']['waterposition'] : 1;
        $this->waterstring = isset($GLOBALS['config']['waterstring']) ? $GLOBALS['config']['waterstring'] : "http://www.ecocitoyennete.cn/";
        $this->imgpreview = isset($GLOBALS['config']['imgpreview']) ? $GLOBALS['config']['imgpreview'] : 1;
        $this->imgpreviewsize = isset($GLOBALS['config']['imgpreviewsize']) ? $GLOBALS['config']['imgpreviewsize'] : 1/2;
        $this->uptypes=array(  
        'image/jpg',  
        'image/jpeg',  
        'image/png',  
        'image/pjpeg',  
        'image/gif',  
        'image/bmp',  
        'image/x-png'  
    );  
	}
   
         public function update($photo){
 
        $file = $photo;  
        if($this->max_file_size < $file["size"])  
        //检查文件大小  
        {  
            echo "fichers trop grands!";  
           exit;  
        }  
      
        if(!in_array($file["type"], $this->uptypes))  
        //检查文件类型  
        {  
            echo "type n'accepete pas!".$file["type"];  
            exit;  
        }  
      
        if(!file_exists($this->destination_folder))  
        {  
            mkdir($this->destination_folder);  
        }  
      
        $filename=$file["tmp_name"]; //1.png 
      
        $image_size = getimagesize($filename); 
     
        $pinfo=pathinfo($file["name"]);  
        $ftype=$pinfo['extension'];  
        $destination = $this->destination_folder.time().".".$ftype;  
        if (file_exists($destination) && $overwrite != true)  
        {  
            echo "déja exsite le meme nom";  
            exit;  
        }  
      
        if(!move_uploaded_file ($filename, $destination))  
        {  
            echo "faute duant deplacement du fichers";  
            exit;  
        }  
      
        $pinfo=pathinfo($destination);  
        $fname=$pinfo["basename"];  
        echo " <font color=red>réussi</font><br>fileName:  <font color=blue>".$this->destination_folder.$fname."</font><br>";  
        echo " largeur:".$image_size[0];  
        echo " length:".$image_size[1];  
        echo "<br> size:".$file["size"]." bytes";  
      
        if($this->watermark==1)  
        {  
            $iinfo=getimagesize($destination,$iinfo);  
            $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);  
            $white=imagecolorallocate($nimage,255,255,255);  
            $black=imagecolorallocate($nimage,0,0,0);  
            $red=imagecolorallocate($nimage,255,0,0);  
            imagefill($nimage,0,0,$white);  
            switch ($iinfo[2])  
            {  
                case 1:  
                $simage =imagecreatefromgif($destination);  
                break;  
                case 2:  
                $simage =imagecreatefromjpeg($destination);  
                break;  
                case 3:  
                $simage =imagecreatefrompng($destination);  
                break;  
                case 6:  
                $simage =imagecreatefromwbmp($destination);  
                break;  
                default:  
                die("Ne supporte pas cette type de fiches");  
                exit;  
            }  
      
            imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);  
            imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);  
      
            switch($this->watertype)  
            {  
                case 1:   
                imagestring($nimage,2,3,$image_size[1]-15,$this->waterstring,$black);  
                break;  
                case 2:   
                $simage1 =imagecreatefromgif("xplore.gif");  
                imagecopy($nimage,$simage1,0,0,0,0,85,15);  
                imagedestroy($simage1);  
                break;  
            }  
      
            switch ($iinfo[2])  
            {  
                case 1:  
                //imagegif($nimage, $destination);  
                imagejpeg($nimage, $destination);  
                break;  
                case 2:  
                imagejpeg($nimage, $destination);  
                break;  
                case 3:  
                imagepng($nimage, $destination);  
                break;  
                case 6:  
                imagewbmp($nimage, $destination);  
                //imagejpeg($nimage, $destination);  
                break;  
            }  
      
            //overload l'ancienne file  
            imagedestroy($nimage);  
            imagedestroy($simage);  
        }  
      
    
      return  $destination;
    }  
   
   
} 

