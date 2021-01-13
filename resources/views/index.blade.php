@extends('layouts.app')

@section('content')
    {{-- Session flash --}}
    @include('layouts.includes.flash')
    {{-- Cards --}}
    <div class="row w-100 p-b-100">
        <div class="offset-md-1"></div>
        <div class="col-md-8 p-r-30">
            {{-- Active cards --}}
            <div class="row p-3 active-cards">
                {{-- Header --}}
                <div class="col-md-12 p-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">Active cards</h4>
                            <hr class="aluminium" style="margin-bottom: -6px">
                        </div>
                    </div>
                </div>
                @foreach($cards as $card)
                    @if($card->status_id == 2)
                        <div class="col-md-6 p-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $card->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $card->subtitle }}</h6>
                                    <p class="card-text">{{ $card->content }}</p>
                                    <hr>
                                    {{-- Change the card status to finished --}}
                                    <a href="{{ route('finish.card', ['card' => $card->id]) }}"
                                       class="card-link btn btn-outline-success"><i class="fas fa-check"></i>
                                    </a>
                                    {{-- Change status between waiting and active --}}
                                    <a href="{{ route('swap.card.status', ['card' => $card->id]) }}"
                                       class="card-link btn btn-outline-secondary">
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <div class="float-right">
                                        {{-- Edit card --}}
                                        <a href="{{ route('edit.card', ['card' => $card->id]) }}"
                                           class="card-link btn btn-outline-primary">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        {{-- Softdelete card --}}
                                        <a href="{{ route('remove.card', ['card' => $card->id]) }}"
                                           class="card-link btn btn-outline-danger"><i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <hr class="m-t-35" style="border: 1px solid #D9D9D9">
            {{-- Waiting cards --}}
            <div class="row p-3 waiting-cards">
                {{-- Header --}}
                <div class="col-md-12 p-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">Waiting cards</h4>
                            <hr class="aluminium" style="margin-bottom: -6px">
                        </div>
                    </div>
                </div>
                @foreach($cards as $card)
                    @if($card->status_id == 1)
                        <div class="col-md-4 p-1">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $card->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $card->subtitle }}</h6>
                                    <p class="card-text">{{ $card->content }}</p>
                                    <hr>
                                    {{-- Change status between waiting and active --}}
                                    <a href="{{ route('swap.card.status', ['card' => $card->id]) }}"
                                       class="card-link btn btn-outline-secondary">
                                        <i class="fas fa-chevron-up"></i>
                                    </a>
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
                    @endif
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
                    <li><a href="{{ route('finished.card') }}">View finished cards</a></li>
                    <li><a href="{{ route('trash.card') }}">View removed cards</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
