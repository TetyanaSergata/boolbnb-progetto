@extends('layouts.boolbnb')
@section('head')
	<script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
@endsection

@section('main')
<div class="main-container">
	{{-- Header --}}
	<div class="divider-box">
		<hr>
		<div class="head-title">
			<h1>Lista Messaggi</h1>
		</div>
		<hr>
	</div>
	{{-- Il box dei messaggi --}}
	<div class="messages-box container">
		<ul>
			@php
				$i = 0;
			@endphp
			@if (!empty($userMessage))
			@foreach ($userMessage as $message)
				<li>
					<div class="message">
						<div id="content-visible-{{ $i }}" class="content-visible">
							<h4>{{$message->title}}</h4>
							<p class="line-email">
								<span>Ricevuto da</span>:
								{{$message->email}}
								<a class="button-show" href="javascript:void(0);">
									Mostra di più...
								</a>
							</p>
							{{-- Box nascosto --}}
							<div class="hidden-box">
								<p class="message-text">"{{$message->message}}"
								</p>
								<p>Appartamento: {{$message->flat->title}}
								</p>
							</div>
							{{-- Bottone Mostra meno --}}
							<p>
								<a class="button-hide" href="javascript:void(0);">
									Mostra meno
								</a>
							</p>
						</div>
					</div>
				</li>	
				@php
					$i++;
				@endphp
			@endforeach
			@else
				<h2 style="text-align: center">Nessun messaggio ricevuto</h2>
			@endif
		</ul>
	</div>
</div>
@endsection
{{-- Script --}}
@section('script')
<script src="{{asset('js/message.js')}}"></script>
@endsection
