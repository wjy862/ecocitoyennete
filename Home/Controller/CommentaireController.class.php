<?php
namespace Home\Controller;
use Frame\Libs\BaseController;
use \Home\Model\CommentaireModel;
use \Home\Model\AfficheModel;
class commentaireController extends BaseController
{
	public function index()
	{      
                $infoUser=$this->connectezVous();
                $this->smarty->assign('infoUser',$infoUser);
		//subtree classfier
		//$affiches=AfficheModel::getInstance()->typesAffichelist(AfficheModel::getInstance()->fetchAll("order by idAffiche asc"));
                $affiches =AfficheModel::getInstance()->fetchAll("order by idAffiche asc");
		
                // rechercher des affiches
                    //condition de recherche
		$where="3>1 ";
		if(!empty($_REQUEST['idAffiche'])) $where =" idAffiche=".$_REQUEST['idAffiche'];
		if(!empty($_REQUEST['keyword'])) $where.=" and commentaire like '%".$_REQUEST['keyword']."%' ";
		// pages 
		$pagesize=5;
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=commentaireModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idAffiche'])) $params['idAffiche']=$_POST['idAffiche'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];;

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();

		// pages donness
		$commentaires=commentaireModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);

		//smarty afficher et assign valeurs
		$this->smarty->assign(array('commentaires'=>$commentaires,
							'affiches'=>$affiches,
							'str'=>$str));
		
		$this->smarty->display('./Home/View/Index/index.html');
	}

//insere une ligne des données
	public function insert()
	{
                 $this->denyAccess();
		 /*
		$data['idUser']= $_SESSION['uid'];
		$data['idCommentaire']= $_POST['idCommentaire'];
		$data['commentaire']= $_POST['commentaire'];
                $data['description']= $_POST['description'];
		$data['idTypeManipulation']= $_POST['idTypeManipulation'];
                $data['photo']= $_POST['photo'];
                $data['lieu']= $_POST['lieu'];
		//$data['top']= isset($_POST['top']) ? 1:0;
		$data['dateAff']= time();
                */ 
                $data['idUser']= $_SESSION['idUser'];
               // $data['idCommentaire']= $_POST['idCommentaire'];
                $data['commentaire']= $_POST['commentaire'];
                $data['idAffiche']= $_GET['idAffiche'];
                //$data['dateC']= time();

		if (commentaireModel::getInstance()->insert($data))
		{
			$this->jump("reussi","?c=commentaire");
		}else
		{
			$this->jump("pas","?c=commentaire");
		}
	}

	public function delete()
	{
		 $this->denyAccess();
		//supprimer quelle ligne
		$id = $_GET['idCommentaire'];
                $idUser= $_SESSION['idUser'];
                $dateC= time();
		//verifier sql exec
		if(commentaireModel::getInstance()->delete($id,$idUser,$dateC))
		{ 
			$this->jump("id={$id} a reussi de supprimé","?c=commentaire");
		}else
		{
			$this->jump("id={$id} a pas reussi de supprimé","?c=commentaire");
		}
	}



	public function update()
	{
                 $this->denyAccess();
                $id=$_POST['idCommentaire'];
		$data['idUser']= $_SESSION['uid'];
		$data['idAffiche']= $_POST['idAffiche'];
                $data['commentaire']= $_POST['commentaire'];
                $data['description']= $_POST['description'];
		//$data['top']= isset($_POST['top']) ? 1:0;
		//$data['idTypeManipulation']= $_POST['idTypeManipulation'];
		//$data['photo']= $_POST['photo'];
                //$data['lieu']= $_POST['lieu'];
		$data['dateC']= time();

		if (commentaireModel::getInstance()->update($data,$id))
		{
			$this->jump("reussi","?c=commentaire");
		}else
		{
			$this->jump("pas","?c=commentaire");
		}
	}

}





?>