@extends('main')

@section('info')

@if(isset($user))
<p> {{ $user['name'] }} är {{ $user['age'] }} år gammal.</p>
@endif

@if(isset($error))
<p>Tyvärr finns det ingen användare med det namnet</p>
@endif

@if(isset($users))
@foreach ($users as $user)
<p> {{ $user['name'] }} </p>
@endforeach
@endif
@endsection