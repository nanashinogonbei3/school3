<?php

namespace App\Http\Controllers;


use App\Lesson;
use App\Instructor;

// 追加
use Illuminate\Support\Facades\DB;
// 追加
use App\Parent_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;



class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Lesson $lessons レッスンのモデル
     * @return \Illuminate\Http\Response
     */

    // トップ・インデックス
    public function index(Lesson $lessons, Request $request)
    {
        $lessons = Lesson::orderBy('updated_at', 'desc')
            ->Paginate(2);
        // 講座カテゴリ検索機能
        // カテゴリ検索項目一覧
        $parentCategory = new Parent_category;
        $category_list = $parentCategory->getLists();

        $input = '';

        return view('lessons.lesson', compact('lessons', 'category_list', 'input'));
    }

    // レッスンリスト一覧
    public function listlesson(Lesson $lessons)
    {
        $lessons = Lesson::orderBy('updated_at', 'desc')
            ->Paginate(5);

        //検索要項を追記
        return view('lessons.listlesson', compact('lessons'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory = new Parent_category;
        // セレクトの最初に「'選択'」を表示する
        $category_list = $parentCategory->getLists()->prepend('選択', '');
        return view('lessons.create', compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // タイムアウトしない
        ini_set("max_execution_time", 0);
        // パース時間を設定しない
        ini_set("max_input_time", 0);

        $lesson = new Lesson();


        $lesson->fill($request->session()->get('input'));
        //fillはlessonsテーブルのカラムにあるもの以外を消してしまうので、
        // category_id は消されて、入っていなかった。だからセッションに保存されているcategory_idを
        // 引っ張ってくる必要があった。↓ // セッションinputに入っているのを変数に入れる。
        // 下で、$input['category_id]を$categoryIdに代入する
        $input = $request->session()->get('input');


        // ログインユーザーID
        $lesson->instructor_id = Auth::user()->id;
        $lesson->save();

        // 中間モデルに値を挿入する。
        $categoryId = $input['category_id'];
        // $lesson.phpファイルのParent_category()メソッドの$categoryId(カテゴリid)をattachメソッドで中間テーブルへ挿入する
        // attachでcategory_idを中間テーブルに代入した。
        $lesson->Parent_category()->attach($categoryId);


        return redirect()->route('mylesson');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * @param Lesson $lessons レッスンのモデル
     * @return \Illuminate\Http\Response
     */

    public function show(Lesson $lessons, $id)
    {
        $lessons = Lesson::find($id);
        return view('lessons.show', compact('lessons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
     * @param Lesson $lessons レッスンのモデル
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Lesson $lesson)
    {
        $lessons = Instructor::where(Auth::user()->id);
        $lesson = Lesson::find($request->id);

        // カテゴリー一覧表示
        $parentCategory = new Parent_category;
        $category_list = $parentCategory->getLists()->prepend('選択', '');

        return view('lessons.edit', compact('lesson', 'category_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * @param Lesson $lessons レッスンのモデル
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        // タイムアウトしない
        ini_set("max_execution_time", 0);
        // パース時間を設定しない
        ini_set("max_input_time", 0);

        $lesson->instructor_id = Auth::user()->id;

        $this->validate($request, Lesson::$rules);
        $lesson = Lesson::find($request->id);

        $form = $request->all();

        // $input変数に、$request(category_idを含んだ全部)を格納する。
        // 下の方175行目で、$categoryId変数に代入し、attach で中間テーブルに挿入する。
        $input = $request->all();

        // 画像だけを取り除く。
        $form = $request->except(['img']);
        // 画像は storage/images/に一旦保存する処理
        $imagefile = $request->file('img');
        // 画像の保管先を/public/images
        $temp_path = $imagefile->store('public/images');


        $form['img'] = $temp_path;
        unset($form['_token']);

        $lesson->fill($form)->save();

        // 中間モデルに値を挿入する。
        $categoryId = $input['category_id'];
        // attachでcategory_idを中間テーブルに代入した。
        $lesson->Parent_category()->attach($categoryId);



        return redirect()->route('mylesson');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $lesson = Lesson::find($request->id)->delete();

        return redirect('instructors/mylesson');
    }




    public function confirm(Request $request)
    {

        $input = new Lesson;

        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate(
            [
                // 文字列、文字数制限3文字以上15文字未満
                'lesson_name' => 'required | string | min:3 | max:15',
                // 選択必須
                'category_id' => 'required ',
                // 文字列、文字数制限5文字以上25文字未満
                'describe' => 'required | string | min:5 | max:25',
                // 整数で最小60分以上最大120かつ数字
                'lesson_time' => 'required | numeric | between:60,120',
                // 日付は今日よりも後の日付にします。
                'event_date' => 'required | date | after:today',
                // 数字、3000円以上10000円未満
                'fee' => 'required | numeric | between:3000,10000',
                // 画像ファイルであって、10MB以内、指定のファイル以外はアップロードできません。
                'img' => 'required | image | max:10240 |mimes:jpeg,png,jpg',
                // 数字、10人以上30人未満
                'capacity'  => 'required | integer | min:10 | max:30',

            ],

            [
                //レッスン名 のバリデーション・エラー
                'lesson_name.required' => 'レッスン名を入力してください。',
                'lesson_name.min' =>  'レッスン名は文字列で3文字以上で15文字以内にしてください。',
                'lesson_name.max' =>  'レッスン名は文字列で3文字以上で15文字以内にしてください。',
                //  カテゴリー
                'category_id.required' => 'カテゴリーを選択してください。',
                //  説明文
                'describe.required'  => 'レッスンの説明文を入力してください。',
                'describe.min'  => 'レッスンの説明文は、文字数5文字以上で25文字以内にしてください。',
                //  レッスンタイム
                'lesson_time.required' => 'レッスン時間を入力してください。',
                'lesson_time.numeric' => 'レッスン時間は60分以上120分以内にしてください。',
                'lesson_time.between' => 'レッスン時間は60分以上120分以内にしてください。',
                //  イベントの日付
                'event_date.required' => 'レッスン開催日の日付を選択してください。',
                'event_date.after' => 'レッスン開催日の日付は今日よりも後の日付にしてください。',
                //  レッスン費用
                'fee.required' => 'レッスン費を入力してください。',
                'fee.between' => '3000円以上10,000円未満にしてください。',
                // イメージ画像ファイル
                'img.required' => '画像ファイルを選択してください。',
                'img.image' => '画像ファイルは10メガバイト以下のjpeg,png,jpgファイルを選択してください。',
                'img.max' => '画像ファイルは10メガバイト以下のjpeg,png,jpgファイルを選択してください。',
                'img.mimes' => '画像ファイルは10メガバイト以下のjpeg,png,jpgファイルを選択してください。',
                // 定員
                'capacity.required' => '定員数を入力してください。',
                'capacity.min' => '定員は10人以上30人以内にしてください。',
                'capacity.max' => '定員は10人以上30人以内にしてください。',
            ]
        );

        //フォームから受け取ったすべてのinputの値を取得
        $input = $request->all();

        // 保存形式がfileで、他と違う画像だけをrequestから取り除く。
        $input = $request->except(['img']);
        // 画像は storage/images/に一旦保存する処理
        $imagefile = $request->file('img');
        // 画像の保管先を/public/images
        $temp_path = $imagefile->store('public/images');
        // $requestされた$input配列に、$temp_pathを、
        // $input['imgカラム']に代入する。
        $input['img'] = $temp_path;

        $request->session()->put('input', $input);

        //入力内容確認ページのviewに変数を渡して表示
        return view('lessons.confirm', [
            'input' => $input,
        ]);
    }



    // 検索 + 検索結果
    // レッスンの検索 lessons/find.blade.php の検索フォーム
    // ・検索結果という、2つの機能を同時に表示する。
    public function find(Request $request)
    {

        $item = Lesson::where('lesson_name', 'LIKE', '%' . $request->query('input') . '%')
            ->orWhere('lesson_time', 'LIKE', '%' . $request->query('input') . '%')
            ->orderBy('lessons.id')->paginate(6);

        // カテゴリ検索項目一覧
        $parentCategory = new Parent_category();
        $category_list = $parentCategory->getLists();

        $param = ['input' => $request->query('input'), 'item' => $item, 'category_list' => $category_list];



        return view('lessons.find', $param);
    }


    // マナベルのアクセス地図表示
    public function access()
    {
        return view('lessons.access');
    }



    // レッスン登録時カテゴリー選択項目
    public function category()
    {
        $category = new Parent_category;
        $categories = $category->getLists()->prepend('選択', '');

        return view('lessons.create', ['categories' => $categories]);
    }


    // lessons/findcategory1.blade.php にある「カテゴリー検索」機能。
    public function findcategory1(Request $request)
    {
        $parentCategory = new Parent_category;
        $category_list = $parentCategory->getLists();


        return view('lessons.findcategory1', compact('category_list'));
    }

    // ↓ lessons/findcategory.blade.php にある「カテゴリー検索」機能。
    public function categoryserch(Request $request)
    {

        if (isset($request->id)) {
            $param = ['id' => $request->id];


            $lessons = DB::table('lessons')
                ->join('lesson_categories', 'lesson_id', '=', 'lessons.id')
                ->select('lessons.id', 'lesson_name', 'describe', 'event_date', 'img')->where('category_id', '=', $request->id)
                ->orderBy('lessons.id')->paginate(6);

            $input = '';

            // カテゴリ検索項目一覧
            $parentCategory = new Parent_category;
            $category_list = $parentCategory->getLists();
        }

        return view('lessons.findcategory2', compact('lessons', 'category_list', 'input'));
    }
}
