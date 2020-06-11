<?php
namespace Home\Controller;
use Frame\Libs\BaseController;
use \Home\Model\ArticleModel;
use \Home\Model\CategorieModel;
class ArticleController extends BaseController
{
	public function index() 
	{   
            $infoUser=$this->connectezVous();
                $this->smarty->assign('infoUser',$infoUser);
		//subtree classfier
		$categories=CategorieModel::getInstance()->categorielist(CategorieModel::getInstance()->fetchAll("order by idCategorie asc"));

		// rechercher des articles
                    //condition de recherche
		$where="3>1 ";
		if(!empty($_REQUEST['idCategorie'])) $where =" idCategorie=".$_REQUEST['idCategorie'];
		if(!empty($_REQUEST['keyword'])) $where.=" and titreArticle like '%".$_REQUEST['keyword']."%' ";
                if(!empty($_GET['idArticle'])) $where.=" and idArticle=".$_GET['idArticle'];

		// pages 
		$pagesize=5;
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=ArticleModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idCategorie'])) $params['idCategorie']=$_POST['idCategorie'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];
                  if(!empty($_GET['idArticle'])) $params['idArticle']=$_GET['idArticle'];

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();

		// pages donness
		$articles=ArticleModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);

		//smarty afficher et assign valeurs
		$this->smarty->assign(array('articles'=>$articles,
							'categories'=>$categories,
							'str'=>$str));
		
		$this->smarty->display('articleC.html');
	}
        
        public function indexEvenement() 
	{
                 $infoUser=$this->connectezVous();
                $this->smarty->assign('infoUser',$infoUser);
		//subtree classfier
		$categories=CategorieModel::getInstance()->categorielist(CategorieModel::getInstance()->fetchAll("order by idCategorie asc"));

		// rechercher des articles
                    //condition de recherche
		$where="3>1 ";
		if(!empty($_REQUEST['idCategorie'])) $where =" idCategorie=".$_REQUEST['idCategorie'];
		if(!empty($_REQUEST['keyword'])) $where.=" and titreArticle like '%".$_REQUEST['keyword']."%' ";
                if(!empty($_GET['idArticle'])) $where.=" and idArticle=".$_GET['idArticle'];

		// pages 
		$pagesize=5;
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=ArticleModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idCategorie'])) $params['idCategorie']=$_POST['idCategorie'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];
                 if(!empty($_GET['idArticle'])) $params['idArticle']=$_GET['idArticle'];

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();

		// pages donness
		$articles=ArticleModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);

		//smarty afficher et assign valeurs
		$this->smarty->assign(array('articles'=>$articles,
							'categories'=>$categories,
							'str'=>$str));
		
		$this->smarty->display('evenementC.html');
	}
        
        
     //afficher la page add.html
	public function add()
	{       
                $infoUser=$this->connectezVous();
                $this->smarty->assign('infoUser',$infoUser);
                 $this->denyAccess();
		$categories=CategorieModel::getInstance()->categorielist(CategorieModel::getInstance()->fetchAll("order by idCategorie asc"));
		$this->smarty->assign("categories",$categories);
		$this->smarty->display('articleADD.html');
	}
//insere une ligne des données
	public function insert()
	{
                 $this->denyAccess();
		$data['idUser']= $_SESSION['idUser'];
		$data['idCategorie']= $_POST['idCategorie'];
		//$data['titreArticle']= $_POST['titreArticle'];
                //$data['contenuArticle']= $_POST['contenuArticle'];
                
                $data['titreArticle'] = filter_input(INPUT_POST, 'titreArticle', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['contenuArticle'] = filter_input(INPUT_POST, 'contenuArticle', FILTER_SANITIZE_SPECIAL_CHARS);
		//$data['idTypeManipulation']= $_POST['idTypeManipulation'];
		//$data['top']= isset($_POST['top']) ? 1:0;
		//$data['dateArt']= time();

		if (ArticleModel::getInstance()->insert($data))
		{
			$this->jump("reussi","?c=Index&a=Article");
		}else
		{
			$this->jump("pas","?c=Index&a=Article");
		}
	}

	public function delete()
	{
		 $this->denyAccess();
		//supprimer quelle ligne
		$idArticle = $_GET['idArticle'];
                $idUser= $_SESSION['idUser'];
                $dateArt= time();
		//verifier sql exec
		if(ArticleModel::getInstance()->delete($idArticle,$idUser,$dateArt))
		{ 
			$this->jump("idArticle={$idArticle} a reussi de supprimé","?c=Index&a=article");
		}else
		{
			$this->jump("idArticle={$idArticle} a pas reussi de supprimé","?c=Index&a=article");
		}
	}

	PUBLIC FUNCTION edit()
	{
                $infoUser=$this->connectezVous();
                $this->smarty->assign('infoUser',$infoUser);
		$this->denyAccess();
		$id=$_GET['idArticle'];
		$articles = ArticleModel::getInstance()->fetchOne("idArticle={$id}");
		$categories=CategorieModel::getInstance()->categorielist(CategorieModel::getInstance()->fetchAll("order by idCategorie asc"));
		$this->smarty->assign("categories",$categories);
		$this->smarty->assign("articles",$articles);
		$this->smarty->display("edit.html");
	}

	public function update()
	{       
                $this->denyAccess();
		$id=$_POST['idArticle'];
		$data['idUser']= $_SESSION['idUser'];
		$data['idCategorie']= $_POST['idCategorie'];
                $data['titreArticle'] = filter_input(INPUT_POST, 'titreArticle', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['contenuArticle'] = filter_input(INPUT_POST, 'contenuArticle', FILTER_SANITIZE_SPECIAL_CHARS);
		
		//$data['dateArt']= time();

		if (ArticleModel::getInstance()->update($data,$id))
		{
			$this->jump("reussi","?c=Index&a=Article");
		}else
		{
			$this->jump("pas","?c=Index&a=Article");
		}
	}

}





?>