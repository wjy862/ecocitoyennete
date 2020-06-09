<?php
namespace Admin\Model;
use \Frame\Libs\BaseModel;

class TypesAfficheModel extends BaseModel
{
	protected $table="typesAffiche";

	//public function typesAffichelist($arrs,$level=1,$idTypeAffiche=0)
	//{
		//$arrs donnes original,$level menu level,$idTypeAffiche menu parent id
		//static $typesAffiches=array();

		//loop donnes original
		//foreach ($arrs as  $value) 
		//{
			//chercher menu suivant($idTypeAffiche)
			//if($value['idTypeAffiche']==$idTypeAffiche)
			//{
			//	$value['level']=$level;
			//	$TypesAffiches[]=$value;
				

			//}
		//}
		//return $TypesAffiches;
	//}
        
        //une ligne
          public function fetchOne($where="2>1",$order="idTypeAffiche asc")
	{
		
		$sql = "SELECT * FROM {$this->table} WHERE {$where} order by {$order}";
		//return une ligne de donnees
		return $this->pdo->fetchOne($sql);
	}
        
        //obtenir plusieurs ligne de donnes avec pdo class
	public function fetchAll($ORDER="ORDER BY idTypeAffiche DESC")
	{
		
		$sql = "SELECT * FROM {$this->table} $ORDER";
		//exec sql avec pdo return array de n dimensions
		return $this->pdo->fetchAll($sql);
	}
        
//******************supprimer sql , la date est faut maitenant**********************************************************************************************************************************
	public function delete($id,$idUser=null,$date=null)
	{
		
		$sql = "DELETE FROM {$this->table} WHERE idTypeAffiche={$id}";
       
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
		$sql = "UPDATE {$this->table} SET {$str} WHERE idTypeAffiche={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}
}