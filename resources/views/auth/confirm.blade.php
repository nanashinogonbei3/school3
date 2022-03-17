<div class="card-text">
    <form method="POST" action="{{ route('user.resister_resister') }}">
        @csrf
        <div class="md-form">
            <label for="last_name">氏名</label>
            {{ $input["last_name"] }}
            <input class="form-control" type="hidden" id="name" name="last_name" required value="{{ $input["last_name"] }}">
        </div>
        <div class="md-form">
            <label for="first_name">名前</label>
            {{ $input["first_name"] }}
            <input class="form-control" type="hidden" id="first_name" name="first_name" required value="{{ $input["first_name"] }}">
        </div>
        <div class="md-form">
            <label for="email">メールアドレス</label>
            {{ $input["email"] }}
            <input class="form-control" type="hidden" id="email" name="email" required value="{{ $input["email"] }}">
        </div>
        <div class="md-form">
            <label for="phone_num">電話番号</label>
            {{ $input["phone_num"] }}
            <input class="form-control" type="hidden" id="phone_num" name="phone_num" required value="{{ $input["phone_num"] }}">
        </div>

        <div class="md-form">
            <label for="password">パスワード</label>
            {{ $input["password"] }}
            <input class="form-control" type="hidden" id="password" name="password" required value="{{ $input["password"] }}">
        </div>

        <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit" name="back">戻って変更する</button>
        <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">確認して登録する</button>
    </form>
</div>
