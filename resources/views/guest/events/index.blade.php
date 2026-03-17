@php
  $filters = [
      [
          'type' => 'search',
          'name' => 'search',
          'placeholder' => 'Search events...'
      ],
      [
          'type' => 'select',
          'name' => 'city',
          'label' => 'City',
          'options' => [
              'All Cities',
              'Berlin',
              'Melbourne',
              'New York',
              'Online',
              'Paris',
              'San Francisco',
              'Sydney'
          ]
      ]
  ];

  $events = [
      [
          'title' => 'Study in the UK Virtual Fair',
          'date' => 'March 25, 2026',
          'time' => '3:00 PM GMT',
          'description' =>
              'Meet representatives from top UK universities and get your questions answered.',
          'venue' => 'Online (Zoom)',
          'city' => 'Online',
          'image' =>
              'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'title' => 'USA MBA Admissions Workshop',
          'date' => 'April 2, 2026',
          'time' => '6:00 PM EST',
          'description' => 'Learn how to craft a winning application for top business schools.',
          'venue' => 'New York Public Library',
          'city' => 'New York',
          'image' =>
              'https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'title' => 'Germany Education Expo',
          'date' => 'April 10, 2026',
          'time' => '10:00 AM CET',
          'description' => 'Explore study opportunities in Germany – from engineering to arts.',
          'venue' => 'Berlin Congress Center',
          'city' => 'Berlin',
          'image' =>
              'https://images.unsplash.com/photo-1555888997-1e4b3e3b0b0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'title' => 'Scholarship Application Bootcamp',
          'date' => 'April 18, 2026',
          'time' => '2:00 PM AEST',
          'description' => 'Step-by-step guidance on finding and applying for scholarships.',
          'venue' => 'University of Sydney',
          'city' => 'Sydney',
          'image' =>
              'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'title' => 'Canadian Study Permit Webinar',
          'date' => 'April 25, 2026',
          'time' => '4:00 PM EST',
          'description' =>
              'Immigration experts explain the latest visa rules and application process.',
          'venue' => 'Online (Microsoft Teams)',
          'city' => 'Online',
          'image' =>
              'https://images.unsplash.com/photo-1517486808906-6ca8b3f8e1c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'title' => 'European Business Schools Mixer',
          'date' => 'May 3, 2026',
          'time' => '6:30 PM CET',
          'description' => 'Network with admissions directors from INSEAD, HEC, and LBS.',
          'venue' => 'Hotel de Crillon, Paris',
          'city' => 'Paris',
          'image' =>
              'https://images.unsplash.com/photo-1541339901998-67808f4b9c3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'title' => 'Australia Student Housing Info Session',
          'date' => 'May 12, 2026',
          'time' => '11:00 AM AEST',
          'description' =>
              'Everything you need to know about accommodation options Down Under.',
          'venue' => 'Melbourne Convention Centre',
          'city' => 'Melbourne',
          'image' =>
              'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'title' => 'STEM Graduate Programs Fair',
          'date' => 'May 20, 2026',
          'time' => '1:00 PM PST',
          'description' => 'Meet faculty from top STEM graduate schools in the US and Canada.',
          'venue' => 'San Francisco Marriott',
          'city' => 'San Francisco',
          'image' =>
              'https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ]
  ];
@endphp

<x-app-layout pageTitle="Events | Mimshach">
  <x-slot:styles>
    <style>
      /* pagination */
      .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin: 60px 0;
      }

      .page-item {
        list-style: none;
      }

      .page-link {
        display: block;
        padding: 10px 18px;
        background: white;
        border-radius: 50px;
        color: #0A192F;
        text-decoration: none;
        font-weight: 500;
        transition: 0.2s;
        border: 1px solid transparent;
      }

      .page-link:hover,
      .page-link.active {
        background: #C6A43F;
        color: #0A192F;
        border-color: #C6A43F;
      }

      @media (max-width: 768px) {
        .event-overlay {
          flex-direction: column;
          align-items: flex-start;
          gap: 20px;
        }

        .event-register {
          margin-left: 0;
          width: 100%;
        }

        .btn-register {
          width: 100%;
          text-align: center;
        }

        .filter-bar {
          flex-direction: column;
          border-radius: 30px;
        }

        .footer-grid {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </x-slot:styles>

  <x-page-header
    subtitle="Join webinars, university fairs, and networking sessions around the world"
    title="Upcoming Events" />

  <div class="container">
    <x-filter-bar :$filters />

    <div class="events-list">
      @foreach ($events as $event)
        <x-event.event-card :$event />
      @endforeach
    </div>
  </div>
</x-app-layout>
