@extends('layouts.dashboard.' . config('settings.dashboard_theme') . '.index')

@section('content')
	<div class="content-block">
		<div class="block-header">
			<h2 class="block-title">Новая статья</h2>
		</div>
		<div class="block-body">
			<form id="formContent" action="{{ route('dashboard.articles.store') }}" data-action-index="{{ route('dashboard.articles.index') }}" method="POST">
	            @csrf
	            <div class="post">
	                <div class="form-group">
	                    <label for="title">Название статьи</label>
	                    <input id="title" type="text" name="title" class="form-control">
	                </div>
                    <div class="form-group">
                        <label for="announce">Анонс</label>
                        <textarea id="announce" name="announce" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Текст статьи</label>
                        <textarea id="content" name="content" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="preview_image">Изображение / превью</label>
                        <div class="input-group">
                            <input id="preview_image" type="text" name="preview_image" class="form-control" placeholder="Выберите изображение" aria-label="Выберите изображение" aria-describedby="button-select-image">
                            <button class="btn btn-primary" type="button" id="button-select-image">Выбрать изображение</button>
                        </div>
                    </div>
	                <div class="form-group">
	                    <label for="published">Параметры публикации</label>
	                    <select name="published" class="form-control" id="published">
	                        <option value="0">Не опубликован</option>
	                        <option value="1">Опубликован</option>
	                    </select>
	                </div>
	                <div class="form-group">
	                    <input type="hidden" name="id" value="0">
	                </div>
	            </div>
	        </form>
	        <div class="form-group">
	            <button id="save-close" class="btn btn-primary">Сохранить и закрыть</button>
	            <button id="save" class="btn btn-primary">Сохранить</button>
	            <button id="close" class="btn btn-secondary">Отмена</button>
	        </div>
		</div>
	</div>
@endsection

@section('scripts')
    <script src="{{ secure_asset('/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ secure_asset('/js/resource_actions.js') }}"></script>
@endsection
