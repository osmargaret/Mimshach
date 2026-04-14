<x-app-layout pageTitle="Blog & Resources | Mimshach">
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

      /* Blog specific styles */
      .blog-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin: 60px 0;
      }

      .blog-card {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 8px 20px -5px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
      }

      .blog-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 30px -10px rgba(198, 164, 63, 0.15);
      }

      .blog-thumbnail {
        height: 200px;
        background-size: cover;
        background-position: center;
      }

      .blog-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
      }

      .blog-category {
        display: inline-block;
        background: #F0EEE9;
        color: #C6A43F;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 40px;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .blog-title {
        font-size: 22px;
        margin-bottom: 12px;
        line-height: 1.3;
      }

      .blog-title a {
        text-decoration: none;
        color: #0A192F;
      }

      .blog-title a:hover {
        color: #C6A43F;
      }

      .blog-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 12px;
        color: #666;
        font-size: 14px;
      }

      .blog-meta i {
        color: #C6A43F;
        margin-right: 4px;
      }

      .blog-excerpt {
        color: #4a5568;
        margin-bottom: 20px;
        flex: 1;
        line-height: 1.6;
      }

      .blog-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #eee;
        padding-top: 16px;
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

      .blog-date {
        color: #999;
        font-size: 13px;
      }

      /* Category filter pills */
      .category-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin: 40px 0 20px;
      }

      .category-pill {
        background: white;
        border: 1px solid #e0e0e0;
        color: #0A192F;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
      }

      .category-pill:hover,
      .category-pill.active {
        background: #C6A43F;
        border-color: #C6A43F;
        color: #0A192F;
      }

      .category-pill.disabled {
        opacity: 0.6;
        cursor: not-allowed;
      }

      @media (max-width: 992px) {
        .blog-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (max-width: 768px) {
        .blog-grid {
          grid-template-columns: 1fr;
        }

        .category-filters {
          justify-content: flex-start;
          overflow-x: auto;
          padding-bottom: 10px;
        }
      }
    </style>
  </x-slot:styles>

  <x-page-header subtitle="Expert advice, guides, and resources for your study abroad journey"
    title="Blog & Resources" />

  <div class="container">
    <div class="blog-grid" id="blogGrid">
      @if ($blogs->isEmpty())
        <div class="no-results"
          style="padding: 40px; text-align: center; background: white; border-radius: 30px; box-shadow: 0 8px 20px -5px rgba(0,0,0,.05); margin: 30px 0;">
          <h3>No blog posts found</h3>
        </div>
      @else
        @foreach ($blogs as $blog)
          <x-blog.blog-card :$blog />
        @endforeach
      @endif
    </div>
    <div id="paginationContainer">
      @if ($blogs->hasPages())
        {{ $blogs->links('vendor.pagination.custom') }}
      @endif
    </div>
</x-app-layout>
