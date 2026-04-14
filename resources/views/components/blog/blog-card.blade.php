@props(['blog' => []])

<div class="blog-card">
  <div class="blog-thumbnail" style="background-image: url('{{ $blog->featured_image }}');">
  </div>
  <div class="blog-content">
    <h3 class="blog-title"><a href="{{ route('blogs.article', $blog) }}">{{ $blog->title }}</a></h3>
    <p class="blog-excerpt">{{ $blog->subtitle }}</p>
    <div class="blog-footer">
      <a class="read-more" href="{{ route('blogs.article', $blog) }}">Read More <i
          class="fas fa-arrow-right"></i></a>
      <span class="blog-date">{{ $blog->created_at->format('M j, Y') }}</span>
    </div>
  </div>
</div>
