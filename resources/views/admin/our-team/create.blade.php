@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Our Team</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.our-team.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{route('admin.our-team.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Employees Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="position">Position</label>
                                <input type="text" name="position" id="position" value="{{ old('position') }}" class="form-control @error('position') is-invalid @enderror" placeholder="position">
                                @error('position')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="facebook">Facebook Link</label>
                                <input type="text" name="facebook" id="facebook" value="{{ old('facebook') }}" class="form-control @error('facebook') is-invalid @enderror" placeholder="Facebook">
                                @error('facebook')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="twitter">Twitter Link</label>
                                <input type="text" name="twitter" id="twitter" value="{{ old('twitter') }}" class="form-control @error('twitter') is-invalid @enderror" placeholder="Twitter">
                                @error('twitter')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="linkedin">LinkedIn Link</label>
                                <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin') }}" class="form-control @error('linkedin') is-invalid @enderror" placeholder="Linkedin">
                                @error('linkedin')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image">Upload Image</label>
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
                <a href="{{ route('admin.our-team.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
