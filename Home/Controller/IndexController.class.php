<?php
namespace Home\Controller;
use \Frame\Libs\BaseController;

use \Home\Model\CategorieModel;
use \Home\Model\ArticleModel;
use \Home\Model\CommentaireModel;
use \Home\Model\AfficheModel;
use \Home\Model\TypesAfficheModel;
use \Frame\Vendor\Pager;
class IndexController extends BaseController
{
	public function index()
	{
		$infoUser=$this->connectezVous();
                $this->smarty->assign('infoUser',$infoUser);
		$this->smarty->display('index.html');
	}

    //
        	public function ProtectMyUT1()
	{       
                $infoUser=$this->connectezVous();
		//subtree classfier
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
                //$typesAffiches =TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc");
		
                // rechercher des affiches
                    //condition de recherche
		$where="3>1 and idTypeAffiche=1 ";
		//if(!empty($_REQUEST['idTypeAffiche'])) $where =" idTypeAffiche= ".$_REQUEST['idTypeAffiche']." ";
		//if(!empty($_REQUEST['keyword'])) $where.=" and titre like '%".$_REQUEST['keyword']."%' ";
                if(!empty($_SESSION['idUser'])) {
                     $where.=" and affiches.idUser = ".$_SESSION['idUser']." ";
                    
                }else{
                   $where.=" and 3<1 ";
                }
         
                
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
                
                
                
                //if user n'a pas login, il va pas voir les fichiers
               // if(!empty($affiches)) $affiches="Connectez-vous";
               
		//smarty afficher et assign valeurs
		$this->smarty->assign(array('affiches'=>$affiches,
							'infoUser'=>$infoUser,
							'str'=>$str));
		$this->smarty->display('ProtectMyUT1.html');
	}
         //
        	public function  FindMy()
	{
                 $infoUser=$this->connectezVous();
                //subtree classfier
		//$typesAffiches=TypesAfficheModel::getInstance()->typesAffichelist(TypesAfficheModel::getInstance()->fetchAll("order by idTypeAffiche asc"));
                $typesAffiches =TypesAfficheModel::getInstance()->typesAfficheFindMy("order by idTypeAffiche asc");
		 
                // rechercher des affiches
                    //condition de recherche
		$where="3>1 and idTypeAffiche<>1 ";
		if(!empty($_REQUEST['idTypeAffiche']) && $_REQUEST['idTypeAffiche']!=0) $where =" idTypeAffiche= ".$_REQUEST['idTypeAffiche']." ";
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
                
                
                
                //if user n'a pas login, il va pas voir les fichiers
               // if(!empty($affiches)) $affiches="Connectez-vous";
               
		//smarty afficher et assign valeurs
		$this->smarty->assign(array('affiches'=>$affiches,
							'typesAffiches'=>$typesAffiches,
                                                         'infoUser'=>$infoUser,
							'str'=>$str));
		
		$this->smarty->display('FindMy.html');
	}
         //
        	public function Article()
	{       
                     $infoUser=$this->connectezVous();
                  //récuperer une liste des categorie
                //classfier la liste des categorie par son niveaux(différent niveux sou-catégorie)
		$categories=CategorieModel::getInstance()->categorielist(CategorieModel::getInstance()->categorieArticle("order by idCategorie asc"));

		// rechercher des articles 
                    //condition de recherche
		$where="3>1 and idCategorie<>8 ";
             
		if(!empty($_REQUEST['idCategorie'])) $where =" idCategorie=".$_REQUEST['idCategorie'];
              
                if(!empty($_REQUEST['keyword'])) $where.=" and titreArticle like '%".$_REQUEST['keyword']."%' ";
		// pages 
		$pagesize=3;
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=ArticleModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idCategorie'])) $params['idCategorie']=$_POST['idCategorie'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];;

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();

		// une liste des articles
		$articles=ArticleModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);

		//smarty afficher et assign valeurs
		$this->smarty->assign(array('articles'=>$articles,
							'categories'=>$categories,
                                                        'infoUser'=>$infoUser,
							'str'=>$str));  
         
		
		$this->smarty->display('Article.html');
	}
         //
          	public function evenement()
	{
                     $infoUser=$this->connectezVous();
                $where="3>1 and idCategorie=8 ";
                    // pages 
		$pagesize=3;
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$startrow=($page-1)*$pagesize;
		$records=ArticleModel::getInstance()->rowCount($where);
		$params=array('c'=> CONTROLLER,'a'=> ACTION);
		if(!empty($_PREQUEST['idCategorie'])) $params['idCategorie']=$_POST['idCategorie'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];;

		//PAGE OBJET
		$pageobj=new \Frame\Vendor\Pager($records,$pagesize,$page,$params);
		$str=$pageobj->showPage();

		// pages donness
		$articles=ArticleModel::getInstance()->fetchAllWithJoin($where,$startrow,$pagesize);

		//smarty afficher et assign valeurs
		$this->smarty->assign(array('articles'=>$articles,
							'infoUser'=>$infoUser,
							'str'=>$str));  
         
		
		$this->smarty->display('evenement.html');
	}
       //
            	public function Contactus()
	{
		$infoUser=$this->connectezVous();
                $this->smarty->assign(array('infoUser'=>$infoUser));
		$this->smarty->display('Contactus.html');
	}
       

}