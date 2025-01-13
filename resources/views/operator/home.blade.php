@extends('layouts.operator.app')

@section('title', 'Beranda | Kawal Pilkada')

<style>
    /* Custom scrollbar for Webkit browsers (Chrome, Safari) */
    .table-responsive::-webkit-scrollbar {
        width: 0px; /* Hide scrollbar */
        background: transparent; /* Optional: make scrollbar area transparent */
    }
    
    /* Custom scrollbar for Firefox */
    .table-responsive {
        scrollbar-width: none; /* Hide scrollbar */
        -ms-overflow-style: none;  /* Internet Explorer 10+ */
    }
    #myPieChart {
        height: 400px;
    }
</style>

@section('content')
<h1 class="h4 mb-0 text-gray-800 font-weight-bold">Halo, {{ Auth::user()->profile->nama ?? 'no profile' }}!</h1>
<p class="mb-4 text-gray-500">Kawal Pilkada Batu Bara dengan menjaga tps dan formulir c1</p>

<div class="row">
    
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <a href="{{ route('operator.suara') }}" class="stretched-link"></a>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hasil Suara TPS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jlhSuara }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <a href="{{ route('operator.saksi') }}" class="stretched-link"></a>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Saksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jlhSaksi }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

@endsection
