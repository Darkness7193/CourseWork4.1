<!-- imports: -->
    <script src="{{ asset('js/of_crud-table/submit_changes.js') }}" type="module"></script>


@props(['class'=>'', 'selected_foreign_row'=>null, 'foreign_rows', 'parameters'=>''])
<select class="foreign-cell {{ $class }}" onfocusout="update_cell_of(this)" {{ $parameters }}>
    @foreach ($foreign_rows as $foreign_row)
        <option value="{{ $foreign_row->id ?? '' }}">{{ $foreign_row->name }}</option>
    @endforeach

    <option selected="selected" hidden="hidden" value="{{ $selected_foreign_row->id ?? ''}}">{{ $selected_foreign_row->name ?? '' }}</option>
</select>

