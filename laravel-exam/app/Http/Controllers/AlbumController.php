<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $album;

    public function __construct(){
        $this->album = new Album();
    }
    
    public function index()
    {
        return $this->album->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->album->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->album->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = $this->album->find($id);
        $album->update($request->all());
        return $album;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = $this->album->find($id);
        return $album->delete();
    }
}
