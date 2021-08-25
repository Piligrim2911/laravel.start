<tr id="rowID_{{ $item->id }}" class="rows @if($item->deleted_at) deleted @endif">
    <td class="id">
        {{ $item->id }}
    </td>
	<td class="title">
		<a href="{{ route('dashboard.articles.edit', $item->id) }}">{{ $item->title }}</a>
	</td>
	<td class="status text-center">
        @if($item->published)
            <a href="{{ route('dashboard.articles.updateStatus', $item->id) }}" id="status_{{ $item->id }}" data-item-id="{{ $item->id }}" class="updStatus"><i id="stat_{{ $item->id }}" class="far fa-circle published @if($item->deleted_at) disabled @endif"></i></a>
        @elseif(!$item->published)
            <a href="{{ route('dashboard.articles.updateStatus', $item->id) }}" id="status_{{ $item->id }}" data-item-id="{{ $item->id }}" class="updStatus"><i id="stat_{{ $item->id }}" class="far fa-circle unpublished @if($item->deleted_at) disabled @endif"></i></a>
        @endif
	</td>
	<td class="actions text-center">
		@if($item->deleted_at)
			<a href="{{ route('dashboard.articles.restore', $item->id) }}" id="status_{{ $item->id }}" data-item-id="{{ $item->id }}" class="restore d-inline mr-2">
                <i id="stat_{{ $item->id }}" class="icon fas fa-trash-restore"></i>
            </a>
			<a href="{{ route('dashboard.articles.delete', $item->id) }}" data-item-id="{{ $item->id }}" class="delete d-inline">
                <i class="icon far fa-trash-alt"></i>
            </a>
		@else
			<a href="{{ route('dashboard.articles.edit', $item->id) }}" class="d-inline mr-2">
                <i class="icon fas fa-edit"></i>
            </a>
            <a href="{{ route('dashboard.articles.destroy', $item->id) }}" data-item-id="{{ $item->id }}" class="destroy d-inline">
                <i class="icon far fa-trash-alt"></i>
            </a>
		@endif
	</td>
</tr>
