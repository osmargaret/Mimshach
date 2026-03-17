@php
  $filters = [
      [
          'type' => 'search',
          'name' => 'search',
          'placeholder' => 'Search university...'
      ],
      [
          'type' => 'checkboxes',
          'name' => 'funding',
          'label' => 'Funding Type',
          'options' => ['Grant', 'Loan', 'Scholarship']
      ],
      [
          'type' => 'select',
          'name' => 'country',
          'label' => 'Country',
          'options' => [
              'All Countries',
              'Australia',
              'Canada',
              'Germany',
              'New Zealand',
              'Singapore',
              'South Africa',
              'Switzerland',
              'UK',
              'USA'
          ]
      ]
  ];

  $universities = [
      [
          'name' => 'University of Melbourne',
          'country' => 'Australia',
          'description' =>
              "Australia's leading university with strong programs in business and engineering.",
          'funding' => ['Grant', 'Scholarship'],
          'image' =>
              'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'name' => 'University of Toronto',
          'country' => 'Canada',
          'description' =>
              'Top research university in Canada with diverse undergraduate and graduate programs.',
          'funding' => ['Loan', 'Scholarship'],
          'image' =>
              'https://images.unsplash.com/photo-1517486808906-6ca8b3f8e1c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'name' => "King's College London",
          'country' => 'UK',
          'description' =>
              'Prestigious UK university known for law, medicine, and international relations.',
          'funding' => ['Grant', 'Loan', 'Scholarship'],
          'image' =>
              'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'name' => 'University of Sydney',
          'country' => 'Australia',
          'description' =>
              "One of Australia's oldest universities with strong programs in arts and sciences.",
          'funding' => ['Grant', 'Scholarship'],
          'image' =>
              'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'name' => 'University of British Columbia',
          'country' => 'Canada',
          'description' =>
              'Leading Canadian university with a beautiful campus and strong research focus.',
          'funding' => ['Loan', 'Scholarship'],
          'image' =>
              'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ],
      [
          'name' => 'University of Edinburgh',
          'country' => 'UK',
          'description' =>
              'Historic UK university with strong programs in humanities and sciences.',
          'funding' => ['Grant', 'Loan'],
          'image' =>
              'https://images.unsplash.com/photo-1509395062183-67c691481df8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80',
          'url' => '#'
      ]
  ];
@endphp

<x-app-layout pageTitle="Universities | Mimshach">
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

      @media (max-width: 992px) {
        .uni-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (max-width: 768px) {
        .uni-grid {
          grid-template-columns: 1fr;
        }

        .filter-row {
          flex-direction: column;
          align-items: stretch;
        }

        .filter-checkboxes {
          justify-content: center;
        }

        .footer-grid {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </x-slot:styles>

  <x-page-header
    subtitle="Explore top institutions around the world offering programs for international students"
    title="Partner Universities" />

  <div class="container">
    <x-filter-bar :$filters />

    <div class="uni-grid" id="uniGrid">
      @foreach ($universities as $university)
        <x-university.university-card :$university />
      @endforeach
    </div>
  </div>
</x-app-layout>
