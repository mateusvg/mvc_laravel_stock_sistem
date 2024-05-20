@extends('layouts.main')

@section('title', 'My App Welcome')

@section('content')
    <h1>Welcome</h1>
    {{-- @if (10 == 5)
        <h1 class=""> e true</h1>
    @else
        <h1>não e true {{$nome}}</h1>
    @endif --}}
    {{--
    @for ($i = 0; $i < count($arr); $i++)
        <span>{{$arr[$i]}} - {{$i}} ||</span>
    @endfor --}}
    @php
        $name = 'Welcome to Point of Sale PHP';
        echo $name;
    @endphp

@endsection
