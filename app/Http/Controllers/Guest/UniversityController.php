<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $countries = ['All Countries', ...University::distinct()->pluck('country')->filter()->sort()->values()->toArray()];

        $fundingOptions = Funding::orderBy('name')->pluck('name')->unique()->toArray();

        $filters = [
            [
                'type' => 'search',
                'name' => 'search',
                'placeholder' => 'Search university...',
            ],
            [
                'type' => 'checkboxes',
                'name' => 'funding',
                'label' => 'Funding Type',
                'options' => $fundingOptions,
            ],
            [
                'type' => 'select',
                'name' => 'country',
                'label' => 'Country',
                'options' => $countries,
            ],
        ];

        $query = University::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->country && $request->country !== 'All Countries') {
            $query->where('country', $request->country);
        }

        if ($request->filled('funding')) {
            $fundingValues = $request->input('funding', []);
            $query->whereHas('fundings', function ($q) use ($fundingValues) {
                $q->whereIn('name', $fundingValues);
            });
        }

        $universities = $query->with('fundings')
            ->orderBy('name')
            ->paginate(6)
            ->appends($request->query());

        return view('guest.universities.index', compact('universities', 'filters'));
    }

    public function show(University $university)
    {
        $university->load([
            'admissions' => fn ($query) => $query->orderBy('deadline', 'asc'),
        ]);

        return view('guest.universities.university', compact('university'));
    }
}
