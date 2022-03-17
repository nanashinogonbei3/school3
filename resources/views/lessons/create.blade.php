@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('confirm')}}" method="post" enctype="multipart/form-data">



                        {{ csrf_field() }}
                        @csrf
                        {{-- レッスン名 --}}
                        <div class="form-group row">
                            <label for="lesson_name" class="col-md-4 col-form-label text-md-right">レッスン名</label>
                            <div class="col-md-6">

                                @if ($errors->has('lesson_name'))
                                    @foreach($errors->get('lesson_name') as $message)
                                    <span class="text-danger">{{ $message }}</span>
                                    @endforeach
                                @endif

                                <input id="lesson_name" type="text" name="lesson_name" class="form-control @error('lesson_name') is-invalid @enderror" value="{{ old('lesson_name') }}">
                            </div>
                        </div>

                        {{-- カテゴリー一覧 --}}
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">カテゴリー</label>
                            <div class="col-md-6">
                                @if ($errors->has('category_id'))
                                    @foreach($errors->get('category_id') as $message)
                                    <span class="text-danger">{{ $message }}</span>
                                    <br>
                                    @endforeach
                                @endif

                            <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" value="{{ old('category_id') }}">
                                @foreach($category_list as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        {{-- 講座の説明 --}}
                        <div class="form-group row">
                            <label for="describe" class="col-md-4 col-form-label text-md-right">講座の説明</label>
                            <div class="col-md-6">

                                @if ($errors->has('describe'))
                                    @foreach($errors->get('describe') as $message)
                                    <span class="text-danger">{{ $message }}</span><br>
                                    @endforeach
                                @endif

                                <input id="describe" type="textarea" name="describe" class="form-control @error('describe') is-invalid @enderror" value="{{ old('describe') }}">
                            </div>
                        </div>

                        {{-- 講座の時間 --}}
                        <div class="form-group row">
                            <label for="lesson_time" class="col-md-4 col-form-label text-md-right">講座の時間</label>
                            <div class="col-md-6">
                            @if ($errors->has('lesson_time'))
                                @foreach($errors->get('lesson_time') as $message)
                                <span class="text-danger">{{ $message }}</span><br>
                                @endforeach
                            @endif


                            
                                <input id="lesson_time" type="text" name="lesson_time" class="form-control @error('lesson_time') is-invalid @enderror" value="{{ old('lesson_time') }}">
                            </div>
                        </div>

                        {{-- 講座の開催日 --}}
                        <div class="form-group row">
                            <label for="event_date" class="col-md-4 col-form-label text-md-right">講座の開催日</label>
                            <div class="col-md-6">
                            @if ($errors->has('event_date'))
                                @foreach($errors->get('event_date') as $message)
                                <span class="text-danger">{{ $message }}</span><br>
                                @endforeach
                            @endif


                            
                                <input id="event_date" type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}">
                            </div>
                        </div>

                        {{-- 参加費 --}}
                        <div class="form-group row">
                            <label for="fee" class="col-md-4 col-form-label text-md-right">講座の費用</label>
                            <div class="col-md-6">

                            @if ($errors->has('fee'))
                                @foreach($errors->get('fee') as $message)
                                <span class="text-danger">{{ $message }}</span><br>
                                @endforeach
                            @endif

                                <input id="fee" type="text" name="fee" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee')}} ">
                            </div>
                        </div>

                        {{-- 画像 --}}
                        <div class="form-group row">
                            <label for="img" class="col-md-4 col-form-label text-md-right">イメージ画像</label>
                            <div class="col-md-6">
                            
                            @if ($errors->has('img'))
                                @foreach($errors->get('img') as $message)
                                <span class="text-danger">{{ $message }}</span><br>
                                @endforeach
                            @endif
                         
                            
                                <input type="file" name="img" accept="image/png, image/jpeg" class="form-control @error('img') is-invalid @enderror" value="{{ old('img') }}">
                            </div>
                        </div>

                        {{-- 定員 --}}
                        <div class="form-group row">
                            <label for="capacity" class="col-md-4 col-form-label text-md-right">定員数</label>
                            <div class="col-md-6">
                            

                            @if ($errors->has('capacity'))
                                @foreach($errors->get('capacity') as $message)
                                <span class="text-danger">{{ $message }}</span><br>
                                @endforeach
                            @endif
                            
                            
                                <input id="capacity" type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <button class="btn btn-primary mr-2 ml-2" type="submit">送信</button>

                            <a href="{{ route('mylesson') }}" class="btn btn-secondary">戻る</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection