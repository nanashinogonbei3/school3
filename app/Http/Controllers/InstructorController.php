<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
// 追加
use App\Lesson;
use App\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// パスワードをHash化
use Illuminate\Support\Facades\Hash;



class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param Instructor $instructors インストラクターのモデル
     * @return \Illuminate\Http\Response
     */
    public function index(Instructor $instructors)
    {
        $instructors = Instructor::orderBy('updated_at', 'desc')
            ->Paginate(10);
        return view('instructors.instructor', compact('instructors'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @param Instructor $instructors インストラクターのモデル
     * @return \Illuminate\Http\Response
     */
    protected function create(Instructor $instructor)
    {
        return view('instructors/create', compact('instructor'));
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

        $instructor = new Instructor();
        // ログインユーザーID
        $instructor->fill($request->session()->get('inputs'));

        $inputs = $request->session()->get('inputs');

        $instructor->password = Hash::make($inputs['password']);

        $instructor->save();
        // ログイン画面にリダイレクト
        return redirect()->route('personal');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * @param Instructor $instructors インストラクターのモデル
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructors, $id)
    {

        $instructors = Instructor::find($id);

        // find($id)のインストラクターの講座のリストだけを表示する。
        $lessons = Lesson::where('instructor_id', $id)
            ->orderBy('created_at', 'desc')->Paginate(3);

        return view('instructors.show', compact('instructors', 'lessons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $instructors = Instructor::where(Auth::user()->id);

        $instructor = Instructor::find($request->id);

        return view('instructors.edit', ['instructor' => $instructor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * @param Instructor $instructors インストラクターのモデル
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        // タイムアウトしない
        ini_set("max_execution_time", 0); 
        // パース時間を設定しない
        ini_set("max_input_time", 0); 

        $instructor->id = Auth::user()->id;
        $instructor = Instructor::find($request->id);

        $this->validate($request, Instructor::$rules);

        $form = $request->all();

        // 画像だけを取り除く。
        $form = $request->except(['img']);
        // 画像は storage/images/に一旦保存する処理
        $imagefile = $request->file('img');
        $fileName = $imagefile->getClientOriginalName();
        // 画像の保管先を/public/instructorImg
        $temp_path = $imagefile->storeAs('public/instructorImg', $fileName);

        $data = array(
            'form' => $form,
        );

        $form['img'] = $temp_path;

        $instructor->password = Hash::make($form['password']);

        unset($form['_token']);
        $instructor->fill($form)->save();


        return redirect()->route('mylesson');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインして下さい。'];
        return view('instructors.auth', $param);
    }

    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(
            [
                'email' => $email,
                'password' => $password
            ]
        )) {

            return redirect()->route('mylesson');
            

        } else {
            $msg = 'ログインに失敗しました。';
            return redirect()->route('auth');
        }
    }

    public function mylesson(Request $request)
    {
        if (!empty(Auth::user())) {
            $msg = '
            ' . Auth::user()->last_name . '先生の編集ページ' . ' ';
            // ログインしているインストラクターIDをwhere条件に加える。
            $lessons = Instructor::where(Auth::user()->id);
            

            // ログインユーザーの講座のリストだけを表示する。
            $lessons = Lesson::where('instructor_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                // $lessons = Lesson::where(Auth::user()->id)
                // $lessons = Lesson::orderBy('created_at', 'desc')
                ->Paginate(3);


            //クエリビルダ
            $lessonId = DB::table('lessons')->where('id')->get();

            foreach ($lessonId as $id) {

                $categoryId = DB::select('select * from lesson_categories where lesson_id = :id', $id);
            }
            // 講師テーブルとリレーションしたレッスンを表示
            // 表示するページ
            return view('instructors.personal', compact('lessons', 'msg'));
            

        } else {
            return redirect()->route('auth');
        }
    }

    public function confirm(Request $request, Instructor $instructor)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            // emailは、メールアドレス形式に。
            'email' => 'required | email',
            // パスワードは英数字記号を混合
            'password' => 'required | regex:/^[!-~]+$/',
            // 電話番号は10桁または11桁になります
            'phone_no' => 'required | numeric','digits_between:10,11',
            // 画像ファイルであって、10MB以内、指定のファイル以外はアップロードできません。
            'img' => 'required| image | max:10240 |mimes:jpeg,png,jpg',
            // 文字列、文字数制限15文字以上50文字未満
            'profile' => 'required | string | min:15 | max:150',
            // 文字列、文字数制限15文字以上50文字未満
            'introduction' => 'required | string | min:15 | max:150',
            // 文字列、文字数制限2文字以上15文字未満
            'profession' => 'required | string | min:2 | max:15',
            
        ],

            [
            //氏名 
            'last_name.required' => '氏名を入力してください。',
            'first_name.required' => 'お名前を入力してください。',
            // メールアドレス
            'email.required' => 'メールアドレスを入力してください。。',
            'email.email' => 'メールアドレス形式ではありません。',
            // パスワード
            'password.required' => 'パスワードを入力してください。',
            'password.numeric' => 'パスワードは英数字記号を混合してください。',
            'password.regex' => 'パスワードは英数字記号を混合してください。',
            // 電話番号 
            'phone_no.required' => '電話番号を入力してください。',
            'phone_no.numeric' => '電話番号はハイフンなしで10桁から11桁で入力してください。',
            'phone_no.digits_between' => '電話番号はハイフンなしで10桁から11桁で入力してください。',
            // イメージ画像ファイル
            'img.required' => '画像ファイルを選択してください。',
            'img.image' => '画像ファイルは10メガバイト以下のjpeg,png,jpgファイルを選択してください。',
            'img.max' => '画像ファイルは10メガバイト以下のjpeg,png,jpgファイルを選択してください。',
            'img.mines' => '画像ファイルは10メガバイト以下のjpeg,png,jpgファイルを選択してください。',
            // プロフィール
            'profile.required' => 'プロフィールを入力してください。',
            'profile.string' => 'プロフィールは文字列で15文字以上で150文字以内にしてください。',
            'profile.min' => 'プロフィールは文字列で15文字以上で150文字以内にしてください。',
            'profile.max' => 'プロフィールは文字列で15文字以上で150文字以内にしてください。',
            // 自己紹介
            'introduction.required' => '自己紹介を入力してください。',
            'introduction.string' => '自己紹介は文字列で15文字以上で150文字以内にしてください。',
            'introduction.min' => '自己紹介は文字列で15文字以上で150文字以内にしてください。',
            'introduction.max' => '自己紹介は文字列で15文字以上で150文字以内にしてください。',
            // 職業
            'profession.required' => '職業を入力してください。',
            'profession.string' => '職業は文字列で2文字以上で15文字以内にしてください。',
            'profession.min' => '職業は文字列で3文字以上で15文字以内にしてください。',
            'profession.max' => '職業は文字列で3文字以上で15文字以内にしてください。',

                
        ]);

        // フォームから受け取ったすべてのinputの値を取得
        $input = $request->file('importable');
        $input = new Instructor();


        $input = $request->all();

        // 画像だけを取り除く。
        $input = $request->except(['img']);
        // 画像は storage/images/に一旦保存する処理
        $imagefile = $request->file('img');

        // 画像の保管先を/public/images
        $temp_path = $imagefile->store('public/instructorImg');

        $data = array(
            'input' => $input,
        );
        // $requestされた$input配列に、$temp_pathを、
        // $input['imgカラム']に代入する。
        $input['img'] = $temp_path;
        
        // セッションに値を保存する
        $request->session()->put('inputs', $input);

        //入力内容確認ページのviewに変数を渡して表示
        return view('instructors.confirm', [
            'inputs' => $input,

        ]);
    }

    



    // パスワードにHash(暗号化)するために全カラム
    protected function pwhash(Request $request, Instructor $instructor)
    {
        return Instructor::create([ // UserからInstructorに変更
            'last_name' => $request['last_name'],
            'first_name' => $request['first_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone_no' => $request['phone_no'],
            'img' => $request['img'],
            'profile' => $request['profile'],
            'introduction' => $request['introduction'],
            'profession' => $request['profession'],
        ]);

        return redirect()->route('confirm');
    }
}
