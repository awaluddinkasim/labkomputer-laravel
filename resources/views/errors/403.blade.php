@extends('layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-error">
                <div class="page-inner">
                    <h2>Error</h2>
                    <h1>403</h1>
                    <div class="page-description">
                        Anda tidak memiliki akses.
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="document.location.href='{{ route('dashboard') }}'">
                            <i class="fas fa-chevron-left"></i>
                            <span class="ml-3">Dashboard</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
