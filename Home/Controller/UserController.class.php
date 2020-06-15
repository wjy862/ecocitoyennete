<?php
//namespace et referer des class
namespace Home\Controller;
use \Frame\Libs\BaseController;
use \Home\Model\UserModel;

//define usecontroller vient de basecontroller
class UserController extends BaseController
{
	//afficher tous les utilisateurs
	public function index()
	{
		
		$this->denyAccess();
		//usemodel class
		$modelObj = UserModel::getInstance();
		//obtenir des donnes de utlisateurs
		$users = $modelObj->fetchAll();
		
		$this->smarty->assign("users",$users);
		$this->smarty->display("./Home/View/Index/index.html"); 
	}

	//afficher view d'ajouter un utilisateur
	public function add()
	{
		
		//$this->denyAccess();
		$this->smarty->display("Inscrire.html");
	}

	//ajouter des donnes vient de form de add.html
	public function insert()
	{

		
		//$this->denyAccess();
		
		$data['mailUser']	= $_POST['mailUser'];
		$data['password']	= md5($_POST['password']);
                $data['nomUser']		= $_POST['nomUser'];
		$data['prenomUser']		= $_POST['prenomUser'];
		//$data['mailUser']		= $_POST['mailUser'];
		$data['idTypeUser']		= $_POST['idTypeUser'];

		//verifier si l'utilisateur est deja exsite mailUser='admin'
		if(UserModel::getInstance()->rowCount("mailUser='{$data['mailUser']}'"))
		{
			$this->jump("mail : {$data['mailUser']}est utlisé","?c=User");
		}

		//les 2 mdp soivent coherent
		if($data['password'] != md5($_POST['confirmpwd']))
		{
			$this->jump("les 2 mot de pass soient cohérents","?c=User");
		}

		//sql exec verifier
		if(UserModel::getInstance()->insert($data))
		{
			$this->jump("reussi","?c=User");
		}else
		{
			$this->jump("pas reussi","?c=User");
		}
	}

	//afficher edit view
	public function edit()
	{
		
		

		//obtenir idUser(modifier quelle ligne ) vient de url
		$idUser = $_GET['idUser'];
		//obtenir utlisateur de tel idUser
		$user = UserModel::getInstance()->fetchOne("idUser={$idUser}");
		
		$this->smarty->assign("user",$user);
		$this->smarty->display("edit.html");
	}

	//update utlisateur
	public function update()
	{
		
		$this->denyAccess();

		//donnes vient de edit.html
		$idUser= $_POST['idUser'];
		$data['password']	= md5($_POST['password']);
                $data['nomUser']		= $_POST['nomUser'];
		$data['prenomUser']		= $_POST['prenomUser'];
		$data['mailUser']		= $_POST['mailUser'];
		$data['idTypeUser']		= $_POST['idTypeUser'];
		
		//il faut 2 fois mdp
		if(!empty($_POST['password']) && !empty($_POST['confirmpwd']))
		{
			//les 2 soivent cohérent
			if($_POST['password']==$_POST['confirmpwd'])
			{
				$data['password'] = md5($_POST['password']);
			}
		}

		//verifier sql exec
		if(UserModel::getInstance()->update($data,$idUser))
			{
				$this->jump("idUser={$idUser} a reussi de update","?c=User");
			}else
			{
				$this->jump("idUser={$idUser}a pas reussi de update","?c=User");
			}
		}

	//supprimer un utilisatuer
	

	//afficher login.html
	public function login()
	{
		$this->smarty->display("Connecter.html");
	}

	//verifier login donnees
	public function loginCheck()
	{
		//obtenir des donnees vient de login.html
		$mailUser	= $_POST['mailUser'];
		$password	= md5($_POST['password']);//coder avec md5
		$verify		= $_POST['verify'];

		//verifier code de verification
                /*
		if(strtolower($verify) != $_SESSION['captcha'])
		{
			$this->jump("code de vérification pas correct！","?c=User&a=login");
		}
                */
                 

		//verifier mdp et nom
		$user = UserModel::getInstance()->fetchOne("mailUser='$mailUser' and password='$password'");
		if(!$user)
		{
			$this->jump("nom ou mot de pass pas correct","?c=User&a=login");
		}

		//verifier status de compte
		//if(empty($user['status']))
		//{
		//	$this->jump("status de compte innormal","?c=User&a=login");
		//}

		//renouveler donnees de ce utlisateur:last_login_ip、last_login_time、login_times
		//$data['last_login_ip'] 		= $_SERVER['REMOTE_ADDR'];
		//$data['last_login_time']	= time();
		//$data['login_times']		= $user['login_times']+1;
		//if(!UserModel::getInstance()->update($data,$user['idUser']))
		//{
		//	$this->jump("pas reussi de update donnee de utlisatuer de cette fois de login","?c=User&a=login");
		//}

		//SESSION
		$_SESSION['idUser']	= $user['idUser'];
		//$_SESSION['mailUser']	= $mailUser;
                //$_SESSION['uid']	= $user['idUser'];
		$_SESSION['mailUser']	= $mailUser;
		
		header("location:./index.php");
	}

	//captcha referer
	public function captcha()
	{
		//objet de cpatcha
		$captcha = new \Frame\Vendor\Captcha();
		//cpacha dans session
		$_SESSION['captcha'] = $captcha->getCode(); 
	}

	//log out
	public function logout()
	{
		//supprimer donnes de session
		unset($_SESSION['mailUser']);
		unset($_SESSION['idUser']);
		//supprimer session ficher
		session_destroy();
		//supprimer sessiom information dans cookie
		setcookie(session_name(),false);
		//revenir au page d'accueil
		header("location:index.php?c=User&a=login");
	}
}