{{-- Session flash --}}
<div class="row w-100" style="height: 50px;">
    <div class="offset-md-2"></div>
    @if(session()->has('message'))
        <div id="successMessage" class="col-md-6 shadow" style="margin-top: -20px">
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif
</div>