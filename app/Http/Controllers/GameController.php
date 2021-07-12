<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //AQUI VAN LAS QUERYS PARA LA INTERFAZ DE USUARIO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    public function getGameByTitle(Request $request,Game $game, $title)
    {
        // $game = Game::where('title', $title)->get();
        $game = Game::select('title', $title)->get();
        return response()->json($game, status:200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game, $id)
    {
        $game = Game::findOrFail($id);
        $game->update($request->all());
        // return $game;
        return response()->json($game, status:200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $game = Game::findOrFail($id);

        $game->delete();
    }

    public function getGameById(Request $request, $id)
    {
        $game = Game::where('id', $id)->get();
        return response()->json($game, status:200);
    }

    //Metodo para consumir datos en la API BUENA PRACTICA. PARA NO USAR EL INDEX
    public function getAll(Request $request, Game $game)
    {
        if($request->isJson()) {//AQUI VALIDAMOS QUE SEA UN ARCHIVO JSON
            return Game::all();
        } else {
            return response()->json(['error' => 'No acceptable'], status:406);
        }
    }
    //AQUI CREAMOS EL JUEGO TIPO JSON
    public function createGame(Request $request, Game $game) {
        if($request->isJson()) {
            $data = $request->json()->all();

            //CONFIRMACIÓN PARA SABER SI EL USUARIO EXISTE
            $userExists = User::where("id", $data['user_id'])->exists();

            if($userExists === false) {
                return response()->json(['error' => 'Invalid parameters'], status:406);
            }

            $datatoBeSaved = [
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'thumbnail_url' => $data['thumbnail_url'],
            ];
            //Aqui ejecutamos la variable datatosaved, para que se guarde el juego
            $game = Game::create($datatoBeSaved);

            return response()->json($game, status:200);
        } else {
            return response()->json(['error' => 'Error not a valid JSON!!!'], status:406,);
        }
    }
}
