@extends('master')

@section('content')
    <br><br>
    <div class="container">
        @php($count=0)
        @foreach($fotos as $foto)
            @php($count++)
            <a href="{{route('destroyHome', $foto)}}" onclick="return confirm('Tem a certeza que quer apagar a foto?')"><img id="delete" src="{{asset('/delete.png')}}" style="width:30px;"></a>
            <img class="horizontal" id="image" src="{{asset('/storage/fotos/'.$foto->foto)}}" alt="" style="margin-right:1%;">
            @if($count%3==0)
                <br><br>
            @endif
        @endforeach
    </div>
@endsection