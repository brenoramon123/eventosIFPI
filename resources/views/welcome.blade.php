@extends('layouts.main')

@section('title','IFPI events')
@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="aperte o enter para procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Buscando por {{$search}}</h2>
    @else
    <h2>Próximos Eventos</h2>
    @endif
    <p class="subtitle">Veja os Eventos dos próximos dias</p>
    <div id="cards-container" class="row">
        @foreach($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{$event->image}}" alt="{{$event->title}}">
                <div class="card-body">
                    <div class="card-date">{{date('d/m/Y',strtotime($event->date))}}</div>
                    <h5 class="card-title">{{$event->title}}</h5> <!-- Correção feita aqui -->
                    <p class="card-participants">{{count($event->users)}} Pessoas</p>
                    <a href="/events/{{$event->id}}" class="btn btn-primary">ENTRAR</a>
                </div>
            </div>
        @endforeach <!-- Movido o </div> após o laço foreach -->
        @if(count($events)==0&&$search)
            <p>Não foi possivel encontrar nehum evento com {{$search}}! <a href="/" class="btn btn-primary">Ver todos</a></p>
        @elseif(count($events)==0)
        <p>Não há eventos disponiveis</p>
        @endif
    </div>
</div>

@endsection
