@extends('user.main')

@section('content')
    @include('user.components.hero')

    @include('user.components.berita')
    
    @include('user.components.about-hero')

    @include('user.components.sewa-component')
@endsection
