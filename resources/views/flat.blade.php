@extends('layouts.boolbnb')
 @section('main')
   @foreach ($flats as $flat)
    <p>{{$flat['guest']}}</p>
    <p>{{$flat['address']}}</p>
    <a href="{{route('show.flat', $flat['slug'])}}">Mostra</a>
   @endforeach
 @endsection