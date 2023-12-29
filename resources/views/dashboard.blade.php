@extends('layouts.main')

@section("title",event->title)
@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count(events)>0)

    @else
    <p>Você ainda não tem eventos, <a href="/events/create" class="btn btn-primary">Criar eventos</a></p>
</div>
@endsection