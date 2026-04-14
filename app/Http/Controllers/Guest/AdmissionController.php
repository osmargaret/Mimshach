<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\University;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        // Get unique values from database for filters
        $years = ['All Years', ...Admission::distinct()->pluck('year')->sort()->toArray()];
        $universitiesList = University::orderBy('name')->pluck('name')->toArray();
        $universities = ['All Universities', ...$universitiesList];
        $programs = ['All Programs', ...Admission::distinct()->pluck('program')->sort()->toArray()];
        $countries = ['All Countries', ...Admission::distinct()->pluck('country')->sort()->toArray()];

        // Build filters array (keep it simple)
        $filters = [
            [
                'type' => 'select',
                'name' => 'year',
                'label' => 'Year',
                'options' => $years,
            ],
            [
                'type' => 'select',
                'name' => 'university',
                'label' => 'University',
                'options' => $universities,
            ],
            [
                'type' => 'select',
                'name' => 'program',
                'label' => 'Program',
                'options' => $programs,
            ],
            [
                'type' => 'select',
                'name' => 'country',
                'label' => 'Country',
                'options' => $countries,
            ],
        ];

        // Apply filters to query
        $query = Admission::query();

        if ($request->year && $request->year !== 'All Years') {
            $query->where('year', $request->year);
        }

        if ($request->university && $request->university !== 'All Universities') {
            $query->whereHas('university', function ($q) use ($request) {
                $q->where('name', $request->university);
            });
        }

        if ($request->program && $request->program !== 'All Programs') {
            $query->where('program', $request->program);
        }

        if ($request->country && $request->country !== 'All Countries') {
            $query->where('country', $request->country);
        }

        $admissions = $query->with('university')
            ->latest()
            ->paginate(6)
            ->appends($request->query());

        return view('guest.admissions.index', compact('admissions', 'filters'));
    }

    public function show(Admission $admission)
    {
        $admission->load([
            'university.admissions' => fn ($query) => $query
                ->where('id', '!=', $admission->id)
                ->where('deadline', '>=', now())
                ->latest()
                ->limit(3),
        ]);

        $relatedAdmissions = $admission->university->admissions;

        return view('guest.admissions.admission', compact('admission', 'relatedAdmissions'));
    }
}
