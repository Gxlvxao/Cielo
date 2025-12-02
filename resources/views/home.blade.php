@extends('layouts.public')

@section('content')
    @include('components.header')
    
    <main>
        @include('components.hero')
        @include('components.about')
        @include('components.municipalities')
        @include('components.services')
        @include('components.off-market-cta')
    </main>
    
    @include('components.footer')
@endsection
