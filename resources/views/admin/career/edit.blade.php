@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Career Edit</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.career.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('admin.career.update', $careers->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="jobcategory">Job Category</label>
                                <input type="text" name="jobcategory" id="jobcategory" value="{{ $careers->jobCategory }}" class="form-control @error('jobcategory') is-invalid @enderror" placeholder="Job Category">
                                @error('jobcategory')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="position">Job Category</label>
                                <input type="text" name="position" id="position" value="{{ $careers->position }}" class="form-control @error('position') is-invalid @enderror" placeholder="Employee Position">
                                @error('position')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="vacancies">No. Of Vacancies</label>
                                <input type="number" name="vacancies" id="vacancies" value="{{ $careers->totalPositions }}" class="form-control @error('vacancies') is-invalid @enderror" placeholder="Number of Vacancies">
                                @error('vacancies')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="qualification">Qualification</label>
                                <input type="text" name="qualification" id="qualification" value="{{ $careers->qualification }}" class="form-control @error('qualification') is-invalid @enderror" placeholder="Qualification">
                                @error('qualification')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="experience">Experience</label>
                                <input type="text" name="experience" id="qualification" value="{{ $careers->experience }}" class="form-control @error('experience') is-invalid @enderror" placeholder="Experience">
                                @error('experience')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="gender">
                                    <div id="gender" class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="male" value="male" class="form-check-input @error('gender') is-invalid @enderror" {{ $careers->gender == 'male' ? 'checked' : '' }}>
                                        <label for="male" class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="female" value="female" class="form-check-input @error('gender') is-invalid @enderror" {{ $careers->gender == 'female' ? 'checked' : '' }}>
                                        <label for="female" class="form-check-label">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="other" value="other" class="form-check-input @error('gender') is-invalid @enderror" {{ $careers->gender == 'other' ? 'checked' : '' }}>
                                        <label for="other" class="form-check-label">Other</label>
                                    </div>
                                    @error('gender')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div> 
                            <div class="mb-3">
                                <label for="last_date">Last Date of Vacancy</label>
                                <input type="date" name="last_date" id="last_date" value="{{ $careers->lastDate }}" class="form-control @error('last_date') is-invalid @enderror" placeholder="Last Date Of Vacancy">
                                @error('last_date')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control summernote @error('description') is-invalid @enderror" placeholder="Description">{{ $careers->description }}</textarea>
                                @error('description')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="is_active">Is Active</label>
                                <input type="checkbox" name="is_active" id="is_active" {{ $careers->is_active == 1 ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.career.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
