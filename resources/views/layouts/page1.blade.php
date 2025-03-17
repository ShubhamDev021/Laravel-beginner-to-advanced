@extends('layouts.master')

@section('content')
    This is page 1
    <br><br>

    {{-- If statement --}}
    @if (1 == 1)
        If block
    @endif
    <br><br>

@endsection