<?php
//URLをcakephp_tutorial/post/indexと入力すると
//PostControllerのindexメソッドを実行し、
//index.ctpにデータを送り、それを表示させる
class PostsController extends AppController{
	public $helper=array('Html','Form');
	public $components= array('Flash');
	public function index(){
		$options=array('limit'=>'');

		//setでpostsにPostの中身(postsデータベースの内容)全てとオプションを$postsに代入する
		//配列は$posts[id]['Post'][postsテーブルのカラム名]
		$this->set('posts',$this->Post->find('all',$options));
		//index.ctpで出力する。debug()で表示
	}

//URLをcakephp_tutorial/post/showと入力してshow.ctpを
//表示させる場合、showには引数が設定されているので、
//URLの後ろに"/引数の値"と加えることでその引数で
//showメソッドを実行する

//メッソドの中に$idを定義すると、$_GET['id']と
//同等の結果が取得できる
///posts/show/123 => $idの中身が123と代入される
	public function show($id){
		$post=$this->Post->findById($id);
		$this->set('post',$post);
	}

	public function add(){
		//$_SERVER['REQUEST_METHOD']==='POSTと同じ

		if($this->request->is('post')){
			if($this->Post->save($this->request->data)){
				//保存に成功した時
				$this->Flash->success('新しい項目を追加しました');
				//リダイレクト
				return $this->redirect(array('action'=>'index'));
			}else{
				//保存に失敗した場合
				return $this->Flash->error('保存できませんでした');
			}
		}
	}
}