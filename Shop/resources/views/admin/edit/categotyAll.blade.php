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
                    @foreach($categotys as $categoty)
                    <form method="POST" action="{{ route('updateCategoty', ['id' => $categoty->id]) }}" id="myForm{{$categoty->id}}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <input type="text" class="form-control" id="view_name" name="view_name" placeholder="Введіть назву виду" value="{{ $categoty->categori }}">
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

                        <div class="btn-toolbar" role="toolbar" aria-label="Опції">
                            <div class="btn-group mr-5" role="group" aria-label="Кнопки">
                                <button type="submit" class="btn btn-primary" id="updateBtn{{$type->id}}">Оновити</button>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('deleteCategoty', ['id' => $categoty->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger deleteBtn" onclick="return confirm('Ви впевнені?')">Видалити</button>
                    </form>
                    <a href="{{ route('admin.product', ['id' => $categoty->id]) }}" class="btn btn-primary">Переглянути всі товари</a>
                    <div class="mb-5"></div> <!-- Вертикальний відступ між парою форм -->
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
