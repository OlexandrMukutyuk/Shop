@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('index_admin') }}" class="btn btn-primary mb-3">На головну</a>

                    <form method="POST" action="{{ route('admin.view.save') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control" id="view_name" name="view_name" placeholder="Введіть назву виду">
                        </div>

                        @if ($errors->has('view_name'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('view_name') }}
                            </div>
                        @endif

                        <button type="submit" class="btn btn-success">Зберегти</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
