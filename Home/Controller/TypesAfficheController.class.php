<?php
namespace Admin\Controller;
use \Frame\Libs\BaseController;

use \Admin\Model\TypesAfficheModel;
class TypesAfficheController extends BaseController
{
	//afficher inde
	public function index()
	{
		//obetenir donnes

		$typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		//subtree donnees
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist($typesAffiches);
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->display("./Home/View/Index/index.html");
	}

	public function add()
	{
		//subtree donnees
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->display('Add.html');

	}

	public function insert()
	{
		$data['nomTypeAffiche']=$_POST['nomTypeAffiche'];
                //$data['orderby']=$_POST['orderby'];
		//$data['pid']=$_POST['pid'];
		//$id=(int)$_POST['pid'];
		$name=$_POST['nomTypeAffiche'];
		$where="nomTypeAffiche='{$name}' ;";

		if (TypesAfficheModel::getInstance()->rowCount($where))
		{
			$this->jump("exsité,changez le nom ","?c=TypesAffiche");

		}

		if(TypesAfficheModel::getInstance()->insert($data))
		{
			$this->jump("reussi","?c=TypesAffiche");
		}else
		{
			$this->jump("pas reussi","?c=TypesAffiche");
		}
	}

		public function delete()
	{
		
		//supprimer quelle ligne
		$id = $_GET['idTypeAffiche'];
		//verifier sql exec
		if(TypesAfficheModel::getInstance()->delete($id))
		{ 
			$this->jump("id={$id} a reussi de supprimé","?c=TypesAffiche");
		}else
		{
			$this->jump("id={$id} a pas reussi de supprimé","?c=TypesAffiche");
		}
	}

	public function edit()
	{
		$id=$_GET['idTypeAffiche'];

		$typesAfficheOne=TypesAfficheModel::getInstance()->fetchOne($where="idTypeAffiche={$id}");
                //$typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypesAffiche asc"));
		//$this->smarty->assign('typesAffiches',$typesAffiches);
		$this->smarty->assign('typesAfficheOne',$typesAfficheOne);
		
		
		$this->smarty->display('edit.html');
	}

	public function update()
	{
		$id=$_POST['idTypeAffiche'];
		$data['nomTypeAffiche']=$_POST['nomTypeAffiche'];
		//$data['orderby']=$_POST['orderby'];
		//$data['pid']=$_POST['pid'];

		if (TypesAfficheModel::getInstance()->update($data,$id))
		{
			$this->jump("id={$id} a reussi de update","?c=TypesAffiche");
		}else
		{
			$this->jump("id={$id} a pas reussi de update","?c=TypesAffiche");
		}
	}
}