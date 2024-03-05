<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;
use App\Models\Artist;

class DashboardController extends Controller
{
   public function totalAlbumsSoldPerArtist(){
    $albumsSoldPerArtist = Album::with('artist:id,name')
    ->select('artist_id', DB::raw('COUNT(`id`) AS album_count')) 
    ->groupBy('artist_id')
    ->get();

    return $albumsSoldPerArtist;
   }

   public function combinedAlbumSalesPerArtist(){

     $combinedSales = Album::with('artist:id,name')
     ->select('artist_id', DB::raw('SUM(`sales`) as combined_sales'))
     ->groupBy('artist_id')
     ->get();

     return $combinedSales;
   }

   public function topSellingArtist(){

    $topArtist = Album::with('artist:id,name')
    ->select('artist_id', DB::raw('SUM(`sales`) as combined_sales'))
    ->groupBy('artist_id')
    ->orderBy('combined_sales', 'desc')
    ->take(1)
    ->get();

    return $topArtist;
   }

   public function listAlbumsByArtist($artistName){

    $artist = Artist::where('name', $artistName)->first();
    $artistAlbums = Album::where('artist_id', $artist->id)->get();

    return $artistAlbums;
   }
}
