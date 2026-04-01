@extends('user.main')

@section('content')
    @include('user.components.hero')

    @include('user.components.about-hero')
    
    @include('user.components.kegiatan')

    @include('user.components.sewa-component')
@endsection
