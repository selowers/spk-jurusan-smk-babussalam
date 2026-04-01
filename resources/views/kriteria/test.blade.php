@extends('layouts.app')

@section('title', 'Test Kriteria')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1>Test Kriteria</h1>
            </div>
            <div class="card-body">
                <p>Jumlah kriteria: {{ $kriterias->count() }}</p>
                @foreach($kriterias as $kriteria)
                    <p>{{ $kriteria->nama_kriteria }} - {{ $kriteria->bobot }}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection