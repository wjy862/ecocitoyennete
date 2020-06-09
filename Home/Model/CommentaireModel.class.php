<?php
namespace Home\Model;
Use \Frame\Libs\BaseModel;

class CommentaireModel extends BaseModel
{
	protected $table='Commentaires';
	//plusieurs tableux avec jointures
	public function fetchAllWithJoin($where='3>1 ',$startrow=0,$pagesize=10)
	{
		
		$sql="select c.*, u.nomUser,u.prenomUser,u.mailUser  ";
		$sql.="from (select * from commentaires where idCommentaire not in (SELECT c.idCommentaire as idCommentaire
                FROM commentaires c , manipulercommentaire m 
                WHERE c.idCommentaire=m.idCommentaire and m.idTypeManipulation =3)) c, users u  ";
		$sql.="where c.idUser=u.idUser ";
		$sql.="and ".$where;
		$sql.=" order by c.idCommentaire desc ";
		$sql.="limit {$startrow},{$pagesize}";
		
		return $this->pdo->fetchAll($sql);
	}
        
         //une ligne
          public function fetchOne($where="2>1",$order="idCommentaire asc")
	{
		
		$sql = "SELECT * FROM {$this->table} WHERE {$where} order by {$order}";
		//return une ligne de donnees
		return $this->pdo->fetchOne($sql);
	}
        
        //obtenir plusieurs ligne de donnes avec pdo class
	public function fetchAll($ORDER="ORDER BY idCommentaire DESC")
	{
		
		$sql = "SELECT * FROM {$this->table} $ORDER";
		//exec sql avec pdo return array de n dimensions
		return $this->pdo->fetchAll($sql);
	}
        
//******************supprimer sql , la date est faut maitenant**********************************************************************************************************************************
	public function delete($id,$idUser,$date)
	{
		
		//$sql = "DELETE FROM {$this->table} WHERE idCommentaire={$id}";
                $sql ="INSERT INTO `manipulercommentaire` (`idUser`, `dateC`, `idTypeManipulation`, `idCommentaire`) VALUES 
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
		$sql = "UPDATE {$this->table} SET {$str} WHERE idCommentaire={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}
        
        
}