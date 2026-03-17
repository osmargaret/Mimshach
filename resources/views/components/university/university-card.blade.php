@props(['university' => []])

<style>
  /* universities grid */
  .uni-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin: 60px 0;
  }

  .uni-card {
    background: white;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 8px 20px -5px rgba(0, 0, 0, 0.05);
    transition: 0.3s;
    display: flex;
    flex-direction: column;
  }

  .uni-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 30px -10px rgba(198, 164, 63, 0.15);
  }

  .uni-thumbnail {
    height: 180px;
    background-size: cover;
    background-position: center;
  }

  .uni-content {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .uni-title {
    font-size: 22px;
    margin-bottom: 8px;
  }

  .uni-title a {
    text-decoration: none;
    color: #0A192F;
  }

  .uni-title a:hover {
    color: #C6A43F;
  }

  .uni-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
    color: #C6A43F;
    font-size: 14px;
    font-weight: 500;
  }

  .uni-meta i {
    margin-right: 4px;
  }

  .uni-description {
    color: #4a5568;
    margin-bottom: 20px;
    flex: 1;
  }

  .funding-tags {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }

  .funding-tag {
    background: #F0EEE9;
    padding: 6px 14px;
    border-radius: 40px;
    font-size: 13px;
    font-weight: 500;
    color: #0A192F;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .funding-tag i {
    color: #C6A43F;
  }

  .uni-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #eee;
    padding-top: 16px;
  }

  .explore-link {
    color: #C6A43F;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .explore-link i {
    transition: 0.2s;
  }

  .explore-link:hover i {
    transform: translateX(5px);
  }
</style>

<div class="uni-card">
  <div class="uni-thumbnail" style="background-image: url('{{ $university['image'] }}');">
  </div>
  <div class="uni-content">
    <h3 class="uni-title"><a href="{{ $university['url'] }}">{{ $university['name'] }}</a></h3>
    <div class="uni-meta">
      <span><i class="fas fa-map-marker-alt"></i> {{ $university['country'] }}</span>
    </div>
    <p class="uni-description">{{ $university['description'] }}</p>
    <div class="funding-tags">
      @foreach ($university['funding'] as $funding)
        <span class="funding-tag">
          @if ($funding === 'Grant')
            <i class="fas fa-gift"></i>
          @elseif($funding === 'Scholarship')
            <i class="fas fa-trophy"></i>
          @elseif($funding === 'Loan')
            <i class="fas fa-hand-holding-usd"></i>
          @endif
          {{ $funding }}
        </span>
      @endforeach
    </div>
    <div class="uni-footer">
      <a class="explore-link" href="{{ $university['url'] }}">Explore <i
          class="fas fa-arrow-right"></i></a>
      <span style="color:#C6A43F; font-size:13px;">Apply now</span>
    </div>
  </div>
</div>
