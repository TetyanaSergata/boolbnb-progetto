@section('head')
<link rel='stylesheet' type='text/css'
    href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps.css' />
@endsection

@extends('layouts.boolbnb')
@section('main')
<form action="{{route('account.flats.update', $flat->slug)}}" method="POST" enctype='multipart/form-data'>
    {{-- token generator --}}
    @csrf
    @method('PATCH')
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
                            <span><input type="text" name="title" placeholder="Titolo" value="{{$flat->title}}"></span>
                        </div>
            
                        <div class="form-group form-box">
                            <span class= "label"><label for="street">Via</label></span>
                            <span><input class="street" type="text" name="street" placeholder="Via" value="{{$flat->flat_address->street}}"></span>
                        </div>
                    </div>
                    <div class= "col-4">
                        <div class="form-group form-box">
                            <span class= "label"><label for="street_number">Civico</label></span>
                            <span><input class="street-number" type="text" name="street_number" placeholder="Civico" value="{{$flat->flat_address->street_number}}"></span>
                        </div>
                        <div class="form-group form-box">
                            <span class= "label"><label for="city">Città</label></span>
                            <span><input class="city" type="text" name="city" placeholder="Città" value="{{$flat->flat_address->city}}"></span>
                        </div>
                    </div>
                    <div class= "col-4">
                        <div class="form-group form-box">
                            <span class= "label"><label for="zip_code">Cap</label></span>
                            <span><input class="cap" type="text" name="zip_code" placeholder="Cap" value="{{$flat->flat_address->zip_code}}"></span>
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
                            <span><input type="number" name="rooms" placeholder="Numero stanza" value="{{$flat->rooms}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label"><label for="mq">Metri quadri</label></span>
                            <span><input type="text" name="mq" placeholder="Metri quadri" value="{{$flat->mq}}"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-box">
                            <span class= "label"><label for="guest">Numero ospiti</label></span>
                            <span><input type="number" name="guest" placeholder="Numero ospiti" value="{{$flat->guest}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label"><label for="description">Descrizione</label></span>
                            <span><input type="text" name="description" placeholder="Descrizione" value="{{$flat->description}}"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class= "col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group form-box">
                            <span class= "label"><label for="price_day">Prezzo giornaliero</label></span>
                            <span><input type="text" name="price_day" placeholder="Prezzo giornaliero" value="{{$flat->price_day}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label"><label for="bathrooms">Numero bagni</label></span>
                            <span><input type="number" name="bathrooms" placeholder="Numero bagni" value="{{$flat->bathrooms}}"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-box">
                            <span class= "label"><label for="beds">Numero di Letti</label></span>
                            <span><input type="number" name="beds" placeholder="Numero letti" value="{{$flat->beds}}"></span>
                        </div>
                
                        <div class="form-group form-box">
                            <span class= "label">
                                <label class= "cover-custom" for="cover">
                                    <input id="cover" type="file" name='cover' accept='image/*'>
                                    Cambia l'immagine di copertina
                                </label>
                                
                            </span>
                            {{-- <input type="file" name='cover' accept='image/*'> --}}
                        </div>
                        <div class="form-group form-box hide-flat">
                            <label for="lat"></label>
                            <input class="lat" name="lat" type="hidden" value="{{$flat->lat}}">
                        </div>
                
                        <div class="form-group form-box hide">
                            <label for="long"></label>
                            <input class="long" name="long" type="hidden" value="{{$flat->long}}">
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
                                <input type="radio" name="hidden"value="1" {{$flat->hidden == 1 ? 'checked' : ''}}>
                            </div>
                            <div class="radius">
                                <span>No</span>
                                <input type="radio" name="hidden"value="0" {{$flat->hidden == 0 ? 'checked' : ''}} >
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
                            <span class="checkbox"><input type="checkbox" name="extra_service[]" value="{{$extra_service->id}}" {{($flat->extra_service->contains($extra_service->id)) ? 'checked' : ''}}></span>
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

















{{-- @extends('layouts.boolbnb')
@section('main')
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
<form action="{{route('account.flats.update', $flat->slug)}}" method="POST" enctype='multipart/form-data'> --}}
    {{-- token generator --}}
    {{-- @csrf
    @method('PATCH')

    <div class="container cont-edit">
        <h2>Modifica il tuo indirizzo</h2>
        <div class= "row">
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group form-box">
                            <label for="title">Titolo</label>
                            <input type="text" name="title" placeholder="Titolo" value="{{$flat->title}}">
                        </div>
                    
                        <div class="form-group form-box">
                            <label for="rooms">Numero di stanze</label>
                            <input type="number" name="rooms" placeholder="Numero stanza" value="{{$flat->rooms}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group form-box">
                            <label for="mq">Metri quadri</label>
                            <input type="number" name="mq" placeholder="Metri quadri" value="{{$flat->mq}}">
                        </div>
                    
                        <div class="form-group form-box">
                            <label for="street">Via</label>
                            <input type="text" name="street" placeholder="Via" value="{{$flat->flat_address->street}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class= "col-lg-6 col-md-12">
                <div class="row">
                    <div class= "col-lg-6 col-md-12">
                        <div class="form-group form-box">
                            <label for="street_number">Civico</label>
                            <input type="text" name="street_number" placeholder="Civico" value="{{$flat->flat_address->street_number}}">
                        </div>
                        <div class="form-group form-box">
                            <label for="city">Città</label>
                            <input type="text" name="city" placeholder="Città" value="{{$flat->flat_address->city}}">
                        </div>
                    </div>
                    <div class= "col-lg-6 col-md-12">
                        <div class="form-group form-box">
                            <label for="zip_code">Cap</label>
                            <input type="text" name="zip_code" placeholder="Cap" value="{{$flat->flat_address->zip_code}}"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="container cont-edit">
       <h2>Modifica le caratteristiche dell'annuncio</h2>
       <div class= "row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group form-box">
                <label for="guest">Numero ospiti</label>
                <input type="text" name="guest" placeholder="Numero ospiti" value="{{$flat->guest}}">
            </div>
        
            <div class="form-group form-box">
                <label for="description">Descrizione</label>
                <input type="text" name="description" placeholder="Descrizione" value="{{$flat->description}}">
            </div>
        
            <div class="form-group form-box">
                <label for="price_day">Prezzo giornaliero</label>
                <input type="text" name="price_day" placeholder="Prezzo giornaliero" value="{{$flat->price_day}}">
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group form-box">
                <label for="bathrooms">Numero bagni</label>
                <input type="number" name="bathrooms" placeholder="Numero bagni" value="{{$flat->bathrooms}}">
            </div>

            <div class="form-group form-box">
                <label for="beds">Numero di Letti</label>
                <input type="number" name="beds" placeholder="Numero letti" value="{{$flat->beds}}">
            </div>

            <div class="form-group form-box insert-img">
                <span class= "label">
                    <label class= "cover-custom" for="cover">
                        <input id="cover" type="file" name='cover' accept='image/*'>
                        Scegli l'immagine di copertina
                    </label>
                </span>
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
   <div class="container cont-edit bottom-container-edit">
       <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group form-box hide-flat-edit">
                    <h2>Puoi rendere visibile il tuo appartamento in un secondo momento</h2>
                    <div class="radius-container">
                        <div class="radius">
                            <span>Yes</span>
                            <input type="radio" name="hidden"value="1" {{$flat->hidden == 1 ? 'checked' : ''}}>
                        </div>
                        <div class="radius">
                            <span>No</span>
                            <input type="radio" name="hidden"value="0" {{$flat->hidden == 0 ? 'checked' : ''}}>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-6 col-md-12 extra-edit">
                <h2 id="s-extra">Servizi extra</h2>

                <div class="form-group form-box extra-service-container-edit">
                    <div class = "row">
                        @foreach ($extra_services as $extra_service)
                        <div class="extra_services_box_edit">
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
                                <span class="checkbox"><input type="checkbox" name="extra_service[]"value="{{$extra_service->id}}"></span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="submit-box">
        <input class="btn btn-primary" id="submit"  type="submit" value="Submit">
    </div>
</form>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.52.0/maps/maps-web.min.js"></script>
@endsection

@section('script')
<script src="{{asset('js/create.js')}}"></script>
@endsection --}}