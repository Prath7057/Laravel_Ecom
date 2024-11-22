@extends('masterLayout')
@section('title')
Admin
@endsection

@section('contents')
    @include('components.header')
    @yield('adminContent')
@endsection
