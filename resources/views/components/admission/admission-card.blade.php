@props(['admission' => []])

<div class="blog-item">
  <div class="blog-thumbnail" style="background-image: url('{{ $admission['image'] }}');">
  </div>
  <div class="blog-content">
    <div class="blog-meta">
      <span><i class="far fa-calendar-alt"></i> {{ $admission->deadline->format('Y-m-d') }}</span>
      <span><i class="fas fa-university"></i> {{ $admission->university->name }}</span>
      <span><i class="fas fa-globe"></i> {{ $admission->country }}</span>
    </div>
    <h3 class="blog-title"><a href="{{route('admissions.admission', $admission)}}">{{ $admission->title }}</a></h3>
    <p class="blog-excerpt">{{ $admission->subtitle }}</p>
    <div class="blog-footer">
      <a class="read-more" href="{{route('admissions.admission', $admission)}}">Read more <i class="fas fa-arrow-right"></i></a>
      <div class="blog-tags">
        <p class='tag'>{{ $admission->program }}</p>
        <p class='tag'>{{ $admission->year }}</p>
      </div>
    </div>
  </div>
</div>
