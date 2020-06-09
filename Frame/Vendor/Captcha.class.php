<?php
//namespace
namespace Frame\Vendor;

//captcha class
final class Captcha
{
	//private proprite
	private $codelen; 	//length de code
	private $code;		//string
	private $width;		//width
	private $height;	//height
	private $fontsize;	//taille
	private $fontfile;	//ttf ficher
	private $img;		//img resource

	//construction function
	public function __construct($codelen=4,$width=85,$height=22,$fontsize=18)// avec value par default
	{
		$this->codelen 	= $codelen;
		$this->width 	= $width;
		$this->height 	= $height;
		$this->fontsize = $fontsize;
		//ttf chemin
		$this->fontfile = ROOT_PATH."Public".DS."Admin".DS."Images".DS."msyh.ttf"; 

		$this->createCode();	//aleatoire string
		$this->createImg();		//tabluex
		$this->createBg();		//backgroud de tabluex
		$this->createFont();	//ecrire string
		$this->outPut();		//exporter l'image
	}

	//aleatoire string function
	private function createCode()
	{
		$arr1 = array_merge(range('a','z'),range(0,9),range('A','Z'));
		shuffle($arr1); //melange
		$arr2 = array_rand($arr1,4); //obtenir 4 keys
		$str = "";
		foreach($arr2 as $index) //obtenis des values des 4 keys
		{
			$str .= $arr1[$index];
		}
		$this->code = $str;
	}

	// creer backgroud de tabluex
	private function createImg()
	{
		$this->img = imagecreatetruecolor($this->width,$this->height);
	}

	//creer le image
	private function createBg()
	{
		//distribuer des couleurs
		$color1 = imagecolorallocate($this->img,mt_rand(200,250),mt_rand(200,250),mt_rand(200,255));
		//dessiner un rectangle
		imagefilledrectangle($this->img,0,0,$this->width,$this->height,$color1);
		//des 200 point afin de eviter le robot
		for($i=1;$i<=200;$i++){
			$color3 = imagecolorallocate($this->img,mt_rand(0,250),mt_rand(0,250),mt_rand(50,255));
			imagesetpixel($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),$color3);
		}
		
	}

	//ecrire string
	private function createFont()
	{
		$color2 = imagecolorallocate($this->img,mt_rand(0,250),mt_rand(0,250),mt_rand(50,255));		
		imagettftext($this->img,$this->fontsize,0,10,20,$color2,$this->fontfile,$this->code);
	}

	//exporter img
	private function outPut()
	{
		header("content-type:image/png");
		imagepng($this->img);
		imagedestroy($this->img);
	}

	//exporter code function
	public function getCode()
	{
		return strtolower($this->code);
	}
}