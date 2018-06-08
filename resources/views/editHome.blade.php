@extends('master')

@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Fotografia (Homepage)</div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" name="formUploadFile" action="{{ route('editHome') }}">
                            {{ csrf_field() }}
                            <div class="col-md-9">
                            <label for="file">Selecione o ficheiro:</label>
                                <input id="file" type="file" name="file" accept="image/*" required/>
                            </div>
                            <input type="image" src="{{asset('/submit.png')}}" alt="Submit Form" style="width:90px; height:35px; margin-top:10px; margin-left:25px;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection