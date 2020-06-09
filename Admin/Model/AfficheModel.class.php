<?php
namespace Admin\Model;
Use \Frame\Libs\BaseModel;

class AfficheModel extends BaseModel
{
	protected $table='affiches';
	//plusieurs tableux avec jointures
	public function fetchAllWithJoin($where='3>1 ',$startrow=0,$pagesize=10)
	{
		
		$sql="select a.*, u.nomUser,u.prenomUser,u.mailUser ";
		$sql.="from (select * from affiches where idAffiche not in (SELECT a.idAffiche as idAffiche 
                FROM affiches a , manipuleraffiche m 
                WHERE a.idAffiche=m.idAffiche and m.idTypeManipulation =3)) a, users u 
                where a.idUser=u.idUser ";
		$sql.="and ".$where;
		$sql.=" order by a.idAffiche desc ";
		$sql.="limit {$startrow},{$pagesize}";
		
		return $this->pdo->fetchAll($sql);

	}
        
        
         //une ligne
          public function fetchOne($where="2>1",$order="idAffiche asc")
	{
		
		$sql = "SELECT * FROM {$this->table} WHERE {$where} order by {$order}";
		//return une ligne de donnees
		return $this->pdo->fetchOne($sql);
	}
        
        //obtenir plusieurs ligne de donnes avec pdo class
	public function fetchAll($ORDER="ORDER BY idAffiche DESC")
	{
		
		$sql = "SELECT * FROM {$this->table} $ORDER";
		//exec sql avec pdo return array de n dimensions
		return $this->pdo->fetchAll($sql);
	}
        
//******************supprimer sql , la date est faut maitenant**********************************************************************************************************************************
	public function delete($id,$idUser,$date)
	{
		
		//$sql = "DELETE FROM {$this->table} WHERE idAffiche={$id}";
                $sql ="INSERT INTO `manipuleraffiche` (`idUser`, `dateAff`, `idTypeManipulation`, `idAffiche`) VALUES 
                ('$idUser', '$date', '3', '{$id}')";
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
		$sql = "UPDATE {$this->table} SET {$str} WHERE idAffiche={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}
        
        
}
