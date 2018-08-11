<tr>
    <td>{{ $i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone_no }}</td>
    <td>{{ $user->role->role }}</td>
    <td>
        <form id="delete{{ $user->id }}" action="/deleteUser" method="post">
            <input type="hidden" name="id" value="{{ $user->id }}">
            {{ csrf_field() }}
            <div class="btn-group">
                <button type="button" data-toggle="modal" data-target="#editUser{{ $user->id }}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button>
                <button type="button" onclick="confirm('delete{{ $user->id }}')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
            </div>
        </form>
        <!-- edit user -->
        <div id="editUser{{ $user->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                <form method="POST" class="form-inline" action="/editUser">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <table class="table table-hover">
                        <tr>
                            <td>
                                <label for="price">Role:</label>
                            </td>
                            <td>
                                <select name="role" id="role" class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach($roles as $role)
                                        <option {{ $user->role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="name">Name:</label>
                            </td>
                            <td>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control" id="name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                            <td>
                                <input type="email" value="{{ $user->email }}" name="email" class="form-control" id="email">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phNo">Phone No.:</label>
                            </td>
                            <td>
                                <input type="number" value="{{ $user->phone_no }}" name="phNo" class="form-control" id="phNo">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-success">Save</button>
                </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </td>
</tr>