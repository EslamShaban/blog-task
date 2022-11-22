@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store')}}" id="create-post-form" enctype="multipart/form-data" novalidate>
                        @csrf
                                      
                        <div class="form-group mb-3">
                            <label for="username">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}" required>
                            @error('title')
                                <span class="error invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="username">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" required>{{old('description')}}</textarea>
                            @error('description')
                                <span class="error invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                                      
                        <div class="form-group">
                            <label for="file">Image</label>
                            <div class="uploadOuter">
                            <span class="dragBox" >
                                <i class="fal fa-cloud-upload-alt fa-2x"></i>
                                <input type="file" name="image" class="@error('image') is-invalid @enderror" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  required/>
                                @error('image')
                                    <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </span>
                            </div>
                            <div id="preview"></div>
                        </div>
                        <button class="btn btn-primary" type="submit" style="display:block;margin:auto">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
