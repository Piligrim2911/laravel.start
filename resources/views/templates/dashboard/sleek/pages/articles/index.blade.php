@extends('layouts.dashboard.' . config('settings.dashboard_theme') . '.index')

@section('content')
	<div class="content-block">
		<div class="block-header">
			<h2 class="block-title">Список статей</h2>
			<div>
                <a href="{{ route('dashboard.articles.create') }}" class="btn btn-danger add-button"><i class="fas fa-plus"></i> Добавить статью</a>
            </div>
		</div>
		<div class="block-body">
			<table class="table table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th colspan="4">
                            Список статей
                        </th>
                    </tr>
                    <tr class="col-title">
                        <th class="id">
                            #
                        </th>
                        <th>
                            Название статьи
                        </th>
						<th class="status text-center">
							Статус
						</th>
                        <th class="actions">
                            Действия
                        </th>
                    </tr>
                </thead>
            	<tbody>
					@if(isset($items) && $items->total() > 0)
						@foreach($items as $item)
							@include('templates.dashboard.' . config('settings.dashboard_theme') . '.pages.articles.inc.items-list', array(
                                'item'=>$item
                            ))
						@endforeach
					@else
						<tr>
							<td colspan="4" class="text-center">
								Нет элементов для отображения
							</td>
						</tr>
					@endisset
                </tbody>
			</table>
		</div>
	</div>
@endsection

@section('scripts')
    <script src="{{ secure_asset('/js/resource_actions.js') }}"></script>
@endsection
