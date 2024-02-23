@extends('layouts.app')

@section('content')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @foreach($carts as $cart)   
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ url('/') }}{{ $cart['photo_path'] }}" class="img-fluid rounded-start" alt="Product Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $cart['name']}}</h5>
                                <p class="card-text">Вартість: {{ $cart['cost']}}</p>
                                <form action="{{ route('basket_update', ['id' => Illuminate\Support\Str::afterLast(key($carts), "'")]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Кількість:</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $cart['quantity'] }}" min="1">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Оновити кількість</button>
                                </form>
                                <form action="{{ route('basket_delete', ['id' => Illuminate\Support\Str::afterLast(key($carts), "'")]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Видалити</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <a href="#" class="btn btn-primary">Оплатити</a>
    </div>


@endsection
