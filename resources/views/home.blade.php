@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Center') }}</div>

                <div class="card-body">
                    @if (session()->has('status'))
                        <div class="alert alert-{{ session()->get('status')['type'] }}" role="alert">
                            {{ session()->get('status')['message'] }}
                        </div>
                    @endif
                        <form method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <label for="file">List of Emails File</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>
                                <div class="col-md-2 d-flex align-self-end">
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
