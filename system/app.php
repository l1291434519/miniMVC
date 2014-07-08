<?php
class app{

	public $appPath = '';
	public $themes='templates/';
	public $_dbs=array();
	public $_config=array();

	public function init($config=''){
		$this->appPath = dirname(dirname($config));
		$this->_config = require $config;
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
	
	public function createUrl(){


	}

	public function db($db=''){
		if(empty($db)){
			$db = 'db';
		}
		if(isset($this->_config['dbs'])){
			if (!empty($this->_dbs[$db])) {
				return $this->_dbs[$db];
			}else{


				$this->_dbs[$db] = new medoo($this->_config['dbs'][$db]);
				return $this->_dbs[$db];
			}

		}
		/*if (!empty($this->_db)) {
			return $this->_db;
		}else{

			$this->_db = new medoo(array(
				'database_type' => 'mysql',
				'database_name' => 'bagecms',
				'server' => 'localhost',
				'username' => 'root',
				'password' => '',
				 
				// optional
				'charset' => 'utf8',
			));
			return $this->_db;
		}*/
	}
	
	public function render($tem='',$data=array()){
		if(!empty($data)){
			foreach($data as $k=>$v){
				${$k} = $v;
			}
		}
		include $this->appPath.'/'.$this->themes.$tem;
	}

	public static function autoload($class_name) {
            if (class_exists($class_name)) {
                return;
            }
            $directorys = array(
                'base/',
                'lib/',
            );
            $AppPath = dirname(__FILE__).'/';
            //for each directory
            foreach($directorys as $directory)
            {
                //see if the file exsists
                if(file_exists($AppPath.$directory.$class_name . '.php'))
                {

                    require($AppPath.$directory.$class_name . '.php');
                    //only require the class once, so quit after to save effort (if you got more, then name them something else 
                    return;
                }
                        
            }
    }

}


spl_autoload_register(array('app', 'autoload'));
?>