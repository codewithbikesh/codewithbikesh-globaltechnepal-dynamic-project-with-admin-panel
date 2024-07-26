@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.product-details.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{route("admin.product-details.update",$productDetails->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Title</label>
                                <input type="text" name="name" id="name" value="{{ $productDetails->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control summernote @error('description') is-invalid @enderror" placeholder="Description">{{ $productDetails->description }}</textarea>
                                @error('description')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="">Products Category <span class="text-danger">*</span></label>
                                <select name="cat_id" class="custom-select tm-select-accounts" id="category">
                                    <option selected="" value="{{ $productDetails->productCategory->id }}">{{$productDetails->productCategory->name}}</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image">Upload Logo</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                                <div class="mt-2">
                                    
                                    @if(!empty($product->image))
                                    <div>
                                        <img src="{{ $productDetails->image }}" alt="" width="100px" height="100px">
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="is_active">Is Active</label>
                                <input type="checkbox" name="is_active" id="is_active" {{ $productDetails->is_active == 1 ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.product-details.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
