<?php
class app{
	public $appPath = '';
	public $themes='templates/';
	
	public function init(){
		$this->startSession();
		$this->startLys();
		
	}
	
	public function startSession(){
		if(!isset($_SESSION)){
			session_start();
		}
	}
	
	public function startLys(){
		if (!empty($_GET['ly'])) {
		  $_SESSION['ly'] = trim($_GET['ly']);
		  $_SESSION['new_ly'] = 'jingju|pc|'.trim($_GET['ly']);
		}
	}
	
	public function render($tem='',$data=array()){
		if(!empty($data)){
			foreach($data as $k=>$v){
				${$k} = $v;
			}
		}
		include $this->appPath.$this->themes.$tem;
	}

}

?>