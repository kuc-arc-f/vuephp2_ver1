<?php
/**
 * @calling : 概要、ユーザー機能
 * @purpose
 * @date
 * @argment
 * @return
 */
require_once('../include/lib_inc.php');
require_once('../include/user_auth.php');
require_once('../include/user_common.php');
require_once('../include/tasks.php');

//
class User {
	//
	function init(){
		global $mRequest, $mConfig, $mUser;
		$mConfig['temp_dir']         ='./template';
		$mConfig['mail_temp_dir'] ='../data/mail_template';
		//
		session_start();
//var_dump($_SESSION['user'] );
		if(isset($_SESSION['user'])){
			if(isset($_SESSION['user']['id']) ){
				 $mUser= $_SESSION['user'];
			 }
		}
	}
	//
	function exec_function( $req ){
		switch($req['fn']){
            case 'user_top'     : $this->user_top($req); break;
            /* tasks */
			case 'tasks'     : $this->tasks_index($req); break;
            case 'api_tasks'     : $this->api_tasks_index($req); break;
			case 'tasks_create'     : $this->tasks_create($req); break;
            case 'api_tasks_create' : $this->api_tasks_create($req); break;
            case 'test' : $this->test($req); break;
			// 
			default:
				return;
		}
    }
    function test($req){
        $cls = new Tasks();
        $cls->test();		
	}
		/* tasks */
    function tasks_index($req){
        $cls = new Tasks();
        $cls->index();
    }
    function api_tasks_index($req){
        $cls = new Tasks();
        $cls->api_index();
    }
    function tasks_create($req){
        $cls = new Tasks();
        $cls->create();
    }
    function api_tasks_create($req){
        $cls = new Tasks();
//        var_dump($req);
        $cls->api_create($req);
    }
    /* user */
	function user_show($req){
		$cls=new User_auth();
		$cls->user_show($req);	
	}
	//
	function user_update($req){
		$cls=new User_auth();
		$cls->user_update($req);	
	}
	//
	function user_edit($req){
		$cls=new User_auth();
		$cls->user_edit($req);	
	}
	//
	function user_logout($req){
		require_once('../include/user_auth.php');
		$cls=new User_auth();
		$cls->logout($req);
	}
	//
	function user_add( $req ){
		require_once('../include/user_auth.php');
		$cls=new User_auth();
		$cls->add($req);
	}
	//
	function user_add_show( $req ){
		$cls=new User_auth();
		$cls->user_add_show( $req );
	}
	//
	function user_login( $req ){
		require_once('../include/user_auth.php');
		$cls=new User_auth();
		$cls->login($req);
	}
	//
	function login_show(){
		$cls = new Lib_common();
		$tpl['temp_html'] = 'user_login.html';
		$cls->write_html($tpl, "user_wrap_login.html");
	}
	//
	function user_top( $req ){
		$cls=new User_auth();
		$cls->user_top($req);
	}
	//
	// true= check
	function valid_login_page( $func ){
		$ret= true;
		if($func =="user_login"){ 		$ret= false;  }
		if($func =="user_add_show"){ 		$ret= false;  }
		if($func =="user_add"){ 		$ret= false;  }
		return $ret;
    }
    
}

//-------
// main
//-------
global $mConfig, $mRequest,  $mUser;

$cls =new User();
$cls->init();
//exit();
//
if(isset($_REQUEST)){ $mRequest=$_REQUEST; }
$aut =new User_auth();

/*
if(isset($mRequest['fn'])){
    if($cls->valid_login_page($mRequest['fn'])==true){
        if($aut->check_login()==false){
            $cls->login_show();
            exit();
        }		
    }
}
*/

//if(isset($_REQUEST)){ $mRequest=$_REQUEST; }
if(isset($mRequest['fn'])){
	$cls->exec_function($mRequest ) ;
	exit();
}
//
$cls->user_top(null);


