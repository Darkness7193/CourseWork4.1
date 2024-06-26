<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/abstract/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/number-checkbox-input.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table-tools/ordering-menu.css') }}">
    <script src="{{ asset('js/of_component/of_dropdown.js') }}" type="module"></script>
    <script src="{{ asset('js/of_component/of_number-checkbox-input.js') }}" type="module"></script>
    <script src="{{ asset('js/of_ordering-menu/of_order-direction-btn.js') }}" type="module"></script>


@props(['CrudModel', 'view_fields', 'headers'])
<form class="ordering-component vertical-center"
    method="post"
    action="{{ route('set_order', ['previous_route' => Route::current()->getName()]) }}"
>   @csrf
    <div class="dropdown">
        <div class="vertical-center">
            <button class="icon ordering-btn" type="button" onclick="toggle_dropdown_content(this)"></button>
            <button class="icon un-ordering-btn" type="submit" name="action" value="is_un_ordering" onclick="clear_number_checkboxes()"></button>
            <button class="icon ok-ordering-btn" type="submit" name="action" value="is_ordering"></button>
            <div class="ordering-menu dropdown-content number-check-box-container">
                @php($headers = array_merge($headers, ['created_at' => '# по созданию', 'updated_at' => '# по изменению']))
                <table>
                    @foreach($headers as $view_field => $header)
                        <tr>
                            <td class="header-td">{{ $header }}:</td>
                            <td>
                                <button class="icon order-direction-btn"
                                    type="button"
                                    onclick="toggle_ordering_direction(this)">
                                </button>
                            </td>
                            <td><input class="order-direction-input"
                                hidden="hidden"
                                name="{{ $view_field }}_order_direction"
                                value="asc"
                            ></td>

                            <td><input class="number-checkbox-input"
                                name="{{ $view_field }}_order_priority"
                                type="number"
                                readonly
                            ></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</form>
