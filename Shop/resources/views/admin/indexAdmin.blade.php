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

                    <div class="mt-3">
                        <a href="{{ route('admin.view.create') }}" class="btn btn-secondary">Створити вид</a>
                        <a href="" class="btn btn-secondary">Створити категорію</a>
                        <a href="" class="btn btn-secondary">Створити товар</a>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.view.all') }}" class="btn btn-info">Всі види</a>
                        <a href="" class="btn btn-info">Всі категорію</a>
                        <a href="" class="btn btn-info">Весь товар</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
