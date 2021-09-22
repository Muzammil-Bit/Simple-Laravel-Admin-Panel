<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IplPrediction;
use Illuminate\Http\Request;

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
}
