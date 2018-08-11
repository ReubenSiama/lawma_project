@extends('layouts.head')
@section('title','Employees')
@section('content')
    <div class="panel panel-warning">
        <div class="panel-heading">Employees</div>
        <div class="panel-body">
            <button class="btn btn-success" data-toggle="modal" data-target="#addEmployee">Add Employee</button>
            <hr>
            <label for="item_list">Users:</label>
            <table class="table table-hover">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Role</th>
                    <th>Actions</th>
                </thead>
                <?php $i = 1; ?>
                <tbody>
                    @foreach($users as $user)
                        @include('layouts.partials.user',['user'=>$user,'i'=>$i++])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="addEmployee" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                <form method="POST" class="form-inline" action="/addEmployee">
                    {{ csrf_field() }}
                    <table class="table table-hover">
                        <tr>
                            <td>
                                <label for="price">Role:</label>
                            </td>
                            <td>
                                <select name="role" id="role" class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="name">Name:</label>
                            </td>
                            <td>
                                <input type="text" name="name" class="form-control" id="name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                            <td>
                                <input type="email" name="email" class="form-control" id="email">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phNo">Phone No.:</label>
                            </td>
                            <td>
                                <input type="number" name="phNo" class="form-control" id="phNo">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password:</label>
                            </td>
                            <td>
                                <input type="password" name="password" class="form-control" id="password">
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
@endsection