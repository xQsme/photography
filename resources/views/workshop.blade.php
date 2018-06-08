@extends('master')
@section('styles')
<style>
    body {
        margin-bottom: 100px;
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
        <img id="image" src="{{asset('/workshop.jpg')}}" alt="" style="width:100%;">
        <br>
        @include('footer')
    </div>
@endsection