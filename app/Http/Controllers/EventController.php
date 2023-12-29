<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;


class EventController extends Controller
{
    public function index(){
      
    $search = request("search");

    if($search){
        $events = Event::where([['title','like','%'.$search."%"]])->get();
    }else{
     $events = Event::all();
    }

        return view('welcome',['events'=>$events,'search'=>$search]);
    }

    public function create(){
     return view('events.create');  
    }

    public function store(Request $request){
        $event = new Event;
    
        $event->title = $request->title;
        
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->date = $request->date;


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension(); // Obtendo a extensão correta do arquivo
    
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; // Gerando um nome único para o arquivo
    
            $requestImage->move(public_path("img/events"), $imageName); // Movendo o arquivo para o diretório correto
    
            $event->image = $imageName; // Salvando o nome do arquivo no modelo Event
        }
        $user = auth()->user();
        $event->user_id = $user->id;
        $event->save();
    
        return redirect("/")->with('msg', "Evento criado com sucesso!");
    }

    public function show($id){
        $event = Event::findOrFail($id);
        $eventOwner = User::where('id',$event->user_id)->first()->toArray();
       return view('events.show',['event'=> $event,"eventOwner"=>$eventOwner]);


    }

    public function dashboard(){
       $user = auth()->user();

       $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;
       return view('events.dashboard',['events'=> $events,'eventsAsParticipant'=>$eventsAsParticipant]);
    }

    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg','Evento excluido com sucesso!');
    }

    public function update(Request $request, $id){
        $event = Event::findOrFail($id);
    
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->cidade = $request->input('cidade'); // Use 'cidade' ao invés de 'city'
        $event->private = $request->input('private');
        $event->date = $request->input('date');
    
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->file('image'); // Correção: Obter o arquivo da requisição
            $extension = $requestImage->extension(); // Obtendo a extensão correta do arquivo
    
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; // Gerando um nome único para o arquivo
            $requestImage->move(public_path("img/events"), $imageName); // Movendo o arquivo para o diretório correto
    
            $event->image = $imageName; // Atualizando o nome do arquivo no modelo Event
        }
    
        // Salvar as alterações no evento
        $event->save();
    
        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }
    public function edit($id){
        $user = auth()->user();
     $event = Event::findOrFail($id);
     if($user->id!=$event->user->id){
        return redirect('/dashboard');
     }
     return view("events.edit",['event'=>$event]);
    }

    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);
        
        return redirect('/dashboard')->with('msg', 'Sua presença esta confirmada com sucesso!'.$event->title);
       }
}


