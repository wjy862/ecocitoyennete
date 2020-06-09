<?php
//namespace et referer des class
namespace Home\Model;
use \Frame\Libs\BaseModel;

//DEFINE usermodel vient de basemodel
class UserModel extends BaseModel
{
	
	protected $table = "users";// donnes vient de tableux links de BD
        
        //une ligne
        public function fetchOne($where="2>1",$order="idUser asc")
	{
		
		$sql = "SELECT * FROM {$this->table} WHERE {$where} order by {$order}";
		//return une ligne de donnees
		return $this->pdo->fetchOne($sql);
	}
        
        //obtenir plusieurs ligne de donnes avec pdo class
	public function fetchAll($ORDER="ORDER BY idUser DESC") 
	{
		
		$sql = "SELECT * FROM {$this->table} $ORDER";
		//exec sql avec pdo return array de n dimensions
		return $this->pdo->fetchAll($sql);
	}
        
       //supprimer sql
	public function delete($id,$idUser=0, $date=0)
	{
		
		//$sql = "DELETE FROM {$this->table} WHERE idUser={$id}";
                $sql = "UPDATE {$this->table} SET etat=0 WHERE idUser={$id}";
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
		$sql = "UPDATE {$this->table} SET {$str} WHERE idUser={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}
}