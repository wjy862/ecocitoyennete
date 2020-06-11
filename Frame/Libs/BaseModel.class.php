<?php
//namespace
namespace Frame\Libs;

//abstract basemodel que pour heriter
abstract class BaseModel
{
	//pdo propriétés
	protected $pdo = null;

	//construction function
	public function __construct()
	{
		//PDOWrapper class objet
		$this->pdo = new \Frame\Vendor\PDOWrapper();
	}

	//factory: get a new objet
	public static function getInstance()
	{
		//obtenir le nom que une static fucntion a utlise
		$modelClassName = get_called_class();
		//new a objet
		return new $modelClassName();
	}

	//obtenir une ligne de donnes avec pdo class
	public function fetchOne($where="2>1",$order="id asc")
	{
		
		$sql = "SELECT * FROM {$this->table} WHERE {$where} order by {$order}";
		//return une ligne de donnees
		return $this->pdo->fetchOne($sql);
	}

	//obtenir plusieurs ligne de donnes avec pdo class
	public function fetchAll($ORDER="ORDER BY id DESC")
	{
		
		$sql = "SELECT * FROM {$this->table} $ORDER";
		//exec sql avec pdo return array de n dimensions
		return $this->pdo->fetchAll($sql);
	}

	//supprimer sql
	public function delete($id,$idUser,$date)
	{
		
		$sql = "DELETE FROM {$this->table} WHERE id={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}

	//ajhouter
	public function insert($data)
	{
		//obtenirs des atrributs et values 
		$fields = "";
		$values = "";
		foreach($data as $key=>$value)
		{
			$fields .= "$key,";
			$values .= "'$value',";
		}
		//supprimer le , a la fin
		$fields = rtrim($fields,',');
		$values = rtrim($values,',');
		//sql：INSERT INTO news(title,content,hits) VALUES('title','content','30')
		$sql = "INSERT INTO {$this->table}($fields) VALUES($values)";
                
		//return un boollen
		return $this->pdo->exec($sql);
	}

	//uodate
	public function update($data,$id)
	{
		//comme insert
		$str = "";
		foreach($data as $key=>$value)
		{
			$str .= "{$key}='{$value}',";
		}
		
		$str = rtrim($str,',');
		//SQL:UPDATE news SET title='title',content='content' WHERE id=5
		$sql = "UPDATE {$this->table} SET {$str} WHERE id={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}

	//combien de ligne
	public function rowCount($where="2>1")
	{
		//sql
		$sql = "SELECT * FROM {$this->table} WHERE {$where}";
		//return pdo rowcount
               
		return $this->pdo->rowCount($sql);
	}
}