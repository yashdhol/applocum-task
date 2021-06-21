@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header p-0">
            <div class="col-md-6 heading" style="float: left"><h2>Users</h2></div>
        </div>
        <div class="card-body">
            <!--<div class="table-responsive">-->
            <table class="table table-striped table-bordered dt-responsive nowrap" id="users_data">
                <thead>
                    <tr>
                        <th>Full Name </th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
            </table>
            <!--</div>-->
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('js/users.js') }}"></script>
@endsection