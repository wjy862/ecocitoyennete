<?php
namespace Admin\Controller;
use Frame\Libs\BaseController;
use \Admin\Model\AfficheModel;
use \Admin\Model\TypesAfficheModel;
class AfficheController extends BaseController
{
    
	public function index()
	{
		//subtree classfier
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		
                // rechercher des affiches
                    //condition de recherche
		$where="3>1 ";
		if(!empty($_REQUEST['idTypeAffiche'])) $where =" idTypeAffiche= ".$_REQUEST['idTypeAffiche']." ";
		if(!empty($_REQUEST['keyword'])) $where.=" and titre like '%".$_REQUEST['keyword']."%' ";
		// pages 
		$pagesize=5;
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=AfficheModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idTypeAffiche'])) $params['idTypeAffiche']=$_POST['idTypeAffiche'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];;

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();
              
		// pages donness
		$affiches=AfficheModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);

		//smarty afficher et assign valeurs
		$this->smarty->assign(array('affiches'=>$affiches,
							'typesAffiches'=>$typesAffiches,
							'str'=>$str));
		
		$this->smarty->display('index.html');
	}
     //afficher la page add.html
	public function add()
	{
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->display('add.html');
	}
//insere une ligne des données
	public function insert()
	{
                $data['idTypeAffiche']= $_POST['idTypeAffiche'];
		$data['idUser']= $_SESSION['idUser'];
		//$data['idAffiche']= $_POST['idAffiche'];
		$data['titre']= $_POST['titre'];
                $data['description']= $_POST['description'];
		//$data['idTypeManipulation']= 1;
                //$data['photo']= $_POST['photo'];
                $data['lieu']= $_POST['lieu'];
		//$data['top']= isset($_POST['top']) ? 1:0;
		//$data['dateAff']= time();
                //get PhotoPath
                if(!empty($_FILES["photo"])){
                $photo=$_FILES["photo"];
            
                $photoObj= new \Frame\Vendor\Photo();
              
                $photoPath=$photoObj->update($photo);
                $data['photo']=$photoPath;
                }else{
                    echo "Photo n'existe pas";
                    die();
                }
               
               

		if (AfficheModel::getInstance()->insert($data))
		{
			$this->jump("reussi","?c=Affiche");
		}else
		{
			$this->jump("pas","?c=Affiche");
		}
	}

	public function delete()
	{
		
		//supprimer quelle ligne
		$id = $_GET['idAffiche'];
                  $idUser= $_SESSION['idUser'];
                $dateAff= time();
		//verifier sql exec
		if(AfficheModel::getInstance()->delete($id,$idUser,$dateAff))
		{ 
			$this->jump("id={$id} a reussi de supprimé","?c=Affiche");
		}else
		{
			$this->jump("id={$id} a pas reussi de supprimé","?c=Affiche");
		}
	}

	PUBLIC FUNCTION edit()
	{
		$this->denyAccess();
		$id = $_GET['idAffiche'];
		$affiches = AfficheModel::getInstance()->fetchOne("idAffiche={$id}");
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->assign("affiches",$affiches);
		$this->smarty->display("edit.html");
	}

	public function update()
	{
		$id=$_POST['idAffiche'];
		$data['idUser']= $_SESSION['idUser'];
		$data['idTypeAffiche']= $_POST['idTypeAffiche'];
                $data['titre']= $_POST['titre'];
                $data['description']= $_POST['description'];
		//$data['top']= isset($_POST['top']) ? 1:0;
		//$data['idTypeManipulation']= $_POST['idTypeManipulation'];
		//$data['photo']= $_POST['photo'];
                $data['lieu']= $_POST['lieu'];
		//$data['dateAff']= time();
                 if(!empty($_FILES["photo"])){
                $photo=$_FILES["photo"];
            
                $photoObj= new \Frame\Vendor\Photo();
              
                $photoPath=$photoObj->update($photo);
                $data['photo']=$photoPath;
                }else{
                    echo "Photo n'existe pas";
                    die();
                }

		if (AfficheModel::getInstance()->update($data,$id))
		{
			$this->jump("reussi","?c=Affiche");
		}else
		{
			$this->jump("pas","?c=Affiche");
		}
	}

}





?>