<?php
namespace Frame\Vendor;

final class Pager
{
	//PRVATE member proprite
	private $records;	//lignes total
	private $pages;		//page total
	private $pagesize;	//ligne de donnes de une page
	private $page;		//page maintenant
	private $url;		//url
	private $first;		//1e page
	private $last;		//derniere page
	private $prev;		//page precedent
	private $next;		//page suivant

	public function __construct($records,$pagesize,$page,$params=array())
	{
		$this->records	= $records;
		$this->pagesize	= $pagesize;
		$this->pages	= $this->getPages();
		$this->page		= $page;
		$this->url		= $this->getUrl($params); //?c=Article&a=index&page=
		$this->first            = $this->getFirst();//?c=Article&a=index&page=1
		$this->last		= $this->getLast(); //?c=Article&a=index&page=50
		$this->prev		= $this->getPrev(); //?c=Article&a=index&page=5
		$this->next		= $this->getNext();//?c=Article&a=index&page=7
	}

	//url function
	private function getUrl($params=array())
	{
		
		foreach($params as $key=>$value)
		{
			$arr[] = "$key=$value";
		}
		return "?".implode("&",$arr)."&page=";//?c=Article&a=index&page=
	}

	//pages total
	private function getPages()
	{
		return ceil($this->records/$this->pagesize);
	}

	//1e page
	private function getFirst()
	{
		if($this->page==1){
			return "[Première page]";
		}else{
			return "[<a href='{$this->url}1'>Première page</a>]";
		}
	}

	//derniere page
	private function getLast()
	{
		if($this->page==$this->pages){
			return "[Dernière page]";
		}else{
			return "[<a href='{$this->url}{$this->pages}'>Dernière page</a>]";
		}
	}

	//page precedent
	private function getPrev()
	{
		if($this->page==1)
		{
			return "[Précédent]";
		}else
		{
			return "[<a href='{$this->url}".($this->page-1)."'>Précédent</a>]";
		}
	}

	//page suivante
	private function getNext()
	{
		if($this->page==$this->pages)
		{
			return "[Suivant]";
		}else
		{
			return "[<a href='{$this->url}".($this->page+1)."'>Suivant</a>]";
		}
	}

	//afficher 
	public function showPage()
	{
		if($this->pages>1)
		{
			$str = "EN TOTAL:{$this->pages} pages ,  ";
			$str .= "";
			$str .= "&nbsp{$this->first} &nbsp {$this->prev} Mantenant:{$this->page}e page &nbsp{$this->next} &nbsp {$this->last}";
			return $str;
		}else
		{
			return "En total:{$this->pages}";
		}
	}
}