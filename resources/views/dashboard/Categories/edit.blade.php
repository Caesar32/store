@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Edit Category</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>

                        <div class="card-body">
                            <!-- Display validation errors -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Form to edit the category -->
                            <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="{{ old('name', $category->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="parent_id">Parent Category</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="">Primary Category</option>
                                        @foreach($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}" 
                                                {{ $parentCategory->id == $category->parent_id ? 'selected' : '' }}>
                                                {{ $parentCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="image">Category Image</label>
                                    <input type="file" name="image" class="form-control-file">
                                    @if($category->image)
                                        <img src="{{ asset('uploads/categories/' . $category->image) }}" 
                                             alt="Category Image" class="img-thumbnail mt-2" width="100">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update Category</button>
                                    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
