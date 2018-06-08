@extends('master')

@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Galeria</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('addGaleria') }}">
                            {{ csrf_field() }}
                            <label for="nome" class="col-md-4 control-label">Nome da galeria</label>
                            <div class="col-md-8">
                                <input id="nome" type="text" class="form-control" name="nome" required autofocus>
                            </div>
                            <br><br><br>
                            <label for="descricao" class="col-md-4 control-label">Descrição</label>
                            <div class="col-md-8">
                                <textarea id="descricao" class="form-control" name="descricao"></textarea>
                            </div>
                            <br><br><br><br>
                            <center><input type="image" src="{{asset('/submit.png')}}" alt="Submit Form" style="width:90px; height:35px;"></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection