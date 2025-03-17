@extends('layouts.master')

@section('content')
    This is page 1
    <br><br>

    {{-- If statement --}}
    @if (1 == 1)
        If block
    @endif
    <br><br>

    {{-- Else statement --}}
    @if (1 == 2)
        If block
    @else
        Else block
    @endif
    <br><br>

    {{-- Else if ladder statement --}}
    @if (1 == 2)
        If block
    @elseif (2 == 2)
        Else if block
    @else
        Else block
    @endif
    <br><br>

@endsection