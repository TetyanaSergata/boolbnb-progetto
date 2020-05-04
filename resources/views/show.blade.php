@extends('layouts.boolbnb')
@section('head')
<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps.css'/>
<script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
@endsection
@section('main')
<div>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error) <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div> @endif
</div>
<div>
  @if (isset($status)) @dd($status); {{$status}}
  @endif
</div>
<div class="box-cover container" style="background-image: url({{asset('storage/' . $flats->cover)}});">
</div>

{{-- container promo --}}

  @php 
    use Carbon\Carbon;
    $now = Carbon::now();
  @endphp
{{-- controllo utente autenticato e se ha flat suo e se e' vuota la promo --}}
  @if (Auth::check() && Auth::User()->id == $flats->user_id && !empty($flats->promo_service[0]) == false)
  <div class="box-promo container">
  <div>
    <h1>Ciao {{Auth::user()->name}}, hai già pensato di mettere in risalto il tuo appartamento? </h1>
  </div>
  <div>
    <form action="{{route('payment.index')}}" method="post" class="promo-form">
  @csrf
  @method('POST')

      <span>{{$promos[0]->type}}</span>
      <span>{{$promos[0]->price}}€ - 24 ore</span>
      <input type="radio" name="price" class="ciao" id="{{$promos[0]->id}}" value="{{$promos[0]->price}}">



      <span>{{$promos[1]->type}}</span>
      <span>{{$promos[1]->price}}€ per - 72 ore</span>
      <input type="radio" name="price" class="ciao" id="{{$promos[1]->id}}" value="{{$promos[1]->price}}">


      <span>{{$promos[2]->type}}</span>
      <span>{{$promos[2]->price}}€ per - 144 ore</span>
      <input type="radio" name="price" class="ciao" id="{{$promos[2]->id}}" value="{{$promos[2]->price}}">
      <input type="hidden" name="flat_id" value="{{$flats->id}}">

    <input type="submit" value="Vai al pagamento" class="hidden" class="btn btn-primary" id="bottone">
  </div>
  </form>
  </div>
  @endif

  {{-- controllo utente autenticato e se ha flat suo e se non e' vuota la promo --}}
  @if (Auth::check() && Auth::User()->id == $flats->user_id && !empty($flats->promo_service[0]) == true)
    {{-- controlla che sia ancora valida la promo --}}
      @if ($flats->promo_service[0]->pivot->end > $now)
        @php
            $scadenza = ($flats->promo_service[0]->pivot->end);
            $scadenza = new Carbon($scadenza);
            $tempoRimasto = $scadenza->diff($now);
            $giorni = $tempoRimasto->d;
            $ore = $tempoRimasto->h;
            $minuti = $tempoRimasto->i;
            $countdown = 'La tua promozione scade tra ' . $giorni . ' giorni, ' . $ore . ' ore e ' . $minuti . ' minuti.'
        @endphp
        <h1 class="text-center container" style="border: 1px solid #ff385c; padding: 10px; border-radius: 10px;">{{$countdown}}</h1>
      @endif
  @endif

  {{-- controllo utente autenticato e se ha flat suo e se non e' vuota la promo --}}
  @if (Auth::check() && Auth::User()->id == $flats->user_id && !empty($flats->promo_service[0]) == true)
    {{-- controlla che sia scaduta la promo --}}
      @if ($flats->promo_service[0]->pivot->end < $now)
      <div class="box-promo container">
        <div>
          <h1>Ciao {{Auth::user()->name}}, hai già pensato di mettere in risalto il tuo appartamento? </h1>
        </div>
        <div>
          <form action="{{route('payment.index')}}" method="post" class="promo-form">
        @csrf
        @method('POST')
      
            <span>{{$promos[0]->type}}</span>
            <span>{{$promos[0]->price}}€ - 24 ore</span>
            <input type="radio" name="price" class="ciao" id="{{$promos[0]->id}}" value="{{$promos[0]->price}}">
      
      
      
            <span>{{$promos[1]->type}}</span>
            <span>{{$promos[1]->price}}€ per - 72 ore</span>
            <input type="radio" name="price" class="ciao" id="{{$promos[1]->id}}" value="{{$promos[1]->price}}">
      
      
            <span>{{$promos[2]->type}}</span>
            <span>{{$promos[2]->price}}€ per - 144 ore</span>
            <input type="radio" name="price" class="ciao" id="{{$promos[2]->id}}" value="{{$promos[2]->price}}">
            <input type="hidden" name="flat_id" value="{{$flats->id}}">
      
          <input type="submit" value="Vai al pagamento" class="hidden" class="btn btn-primary" id="bottone">
        </div>
        </form>
        </div>
      @endif
  @endif


{{-- container main --}}
<div class="box-desc container ">

  {{-- box info appartamento --}}
  <div class="box-info">
    <h2 id="title">{{$flats->title}}</h2>
    <p>{{$flats->flat_address->street}} {{$flats->flat_address->street_number}} - {{$flats->flat_address->city}}</p>
    <p>{{$flats->description}}</p>
  </div>
  <div class="box-services">
    <ul>
      <li>
        <i class="fas fa-home"></i> Stanze: {{$flats->rooms}}
      </li>
      <li>
        <i class="fas fa-ruler-combined"></i> Metratura: {{$flats->mq}}
      </li>
      <li>
        <i class="fas fa-bed"></i> Posti letto disponibili: {{$flats->beds}}
      </li>
      <li>
        <i class="fas fa-toilet"></i> Bagni disponibili: {{$flats->bathrooms}}
      </li>
      <li>
        <i class="fas fa-dollar-sign"></i> Prezzo per giorno: {{$flats->price_day}}
      </li>
    </ul>
  </div>
</div>
<div>

{{-- container mappa --}}
<div class="box-bottom container">
  <div class="box-map">
    <div id='map' class='map'></div>
  </div>
  {{-- box extra-service --}}
  <div class="box-extraService">
    <div class="extra-service">
        <h2 class="extra-title">Servizi disponibili</h2>
        {{-- ciclo per checkare servizi extra disponibili --}}
        @foreach ($flats->extra_service as $key => $extra)
          <div class='extra-box'>
           <h2>@if($extra->name == 'wifi')
            <span><i class="fas fa-wifi"></i></span>Wifi
            @elseif($extra->name == 'smoking')
            <span><i class="fas fa-smoking"></i></span>Fumatori
            @elseif($extra->name == 'parking')
            <span><i class="fas fa-parking"></i></span>Parcheggio
            @elseif($extra->name == 'swimming_pool')
            <span><i class="fas fa-swimming-pool"></i></span>Piscina
            @elseif($extra->name == 'breakfast')
            <span><i class="fas fa-coffee"></i></span>Colazione
            @elseif($extra->name == 'view')
            <span><i class="fas fa-mountain"></i></span>Vista
            @endif</h2>
          </div>
        @endforeach
    </div>
  </div>
</div>

{{-- se l'utente ha questo appartamento, niente box messaggi --}}
@if (Auth::check() && Auth::User()->id == $flats->user_id)
{{-- container messaggi --}}
@else
  <div class="mex-container">
    <div class="box-message">
      <form action="{{route('message.store')}}" method="POST"> @csrf
        @method('POST')
        <h2>Scrivi al proprietario</h2>
        <div class="form-group">
          <span class="label"><label class='label' for="title">Titolo</label></span>
          <span><input class='input' type="text" name='title' placeholder="Titolo" value="{{old('title')}}"></span>
        </div>
        <div class="form-group">
          <span class="label"><label class='label' for="email">Email</label></span>
          <span><input class='input' type="text" name='email' placeholder="Email"
            value="{{(Auth::user()) ? Auth::user()->email : old('email')}}"></span>
        </div>
        <div class="form-group">
          <span class="label"><label class='label' for="message">Messaggio</label></span>
          <span>
            <textarea class='input' type="text" name='message' placeholder= "Messaggio" value="{{old('message')}}"></textarea>
          </span>
        </div>
        <input type="hidden" name="id" value="{{$flats->id}}">
        <input class='submit' type="submit" value="Submit">
      </form>
    </div>
  </div>

@endif



<script>
  $(document).ready(function () {
    $(document).on('click', '.ciao', function () {
      if ($('#1').is(':checked') || $('#2').is(':checked') || $('#3').is(':checked')) {
        $('#bottone').removeClass('hidden');
        $('#bottone').addClass('submit');
      }
    })
  })
</script>
</div>
{{-- script e input hidden --}}
<input id="flatId" type="hidden" value="{{$flats->id}}">
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps-web.min.js"></script>
@endsection

@section('script')
<script src="{{asset('js/show.js')}}"></script>
@endsection
