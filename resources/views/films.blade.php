@php
  /**
   * @var bool $isLocal - display additional controls for development
   * @var \Illuminate\Support\Collection|\App\Film[] $films
   */
@endphp

@extends('layout')

@section('content')

  <div id="toolbar" class="mb-3">
    <a href="{{ route('films.create') }}" class="btn"><Address></Address>Add New Film</a>
  </div>

  <div class="films row">
    @foreach($films as $film)
        @include('film-line')
        @if($isLocal)
          <div class="text-center small card-actions text-muted mt-1">
            <a class="btn" href="{{ route('films.edit', $film) }}">   Edit</a>
          </div>
        @endif
    @endforeach
  </div>

  {!! $films->links() !!}
@endsection