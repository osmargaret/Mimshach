<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use App\Models\NewsletterSubscription;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\University;
use App\Models\Admission;
use App\Models\Funding;
use App\Models\Blog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalConsultations = ConsultationRequest::count();
        $newConsultationsToday = ConsultationRequest::whereDate('created_at', Carbon::today())->count();

        $totalNewsletters = NewsletterSubscription::count();
        $newNewslettersToday = NewsletterSubscription::whereDate('subscribed_at', Carbon::today())->count();

        $totalEvents = Event::count();
        $upcomingEvents = Event::where('date', '>=', Carbon::today())->count();
        $totalEventRegistrations = EventRegistration::count();

        $totalUniversities = University::count();
        $totalAdmissions = Admission::count();
        $activeAdmissions = Admission::where('deadline', '>=', Carbon::today())->count();

        $totalFunding = Funding::count();
        $totalBlogs = Blog::count();

        // Recent data
        $recentConsultations = ConsultationRequest::latest()->take(5)->get();
        $recentNewsletters = NewsletterSubscription::latest()->take(5)->get();
        $recentEvents = Event::latest()->take(5)->get();

        // Chart data (last 7 days)
        $consultationChart = $this->getLast7DaysData(ConsultationRequest::class, 'created_at');
        $newsletterChart = $this->getLast7DaysData(NewsletterSubscription::class, 'subscribed_at');

        $stats = [
            [
                'label' => 'Total Consultations',
                'value' => $totalConsultations ?? 0,
                'icon' => '<svg class="text-primary h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>',
                'color' => 'primary',
                'change' => '+' . ($newConsultationsToday ?? 0) . ' from yesterday',
            ],
            [
                'label' => 'Newsletter Subscribers',
                'value' => $totalNewsletters ?? 0,
                'icon' => '<svg class="text-accent h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>',
                'color' => 'accent',
                'change' => '+' . ($newNewslettersToday ?? 0) . ' today',
            ],
            [
                'label' => 'Events',
                'value' => $totalEvents ?? 0,
                'icon' => '<svg class="h-8 w-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>',
                'color' => 'purple-500',
                'change' => ($upcomingEvents ?? 0) . ' upcoming events, ' . ($totalEventRegistrations ?? 0) . ' total registrations',
            ],
            [
                'label' => 'Content Overview',
                'value' => $totalUniversities ?? 0,
                'icon' => '<svg class="h-8 w-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>',
                'color' => 'orange-500',
                'change' => ($totalAdmissions ?? 0) . ' Admissions (' . ($activeAdmissions ?? 0) . ' active), ' . ($totalFunding ?? 0) . ' Funding | ' . ($totalBlogs ?? 0) . ' Blogs',
            ],
        ];

        // Pass to the view
        // return view('admin.dashboard', compact('stats', /* other variables */));

        return view('admin.dashboard', compact(
            'stats',
            'totalConsultations',
            'newConsultationsToday',
            'totalNewsletters',
            'newNewslettersToday',
            'totalEvents',
            'upcomingEvents',
            'totalEventRegistrations',
            'totalUniversities',
            'totalAdmissions',
            'activeAdmissions',
            'totalFunding',
            'totalBlogs',
            'recentConsultations',
            'recentNewsletters',
            'recentEvents',
            'consultationChart',
            'newsletterChart'
        ));
    }

    private function getLast7DaysData($model, $dateColumn)
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = $model::whereDate($dateColumn, $date)->count();
            $data['labels'][] = $date->format('M d');
            $data['values'][] = $count;
        }
        return $data;
    }
}
