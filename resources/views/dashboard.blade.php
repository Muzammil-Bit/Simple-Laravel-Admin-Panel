@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Posted Articles</p>
              <h3 class="card-title">{{ App\Models\Article::where('status', App\Models\Article::POSTED)->count() }} Articles</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Draft Articles</p>
              <h3 class="card-title">{{ App\Models\Article::where('status', App\Models\Article::DRAFT)->count() }}
                <small>Articles</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-warning">article</i>
                <a href="#pablo">Post More Articles</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons"> person </i>
              </div>
              <p class="card-category">Total Answer Recieved</p>
              <h3 class="card-title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from IPL Return @ 2021 App
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-bat"></i>
              </div>
              <p class="card-category">Most Likely Teame To Win</p>
              <h3 class="card-title">AUB</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Graphs --}}

  
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Latest User Answers</h4>
              <p class="card-category">Predictions given by last 10 users</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Team Name</th>
                  <th>Team ID</th>
                </thead>
                <tbody>
                  @php
                    $answers = App\Models\IplPrediction::get();
                  @endphp
                  @foreach ($answers as $index => $ans)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $ans->team_name }}</td>
                      <td>{{ $ans->team_id }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush