

<!-- f($Storage, $report_storage): -->
<select class="report-component" name="report_storage_id" onchange="this.form.submit()">
    @foreach ($Storage::all() as $storage)
        <option value="{{ $storage->id ?? '' }}">{{ $storage->name }}</option>
    @endforeach

    <option selected="selected" hidden="hidden" value="{{ $report_storage->id }}">
        {{ $report_storage->name }}
    </option>
</select>

