@extends('layouts.boolbnb')
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
<div id="h1_edit_user">
    <h1>Modifica i tuoi dati Utente</h1>
</div>
    <div class="edit-container">
        <div class="edit-form">
            <form action="{{route('account.user.update', $user->id)}}" method="post">
                @csrf
                @method('PATCH')
                
                <label for="name" class="label">Nome Utente</label>
                <input type="text" id="name" name="name" value="{{$user->name}}" class="input">
    
                <label for="email" class="label">Email</label>
                <input type="email" id="email" name="email" value="{{$user->email}}" class="input">
    
                <label for="passwordnow" class="label">Password attuale</label>
                <input type="password" id="passwordnow" name="passwordnow" value="" class="input">
    
                <label for="passwordnew" class="label">La tua nuova password</label>
                <input type="password" id="passwordnew" name="passwordnew" class="input">
    
                <label for="confirm" class="label">Conferma la password</label>
                <input type="password" id="confirm" name="confirm" id="" class="input">
    
                <input type="submit" class="btn btn-primary" id="button" value="Salva">
            </form>   
        </div>
    </div>

@endsection