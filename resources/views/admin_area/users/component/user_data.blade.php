@isset($users)
    @foreach($users as $user)
        <tr>
            <td>
                <div class="table-data__info">
                    <h6>{{$user->name}}</h6>
                    <span>
                <a href="#">{{$user->email}}</a>
            </span>
                </div>
            </td>
            <td>
                <span class="role @if($user->role == 'admin'){{__('admin')}}@else{{__('user')}}@endif">{{$user->role}}</span>
            </td>
            <td>
                @if($user->role != 'admin')
                    <div class="rs-select2--trans rs-select2--sm">
                        <form action="" method="post" id="user-{{$user->id}}">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <select class="js-select2" name="access" onchange="accses_user({{$user->id}},'{{route('admin.access')}}')">
                                <option value="1" @if($user->access == 1) {{__('selected')}} @endif >Registered</option>
                                <option value="0" @if($user->access == 0) {{__('selected')}} @endif >Banned</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </form>
                    </div>
                @endif
            </td>
            <td>
                @if($user->moderators != 'super_admin')
                    <div class="rs-select2--trans rs-select2--sm">
                        <form action="" method="post" id="user-moderators-{{$user->id}}">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <select class="js-select2" name="moderators" onchange="moderators_user({{$user->id}},'{{route('admin.moderators')}}')">
                                <option value="admin" @if($user->moderators == 'admin') {{__('selected')}} @endif >Moderators</option>
                                <option value="user" @if($user->moderators == 'user') {{__('selected')}} @endif >User</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </form>
                    </div>
                @endif
            </td>
        </tr>
    @endforeach
@endisset