<?php
/**
 * @calling : 概要、sqlite
 * @purpose
 * @date
 * @argment
 * @return
 */

class Lib_sqlite {
	//
	function init($file){
		try{
			// 接続
			$pdo = new PDO('sqlite:' . $file );
			// SQL実行時にもエラーの代わりに例外を投げるように設定
			// (毎回if文を書く必要がなくなる)
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// デフォルトのフェッチモードを連想配列形式に設定 
			// (毎回PDO::FETCH_ASSOCを指定する必要が無くなる)
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;	
		} catch (Exception $e) {
			echo $e->getMessage() . PHP_EOL;
		}
	}
	function exec($pdo, $sql){
		try{
//			$pdo= $this->init("../db1.sqlite");
			$pdo->exec($sql);
		} catch (Exception $e) {
			echo $e->getMessage() . PHP_EOL;
		}
	}
	//
	function find_array($pdo, $sql){
		$dat =array();
		foreach ( $pdo->query($sql) as $row) {
			$dat[] =$row;
		}
		return $dat;
	}
	//
	function test(){
	}
}

/*
$db= new Lib_sqlite();
$pdo = $db->init("../db1.sqlite");
$db->exec("insert into tasks(title, content)values('t1', 'c1')");
*/
function get_sqlitePDO(){
	global $mConfig, $mRequest,  $mUser;
	$db= new Lib_sqlite();
	$pdo = $db->init($mConfig['db_file']);
	return $pdo;
}
//
/*
$pdo = get_sqlitePDO();
$sql = 'SELECT title FROM tasks ORDER BY id';
foreach ( $pdo->query($sql) as $row) {
	print $row['title'] . "\t";
}
*/
