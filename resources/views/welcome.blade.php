@extends('master')
@section('styles')
<style>
    body {
        margin-bottom: 100px;
    }
    h2 {
        font-size: 20px;
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
        <br>
        @if($auth)
            <center><a href="{{route('editHome')}}"><img src="{{asset('/add.png')}}" style="width:50px"></a>
                <a href="{{route('deleteHome')}}"><img src="{{asset('/delete.png')}}" style="width:50px"></a>
            </center>
        @endif
        @php($count=0)
        @foreach($fotos as $foto)
            @php(++$count)
        @endforeach
        <div class="slideshow-container">
            @foreach($fotos as $foto)
                <div class="mySlides fade">
                    <img id="image" src="{{asset('/storage/fotos/'.$foto->foto)}}" style="width:100%">
                </div>
            @endforeach
        </div>
        <br>
        <div style="text-align:center">
            @foreach($fotos as $foto)
                <span class="dot"></span>
            @endforeach
        </div>

        <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex> slides.length) {slideIndex = 1}
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " active";
                setTimeout(showSlides, 4000); // Change image every 2 seconds
            }
        </script>
        @php($count=0)
        @php($open=0)
        @foreach($galerias as $galeria)
            @if($count==0 && $open==0)
                @php($open=1)
                <div class="col-xs-12">
            @endif
            @foreach($fotosGalerias as $foto)
                @if(!is_null($foto) && $foto->galeria == $galeria->id)
                    @php(++$count)
                    <div class="col-xs-4 col-xs-offset-{{$count}}" id="home">
                        <center><h2>{{$galeria->nome}}</h2></center>
                        <a href="{{ route('galeria', $galeria->id) }}"><img id="image" src="{{asset('/storage/fotos/'.$foto->foto)}}" alt="" style="width:100%"></a>
                        <center><h3>{{$galeria->descricao}}</h3></center>
                    </div>
                    @if($count==2)
                        @php($count=0)
                        @php($open=0)
                        </div>
                    @endif
                    @break
                @endif
            @endforeach
        @endforeach
        @if($open==1)
            </div>
        @endif
        @include('footer')
    </div>
@endsection