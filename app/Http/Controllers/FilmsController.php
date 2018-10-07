<?php

namespace App\Http\Controllers;

use App\Country;
use App\Film;
use App\Genre;
use Illuminate\Http\Request;

class FilmsController extends Controller {

  protected $perPage = 10;

  public function feed() {

    $films = Film::latest('realease_date')
      ->withCount('comments')
      ->paginate($this->perPage);

    return view('films', [
      'films'   => $films,
      'title'   => "Films Catalog",
      'isLocal' => config('app.env') === 'local',
    ]);

  }

  public function create() {
    return view('film-add-edit', [
      'title'     =>"Add New Film",
      'film'      => new Film(),
      'countries' => $this->countries(),
      'genres'    => $this->genres(),
    ]);
  }

  public function edit(Film $film) {
    return view('film-add-edit', [
      'title'     =>"Edit Film",
      'film'      => $film,
      'countries' => $this->countries(),
      'genres'    => $this->genres(),
    ]);
  }

  private function countries() {
    return Country::orderBy('title')->get();
  }

  private function genres() {
    return Genre::orderBy('name')->get();
  }

  public function store(Request $request) {

    /** @var Film $film */
    $film = Film::findOrNew($request->input('id'));
    $isNew = !$film->exists;



    $this->validate($request, [
      'name'          => 'required|string',
      'description'   => 'required|string',
      'realease_date' => 'required|string|date',
      'country'       => 'required|integer',
      'genre'         => 'required|integer',
      'rating'        => 'required|integer',
      'ticket_price'  => 'required|numeric',
      'photo'         => "required|image|mimes:jpg,jpeg,png|max:2048",
    ]);

    $film->name = $request->input('name');
    $film->slug = $film->generateSlug($film->name);
    $film->description = $request->input('description');
    $film->realease_date = $request->input('realease_date');
    $film->country_id = $request->input('country');
    $film->genre_id = $request->input('genre');
    $film->rating = $request->input('rating');
    $film->ticket_price = $request->input('ticket_price');
    $film->save();
    $this->uploadImage($film, 'photo');

    $successMessage = $isNew ?"Film successfully created": "Film successfully updated";

    return redirect(route('home'))->with('success', $successMessage);
  }

  public function show(string $slug) {
    $film = Film::where('slug', '=', $slug)->firstOrFail();
    $comments = $film->comments()->oldest()->get();
    return view('film', [
      'title'    => $film->title(),
      'film'     => $film,
      'comments' => $comments,
    ]);
  }

}