@extends('masterLayout')

@section('title')
{{$product->prod_name}}
@endsection

@push('styles')
  
@endpush

@section('contents')
    @include('components.header')
    
@endsection
