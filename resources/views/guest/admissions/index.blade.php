@php
  $filters = [
      [
          'type' => 'select',
          'name' => 'year',
          'label' => 'Year',
          'options' => ['All Years', '2026', '2025']
      ],
      [
          'type' => 'select',
          'name' => 'university',
          'label' => 'University',
          'options' => [
              'All Universities',
              'University of Melbourne',
              'University of Oxford',
              'Harvard University',
              'University of Toronto',
              'LMU Munich',
              'Imperial College London',
              'Australian National University',
              'Stanford University',
              'Trinity College Dublin',
              'INSEAD'
          ]
      ],
      [
          'type' => 'select',
          'name' => 'program',
          'label' => 'Program',
          'options' => [
              'All Programs',
              'Business',
              'Law',
              'MBA',
              'Engineering',
              'Computer Science',
              'Medicine',
              'Environmental Science',
              'PhD',
              'Data Science'
          ]
      ],
      [
          'type' => 'select',
          'name' => 'country',
          'label' => 'Country',
          'options' => [
              'All Countries',
              'Australia',
              'UK',
              'USA',
              'Canada',
              'Germany',
              'Ireland',
              'France'
          ]
      ]
  ];
  $admissions = [
      [
          'image' =>
              'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'date' => 'Feb 15, 2026',
          'university' => 'University of Melbourne',
          'country' => 'Australia',
          'title' => 'Early Application Deadlines for 2026',
          'excerpt' =>
              'Many top universities have moved their deadlines earlier. Learn how to prepare your application on time.',
          'url' => '#',
          'tags' => ['Business', '2026']
      ],
      [
          'image' =>
              'https://images.unsplash.com/photo-1541339901998-67808f4b9c3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'date' => 'Jan 10, 2025',
          'university' => 'University of Oxford',
          'country' => 'UK',
          'title' => 'Scholarship Opportunities in the UK for 2025',
          'excerpt' =>
              'A comprehensive guide to Chevening, Commonwealth, and university-specific scholarships.',
          'url' => '#',
          'tags' => ['Law', '2025']
      ],
      [
          'image' =>
              'https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'date' => 'Mar 1, 2026',
          'university' => 'Harvard University',
          'country' => 'USA',
          'title' => 'MBA Deadlines: What You Need to Know',
          'excerpt' =>
              'Round 1 vs Round 2 - which is better for you? Key dates for top business schools.',
          'url' => '#',
          'tags' => ['MBA', '2026']
      ],
      [
          'image' =>
              'https://images.unsplash.com/photo-1517486808906-6ca8b3f8e1c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'date' => 'Apr 22, 2025',
          'university' => 'University of Toronto',
          'country' => 'Canada',
          'title' => 'Studying in Canada: New Visa Rules 2025',
          'excerpt' =>
              'Recent changes to the Student Direct Stream (SDS) and what they mean for applicants.',
          'url' => '#',
          'tags' => ['Engineering', '2025']
      ],
      [
          'image' =>
              'https://images.unsplash.com/photo-1555888997-1e4b3e3b0b0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'date' => 'May 5, 2026',
          'university' => 'LMU Munich',
          'country' => 'Germany',
          'title' => "Germany's Tuition-Free Universities",
          'excerpt' =>
              'How to apply to public universities in Germany with little to no tuition fees.',
          'url' => '#',
          'tags' => ['Computer Science', '2026']
      ]
  ];
@endphp

<x-app-layout pageTitle='Admission Insights | Mimshach Education Centre'>
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
        .blog-item {
          flex-direction: column;
        }

        .nav-toggle {
          display: block;
        }

        .nav-menu {
          display: none;
        }

        .nav-menu.open {
          display: flex;
          flex-direction: column;
          position: absolute;
          top: 64px;
          right: 20px;
          background: #0A192F;
          padding: 16px;
          border-radius: 12px;
          gap: 12px;
          width: calc(100% - 40px);
          box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .nav-menu.open a {
          color: white;
          padding: 10px 0;
        }

        .nav-menu li {
          width: 100%;
        }

        .nav-menu li.dropdown-open .dropdown-content {
          display: block;
          position: static;
          background: transparent;
          box-shadow: none;
          min-width: auto;
          padding: 0;
        }

        .nav-menu li.dropdown-open .dropdown-content a {
          color: white !important;
          padding: 8px 16px;
          display: block;
          background: rgba(255, 255, 255, 0.04);
          border-radius: 6px;
          margin-top: 6px;
        }

        .blog-thumbnail {
          height: 200px;
          flex: auto;
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

  <x-page-header subtitle="Stay updated with application deadlines, university news, and expert tips"
    title="Admission Insights" />

  <div class="container">
    <!-- Filter Bar -->
    <x-filter-bar :$filters />

    <div class="blog-list" id="blogList">
      @foreach ($admissions as $admission)
        <x-admission.admission-card :$admission />
      @endforeach
    </div>
    {{-- TODO: Pagination to be handled after implementing Eloquent Database --}}
  </div>
</x-app-layout>
