<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// やりとりするモデルを宣言する
use App\Models\Post;

class PostController extends Controller
{
    // 一覧ページ
    public function index(){
// postsテーブルの全データを新しい順で取得する(ここのPostはモデルのPost→モデルでDBとやり取りしてるから)
        $posts = Post::latest()->get();

        return view('posts.index',compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    // LaravelのRequestクラスを引数として型宣言すると、フォームから送られる内容を取得できる
    public function store(Request $request){//$requestの中にフォームらか送られた内容が入る
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);        

        // ここのPostはモデルのPost、DBのpostsテーブルとよしなにしてくれるMobelクラスを継承したクラス
        $post = new Post();//新規作成する場合はこのコードが必要
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        // saveでpostテーブルにデータを保存する
        $post->save();

        return redirect()->route('posts.index')->with('flash_message','投稿が完了しました。');
    }

    // 詳細ページ  引数の$postには受け取ったPostモデルのインスタンスが自動的に代入
    public function show(Post $post) {
        return view('posts.show',compact('post'));
    }

    //更新ページ
    public function edit(Post $post){
        return view('posts.edit',compact('post'));
    }

    // Requestクラスはフォームから送信された内容を取得・Postクラスはidを一つとる
    // ここで$post = new Post();を書かないのは、引数で$postを受け取った時点でPostのインスタンスをすでに持っているから
    // 新規で作る場合はPostのインスタンスがないから、$post = new Post();を書く必要がある
    public function update(Request $request,Post $post){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->title = $request->input('title');// $request->input('属性の値')で 各フォームの入力内容を取得できる
        $post->content = $request->input('content');
        $post->save();

        // この$postには↑の情報が入っている
        return redirect()->route('posts.show',$post)->with('flash_message','投稿を編集しました。');
    }

    // 削除機能
    public function destroy(Post $post){
        $post->delete();

        return redirect()->route('posts.index')->with('flash_message','投稿を削除しました。');
    }
}
