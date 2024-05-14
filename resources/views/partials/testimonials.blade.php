@if ($testimonials->isEmpty())
    <div class="text-center">
        <p>Data testimoni pengunjung masih kosong!</p>
    </div>
@else
    @foreach ($testimonials as $testimonial)
        <div class="card mb-3" data-aos="fade-right">
            <div class="card-body">
                <h5 class="card-title">{{ $testimonial->user->name ?? 'Anonymous' }}</h5>
                <div class="text-warning mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $testimonial->rating)
                            <i class="fas fa-star"></i>
                        @elseif ($i - 0.5 == $testimonial->rating)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p class="card-text">{{ $testimonial->reviews }}</p>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $testimonials->links() }}
    </div>
@endif
