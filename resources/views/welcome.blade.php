@extends('layouts.app')

@section('content')

<div class="row">
    <image-component/>
</div>

<hr>

<div class="row mb-10">
    <div class="col">
        <h5>POST Загрузка</h5>
        <form action="/upload-image" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Изображение</label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input name="src" type="file"
                               class="custom-file-input @error('src') is-invalid @enderror"
                               id="inputGroupFile01"
                               aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Выберите изображение</label>
                    </div>
                </div>
                @error('src')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Название</label>
                <input name="title" type="text"
                       class="form-control mb-3 @error('title') is-invalid @enderror"
                       id="title"
                       placeholder="Название">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="des">Описание</label>
                <textarea name="des" class="form-control mb-3 @error('des') is-invalid @enderror"
                          id="des"
                          placeholder="Описание"></textarea>
                @error('des')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="type" value="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    <div class="col">
        <h5>AJAX Загрузка</h5>
        <upload-image/>
    </div>
</div>
@endsection
