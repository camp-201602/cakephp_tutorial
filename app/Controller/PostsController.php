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

	public function delete($id){
		if ($this->request->is('get')) {
			//例外処理を投げる。今回はURL直打ち(GETメソッド)では実行できないようにした
            throw new MethodNotAllowedException();
        }


		if($this->Post->delete($id)){
			//削除に成功した場合
			$this->Flash->error('記事'.$id.'を削除しました');
			return $this->redirect(array('action'=>'index'));
		}
	}

	public function edit($id){
		//既存のidを取得
		$post=$this->Post->findById($id);
		$this->Post->id=$id;//これがないと新規データを追加してしまう

		//フォームからの送信をチェック
		if($this->request->is(array('post','put'))){

			//更新処理を試みる
			if($this->Post->save($this->request->data)){
				//更新に成功した場合
				$this->Flash->success('記事'.$id.'を更新しました');
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('記事を更新できませんでした');

			}

		}
		if(!$this->request->data){
			$this->request->data = $post;
		}

	}
}