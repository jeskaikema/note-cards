@extends('layouts.app')

@section('content')
    {{-- Session flash --}}
    @include('layouts.includes.flash')
    <div class="row w-100 p-b-100">
        <div class="offset-md-2"></div>
        <div class="col-md-4 card p-4 shadow">
            <div>
                <h4>Create a new card</h4>
                <hr class="aluminium">
            </div>

            {{-- Create card form --}}
            <form method="POST" action="{{ route('store.card') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Card title</label>
                    <input name="title" type="text"
                           class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title"
                           value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="subtitle">Card subtitle</label>
                    <input name="subtitle" type="text"
                           class="form-control {{ $errors->has('subtitle') ? ' is-invalid' : '' }}" id="subtitle"
                           value="{{ old('subtitle') }}">
                    @if ($errors->has('subtitle'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('subtitle') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="cardcontent">Card content</label>
                    <input name="cardcontent" type="text"
                           class="form-control {{ $errors->has('cardcontent') ? ' is-invalid' : '' }}" id="cardcontent"
                           value="{{ old('cardcontent') }}">
                    @if ($errors->has('cardcontent'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('cardcontent') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status">Card status</label>
                    <select name="status" class="form-control {{ $errors->has('cardcontent') ? ' is-invalid' : '' }}"
                            id="status" value="{{ old('status') }}">
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{ $status->status }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>
                <hr class="aluminium m-t-25 m-b-25">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save new card</button>
                </div>
            </form>
        </div>
        <div class="offset-md-3"></div>

        {{-- Side menu --}}
        <div class="col-md-3">
            <div class="side-menu p-l-30 p-t-20 p-b-50 shadow">
                <p>Create a new card</p>
                <hr class="m-r-35 aluminium">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Return to dashboard</a></li>
                    <li><a href="{{ route('finished.card') }}">View finished cards</a></li>
                    <li><a href="{{ route('trash.card') }}">View removed cards</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection