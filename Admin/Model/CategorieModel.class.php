<?php
namespace Admin\Model;
use \Frame\Libs\BaseModel;

class CategorieModel extends BaseModel
{
	protected $table="categorie";

	public function categorielist($arrs,$level=0,$parentId=0)
	{
		//$arrs donnes original,$level menu level,$parentId menu parent id
		static $categories=array(); 
 
		//loop donnes original
		foreach ($arrs as  $value) 
		{
			//chercher menu suivant($parentId)
			if($value['parentId']==$parentId)
			{
				$value['level']=$level;
				$categories[]=$value;
				//manupuler recuersivite
				$this->categorielist($arrs,$level+1,$value['idCategorie']);

			}
		}
		return $categories;
	}

         //une ligne
          public function fetchOne($where="2>1",$order="idCategorie asc")
	{
		
		$sql = "SELECT * FROM {$this->table} WHERE {$where} order by {$order}";
		//return une ligne de donnees
		return $this->pdo->fetchOne($sql);
	}
        
        //obtenir plusieurs ligne de donnes avec pdo class
	public function fetchAll($ORDER="ORDER BY idCategorie DESC")
	{
		
		$sql = "SELECT * FROM {$this->table} $ORDER";
		//exec sql avec pdo return array de n dimensions
		return $this->pdo->fetchAll($sql);
	}
        
//******************supprimer sql , la date est faut maitenant**********************************************************************************************************************************
	public function delete($id,$idUser=null,$date=null)
	{
		
		$sql = "DELETE FROM {$this->table} WHERE idCategorie={$id}";
       
		//return un boollen
		return $this->pdo->exec($sql);
	} 
        
        	//ajouter
        	public function insert($data)
	{
		//obtenirs des atrributs et values 
		$fields = '';
		$values = '';
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
		$sql = "UPDATE {$this->table} SET {$str} WHERE idCategorie={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}
}