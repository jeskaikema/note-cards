@extends('layouts.app')

@section('content')
    {{-- Session flash --}}
    @include('layouts.includes.flash')
    <div class="row w-100 p-b-100">
        <div class="offset-md-1"></div>
        {{-- Show softdeleted cards --}}
        <div class="col-md-8">
            <div class="row p-3 trashed-cards">
                {{-- Header --}}
                <div class="col-md-12 p-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">Your trashed cards</h4>
                            <hr class="aluminium" style="margin-bottom: -6px">
                        </div>
                    </div>
                </div>
                {{-- If no finished cards show placeholder --}}
                @if($cards->isEmpty())
                    <div class="col-md-4 p-1">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">You have no trashed cards</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <hr>
                                </h6>
                                <p class="card-text">Came back when you have trashed some of your cards!</p>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- All trashed cards --}}
                @foreach($cards as $card)
                    <div class="col-md-4 p-1">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">{{ $card->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $card->subtitle }}</h6>
                                <p class="card-text">{{ $card->content }}</p>
                                <hr>
                                <div class="float-left">
                                    {{-- Restore card from softdelete to waiting --}}
                                    <a href="{{ route('restore.card', $card->id) }}"
                                       class="btn btn-outline-secondary">Return to waiting
                                    </a>
                                </div>
                                <div class="float-right">
                                    {{-- Delete card --}}
                                    <a href="{{ route('delete.card', $card->id) }}"
                                       class="card-link btn btn-outline-danger "><i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Side menu --}}
        <div class="col-md-3">
            <div class="side-menu p-l-30 p-t-20 p-b-50 shadow">
                <a class="btn btn-outline-primary m-l-10 m-b-20 m-t-20" href="{{ route('create.card') }}">
                    Add new card
                </a>
                <hr class="m-r-35 aluminium">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Return to dashboard</a></li>
                    <li><a href="{{ route('finished.card') }}">View finished cards</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection