@extends('layouts.main')

@section('title', 'create')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Imagem:</label>
            <input type="file" required id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="title">Titulo:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="nome do evento...">
        </div>
        <div class="form-group">
            <label for="title">Data:</label>
            <input type="date" class="form-control" id="date" name="date" >
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="cidade...">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select class="form-control" id="private" name="private">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="descreva um pouco mais desse evento"></textarea>
        </div>
        <div class="form-group">
            <label for="description">Adcione items de infraestrutura:</label>
            <div class="form-group">
               <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
               <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>
            <div class="form-group">
               <input type="checkbox" name="items[]" value="Coffee-Break"> Coffee-Break
            </div>
            <div class="form-group">
               <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
            
        </div>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>
@endsection