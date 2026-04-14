@php

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

      /* blog list */
      .blog-list {
        margin: 60px 0;
      }

      .blog-item {
        display: flex;
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 8px 20px -5px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        transition: 0.3s;
      }

      .blog-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 30px -10px rgba(198, 164, 63, 0.15);
      }

      .blog-thumbnail {
        flex: 0 0 260px;
        background-size: cover;
        background-position: center;
      }

      .blog-content {
        flex: 1;
        padding: 30px;
      }

      .blog-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 12px;
        font-size: 14px;
        color: #C6A43F;
        font-weight: 500;
      }

      .blog-meta span i {
        margin-right: 5px;
        font-size: 12px;
      }

      .blog-title {
        font-size: 24px;
        margin-bottom: 12px;
      }

      .blog-title a {
        text-decoration: none;
        color: #0A192F;
      }

      .blog-title a:hover {
        color: #C6A43F;
      }

      .blog-excerpt {
        color: #4a5568;
        margin-bottom: 16px;
      }

      .blog-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .read-more {
        color: #C6A43F;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
      }

      .read-more i {
        transition: 0.2s;
      }

      .read-more:hover i {
        transform: translateX(5px);
      }

      .blog-tags {
        display: flex;
        gap: 10px;
      }

      .tag {
        background: #F0EEE9;
        padding: 4px 12px;
        border-radius: 40px;
        font-size: 12px;
        font-weight: 500;
        color: #0A192F;
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
    <x-filter-bar :$filters contentId="blogList" paginationId="paginationContainer" />

    <div class="blog-list" id="blogList">
      @if ($admissions->isEmpty())
        <div class="no-results"
          style="padding: 40px; text-align: center; background: white; border-radius: 30px; box-shadow: 0 8px 20px -5px rgba(0,0,0,.05); margin: 30px 0;">
          <h3>No admission records found</h3>
          <p>Please adjust your filters to see results. Try selecting a different year, university,
            or program.</p>
        </div>
      @else
        @foreach ($admissions as $admission)
          <x-admission.admission-card :$admission />
        @endforeach
      @endif
    </div>

    <div id="paginationContainer">
      @if ($admissions->hasPages())
        {{ $admissions->links('vendor.pagination.custom') }}
      @endif
    </div>
  </div>
</x-app-layout>
