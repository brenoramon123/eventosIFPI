@extends('layouts.main')

@section('title', 'Editando '.$event->title)

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{$event->title}}</h1>
    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Imagem:</label>
            <input type="file"  id="image" name="image" class="form-control-file">
            <img src="/img/events/{{$event->image}}" alt="" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Titulo:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="nome do evento..." value="{{$event->title}}">
        </div>
        <div class="form-group">
            <label for="date">Data:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d', strtotime($event->date)) }}">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="cidade..." value="{{$event->city}}">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select class="form-control" id="private" name="private">
                <option value="0" {{$event->private == '0' ? 'selected' : ''}}>Não</option>
                <option value="1" {{$event->private == '1' ? 'selected' : ''}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="descreva um pouco mais desse evento">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
    <label for="description">Adcione items de infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras" {{ in_array('Cadeiras', $event->items) ? 'checked' : '' }}> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco" {{ in_array('Palco', $event->items) ? 'checked' : '' }}> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Coffee-Break" {{ in_array('Coffee-Break', $event->items) ? 'checked' : '' }}> Coffee-Break
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes" {{ in_array('Brindes', $event->items) ? 'checked' : '' }}> Brindes
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Atualizar Evento">
    </form>
</div>
@endsection