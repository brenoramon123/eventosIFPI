@extends('layouts.main')

@section('title', $event->title)

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="image-fluid" width="500px">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{$event->title}}</h1>
                <p class="event-city"><ion-icon name="baseball-outline"></ion-icon>{{$event->cidade}}cidade</p>
                <p class="events-participants"><ion-icon name="people-outline"></ion-icon>{{count($event->users)}} Pessoas</p>
                <p class="event-owner"><ion-icon name="star-outline"></ion-icon>{{$eventOwner['name']}}</p>
                <form action="/events/join/{{$event->id}}" method="POST">
                    @csrf
                <a href="/events/join/{{$event->id}}" id="event-submit" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit();">confirmar Presença</a>
                </form>
                <h3>O evento conta com:</h3>
                <ul id="items-list">
                    @foreach($event->items as $item)
                        <li><ion-icon name="play-outline"></ion-icon> <span>{{$item}}</span> </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o eveento:</h3>
                <p class="event-description">
                    {{$event->description}}
                </p>
            </div>
        </div>
    </div>
@endsection