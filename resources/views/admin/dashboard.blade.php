@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_heading', 'Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- Dashboard stats or quick links -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5>Total Stations</h5>
          <p>{{ $stationsCount ?? '—' }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5>Total Trains</h5>
          <p>{{ $trainsCount ?? '—' }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- More dashboard components go here -->
</div>
@endsection
