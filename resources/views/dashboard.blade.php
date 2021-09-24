@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        @php
        // Get the mostlikely team index
          $results = DB::select(DB::raw("select team_id , count(*) * 100.0 / (select count(*) from ipl_predictions) as percentage from ipl_predictions group by team_id"));
          $mostlikely = 0;
          $team_id = 0;

          foreach ($results as  $ind => $rest) {
            if($rest->percentage > $mostlikely){
              $team_id = $rest->team_id;
              $mostlikely = $rest->percentage;
            }
          }
        @endphp

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
                <i class="material-icons">date_range</i> Total Number of articles
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
                <i class="material-icons">sports_cricket</i>
              </div>
              <p class="card-category">Most Likely Team To Win</p>
              <h3 class="card-title">{{ App\Models\IplPrediction::where('team_id', $team_id)->first()->team_name }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">sports_cricket</i> Based on users answers
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
                    $answers = App\Models\IplPrediction::take(10)->get();
                  @endphp
                  @forelse ($answers as $index => $ans)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $ans->team_name }}</td>
                      <td>{{ $ans->team_id }}</td>
                    </tr>
                    @empty
                    <td colspan="3" class="text-center">Nothing found</td>
                  @endforelse
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