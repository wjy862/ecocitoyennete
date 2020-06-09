<?php
//namespace own defined pdo class
namespace Frame\Vendor;
use \PDO;
use \PDOException;

//define final mon propre PDOWrapper class
final class PDOWrapper
{
	//db config
	private $db_type;	//type de db
	private $db_host;	//localhost
	private $db_port;	//port
	private $db_user;	//name
	private $db_pass;	//mot de pass
	private $db_name;	//db name
	private $charset;	//utf8
	private $pdo = null;

	//公共的构造方法
	public function __construct()
	{
		$this->db_type = $GLOBALS['config']['db_type'];//vient de config.conf
		$this->db_host = $GLOBALS['config']['db_host'];
		$this->db_port = $GLOBALS['config']['db_port'];
		$this->db_user = $GLOBALS['config']['db_user'];
		$this->db_pass = $GLOBALS['config']['db_pass'];
		$this->db_name = $GLOBALS['config']['db_name'];
		$this->charset = $GLOBALS['config']['charset'];
		$this->createPDO(); //pdo objet
		$this->setErrMode(); //error mode
	}

	//creer un pdo objet
	private function createPDO()
	{
		try{
			//dsn string
			$dsn = "{$this->db_type}:host={$this->db_host};port={$this->db_port};";
			$dsn .= "dbname={$this->db_name};charset={$this->charset}";

			//pdo class
			$this->pdo = new PDO($dsn, $this->db_user, $this->db_pass);
		}catch(PDOException $e)
		{
			echo "<h2>pas reussi de creer pdo</h2>";
			echo "code de erreur".$e->getCode();
			echo "<br>erruer ligne:".$e->getLine();
			echo "<br>erruer ficher:".$e->getFile();
			echo "<br>erreur information:".$e->getMessage();
			die();
		}
	}

	//set erreur mode
	private function setErrMode()
	{
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	//Encapsulation sql：insert、update、delete、set....
	public function exec($sql)
	{
		try{
			return $this->pdo->exec($sql);
		}catch(PDOException $e)
		{
			$this->showErrMsg($e);
		}
	}

	//une ligne
	public function fetchOne($sql)
	{
		try{
			$PDOStatement = $this->pdo->query($sql);
			return $PDOStatement->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e)
		{
			$this->showErrMsg($e);
		}
	}

	//plusieurs lignes SELECT * FROM student
	public function fetchAll($sql)
	{
		try{
			$PDOStatement = $this->pdo->query($sql);
			return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e)
		{
			$this->showErrMsg($e);
		}
	}

	//combien de lignes
	public function rowCount($sql)
	{
		try{
			$PDOStatement = $this->pdo->query($sql);
			return $PDOStatement->rowCount();
		}catch(PDOException $e)
		{
			$this->showErrMsg($e);
		}		
	}

	//erreur information
	private function showErrMsg($e)
	{
		echo "<h2>sql problem</h2>";
		echo "code de erreur:".$e->getCode();
		echo "<br>dans ligne:".$e->getLine();
		echo "<br>le ficher:".$e->getFile();
		echo "<br>Information:".$e->getMessage();
		die();
	}
}