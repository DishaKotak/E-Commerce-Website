@extends('admin.layout.main')

@section('main-container')

    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PRICE</th>
                    {{-- <th scope="col">IN STOCK</th>
                    <th scope="col">EXPIRE DATE</th> --}}
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <th scope="row">
                        <input type="checkbox" value="{{ $product->id }}" />
                    </th>

                    <td class="tm-product-name">
                        {{ $product->name }}
                    </td>

                    <td>
                    {{ number_format($product->price, 0) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <div class="text-end mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-block text-uppercase">
                Add New Product
            </a>
            </div>
            <td>
            <form action="{{ route('products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-primary btn-block text-uppercase">
                Delete Selected Product
            </button>
            </form>
            </td>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
            <h2 class="tm-block-title">Product Categories</h2>
            <div class="tm-product-table-container">
              <table class="table tm-table-small tm-product-table">
                <tbody>
                  <tr>
                    <td class="tm-product-name">Product Category 1</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 2</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 3</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 4</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 5</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 6</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 7</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 8</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 9</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 10</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="tm-product-name">Product Category 11</td>
                    <td class="text-center">
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <button class="btn btn-primary btn-block text-uppercase mb-3">
              Add new category
            </button>
          </div>
        </div>
      </div>
    </div>

@endsection
