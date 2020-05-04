@section('head')
<link rel='stylesheet' type='text/css'
    href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps.css' />
@endsection

@extends('layouts.boolbnb')
@section('main')
<form action="{{route('account.flats.store')}}" method="POST" enctype='multipart/form-data'>
  {{-- token generator --}}
    @csrf
    @method('POST')
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div> 
{{-- container top --}}
    <div class="container cont-create">
        <div class="row">
            <div class= "col-lg-6 col-md-12">
                <div class="row">
                    <div class= "col-4">
                        <div class="form-group form-box">
                            <span class="label"><label for="title">Titolo</label></span>
                            <span><input type="text" name="title" placeholder="Titolo" value="{{old('title')}}"></span>
                        </div>
            
                        <div class="form-group form-box">
                            <span class= "label"><label for="street">Via</label></span>
                            <span><input class="street" type="text" name="street" placeholder="Via" value="{{old('street')}}"></span>
                        </div>
                    </div>
                    <div class= "col-4">
                        <div class="form-group form-box">
                            <span class= "label"><label for="street_number">Civico</label></span>
                            <span><input class="street-number" type="text" name="street_number" placeholder="Civico" value="{{old('street_number')}}"></span>
                        </div>
                        <div class="form-group form-box">
                            <span class= "label"><label for="city">Città</label></span>
                            <span><input class="city" type="text" name="city" placeholder="Città" value="{{old('city')}}"></span>
                        </div>
                    </div>
                    <div class= "col-4">
                        <div class="form-group form-box">
                            <span class= "label"><label for="zip_code">Cap</label></span>
                            <span><input class="cap" type="text" name="zip_code" placeholder="Cap" value="{{old('zip_code')}}"></span>
                        </div>
            
                        <input type="button" class="btn btn-primary map-button" value="Controlla indirizzo">
                    </div>
                        
                    </div>
                </div>
                <div class= "col-lg-6 col-md-12">
                    <div class="hide-map-box" id= "map-map">
                        <div id='map' class='map'></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    {{-- container middle --}}
    <div class="container cont-create">
        <div class="row">
            <div class= "col-lg-6 col-md-12">
                <div class= "row">
                    <div class="col-6">
                        <div class="form-group form-box">
                            <span class= "label"><label for="rooms">Numero stanza</label></span>
                            <span><input type="number" name="rooms" placeholder="Numero stanza" value="{{old('rooms')}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label"><label for="mq">Metri quadri</label></span>
                            <span><input type="text" name="mq" placeholder="Metri quadri" value="{{old('mq')}}"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-box">
                            <span class= "label"><label for="guest">Numero ospiti</label></span>
                            <span><input type="number" name="guest" placeholder="Numero ospiti" value="{{old('guest')}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label"><label for="description">Descrizione</label></span>
                            <span><input type="text" name="description" placeholder="Descrizione" value="{{old('description')}}"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class= "col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group form-box">
                            <span class= "label"><label for="price_day">Prezzo giornaliero</label></span>
                            <span><input type="text" name="price_day" placeholder="Prezzo giornaliero" value="{{old('price_day')}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label"><label for="bathrooms">Numero bagni</label></span>
                            <span><input type="number" name="bathrooms" placeholder="Numero bagni" value="{{old('bathrooms')}}"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-box">
                            <span class= "label"><label for="beds">Numero di Letti</label></span>
                            <span><input type="number" name="beds" placeholder="Numero letti" value="{{old('beds')}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label">
                                <label class= "cover-custom" for="cover">
                                    <input id="cover" type="file" name='cover' accept='image/*'>
                                    Scegli l'immagine di copertina
                                </label>
                                
                            </span>
                            {{-- <input type="file" name='cover' accept='image/*'> --}}
                        </div>
                        <div class="form-group form-box hide-flat">
                            <label for="lat"></label>
                            <input class="lat" name="lat" type="hidden" value="">
                        </div>
                
                        <div class="form-group form-box hide">
                            <label for="long"></label>
                            <input class="long" name="long" type="hidden" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- container bottom --}}
    <div class="container cont-create bottom-container">
        <div class="row">
            <div class= "col-lg-6 col-md-12">
                <div class= "bottom-box hide-flat">
                    <h2>Puoi rendere visibile il tuo appartamento in un secondo momento</h2>
                        <div class="radius-container">
                            <div class="radius">
                                <span>Yes</span>
                                <input type="radio" name="hidden"value="1">
                            </div>
                            <div class="radius">
                                <span>No</span>
                                <input type="radio" name="hidden"value="0" >
                            </div>
                        </div>
                </div>

            </div>
            <div class= "col-lg-6 col-md-12">
                <h2 id="s-extra">Aggiungi i servizi extra</h2>
                <div class= "bottom-box extra-service-container">
                    @foreach ($extra_services as $extra_service)
                        <div class="extra_services_box">
                            <span>@if($extra_service->name == 'wifi')
                                <span><i class="fas fa-wifi"></i></span>Wifi
                                @elseif($extra_service->name == 'smoking')
                                <span><i class="fas fa-smoking"></i></span>Fumatori
                                @elseif($extra_service->name == 'parking')
                                <span><i class="fas fa-parking"></i></span>Parcheggio
                                @elseif($extra_service->name == 'swimming_pool')
                                <span><i class="fas fa-swimming-pool"></i></span>Piscina
                                @elseif($extra_service->name == 'breakfast')
                                <span><i class="fas fa-coffee"></i></span>Colazione
                                @elseif($extra_service->name == 'view')
                                <span><i class="fas fa-mountain"></i></span>Vista
                                @endif</span>
                            <span class="checkbox"><input type="checkbox" name="extra_service[]" value="{{$extra_service->id}}"></span>
                        </div>
                        @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="submit-box">
        <input class="btn btn-primary" id="submit" type="submit" value="Submit">
    </div>
</form> 

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps-web.min.js"></script>
    @endsection

    @section('script')
    <script src="{{asset('js/create.js')}}"></script>
    @endsection







 