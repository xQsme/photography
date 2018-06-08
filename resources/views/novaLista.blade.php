@extends('master')

@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Publicação</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('addLista') }}">
                            {{ csrf_field() }}
                            <label for="nome" class="col-md-4 control-label">Publicação:</label>
                            <div class="col-md-6">
                                <textarea id="nome" class="form-control" name="nome" required autofocus></textarea>
                            </div>
                            <input type="image" src="{{asset('/submit.png')}}" alt="Submit Form" style="width:90px; height:35px;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection