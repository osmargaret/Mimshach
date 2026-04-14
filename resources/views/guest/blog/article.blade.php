@php
  $pageTitle = $article->title . ' | Blog | Mimshach';
@endphp

<x-app-layout :$pageTitle>
  <x-slot:styles>
    <style>
      .blog-hero {
        background: linear-gradient(135deg, #0A192F 0%, #1a2f4a 100%);
        padding: 140px 0 60px;
        color: white;
        position: relative;
      }

      .blog-hero h1 {
        font-size: 48px;
        margin-bottom: 20px;
        line-height: 1.2;
        max-width: 900px;
      }

      .blog-meta {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        margin-top: 24px;
      }

      .blog-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .blog-meta-item i {
        color: #C6A43F;
      }

      .blog-content {
        padding: 80px 0;
        background: #F9F7F5;
      }

      .blog-layout {
        display: grid;
        grid-template-columns: 2.5fr 1fr;
        gap: 60px;
      }

      .blog-main {
        background: white;
        border-radius: 30px;
        padding: 48px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      }

      .featured-image {
        width: 100%;
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      }

      .blog-body {
        font-size: 18px;
        line-height: 1.8;
        color: #4a5568;
      }

      .blog-body p {
        margin-bottom: 24px;
      }

      .blog-body h2 {
        font-size: 28px;
        margin: 40px 0 20px;
        color: #0A192F;
        font-family: 'Playfair Display', serif;
      }

      .blog-body h3 {
        font-size: 24px;
        margin: 32px 0 16px;
        color: #0A192F;
      }

      .blog-body ul,
      .blog-body ol {
        margin: 20px 0;
        padding-left: 24px;
      }

      .blog-body li {
        margin-bottom: 10px;
      }

      .blog-body blockquote {
        border-left: 4px solid #C6A43F;
        padding: 20px 30px;
        margin: 30px 0;
        background: #F9F7F5;
        font-style: italic;
        border-radius: 0 16px 16px 0;
      }

      .author-section {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 24px;
      }

      .author-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #C6A43F;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
      }

      .author-info h4 {
        font-size: 20px;
        margin-bottom: 8px;
        color: #0A192F;
      }

      .sidebar-card {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 32px;
        position: sticky;
        top: 100px;
      }

      .sidebar-card h3 {
        font-size: 22px;
        margin-bottom: 20px;
        color: #0A192F;
      }

      .share-buttons {
        display: flex;
        gap: 12px;
        margin-top: 20px;
      }

      .share-btn {
        flex: 1;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        color: white;
        text-decoration: none;
        transition: 0.2s;
      }

      .share-btn.facebook {
        background: #3b5998;
      }

      .share-btn.twitter {
        background: #1da1f2;
      }

      .share-btn.linkedin {
        background: #0077b5;
      }

      .share-btn:hover {
        opacity: 0.8;
        transform: translateY(-2px);
      }

      .recent-posts {
        list-style: none;
        padding: 0;
      }

      .recent-posts li {
        padding: 16px 0;
        border-bottom: 1px solid #e2e8f0;
      }

      .recent-posts li:last-child {
        border-bottom: none;
      }

      .recent-posts a {
        text-decoration: none;
        color: #0A192F;
        transition: 0.2s;
        display: block;
      }

      .recent-posts a:hover {
        color: #C6A43F;
      }

      .recent-posts .post-title {
        font-weight: 600;
        margin-bottom: 6px;
      }

      .recent-posts .post-date {
        font-size: 12px;
        color: #C6A43F;
      }

      .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
        text-decoration: none;
        margin-bottom: 32px;
        font-weight: 500;
        transition: 0.2s;
      }

      .back-button:hover {
        gap: 12px;
        color: #C6A43F;
      }

      @media (max-width: 992px) {
        .blog-layout {
          grid-template-columns: 1fr;
        }

        .sidebar-card {
          position: static;
        }
      }

      @media (max-width: 768px) {
        .blog-hero {
          padding: 100px 0 40px;
        }

        .blog-hero h1 {
          font-size: 32px;
        }

        .blog-main {
          padding: 32px;
        }

        .author-section {
          flex-direction: column;
          text-align: center;
        }
      }
    </style>
  </x-slot:styles>

  <div class="blog-hero">
    <div class="container">
      <a class="back-button" href="{{ route('blogs.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Blog
      </a>
      <h1>{{ $article->title }}</h1>
      @if ($article->subtitle)
        <p style="font-size: 18px; opacity: 0.9; max-width: 800px;">{{ $article->subtitle }}</p>
      @endif
      <div class="blog-meta">
        <div class="blog-meta-item">
          <i class="fas fa-user"></i>
          <span>{{ $article->user->name ?? 'Admin' }}</span>
        </div>
        <div class="blog-meta-item">
          <i class="fas fa-calendar-alt"></i>
          <span>{{ $article->created_at->format('F j, Y') }}</span>
        </div>
        <div class="blog-meta-item">
          <i class="fas fa-clock"></i>
          <span>
    @php
        $created = $article->created_at;
        $now = now();
        
        $diffInDays = $created->diffInDays($now);
        $diffInWeeks = floor($diffInDays / 7);
        $diffInMonths = floor($diffInDays / 30);
        
        if ($diffInDays == 0) {
            $time = 'Today';
        } elseif ($diffInDays == 1) {
            $time = 'Yesterday';
        } elseif ($diffInDays < 7) {
            $time = $diffInDays . ' days ago';
        } elseif ($diffInDays >= 7 && $diffInDays < 14) {
            $time = '1 week ago';
        } elseif ($diffInDays >= 14 && $diffInDays < 21) {
            $time = '2 weeks ago';
        } elseif ($diffInDays >= 21 && $diffInDays < 28) {
            $time = '3 weeks ago';
        } elseif ($diffInDays >= 28 && $diffInDays < 35) {
            $time = '4 weeks ago';
        } elseif ($diffInMonths == 1) {
            $time = '1 month ago';
        } elseif ($diffInMonths > 1) {
            $time = $diffInMonths . ' months ago';
        } else {
            $time = $diffInDays . ' days ago';
        }
    @endphp
    {{ $time }}
</span>
        </div>
      </div>
    </div>
  </div>

  <div class="blog-content">
    <div class="container">
      <div class="blog-layout">
        <div class="blog-main">
          @if ($article->featured_image)
            <img alt="{{ $article->title }}" class="featured-image"
              src="{{ $article->featured_image }}">
          @endif

          <div class="blog-body">
            {!! nl2br(e($article->content)) !!}
          </div>
        </div>

        <div class="sidebar">


          @if ($recentBlogs && count($recentBlogs) > 0)
            <div class="sidebar-card">
              <h3>Recent Posts</h3>
              <ul class="recent-posts">
                @foreach ($recentBlogs as $recent)
                  <li>
                    <a href="{{ route('blogs.article', $recent) }}">
                      <div class="post-title">{{ $recent->title }}</div>
                      <div class="post-date">{{ $recent->created_at->format('M d, Y') }}</div>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
