@extends('layouts.app')
@section('title', 'Buat Post Baru')
@section('content')
<div class="wrapper">
    <h1>Buat Post Baru</h1>

    @if (session('success'))
    <div class="alert-success">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ url('tenants') }}">
        @csrf
        <input name="tenant" type="text" placeholder="Tenant...">
        <input name="name" type="text" placeholder="Name...">
        <input name="email" type="email" placeholder="Email...">
        <input name="password" type="password" placeholder="Password...">
        <button class="btn-blue">Submit</button>
    </form>
</div>
@endsection
