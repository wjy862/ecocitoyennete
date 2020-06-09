<?php
//declarer namespace
namespace Admin\Controller;
use \Frame\Libs\BaseController;

//finale indexController vient de BaseController
final class IndexController extends BaseController
{
	//afficher page daccueil
	public function index()
	{
		// verifier status de connection et afficher index.html
		$this->denyAccess();
		$this->smarty->display("index.html");
	}

	//top fram
	public function top()
	{
		// verifier status de connection
		$this->denyAccess();
		$this->smarty->display("top.html");
	}

	//left
	public function left()
	{
		
		$this->denyAccess();
		$this->smarty->display("left.html");
	}

	//center
	public function center()
	{
		
		$this->denyAccess();
		$this->smarty->display("center.html");
	}

	//main
	public function main()
	{
		
		$this->denyAccess();
		$this->smarty->display("main.html");
	}
}