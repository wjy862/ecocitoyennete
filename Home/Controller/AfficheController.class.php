<?php
namespace Home\Controller;
use Frame\Libs\BaseController;
use \Home\Model\AfficheModel;
use \Home\Model\TypesAfficheModel;
use \Home\Model\CommentaireModel;
class AfficheController extends BaseController
{
 
	public function indexProtect()
	{       
    
                // rechercher des affiches
                    //condition de recherche
		$where="3>1 ";
		if(!empty($_REQUEST['idCommentaire'])) $where =" idCommentaire= ".$_REQUEST['idCommentaire']." ";
		if(!empty($_REQUEST['keyword'])) $where.=" and titre like '%".$_REQUEST['keyword']."%' ";
                if(!empty($_GET['idAffiche'])){
                    $where.=" and idAffiche=".$_GET['idAffiche'];
                    $commentaires =CommentaireModel::getInstance()->fetchAll( " where ".$where." order by idCommentaire asc");
                }
                if(!empty($_REQUEST['idUser'])) {
                     $where.=" and idUser like '%".$_REQUEST['idUser']."%' ";
                }else{
                   //$where.=" and 3<1 ";
                }
                  
                
		// pages 
		$pagesize=3;  
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=AfficheModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idCommentaire'])) $params['idCommentaire']=$_POST['idCommentaire'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];
                  if(!empty($_GET['idArticle'])) $params['idArticle']=$_GET['idArticle'];

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();

		// pages donness
		$affiches=AfficheModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);
                //if user n'a pas login, il va pas voir les fichiers
                //if(!empty($affiches)) $affiches="Connectez-vous";
               
		//smarty afficher et assign valeurs
		$this->smarty->assign(array('affiches'=>$affiches,
							'commentaires'=>$commentaires,
							'str'=>$str));
		
		$this->smarty->display('./Home/View/Affiche/PNR.html');
	}
        
        
        	public function indexFindMy(){
                    	//subtree classfier
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		
                // rechercher des affiches
                    //condition de recherche
		$where="3>1 ";
		if(!empty($_REQUEST['idTypeAffiche'])) $where =" idTypeAffiche= ".$_REQUEST['idTypeAffiche']." ";
		if(!empty($_REQUEST['keyword'])) $where.=" and titre like '%".$_REQUEST['keyword']."%' ";
                if(!empty($_REQUEST['idAffiche'])) $where.=" and idAffiche=".$_REQUEST['idAffiche'];
                 
		// pages 
		$pagesize=3;  
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=AfficheModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idTypeAffiche'])) $params['idTypeAffiche']=$_POST['idTypeAffiche'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];
                 if(!empty($_GET['idArticle'])) $params['idArticle']=$_GET['idArticle'];

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();

		// pages donness
		$affiches=AfficheModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);

		//smarty afficher et assign valeurs
		$this->smarty->assign(array('affiches'=>$affiches,
							'typesAffiches'=>$typesAffiches,
							'str'=>$str));
		
		$this->smarty->display('./Home/View/Affiche/objet.html');
                    
                }
        
            //afficher la page add.html
	public function addProtect()
	{
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->display('Nouveauxproblemes.html');
	}
        
        
     //afficher la page add.html
	public function addFindMy()
	{
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->display('Nouveauxobjets.html');
	}
//insere une ligne des données
	public function insert()
	{
		$data['idUser']= $_SESSION['idUser'];
		$data['idTypeAffiche']= $_POST['idTypeAffiche'];
		$data['titre']= $_POST['titre'];
                $data['description']= $_POST['description'];
		//$data['idTypeManipulation']= 1;
                //$data['photo']= $_POST['photo'];
                $data['lieu']= $_POST['lieu'];
		//$data['top']= isset($_POST['top']) ? 1:0;
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
                

		if (AfficheModel::getInstance()->insert($data))
		{
			$this->jump("reussi","?c=Index&a=index");
		}else
		{
			$this->jump("pas","?c=Index&a=index");
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
			$this->jump("id={$id} a reussi de supprimé","?c=Index&a=index");
		}else
		{
			$this->jump("id={$id} a pas reussi de supprimé","?c=Index&a=index");
		}
	}

	PUBLIC FUNCTION editProtect()
	{
		$this->denyAccess();
		$id = $_GET['idAffiche'];
		$affiches = AfficheModel::getInstance()->fetchOne("idAffiche={$id}");
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->assign("affiches",$affiches);
		$this->smarty->display("afficheM.html");
	}
        
        PUBLIC FUNCTION editFindMy()
	{
		$this->denyAccess();
		$id = $_GET['idAffiche'];
		$affiches = AfficheModel::getInstance()->fetchOne("idAffiche={$id}");
                $typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
		$this->smarty->assign("typesAffiches",$typesAffiches);
		$this->smarty->assign("affiches",$affiches);
		$this->smarty->display("afficheM.html");
	}

	public function update()
	{
		$id=$_POST['idAffiche'];
		$data['idUser']= $_SESSION['idUser'];
		//$data['idTypeAffiche']= $_POST['idTypeAffiche'];
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
			$this->jump("reussi","?c=Index&a=index");
		}else
		{
			$this->jump("pas","?c=Index&a=indexe");
		}
	}

}





?>