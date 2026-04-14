<x-app-layout pageTitle="Funding Opportunities | Study Abroad">
  <x-slot:styles>
    <style>
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

      /* fundings grid */
      .fundings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin: 60px 0;
      }

      .funding-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        display: block;
      }

      .funding-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      }

      .funding-image {
        height: 200px;
        overflow: hidden;
        position: relative;
      }

      .funding-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
      }

      .funding-card:hover .funding-image img {
        transform: scale(1.05);
      }

      .funding-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: #C6A43F;
        color: #0A192F;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
      }

      .funding-content {
        padding: 24px;
      }

      .funding-title {
        font-size: 22px;
        font-weight: 700;
        color: #0A192F;
        margin-bottom: 8px;
        font-family: 'Playfair Display', serif;
      }

      .funding-university {
        color: #C6A43F;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .funding-university i {
        font-size: 12px;
      }

      .funding-description {
        color: #4a5568;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }

      .funding-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
      }

      .education-level {
        background: #f0f3ff;
        color: #0A192F;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
      }

      .view-link {
        color: #C6A43F;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: transform 0.2s;
      }

      .funding-card:hover .view-link {
        transform: translateX(5px);
      }

      .no-results {
        padding: 60px 40px;
        text-align: center;
        background: white;
        border-radius: 30px;
        box-shadow: 0 8px 20px -5px rgba(0, 0, 0, 0.05);
        margin: 30px 0;
      }

      .no-results i {
        font-size: 64px;
        color: #C6A43F;
        margin-bottom: 20px;
        display: block;
      }

      .no-results h3 {
        font-size: 24px;
        margin-bottom: 12px;
        color: #0A192F;
      }

      .no-results p {
        color: #4a5568;
      }

      @media (max-width: 768px) {
        .fundings-grid {
          grid-template-columns: 1fr;
          gap: 20px;
        }

        .funding-content {
          padding: 20px;
        }

        .funding-title {
          font-size: 20px;
        }
      }
    </style>
  </x-slot:styles>

  <x-page-header 
    subtitle="Discover scholarships, grants, and loans to support your study abroad journey"
    title="Funding Opportunities" 
  />

  <div class="container">

    <div class="fundings-grid" id="fundingsGrid">
      @if ($fundings->isEmpty())
        <div class="no-results">
          <i class="fas fa-search"></i>
          <h3>No funding opportunities found</h3>
          <p>Please adjust your filters to see more results.</p>
        </div>
      @else
        @foreach ($fundings as $funding)
          <x-funding.funding-card :$funding />
        @endforeach
      @endif
    </div>

    <div id="paginationContainer">
      @if ($fundings->hasPages())
        {{ $fundings->links('vendor.pagination.custom') }}
      @endif
    </div>
  </div>
</x-app-layout>