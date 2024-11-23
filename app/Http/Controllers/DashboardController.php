<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsedFeaturedResource;
use App\Models\UsedFeature;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $usedFeatures = UsedFeature::query()
        ->with(['feature'])
        ->where("user_id", auth()->user()->id)
        ->latest()
        ->paginate();

        return Inertia::render('Dashboard', [
            'usedFeatures' => UsedFeaturedResource::collection($usedFeatures)
        ]);
    }
}
