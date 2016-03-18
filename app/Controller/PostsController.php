<?php

class PostsController extends AppController{
	public $helper=array('Html','Form');
	public function index(){
		$options=array('limit'=>'');
		$this->set('posts',$this->Post->find('all',$options));
	}
	//メッソドの中に$idを定義すると、$_GET['id']と
	//同等の結果が取得できる
	///posts/show/123 => $idの中身が123と代入される
	public function show($id){
		$post=$this->Post->findById($id);
		$this->set('post',$post);
	}
}