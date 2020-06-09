<?php
namespace Admin\Controller;
use \Frame\Libs\BaseController;

use \Admin\Model\CategorieModel;
class CategorieController extends BaseController
{
	//afficher inde
	public function index()
	{
		//obetenir donnes

		$categories =CategorieModel::getInstance()->fetchAll("order by idCategorie asc");
		//subtree donnees
		$categories=CategorieModel::getInstance()->categorielist($categories);
		$this->smarty->assign("categories",$categories);
		$this->smarty->display("Index.html");
	} 

	public function add()
	{
		//subtree donnees
		$categories=CategorieModel::getInstance()->categorielist(CategorieModel::getInstance()->fetchAll("order by idCategorie asc"));
		$this->smarty->assign("categories",$categories);
		$this->smarty->display('Add.html');

	}

	public function insert()
	{
		$data['nomCategorie']=$_POST['nomCategorie'];
		//$data['orderby']=$_POST['orderby'];
		$data['parentId']=$_POST['parentId'];
		$id=(int)$_POST['parentId'];
		$name=$_POST['nomCategorie'];
		$where="nomCategorie='{$name}' and parentId={$id};";

		if (CategorieModel::getInstance()->rowCount($where))
		{
			$this->jump("exsité,changez le nom ou parentId","?c=Categorie");

		}

		if(CategorieModel::getInstance()->insert($data))
		{
			$this->jump("reussi","?c=Categorie");
		}else
		{
			$this->jump("pas reussi","?c=Categorie");
		}
	}

		public function delete()
	{
		
		//supprimer quelle ligne
		$idCategorie = $_GET['idCategorie'];
		//verifier sql exec
		if(CategorieModel::getInstance()->delete($idCategorie))
		{ 
			$this->jump("idCategorie={$idCategorie} a reussi de supprimé","?c=Categorie");
		}else
		{
			$this->jump("idCategorie={$idCategorie} a pas reussi de supprimé","?c=Categorie");
		}
	}

	public function edit()
	{
		$idCategorie=$_GET['idCategorie'];

		$categorieOne=CategorieModel::getInstance()->fetchOne($where="idCategorie={$idCategorie}");
		$categories=CategorieModel::getInstance()->categorielist(CategorieModel::getInstance()->fetchAll("order by idCategorie asc"));
		$this->smarty->assign('categories',$categories);
		$this->smarty->assign('categorieOne',$categorieOne);
		
		
		$this->smarty->display('edit.html');
	}

	public function update()
	{
		$idCategorie=$_POST['idCategorie'];
		$data['nomCategorie']=$_POST['nomCategorie'];
		//$data['orderby']=$_POST['orderby'];
		$data['parentId']=$_POST['parentId'];

		if (CategorieModel::getInstance()->update($data,$idCategorie))
		{
			$this->jump("idCategorie={$idCategorie} a reussi de update","?c=Categorie");
		}else
		{
			$this->jump("idCategorie={$idCategorie} a pas reussi de update","?c=Categorie");
		}
	}
}