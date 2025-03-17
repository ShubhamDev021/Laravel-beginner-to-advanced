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

    {{-- Switch statement --}}
    @switch(2)
        @case(1)
            First case...
            @break

        @case(2)
            Second case...
            @break

        @default
            Default case...
    @endswitch
    <br><br>

    {{-- for loop statement --}}
    @for ($i = 0; $i < 10; $i++)
        The current value is {{ $i }}
        <br>
    @endfor
    <br><br>

    {{-- foreach loop statement --}}
    @php
        $users = array();
        $users[] = ['id' => 1, 'name' => 'ayush'];
        $users[] = ['id' => 2, 'name' => 'shubham'];
        $users[] = ['id' => 3, 'name' => 'akansha'];
    @endphp
    @foreach ($users as $user)
        <p>This is user {{ $user['id'] }}</p>
        <p>Name: {{ $user['name'] }}</p>
    @endforeach
    <br><br>

    {{-- while loop statement --}}
    @php $i = 1; @endphp
    @while ($i <= 5)
        <p>Value: {{ $i }}</p>
        @php $i++ @endphp
    @endwhile

    {{-- isset directive --}}
    @isset($records)
        $records is defined and is not null...
    @endisset
    <br><br>

@endsection