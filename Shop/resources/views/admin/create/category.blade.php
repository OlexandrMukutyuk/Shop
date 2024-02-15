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

                    <!-- Форма для введення назви виду -->
                    <form method="POST" action="{{ route('admin.categoty.save')}}">
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control" id="view_name" name="view_name" placeholder="Введіть назву виду">
                        </div>

                        <div class="mb-3">
                            <label for="exampleSelect">Виберіть вид</label>
                            <select class="form-select" id="exampleSelect" name="exampleSelect">
                                @foreach($types as $type)
                                    <option value={{$type->id}}>{{$type->name_type}}</option>
                                @endforeach
                            </select>
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
