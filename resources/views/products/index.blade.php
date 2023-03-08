@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">

        <div class="card bg-light mt-3">
            <h2>Products Table</h2>
            <div class="card-header">
                Laravel 8 Import Export Excel to database Example
            </div>
            <div class="card-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import Product Data</button>
                    <a class="btn btn-warning" href="{{ route('export') }}">Export Product Data</a>
                </form>
            </div>
        </div>

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th>Image</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->detail }}</td>
                <td>
                    <img src="{{ asset('uploads/'.$product->file) }}" width="100px">
                </td>
                <td>
                    <form action=" {{ route('products.destroy',$product->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                        @can('product-edit')
                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('product-delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>





    {!! $products->links() !!}


    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
</div>
@endsection