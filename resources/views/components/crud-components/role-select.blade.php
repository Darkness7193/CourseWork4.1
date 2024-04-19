@php($ru_roles = [
    'UnapprovedUser' => 'Неодобренный',
    'User' => 'Пользователь',
    'Admin' => 'Админ'
])


@props(['user'])
<select class="foreign-cell user-role-select" onfocusout="update_cell_of(this)">
    @foreach ($ru_roles as $role => $ru_role)
        <option value="{{ $role }}">{{ $ru_role }}</option>
    @endforeach

    <option value="{{ "{$user->getRoleNames()->first()}" ? $user->getRoleNames()->first() : '' }}" selected="selected"
        hidden="hidden"
    >   {{ "{$user->getRoleNames()->first()}" ? $ru_roles[$user->getRoleNames()->first()] : '' }}
    </option>
</select>
