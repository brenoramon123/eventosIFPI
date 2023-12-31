@extends('layouts.main')

@section("title", "dashboard")

@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td scope="row">{{$loop->index+1}}</td>
                <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                <td>{{count($event->users)}}</td> <!-- Correção: Fechamento correto de colchetes -->
                <td>
                    <a href="/events/edit/{{$event->id}}" class="btn btn-info edit-btn"><ion-icon name='create-outline'></ion-icon> Editar</a>
                    <form action="/events/{{$event->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não tem eventos, <a href="/events/create" class="btn btn-primary">Criar eventos</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que participo</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsAsParticipant) > 0) <!-- Correção: Adição do parêntese faltante -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventsAsParticipant as $event)
            <tr>
                <td scope="row">{{$loop->index+1}}</td>
                <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                <td>{{count($event->users)}}</td> <!-- Correção: Fechamento correto de colchetes -->
                <td>
                  <a href="#" class="btn btn-danger">Sair do evento</a>  
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você não está participando de nenhum evento <a href="/">eventos</a></p>
    @endif 
</div>
@endsection
