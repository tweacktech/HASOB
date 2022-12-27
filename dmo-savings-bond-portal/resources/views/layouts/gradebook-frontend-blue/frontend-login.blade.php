@extends('layouts.gradebook-frontend-blue.page-master-login')

@section('body')
    @yield('content')
@stop

@section('nav')
  @include('layouts.gradebook-frontend-blue.nav')
@stop

@section('footer-login')
  @include('layouts.gradebook-frontend-blue.footer-login')
@stop