@extends('master')
@section('styles')
    <style>
        body {
            margin-bottom: 100px;
        }
        .col-xs-8>h3, #list{
            margin-top:5px;
            margin-bottom:7px;
        }
        #list{
            margin-left: 15px;
        }
        @media all and (orientation: portrait) {
            body {
                margin-bottom: 170px;
            }
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="col-xs-8 col-xs-offset-2" id="sobre">
            <br>
            <center><img id="image" class="sobre" src="{{asset('/sobre.jpg')}}" alt=""></center>
            <h3>Paulo Silva nasceu em Lourosa, Santa Maria da Feira, em 1969.</h3>
            <h3>Ligado às artes gráficas, começa a fotografar de forma sistemática a partir de 2012, como entusiasta e
                autodidata. Depressa desenvolve o seu próprio estilo. Fotógrafo paisagista e amante da Natureza, tem no
                coração a paixão pelas inebriantes paisagens de Portugal, em especial a Ria de Aveiro.</h3>
            <h3>Fez um curso no Instituto Portugês de Fotografia no Porto, com Nelson D'aires, em 2015.</h3>
            <h3>Conta com vários trabalhos publicados em revistas nacionais e internacionais, sendo alguns já premiados:</h3>
            <h3>
                @foreach($listas as $lista)
                    <li id="list">{{$lista->lista}}
                        @if($auth)
                        <a href="{{route('deleteLista', $lista)}}" onclick="return confirm('Tem a certeza que quer apagar a publicação?')"><img src="{{asset('/delete.png')}}" style="width:15px;"></a>
                        @endif
                    </li>
                @endforeach
                @if($auth)
                    <a href="{{route('addLista')}}"><img src="{{asset('/add.png')}}" style="width:25px"></a>
                @endif
            </h3>
        </div>
        @include('footer')
    </div>
@endsection