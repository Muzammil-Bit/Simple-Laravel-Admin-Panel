<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IplPrediction;
use App\Models\IplPredictionToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollsController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|string|unique:ipl_predictions,unique_id',
            'team_id' => 'required|integer',
            'team_name' => 'required|string',
        ]);

        $ipl = new IplPrediction();
        $ipl->unique_id = $request->unique_id;
        $ipl->team_id = $request->team_id;
        $ipl->team_name = $request->team_name;
        if ($ipl->save()) {
            return ['success' => true, 'message' => 'Answer Added Successfuly.'];
        }
    }

    public function getAnswers()
    {
        $results = DB::select(DB::raw("select team_id , count(*) * 100.0 / (select count(*) from ipl_predictions) as percentage from ipl_predictions group by team_id"));
        return ['success' => true, 'data' => $results];
    }

    public function storeToday(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|string|unique:ipl_predictions,unique_id',
            'team_id' => 'required|integer',
            'team_name' => 'required|string',
            'date' => 'required|string',
        ]);

        $ipl = new IplPredictionToday();
        $ipl->unique_id = $request->unique_id;
        $ipl->team_id = $request->team_id;
        $ipl->team_name = $request->team_name;
        $ipl->date = $request->date;

        if ($ipl->save()) {
            return ['success' => true, 'message' => 'Answer Added Successfuly.'];
        }
    }


    public function getToday(Request $request)
    {
        $request->validate(['date' => 'required|string']);

        $results = DB::select(DB::raw("select team_id , count(*) * 100.0 / (select count(*) from ipl_predictions WHERE date='" . $request->date . "') as percentage from ipl_predictions WHERE date='" . $request->date . "' group by team_id"));
        return ['success' => true, 'data' => $results];
    }
}
