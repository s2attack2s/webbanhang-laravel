<section class="slider-section">
    <div class="slider">
      @if($slider)
      @foreach($slider as $sliders)
      <img src="https://docs.google.com/uc?id={{$sliders->img}}" alt="#" />
      @endforeach
      @endif
    </div>
</section>