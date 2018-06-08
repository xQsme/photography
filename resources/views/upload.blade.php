@extends('master')

@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload de Fotografias (Galeria {{$galeria->nome}})</div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" name="formUploadFile" action="{{ route('add', $galeria) }}">
                            {{ csrf_field() }}
                            <div class="col-md-9">
                            <label for="file">Selecione os ficheiros:</label>

                                <input id="file" type="file" name="files[]" multiple="multiple" accept="image/*" required/>
                            </div>
                            <input type="image" src="{{asset('/submit.png')}}" alt="Submit Form" style="width:90px; height:35px; margin-top:10px; margin-left:25px;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection