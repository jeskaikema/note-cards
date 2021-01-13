@extends('layouts.app')

@section('content')
    {{-- Session flash --}}
    @include('layouts.includes.flash')
    <div class="row w-100 p-b-100">
        <div class="offset-md-2"></div>
        <div class="col-md-8 p-r-30">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <hr class="aluminium">
                    {{-- User details update form --}}
                    <form method="POST" action="{{ route('update.profile', ['user' => $user->id]) }}"
                          enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf
                        <h4 class="m-t-25 m-b-25">Edit user details</h4>
                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Name:</label>
                            <div class="col-6">
                                <input id="name" name="name"
                                       class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"
                                       value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email:</label>
                            <div class="col-6">
                                <input id="email" name="email"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text"
                                       value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label"></label>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">Update user details</button>
                            </div>
                        </div>
                    </form>
                    <hr class="aluminium">
                </div>
            </div>
        </div>
    </div>
@endsection
