@props(['admission' => []])

<style>
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
</style>

<div class="blog-item">
  <div class="blog-thumbnail" style="background-image: url('{{ $admission['image'] }}');">
  </div>
  <div class="blog-content">
    <div class="blog-meta">
      <span><i class="far fa-calendar-alt"></i> {{ $admission['date'] }}</span>
      <span><i class="fas fa-university"></i> {{ $admission['university'] }}</span>
      <span><i class="fas fa-globe"></i> {{ $admission['country'] }}</span>
    </div>
    <h3 class="blog-title"><a href="#">{{ $admission['title'] }}</a></h3>
    <p class="blog-excerpt">{{ $admission['excerpt'] }}</p>
    <div class="blog-footer">
      <a class="read-more" href="{{ $admission['url'] }}">Read more <i
          class="fas fa-arrow-right"></i></a>
      <div class="blog-tags">
        @foreach ($admission['tags'] as $tag)
          <span class="tag">{{ $tag }}</span>
        @endforeach
      </div>
    </div>
  </div>
</div>
