@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6 heading" style="float: left"><h3>{{$title}}</h3></div>
            <div class="col-md-6 heading-link heading-link-all" style="float: right;text-align: right;">
                <a class="btn btn-success" href="{{ url('category') }}" > View Category</a>
            </div>
        </div>
        @error('products')
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror
        <form method="POST" action="{{ isset($category->id) ?  route('category.store','id='. $category->id) : route('category.store')  }}"  enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="name" >Name<span style="color: red">*</span></label>
                        <input id="name" type="text"   class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($category->name)? $category->name : old('name') }}"  autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="image" >Image<span style="color: red">*</span></label>
                        <input id="image" type="file"   class="form-control @error('image') is-invalid @enderror" name="image" value="{{ isset($category->image)? $category->image : old('image') }}" >
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="category" >Category<span style="color: red">*</span></label>
                        <select id="category" name="category" class="form-control @error('category') is-invalid @enderror">
                            <option value=""> Select Category</option>
                            @foreach ($categorys as $loca)
                            <option value="{{$loca->id}}"  @if($loca->id == old('category', isset($category->parent_id)?$category->parent_id:''))
                                selected="selected"
                                @endif> {{$loca->name}}
                            </option>
                            @endforeach
                        </select> 
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer user-edit-footer">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-right">{{$button}}</button>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('js/category.js') }}"></script>
@endsection