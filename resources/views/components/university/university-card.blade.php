@props(['university' => []])

<div class="uni-card">
  <div class="uni-thumbnail" style="background-image: url('{{ $university->image }}');">
  </div>
  <div class="uni-content">
    <h3 class="uni-title"><a href="{{route('universities.university', $university)}}">{{ $university->name }}</a></h3>
    <div class="uni-meta">
      <span><i class="fas fa-map-marker-alt"></i> {{ $university->country }}</span>
    </div>
    <p class="uni-description">{{ $university->subtitle }}</p>
    <div class="funding-tags">
      @foreach ($university->fundings->pluck('name')->unique() as $fundingName)
        <span class="funding-tag">
          @if ($fundingName === 'Grant')
            <i class="fas fa-gift"></i>
          @elseif($fundingName === 'Scholarship')
            <i class="fas fa-trophy"></i>
          @elseif($fundingName === 'Loan')
            <i class="fas fa-hand-holding-usd"></i>
          @endif
          {{ $fundingName }}
        </span>
      @endforeach
    </div>
    <div class="uni-footer">
      <a class="explore-link" href="{{route('universities.university', $university)}}">Explore <i
          class="fas fa-arrow-right"></i></a>
      <span style="color:#C6A43F; font-size:13px;">Apply now</span>
    </div>
  </div>
</div>
