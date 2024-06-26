@php($ru_roles = [
    'unapproved user' => 'Неодобрен',
    'approved user' => 'Пользователь',
    'admin' => 'Админ',
    'super admin' => 'Супер админ'
])


@props(['user'])
@php($current_role = $user->getRoleNames()->first())
<select class="foreign-cell user-role-select" onfocusout="update_cell_of(this)"
    @cannot("$user" ? "remove role $current_role" : null) disabled @endcan
    @if($user->getRoleNames()->first() === 'super admin') disabled @endif
    >
    @can('assign role unapproved user')
        <option value="unapproved user"> Неодобренный </option>
    @endcan
    @can('assign role approved user')
        <option value="approved user"> Пользователь </option>
    @endcan
    @can('assign role admin')
        <option value="admin"> Админ </option>
    @endcan

    <option value="{{ "{$user->getRoleNames()->first()}" ? $user->getRoleNames()->first() : '' }}" selected="selected"
        hidden="hidden"
    >   {{ "{$user->getRoleNames()->first()}" ? $ru_roles[$user->getRoleNames()->first()] : '' }}
    </option>
</select>
