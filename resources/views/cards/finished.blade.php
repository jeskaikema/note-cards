@extends('layouts.app')

@section('content')
    {{-- Session flash --}}
    @include('layouts.includes.flash')
    <div class="row w-100 p-b-100">
        <div class="offset-md-1"></div>
        {{-- Finished cards --}}
        <div class="col-md-8">
            <div class="row p-3 finished-cards">
                {{-- Header --}}
                <div class="col-md-12 p-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">Your finished cards</h4>
                            <hr class="aluminium" style="margin-bottom: -6px">
                        </div>
                    </div>
                </div>
                {{-- If no finished cards show placeholder --}}
                @if($cards->isEmpty())
                    <div class="col-md-4 p-1">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">You have no finished cards</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <hr>
                                </h6>
                                <p class="card-text">Came back when you have finished some of your cards!</p>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- All finished cards --}}
                @foreach($cards as $card)
                    <div class="col-md-4 p-1">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">{{ $card->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $card->subtitle }}</h6>
                                <p class="card-text">{{ $card->content }}</p>
                                <hr>
                                {{-- Choose status dropdown --}}
                                <div class="dropdown float-left">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                           href="{{ route('choose.card.status', ['card' => $card->id,1]) }}">Waiting
                                        </a>
                                        <a class="dropdown-item"
                                           href="{{ route('choose.card.status', ['card' => $card->id,2]) }}">Active
                                        </a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    {{-- Edit card --}}
                                    <a href="{{ route('edit.card', ['card' => $card->id]) }}"
                                       class="card-link btn btn-outline-primary"><i class="fas fa-pencil-alt"></i>
                                    </a>
                                    {{-- Softdelete card --}}
                                    <a href="{{ route('remove.card', ['card' => $card->id]) }}"
                                       class="card-link btn btn-outline-danger"><i class="fas fa-times"></i>
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
                    <li><a href="{{ route('trash.card') }}">View removed cards</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection