<?php
//namespace
namespace Frame\Libs;

//BaseController que pour heriter ne peut pas etre new
abstract class BaseController
{
	//smarty objet
	protected $smarty = null;

	//construction function
	public function __construct()
	{
		//new smarty cobjet
		$smarty = new \Frame\Vendor\Smarty();
		//changer left et rignt delimiter
		$smarty->left_delimiter = "<{";
		$smarty->right_delimiter = "}>";
		//define compiledir
		$smarty->setCompileDir(sys_get_temp_dir().DS.'view_c'.DS);
		//viwe dir
		$smarty->setTemplateDir(VIEW_PATH);
		// assigner value au $smarty
		$this->smarty = $smarty;
	}

	//verifier connection
	protected function denyAccess()
	{
		
		if(empty($_SESSION['idUser']))
		{
			$this->jump("Connectez-Vous","?c=User&a=login");
		}		
	}

	//sauter function
	protected function jump($message,$url='?',$time=3)
	{
		echo "<h2>{$message}</h2>";
		header("refresh:{$time};url={$url}");
		die();
	}
}