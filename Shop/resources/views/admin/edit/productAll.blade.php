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
                    <form method="POST" action="{{ route('admin.product.save')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Введіть назву товару">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Введіть вартість товару">
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Введіть опис товару"></textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="exampleSelect">Виберіть категорію</label>
                            <select class="form-select" id="exampleSelect" name="exampleSelect">
                                @foreach($categorys as $category)
                                    <option value="{{ $category->id }}">{{ $category->categori }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($errors->has('product_name') || $errors->has('price') || $errors->has('description') || $errors->has('photo'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('product_name') }}
                                {{ $errors->first('price') }}
                                {{ $errors->first('description') }}
                                {{ $errors->first('photo') }}
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
