@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Головна сторінка магазину</h1>

    <!-- Категорії -->
    <div class="row">
      <div class="col-md-4">
        <h2>Категорії</h2>
        <ul class="list-group">
            @foreach($categorys as $category)
                <a href="{{ route('category', ['id' => $category->id]) }}" class="list-group-item list-group-item-action" id="category_a" onclick="handleButtonClick('{{ $category->categori }}')">
                    {{ $category->categori }}
                </a>
            @endforeach
        </ul>

      </div>

      <!-- Товари -->
      <div class="col-md-8">
        <select class="form-control" id="filterSelect" onchange="handleFilterChange(this.value)">
            <option value="Base">Без фільтру</option>
            <option value="Cheaper">Спочатку дешевші</option>
            <option value="Expensive">Спочатку дорогі</option>
            <!-- Додайте більше опцій, які потрібно -->
        </select>
        <h2>Всі товари</h2>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4 mb-3">
                <a href="{{ route('product', ['id' => $product->id]) }}" class="card-link">
                    <div class="card">
                        <img src="{{ url('/') }}{{ $product->photo_path }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Ціна товару: {{ $product->cost }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <!-- Додайте більше карток товарів, якщо потрібно -->
        </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    var urlParams = new URLSearchParams(window.location.search);
    var filterValue = urlParams.get('filter');
    filterValue = (filterValue == null ? "Base" : filterValue);
    document.getElementById("filterSelect").value = filterValue;


    function handleFilterChange(selectedValue) {
        console.log("Вибрано значення фільтра: " + selectedValue);
        if (selectedValue == 'Base'){
            var Url = window.location.origin + window.location.pathname
        }else {
            var Url = window.location.origin + window.location.pathname + '?filter=' + selectedValue;
        }
        window.location.href = Url;
    }
  </script>

@endsection
