<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追加
use App\Image;
// 追加
use App\Parent_category;


class ImageController extends Controller
{
    public function index(Image $image)
    {
        //レコード取得
        $images = Image::all(); 

        // レッスン曖昧検索フォーム
        $input = '';

        // カテゴリ検索項目一覧
        $parentCategory = new Parent_category;
        $category_list = $parentCategory->getLists();
        //一覧ページ表示
        return view('lessons.img', compact('images', 'input', 'category_list')); 
    }

    public function form()
    {
        //画像投稿フォーム表示
        return view('lessons.form'); 
    }

    public function store(Request $request)
    {
        //画像の処理
        $image = $request->file('image'); //file()で受け取る
        if ($request->hasFile('image') && $image->isValid()) { //画像があるないで条件分岐
            //storeAsで指定する、一意の画像ファイル名を作成
            $image = $image->getClientOriginalName();
            
        } else {
            return;
        }
        Image::create([
            'image' => $request->file('image')->storeAs('public/map', $image),
        ]);

        //storage/app/public/images(imagesは作られる)に保存
        //保存処理後一覧ページに飛ばす
        return redirect()->route('img');
        
    }
}
