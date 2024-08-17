@php
    $categories = App\Models\Category::get();
    $blogs = App\Models\Blog::latest()->take(3)->get();
    // $categories = App\Models\Category::take(2)->get();
@endphp
<!-- Start Blog Post Siddebar -->
<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
        <div class="single-sidebar-widget newsletter-widget">
            <h4 class="single-sidebar-widget__title">Newsletter</h4>
            <div class="form-group mt-30">
                <div class="col-autos">
                    <form method="POST" action="{{ route('subscriber.store') }}">
                        @csrf
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" name="email"
                            value="{{ @old('email') }}">
                        {{-- <button type="submit" class="bbtns d-block mt-20 w-100">Subcribe</button> --}}
                        <input type="submit" class="bbtns d-block w-100 mt-2" value="Subscribe">
                        @error('email')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
            </ <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">Catgory</h4>
            <ul class="cat-list mt-20">
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('theme.category', ['id' => $category->id]) }}"
                                class="d-flex justify-content-between">
                                <p>{{ $category->name }}</p>
                                <p>({{ count($category->blogs) }})</p>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            </ <div class="single-sidebar-widget popular-post-widget">
            <h4 class="single-sidebar-widget__title">Recent Post</h4>
            <div class="popular-post-list">
                @if (count($blogs) > 0)
                    @foreach ($blogs as $blog)
                        <div class="single-post-list">
                            <div class="thumb">
                                <img class="card-img rounded-0" src="{{ asset('storage') }}/blogs/{{ $blog->image }}"
                                    alt="">
                                <ul class="thumb-info">
                                    <li><a href="#">{{ $blog->user->name }}</a></li>
                                    <li><a href="#">{{ $blog->created_at->format('d M Y') }}</a></li>
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="blog-single.html">
                                    <h6>{{ $blog->description }}</h6>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End Blog Post Siddebar -->
