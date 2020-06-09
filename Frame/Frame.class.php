<?php
//namespace
namespace Frame;

//final frame class index ou admin l'utilisent
final class Frame
{
	//run function :utlise sur admin.php et indx.php
	public static function run()
	{
		self::initConfig();		//config proprite
		self::initRoute();		//
		self::initConst();		//
		self::initAutoLoad();	//
		self::initDispatch();	//
	}
	//init config proprite
	private static function initConfig()
	{
		//session start pour tous les pages
		session_start();

		$GLOBALS['config'] = require_once(APP_PATH."Conf".DS."Config.php");
	}

	//init routeur proprite
	private static function initRoute()
	{
		//routeur index
		$p = $GLOBALS['config']['default_platform']; //platform index
		$c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller']; //nom de controller
		$a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action']; //action
		define("PLAT",$p);
		define("CONTROLLER",$c);
		define("ACTION",$a);
	}
	//init view 
	private static function initConst()
	{
		define("VIEW_PATH",APP_PATH."View".DS.CONTROLLER.DS); 
	}

	//class auto load
	private static function initAutoLoad()
	{
		
		spl_autoload_register(function($className){
			//1,index:Home\Controller\StudentController
			//2,chemin reel:./Home/Controller/StudentController.class.php
			//tranfere: de 1 a 2
			$filename = ROOT_PATH.str_replace("\\",DS,$className).".class.php";
			//include chaque class.php
			if(file_exists($filename)) require_once($filename);
		});		
	}

	//inin request distribuer, manupuler quel controller (c),de quelle function(c) dans un platform (admin.php ou index.php)
	private static function initDispatch()
	{
		//nom de class de controller:Home\Controller\StudentController
		$controllerClassName = PLAT."\\"."Controller"."\\".CONTROLLER . "Controller";
		//creer objet de controller class(plat.controller.ccontreoller)(nommer standard)
		$controllerObj = new $controllerClassName();

		//manupuler differentes function ver action index
		$action_name = ACTION;
		$controllerObj->$action_name();
	}
}