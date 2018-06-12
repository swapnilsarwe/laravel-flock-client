<?php

namespace SwapnilSarwe\LaravelFlockClient\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use SwapnilSarwe\LaravelFlockClient\Services\FlockAppService;

class FlockAppController extends Controller
{
    public function index()
    {
        return ["status" => "OK"];
    }

    public function eventListener(Request $request, FlockAppService $flockAppService)
    {
        Log::debug($request->all());
        return $flockAppService->eventListener($request);
    }

    public function configuration(Request $request)
    {
        Log::debug($request->all());
        $viewData = array();
        return view('flock-app::configuration', $viewData);
    }
}
