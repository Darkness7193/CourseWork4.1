<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/global-errors.css') }}">


<!-- f(): -->
@if ($errors->any())
    <table class="global-errors" onclick="this.remove()">
        <ul>
            @foreach ($errors->all() as $error)
                <tr>
                    <td>
                        {{ $error }}
                    </td>
                </tr>
            @endforeach
        </ul>
    </table>
@endif

