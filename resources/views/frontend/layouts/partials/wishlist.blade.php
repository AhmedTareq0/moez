@if(auth()->check() && (auth()->user()->hasRole('student')))
    <form class="d-inline-block" name="wishlist-form" action="{{ route('add-to-wishlist') }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course }}">
        <input type="hidden" name="price" value="{{ $price }}">
        <button type="submit" class="p-0 btn btn-secondary mt-3">
            <i class="fa fa-heart"></i>
        </button>
    </form>
@endif
@if(!auth()->check())
    <a id="openLoginModal" data-target="#myModal" href="#" class="p-0 d-inline-block btn btn-secondary mt-3">
        <i class="fa fa-heart"></i>
    </a>
@endif
