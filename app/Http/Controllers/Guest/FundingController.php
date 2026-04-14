<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Funding;

class FundingController extends Controller
{
    public function index()
    {
        $fundings = Funding::with('university')->latest()->paginate(6);
        $educationLevels = Funding::select('education_level')->distinct()->pluck('education_level');

        return view('guest.fundings.index', compact('fundings', 'educationLevels'));
    }

    public function show(Funding $funding)
    {
        $relatedFundings = Funding::with('university')
            ->where('id', '!=', $funding->id)
            ->where(function ($query) use ($funding) {
                $query->where('education_level', $funding->education_level)
                    ->orWhere('university_id', $funding->university_id);
            })
            ->limit(3)
            ->get();

        return view('guest.fundings.funding', compact('funding', 'relatedFundings'));
    }
}
