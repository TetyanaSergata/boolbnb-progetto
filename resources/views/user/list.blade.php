@extends('layouts.boolbnb')
 @section('main')
   <div class="welcome">
     <h1>Benvenuto {{Auth::User()->name}}</h1>
     {{-- Rotta crea appartamento --}}
     <a href="{{route('account.flats.create')}}">
       <button class="btn info-btn mb-3 mr-4" type="button" name="button">
         Crea un nuovo appartamento
      </button>
      {{-- Rotta messaggio --}}
      <a href="{{route('account.message.index')}}">
        <button class="btn info-btn mb-3" type="button" name="button">
          Messaggi Ricevuti
       </button>
     </a>
   </div>
   {{-- Lista appartamenti --}}
   <div class="list-flat container">
     <ul>
       @if (!empty($flats[0]))
       @foreach ($flats as $flat)
          <li>
            <div class="flat-box mb-3">
              <div class="box-image">
                <a href="{{route('show.flat', $flat->slug)}}">
                  <img src="{{asset('storage/' . $flat->cover)}}" alt="Copertina della casa">
                </a>
              </div>
              <div class="box-info">
                <a href="{{route('show.flat', $flat->slug)}}">
                  <h4 class="bold">{{$flat->title}}</h4>
                  <p>{{$flat->description}}</p>
                  <span class="bold">{{$flat->price_day}} €</span>
                  <span>a notte</span>
                </a>
              </div>
              <div class="box-button">
                <a href="{{route('account.flats.edit', $flat->slug)}}">
                  <button class="btn info-btn mb-2" type="button" name="button">Modifica</button>
                </a>
                <a href="{{route('account.stat.show', $flat->slug)}}">
                  <button class="btn info-btn mb-2" type="button" name="button">
                  Statistiche
                  </button>
                </a>
                <form action="{{route('account.flats.destroy', $flat->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger mb-2" name="button">Cancella</button>
                </form>
              </div>
            </div>
          </li>
        @endforeach

       @else
           <h2 style="text-align: center">Non hai inserito ancora nessun appartamento</h2>
       @endif
     </ul>
   </div>
 @endsection
