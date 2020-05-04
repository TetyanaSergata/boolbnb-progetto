@extends('layouts.boolbnb')

@section('main')

<div class="general_main">


	<div class="search-interface">
		<div class="second_navbar">
			<div>
				<label for="text">
					<p class="category">Entro: </p>
				</label>
				<select id="radius">
					<option value="10">10 Km</option>
					<option class="default" value="20" selected="20">20 Km</option>
					<option value="30">30 Km</option>
					<option value="40">40 Km</option>
					<option value="50">50 Km</option>
				</select>
			</div>
	
			<div class="typology">
				<label for="text">
					<p class="category">Stanze: </p>
				</label>
				<select id="rooms">
					<option class="default" value="" selected>--</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
				</select>
			</div>
	
			<div class="typology">
				<label for="text">
					<p class="category">Letti: </p>
				</label>
				<select id="beds">
					<option class="default" value="" selected>--</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
			</div>

		</div>
	
		<div class="extra-services">
			<h3 class="services">Soggiorno con Servizi Extra: </h3>
			<ul>
				<li>
					<label for="wifi"><a class="icone_space" href="#"><i class="icone fas fa-wifi"></i></a> Wi Fi </label>
					<input id="wifi" type="checkbox" name="wifi">
				</li>
				<li>
					<label for="smoking"><a href="#"><i class="icone fas fa-smoking"></i></a> Area fumatori </label>
					<input id="smoking" type="checkbox" name="smoking">
				</li>
				<li>
					<label for="parking"><a href="#"><i class=" icone fas fa-parking"></i></a> Parcheggio </label>
					<input id="parking" type="checkbox" name="parking">
				</li>
				<li>
					<label for="swimming-pool"><a href="#"><i class="icone fas fa-swimming-pool"></i></a> Piscina </label>
					<input id="swimming-pool" type="checkbox" name="swimming-pool">
				</li>
				<li>
					<label for="breakfast"><a href="#"><i class="icone fas fa-coffee"></i></a> Colazione </label>
					<input id="breakfast" type="checkbox" name="breakfast">
				</li>
				<li>
					<label for="view"><a href="#"><i class="icone fas fa-mountain"></i></a> Camera con vista</label>
					<input id="view" type="checkbox" name="view">
				</li>
			</ul>
		</div>

		<div class="button_padding">
			<input class="btn button_padding button_center filter" type="button" value="Ricerca avanzata">
		</div>
		<div class="empty" style="margin-top: 20px">
			<h2 style="text-align: center"></h2>
		</div>
	</div>
	
	<div class="flats-general-container flats-promo-container container ">
		{{-- lista flats normali --}}
	</div>
	<div class="flats-general-container flats-standard-container container">
		{{-- lista flats promo --}}
	</div>
	<input id="city" type="hidden" value="{{$data['city']}}">
	{{-- handlebars --}}
	<script id="flat-template" type="text/x-handlebars-template">
		<a href="@{{'slug'}}" class="flat">
			<div class="sx" style="background-image: url(@{{'cover'}});">
			</div>
			<div class="dx">
				<h3>@{{'title'}}</h3>
				<h4>Citt&agrave;: @{{'city'}}</h4>
				<h4>Stanze: @{{'rooms'}}</h4>
				<h4>Letti: @{{'beds'}}</h4>
				<h4>Prezzo per giorno: @{{'price'}} &euro;</h4>
				<h4>Distanza dal centro: @{{'distance'}} KM</h4>
				<div class="flat-extra-services">
					@{{{'extra'}}}
				</div>
			</div>
		</a>
	</script>
	<script id="flatPromo-template" type="text/x-handlebars-template">
		<a href="@{{'slug'}}" class="flat">
			<div class="sx" style="background-image: url(@{{'cover'}});">
			</div>
			<div class="dx">
				<h3>@{{'title'}}</h3>
				<h4>Citt&agrave;: @{{'city'}}</h4>
				<h4>Stanze: @{{'rooms'}}</h4>
				<h4>Letti: @{{'beds'}}</h4>
				<h4>Prezzo per giorno: @{{'price'}} &euro;</h4>
				<h4>Distanza dal centro: @{{'distance'}} KM</h4>
				<div class="flat-extra-services">
					@{{{'extra'}}}
				</div>
			</div>
		</a>
	</script>
	<script src="{{asset('js/search.js')}}"></script>
</div>

@endsection
