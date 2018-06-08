<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Galeria;
use App\Home;
use App\Lista;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        $galerias = Galeria::orderBy('position', 'desc')->take(4)->get();
        $fotos = Home::all();
        $auth=Auth::check();
        $count=0;
        foreach($galerias as $galeria){
            $fotosGalerias[$count++] = Foto::where('galeria', $galeria->id)->first();
        }
        return view('welcome', compact('auth', 'fotos', 'galerias', 'fotosGalerias'));
    }

    public function galeria($id)
    {
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $fotos = Foto::all();
        $scroll = Galeria::all()->where('id', '=', $id)->first()->nome;
        if($scroll == $galerias->first()->nome)
            $scroll = "container";
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function galeriaDefault()
    {
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $fotos = Foto::all();
        $scroll = "container";
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function sobre()
    {
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $listas = Lista::all();
        return view('sobre', compact('auth', 'galerias', 'listas'));
    }

    public function workshop()
    {
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        return view('workshop', compact('auth', 'galerias'));
    }

    public function addGaleria(){
        if(!Auth::check())
            abort(403);
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        return view('novaGaleria', compact('auth', 'galerias'));
    }

    public function storeGaleria(Request $req){
        if(!Auth::check())
            abort(403);
        $galeria = new Galeria();
        $galeria->nome = $req->nome;
        $galeria->descricao = $req->descricao;
        $temp = Galeria::orderBy('position', 'desc')->first();
        if($temp)
            $galeria->position = $temp->position+1;
        else
            $galeria->position = 1;
        $galeria->timestamps = false;
        $galeria->save();
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $scroll = "container";
        $fotos = Foto::all();
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function addLista(){
        if(!Auth::check())
            abort(403);
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        return view('novaLista', compact('auth', 'galerias'));
    }

    public function storeLista(Request $req){
        if(!Auth::check())
            abort(403);
        $lista = new Lista();
        $lista->lista = $req->nome;
        $lista->timestamps = false;
        $lista->save();
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $listas = Lista::all();
        return view('sobre', compact('auth', 'galerias', 'listas'));
    }

    public function edit(Galeria $galeria){
        if(!Auth::check())
            abort(403);
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        return view('editGaleria', compact('auth', 'galerias', 'galeria'));
    }

    public function storeEdit(Request $req, Galeria $galeria){
        if(!Auth::check())
            abort(403);
        $galeria->nome = $req->nome;
        $galeria->descricao = $req->descricao;
        $galeria->timestamps = false;
        $galeria->save();
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $scroll = $galerias->first()->nome;
        $fotos = Foto::all();
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function add(Galeria $galeria){
        if(!Auth::check())
            abort(403);
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        return view('upload', compact('auth', 'galerias', 'galeria'));
    }

    public function store(Request $req, Galeria $galeria){
        if(!Auth::check())
            abort(403);
        $fotos=$req->file('files');
        foreach($fotos as $i) {
            $foto = new Foto();
            $foto->timestamps = false;
            $path = $i->store('public/fotos');
            $parts = explode('/', $path);
            $foto->foto = $parts[2];
            $foto->galeria = $galeria->id;
            list($width, $height) = getimagesize('../storage/app/public/fotos/'.$foto->foto);
            if ($width > $height) {
                $foto->horizontal=1;
            } else {
                $foto->horizontal=0;
            }
            $foto->save();
        }
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $fotos = Foto::all();
        $scroll = "container";
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function delete(Foto $foto){
        if(!Auth::check())
            abort(403);
        Storage::delete('public/fotos/' . $foto->foto);
        $foto->delete();
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $fotos = Foto::all();
        $scroll = "container";
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function deleteLista(Lista $lista){
        if(!Auth::check())
            abort(403);
        $lista->delete();
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $listas = Lista::all();
        return view('sobre', compact('auth', 'galerias', 'listas'));
    }

    public function deleteGaleria(Galeria $galeria){
        if(!Auth::check())
            abort(403);
        $fotos = Foto::where('galeria', '=', $galeria->id)->get();
        foreach($fotos as $foto){
            Storage::delete('public/fotos/' . $foto->foto);
            $foto->delete();
        }
        $galeria->delete();
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $fotos = Foto::all();
        $scroll = "container";
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function move(Galeria $galeria){
        if(!Auth::check())
            abort(403);
        $temp=$galeria->position;
        $galeria2=Galeria::where('position', '>', $galeria->position)->orderBy('position', 'asc')->first();
        $galeria->position=$galeria2->position;
        $galeria2->position=$temp;
        $galeria->timestamps = false;
        $galeria2->timestamps = false;
        $galeria->save();
        $galeria2->save();
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $fotos = Foto::all();
        $scroll = "container";
        return view('galeria', compact('auth', 'galerias', 'fotos', 'scroll'));
    }

    public function editHome(){
    if(!Auth::check())
        abort(403);
    $auth=Auth::check();
    $galerias = Galeria::orderBy('position', 'desc')->get();
    return view('editHome', compact('auth', 'galerias'));
}

    public function storeHome(Request $req){
        if(!Auth::check())
            abort(403);
        $foto = new Home();
        $foto->timestamps = false;
        $path = $req->file('file')->store('public/fotos');
        $parts = explode('/', $path);
        $foto->foto = $parts[2];
        $foto->save();
        $galerias = Galeria::orderBy('position', 'desc')->take(4)->get();
        $fotos = Home::all();
        $auth=Auth::check();
        $count=0;
        foreach($galerias as $galeria){
            $fotosGalerias[$count++] = Foto::where('galeria', $galeria->id)->first();
        }
        return view('welcome', compact('auth', 'fotos', 'galerias', 'fotosGalerias'));
    }

    public function deleteHome(){
        if(!Auth::check())
            abort(403);
        $auth=Auth::check();
        $galerias = Galeria::orderBy('position', 'desc')->get();
        $fotos = Home::all();
        return view('deleteHome', compact('auth', 'galerias', 'fotos'));
    }

    public function destroyHome(Home $home){
        if(!Auth::check())
            abort(403);
        Storage::delete('public/fotos/' . $home->foto);
        $home->delete();
        $galerias = Galeria::orderBy('position', 'desc')->take(4)->get();
        $fotos = Home::all();
        $auth=Auth::check();
        $count=0;
        foreach($galerias as $galeria){
            $fotosGalerias[$count++] = Foto::where('galeria', $galeria->id)->first();
        }
        return view('welcome', compact('auth', 'fotos', 'galerias', 'fotosGalerias'));
    }

}


