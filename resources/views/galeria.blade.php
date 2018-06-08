@extends('master')
@section('content')
    @push('master_header')
        <script src="{{asset('/js/jquery.fancybox.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/css/jquery.fancybox.min.css')}}">
    @endpush
    <script type="text/javascript">
        $(document).ready(function() {
            $(".fancybox").fancybox();
            document.getElementById('{{$scroll}}').scrollIntoView();
        });
    </script>
    <div class="container">
        @if($auth)
            <br>
            <center><a href="{{route('addGaleria')}}"><img src="{{asset('/add.png')}}" style="width:70px"></a></center>
        @endif
    @php($num=0)
    @foreach($galerias as $galeria)
        @php($count=0)
        @php(++$num)
        <div id="{{$galeria->nome}}"><center><h2>{{$galeria->nome}}
                    @if($auth)
                        <a href="{{route('add', $galeria)}}"><img src="{{asset('/add.png')}}" style="width:25px"></a>
                        <a href="{{route('edit', $galeria)}}"><img src="{{asset('/edit.png')}}" style="width:25px"></a>
                        @if($num != 1)
                            <a href="{{route('move', $galeria)}}"><img src="{{asset('/up.png')}}" style="width:25px"></a>
                        @endif
                        <a href="{{route('deleteGaleria', $galeria)}}" onclick="return confirm('Tem a certeza que quer apagar a galeria?')"><img src="{{asset('/delete.png')}}" style="width:30px"></a>
                    @endif
                </h2></center>
        </div>
        @foreach($fotos as $foto)
            @if($foto->galeria == $galeria->id)
                 @if($count==0)
                    <div class="col-xs-12" id="separator">
                 @endif
                 @if($auth)
                     <a href="{{route('delete', $foto)}}" onclick="return confirm('Tem a certeza que quer apagar a foto?')"><img id="delete" src="{{asset('/delete.png')}}" style="width:30px;"></a>
                 @endif
                 <a href="/storage/fotos/{{$foto->foto}}" data-fancybox="{{$galeria->nome}}"><img id="image"
                 @if($foto->horizontal)
                    class="horizontal"
                    @php(++$count)
                 @else
                    class="vertical"
                    @php($count=$count+0.5)
                 @endif
                 src="{{asset('/storage/fotos/'.$foto->foto)}}" alt="" style="margin-right:1%;"></a>
                 @if($count > 2.5)
                     </div>
                     @php($count=0)
                 @endif
            @endif
        @endforeach
        @if($count != 0)
            </div>
        @endif
    @endforeach
    </div>
    <br>
@endsection