@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6 heading" style="float: left"><h3>{{$title}}</h3></div>
            <div class="col-md-6 heading-link heading-link-all" style="float: right;text-align: right;">
                <a class="btn btn-success" href="{{ url('products') }}" > View Category</a>
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
        <form method="POST" action="{{ isset($products->id) ?  route('products.store','id='. $products->id) : route('products.store')  }}"  enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label for="name" >Name<span style="color: red">*</span></label>
                        <input id="name" type="text"   class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($products->name)? $products->name : old('name') }}"  autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="category" >Category<span style="color: red">*</span></label>
                        <select id="category" name="category" class="form-control @error('category') is-invalid @enderror">
                            <option value=""> Select Category</option>
                            @foreach ($category as $loca)
                            <option value="{{$loca->id}}"  @if($loca->id == old('category', isset($products->category_id)?$products->category_id:''))
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
                    <div class="form-group  col-md-4">
                        <label for="image" >Image<span style="color: red">*</span></label>
                        <input id="image" type="file"   class="form-control @error('image') is-invalid @enderror" name="image" value="{{ isset($products->image)? $products->image : old('image') }}" >
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="description" >Description<span style="color: red">*</span></label>
                        <textarea id="description" type="text"  class="form-control @error('description') is-invalid @enderror" name="description">
                            {{ isset($products->description)? $products->description : old('description') }}
                        </textarea>
                        @error('description')
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
<script src="{{ asset('js/product.js') }}"></script>
@endsection