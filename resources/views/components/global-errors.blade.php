<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/global-errors.css') }}">


@props([])
@if ($errors->any())
    <table class="global-errors" onclick="this.remove()">
        <ul>
            @foreach (array_unique($errors->all()) as $error)
                <tr>
                    <td>
                        {{ $error }}
                    </td>
                </tr>
            @endforeach
        </ul>
    </table>
@endif

