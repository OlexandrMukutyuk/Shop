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
                    @foreach($products as $product)
                    <form method="POST" action="{{ route('updateProduct', ['id' => $product->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Введіть назву товару" value="{{$product->name}}">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Введіть вартість товару" value="{{$product->cost}}">
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Введіть опис товару">{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <img src="{{ url('/') }}{{ $product->photo_path }}" alt="Фото" style="max-width: 200px; max-height: 200px;">
                        </div>


                        <div class="mb-3">
                            <label for="exampleSelect">Виберіть категорію</label>
                            <select class="form-select" id="exampleSelect" name="exampleSelect">
                                @foreach($categorys as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $product->categoti_id) selected @endif>{{ $category->categori }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($errors->has('product_name') || $errors->has('price') || $errors->has('description') || $errors->has('photo'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('product_name') }}
                                {{ $errors->first('price') }}
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                        <button type="submit" class="btn btn-success">Оновити</button>
                    </form>
                    <form action="{{ route('deleteProduct', ['id' => $product->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger deleteBtn" onclick="return confirm('Ви впевнені?')">Видалити</button>
                    </form>
                    <div class="mb-5"></div>
                @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
