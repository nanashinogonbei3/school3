<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// 既存登録画面/register'
Route::post('/register', 'InstructorController@register')->name('register');



// 講師の新規登録
Route::get('instructors/create', 'InstructorController@create')->name('inst_create');
// 講師新規登録（passwordのHash暗号化）pwhash
Route::post('instructors/pwhash', 'InstructorController@pwhash')->name('pwhash');
// 講師の登録確認画面
Route::post('instructors/confirm', 'InstructorController@confirm')->name('inst_confirm');
// 講師の登録
Route::post('instructors/store', 'InstructorController@store')->name('inst_store');


// 講師ログイン後の遷移先
Route::get('instructors/auth', 'InstructorController@getAuth')->name('auth');
Route::post('instructors/auth', 'InstructorController@postAuth')->name('personal');


// 講師の修正(personal.blade.phpから"講師の登録内容編集"ボタンから表示されるedit.blade.php)
Route::get('instructors/edit', 'InstructorController@edit')->name('inst_edit');
// 講師の更新
Route::post('instructors/update', 'InstructorController@update')->name('update');

// 講師一覧
Route::get('instructors/instructors', 'InstructorController@index')->name('instructors');
// 講師詳細
Route::get('instructors/show/{id}', 'InstructorController@show')->name('introduce');





// レッスン一覧
Route::get('lessons', 'LessonController@index')->name('index');
// レッスンリスト
Route::get('lessons/listlesson', 'LessonController@listlesson')->name('listlesson');


// レッスン詳細
Route::get('lessons/show/{id}', 'LessonController@show')->name('show');
//
// レッスン新規作成
Route::get('lessons/create', 'LessonController@create')->name('create');
// レッスン登録確認画面
Route::post('lessons/confirm', 'LessonController@confirm')->name('confirm');
// レッスン登録
Route::post('lessons/store', 'LessonController@store')->name('store');
//
// レッスンの修正(personal.blade.phpから編集ボタンから表示されるedit.blade.php)
Route::get('lessons/edit', 'LessonController@edit')->name('edit');
// レッスン更新
Route::post('lessons/update', 'LessonController@update')->name('update_get');


// レッスン更新後の遷移先 fail名：instructor/personal
Route::get('instructors/mylesson', 'InstructorController@mylesson')->name('mylesson');

// 削除
Route::post('lessons/destroy','LessonController@destroy')->name('del');


// レッスン名の曖昧検索フォーム
Route::get('/lessons/find','LessonController@find')->name('find');


//レッスン・カテゴリー検索
Route::get('/lessons/findcategory1', 'LessonController@findcategory1');
Route::get('/lessons/findcategory2/{id}', 'LessonController@categoryserch');


// アクセス地図
// DB に保存した画像一覧を表示するページ
Route::get('/lessons/img', 'ImageController@index')->name('img');
// アクセス画像ファイル選択フォームを表示するページ
Route::get('/lessons/form', 'ImageController@form');
// アクセス画像投稿フォーム画像保存
Route::post('/image/store', 'ImageController@store')->name('images');