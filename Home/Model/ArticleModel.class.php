<?php
namespace Home\Model;
Use \Frame\Libs\BaseModel;

class ArticleModel extends BaseModel
{
	protected $table='articles';
	//plusieurs tableux avec jointures
	public function fetchAllWithJoin($where='3>1 ',$startrow=0,$pagesize=10)
	{
		
		$sql="select a.*, u.nomUser,u.prenomUser,u.mailUser ";
		$sql.="from (select * from articles where idArticle not in 
               (SELECT a.idArticle as idArticle
                FROM articles a , manipulerarticle m 
                WHERE a.idArticle=m.idArticle and m.idTypeManipulation =3)) a, users u ";
		$sql.="where a.idUser=u.idUser ";
		$sql.="and ".$where;
		$sql.=" order by a.idArticle desc ";
		$sql.="limit {$startrow},{$pagesize}";
		
		return $this->pdo->fetchAll($sql);
	}
        
         //une ligne
          public function fetchOne($where="2>1",$order="idArticle asc")
	{
		
		$sql = "SELECT * FROM {$this->table} WHERE {$where} order by {$order}";
		//return une ligne de donnees
		return $this->pdo->fetchOne($sql);
	}
        
        //obtenir plusieurs ligne de donnes avec pdo class
	public function fetchAll($ORDER="ORDER BY idArticle DESC")
	{
		
		$sql = "SELECT * FROM {$this->table} $ORDER";
		//exec sql avec pdo return array de n dimensions
		return $this->pdo->fetchAll($sql);
	}
        
//******************supprimer sql , la date est faut maitenant**********************************************************************************************************************************
	public function delete($id,$idUser,$date)
	{
		
		//$sql = "DELETE FROM {$this->table} WHERE idArticle={$id}";
                $sql ="INSERT INTO `manipulerarticle` (`idUser`, `dateArt`, `idTypeManipulation`, `idArticle`) VALUES 
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
		$sql = "UPDATE {$this->table} SET {$str} WHERE idArticle={$id}";
		//return un boollen
		return $this->pdo->exec($sql);
	}
        
        
}