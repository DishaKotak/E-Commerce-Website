@extends('frontend.layouts.main')

@section('main-container')

<div class="container mt-5">
    <h2>Add Product</h2>

    <form action="/store-product" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Product Name</label>
            <input type="text" name="name" class="form-control"><br> 
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea><br>
        </div>

        <div>
            <label>Price</label>
            <input type="text" name="price" class="form-control"><br>
        </div>

        <div>
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

@endsection
