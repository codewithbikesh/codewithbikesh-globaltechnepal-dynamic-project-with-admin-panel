@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Clients Logo</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('admin.client.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                @error('title')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image">Upload Logo</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="is_active">Is Active</label>
                                <input type="checkbox" name="is_active" id="is_active" {{ old('is_active') ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.client.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
