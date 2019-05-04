<?php
/**
 * @calling : 概要、config設定
 * @purpose
 * @date
 * @argment
 * @return
 */
$mConfig= array();  //config設定
$mUser  = array();  //ログイン、ユーザーdata
$mRequest= array();  //HTTP-request

//config
$mConfig['sys_title'] = 'vuephp1-test';
$mConfig['host_name'] = 'http://localhost';
$mConfig['base_url'] = '/vuephp2';
$mConfig['temp_dir'] = '';     //template パス
$mConfig['mail_temp_dir'] = '';     //mail_template パス
// mail
$mConfig['mail_from_addr'] = 'norep@kuc-arc-f.com';     //mail_from アドレス
//db
$mConfig['db_file'] = '../db1.sqlite';  //sqlite
