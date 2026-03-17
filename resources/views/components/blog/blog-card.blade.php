@props(['blog' => []])

<style>
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
</style>

<div class="blog-card">
  <div class="blog-thumbnail" style="background-image: url('{{ $blog['image'] }}');">
  </div>
  <div class="blog-content">
    <span class="blog-category">{{ $blog['category'] }}</span>
    <h3 class="blog-title"><a href="{{ $blog['url'] }}">{{ $blog['title'] }}</a></h3>
    <div class="blog-meta">
      <span><i class="fas fa-user"></i> {{ $blog['author'] }}</span>
      <span><i class="fas fa-clock"></i> {{ $blog['read_time'] }}</span>
    </div>
    <p class="blog-excerpt">{{ $blog['excerpt'] }}</p>
    <div class="blog-footer">
      <a class="read-more" href="{{ $blog['url'] }}">Read More <i
          class="fas fa-arrow-right"></i></a>
      <span class="blog-date">{{ $blog['date'] }}</span>
    </div>
  </div>
</div>
