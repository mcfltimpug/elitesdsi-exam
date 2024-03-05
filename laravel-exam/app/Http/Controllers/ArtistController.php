<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $artist;
    public function __construct(){
       $this->artist = new Artist();
   }
   
   public function index()
    {
        return $this->artist->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->artist->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->artist->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $artist = $this->artist->find($id);
        $artist->update($request->all());
        return $artist;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artist = $this->artist->find($id);
        return $artist->delete();
    }
}
