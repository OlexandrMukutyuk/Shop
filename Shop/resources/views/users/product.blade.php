@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ url('/') }}{{ $product->photo_path }}" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name}}</h2>
                <p>{{ $product->description}}</p>
                <p>Ціна: {{ $product->cost}}</p>
                <!-- Форма для додавання продукту до кошика -->
                <form action="{{ route('basket_post', ['id' => $product->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Кількість:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" class="form-control">
                    </div>
                    <!-- Кнопка для додавання продукту до кошика -->
                    <button type="submit" class="btn btn-primary">Додати до кошика</button>
                </form>
                <!-- Кнопка для повернення на головну сторінку -->
                <a href="{{ route('home') }}" class="btn btn-secondary mt-2">На головну</a>
            </div>
        </div>
    </div>

</div>
@endsection
