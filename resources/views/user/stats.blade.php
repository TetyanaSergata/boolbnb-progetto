@extends('layouts.boolbnb')
@section('main')

@php
    use Carbon\Carbon;
    $now = Carbon::now()->month;
    $months = [
        1 => 'Gennaio',
        2 => 'Febbraio',
        3 => 'Marzo',
        4 => 'Aprile',
        5 => 'Maggio',
        6 => 'Giugno',
        7 => 'Luglio',
        8 => 'Agosto',
        9 => 'Settembre',
        10 => 'Ottobre',
        11 => 'Novembre',
        12 => 'Dicembre'
    ];
@endphp

<div class="stats">
    
    <h1>Statistiche di: {{$flat->title}}</h1>
    
    <div class="box-stats">
        <div class="visits">

            <div class="info">
                <h4 class="visitsTotal"></h4>
                
                <label for="month">Visualizza le statistiche per il mese di: </label>
                
                <select id="month">
                <option class="default" value="" hidden selected="">{{$months[$now]}}</option>
                    @for ($i = 1; $i <= $now; $i++)
                    @foreach ($months as $key => $month)
                        @if ($key == $i)
                        <option value="{{$key}}">{{$month}}</option>
                        @endif
                    @endforeach
                    @endfor
                </select>
            </div>
            
            <div style="width:100%; height:100%;">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="messages">

            <div class="info">
                <h4 class="messagesTotal"></h4>
                
                <label for="monthMessages">Visualizza le statistiche per il mese di: </label>

                <select id="monthMessages">
                    <option class="default" value="" disabled selected="">{{$months[$now]}}</option>
                    @for ($i = 1; $i <= $now; $i++)
                    @foreach ($months as $key => $month)
                        @if ($key == $i)
                        <option value="{{$key}}">{{$month}}</option>
                        @endif
                    @endforeach
                    @endfor
                </select>
            </div>
            
            <div style="width:100%; height:100%;">
                <canvas id="myMessage"></canvas>
            </div>
        </div>
    </div>

    
    
    <input type="hidden" id="id" value="{{$flat->id}}">
    
    <script src="{{asset('js/stat.js')}}"></script>
</div>


@endsection