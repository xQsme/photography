@extends('master')

@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <label for="email" class="col-md-4 control-label">User</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" required autofocus>
                            </div>
                            <br><br><br>
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                            <input type="image" src="{{asset('/login.png')}}" alt="Submit Form" style="width:70px">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection