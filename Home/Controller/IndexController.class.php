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
		
		$this->smarty->display('index.html');
	}

    //
        	public function ProtectMyUT1()
	{
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
							//'typesAffiches'=>$typesAffiches,
							'str'=>$str));
		$this->smarty->display('ProtectMyUT1.html');
	}
         //
        	public function  FindMy()
	{
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
							'str'=>$str));
		
		$this->smarty->display('FindMy.html');
	}
         //
        	public function Article()
	{
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
							'str'=>$str));  
         
		
		$this->smarty->display('Article.html');
	}
         //
          	public function evenement()
	{
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
							
							'str'=>$str));  
         
		
		$this->smarty->display('evenement.html');
	}
       //
            	public function Contactus()
	{
		
		$this->smarty->display('Contactus.html');
	}
       

        
        
        
        
       //
        
               	public function Nouveauxproblemes()
	{
		
		$this->smarty->display('Nouveauxproblemes.html');
	}
        
               	public function  Cafeteria()
	{
		
		$this->smarty->display('Cafeteria.html');
	}
        
               	public function PNR()
	{
		
		$this->smarty->display('PNR.html');
	}
        
               	public function RU()
	{
		
		$this->smarty->display('RU.html');
	}
        
               	public function Rapporter()
	{
		
		$this->smarty->display('Rapporter.html');
	}
       
        public function indexMeilleur()
	{
		
		$this->smarty->display('indexMeilleur.html');
	}
       
        
  
       
                
                
                
                
                
                
                
                
                
                
                
                
                
	public function showList()
	{
			//1,links
		$links=LinksModel::getInstance()->fetchAll();
		//2,categorie de artcile
		$categorys=CategoryModel::getInstance()->categoryList(CategoryModel::getInstance()->fetchAllJoin());
		//3,article par mois
		$months=ArticleModel::getInstance()->fetchAllWith();
		//4 rechercher
		$where=" 2>1 ";
		if(!empty($_GET['category_id'])) $where.= " and article.category_id=".$_GET['category_id'];
		if(!empty($_REQUEST['keyword'])) $where.= " and title like '%".$_REQUEST['keyword']."%' ";
		if(!empty($_REQUEST['date'])) 
		{
			$date=$_REQUEST['date'];
			
			
			
			$c=date('Y-m-d',strtotime($date."-01"));
			$d= date("Y-m-d",strtotime("+30 day",strtotime($c)));
			$datedebut=strtotime($c);
			$datefin=strtotime($d);

			$where .=" and article.addate<={$datefin} and  article.addate>={$datedebut} ";
			
			
		}

		//5,pages
		$pagesize	= 30;
		$page		= isset($_GET['page']) ? $_GET['page'] : 1;
		$startrow	= ($page-1)*$pagesize;
		$records	= ArticleModel::getInstance()->rowCount($where);
		$params= array('c'=>CONTROLLER,'a'=>ACTION);
		if(!empty($_GET['category_id'])) $params['category_id']=$_GET['category_id'];
		if(!empty($_REQUEST['keyword'])) $params['keyword']=$_REQUEST['keyword'];
		if(!empty($_REQUEST['date'])) $params['date']=$_REQUEST['date'];
		$pageObj	= new Pager($records,$pagesize,$page,$params);
		$pagestring	= $pageObj->showPage();
		//6,article jointure
		$articles=ArticleModel::getInstance()->fetchAllJoin($where,$startrow,$pagesize);

		$this->smarty->assign(array("links"=>$links,
						"categorys"=>$categorys,
						"months"=>$months,
						"articles"=>$articles,
						'pagestring'=>$pagestring));
		$this->smarty->display("list.html");
	}

	//content :detail de article
	public function content()
	{
		$id=$_GET['id'];
		

		
		ArticleModel::getInstance()->updateRead($id);

		$article=ArticleModel::getInstance()->fetchOneWithJoin($id);

		$prevNext[]=ArticleModel::getInstance()->fetchOne("id<$id","id desc");
		$prevNext[]=ArticleModel::getInstance()->fetchOne("id>$id","id asc");
		$comments = CommentModel::getInstance()->commentList(
			CommentModel::getInstance()->fetchAllWithJoin("$id")
		);
		$this->smarty->assign('article',$article);
		$this->smarty->assign('comments',$comments);
		$this->smarty->assign('prevNext',$prevNext);

		$this->smarty->display("content.html");


	}

	public function send()
	{
		if(empty($_POST['pid']))
		{
			$data['pid']=0;
			$data['article_id'] = $_POST['article_id'];
			$data['content'] = $_POST['content'];
			$data['content'] = $_POST['content'];
			$data['addate']=time();
			if(!empty($_SESSION['uid']))
			{
				$data['user_id'] = $_SESSION['uid'];
			}else
			{
				$data['user_id']=10000;
			}
			if(CommentModel::getInstance()->insert($data))
			{
			$this->jump("c'est bon","?c=Index&a=content&id={$_POST['article_id']}");
			}else
			{
				$this->jump("c'est pas bon","?c=Index&a=content&id={$_POST['article_id']}");
			}


		}else
		{
			$data['pid']=$_POST['pid'];
			$data['article_id'] = $_POST['article_id'];
			$data['content'] = $_POST['content'];
			$data['content'] = $_POST['content'];
			$data['addate']=time();
			if(!empty($_SESSION['uid']))
			{
				$data['user_id'] = $_SESSION['uid'];
			}else
			{
				$data['user_id']=0;
			}
			if(CommentModel::getInstance()->insert($data))
			{
			$this->jump("c'est bon","?c=Index&a=content&id={$_POST['article_id']}");
			}else
			{
				$this->jump("c'est pas bon","?c=Index&a=content&id={$_POST['article_id']}");
			}
		}
	}
}