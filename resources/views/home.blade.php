<x-header title="Find Dream Jobs" />
<section class="section-0 lazy d-flex bg-image-style dark align-items-center " class=""
    data-bg="assets/images/banner5.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Find your dream job</h1>
                <p>Thounsands of jobs available.</p>
                <div class="banner-btn mt-5"><a href="#" class="btn btn-primary mb-4 mb-sm-0">Explore Now</a></div>
            </div>
        </div>
    </div>
</section>

<section class="section-1 py-5 ">
    <div class="container">
        <div class="card border-0 shadow p-5">
            <form action="{{ route('jobs') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords" value="{{ request('keyword') }}">
                    </div>
                    
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="{{ request('location') }}">
                    </div>
                    
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @if($categories->isNotEmpty())
                                @foreach($categories as $category)
                                    <option {{ (request('category') == $category->category) ? 'selected' : '' }} value="{{ $category->category }}">
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="section-2 bg-2 py-5">
    <div class="container">
        <h2>Popular Categories</h2>
        <div class="row pt-5">
            @if($categories->isNotEmpty())
                @foreach($categories as $category)
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        {{-- هنا نرسل اسم التصنيف للبحث عنه في صفحة الوظائف --}}
                        <a href="{{ route('jobs', ['category' => $category->category]) }}">
                            <h4 class="pb-2">{{ $category->category }}</h4>
                        </a>
                        <p class="mb-0"> 
                            <span>{{ $category->jobs_count }}</span> Available positions
                        </p>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>No categories found.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<section class="section-3  py-5">
    <div class="container">
        <h2>Featured Jobs</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @if($featuredJobs->isNotEmpty())
                            @foreach($featuredJobs as $job)
                            <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4">
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                        <p>{{ Str::words($job->description, 10) }}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker text-primary"></i></span>
                                                <span class="ps-1">{{ $job->location }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o text-primary"></i></span>
                                                <span class="ps-1">{{ $job->job_nature }}</span>
                                            </p>
                                            @if($job->salary)
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-usd text-primary"></i></span>
                                                <span class="ps-1">{{ $job->salary }}</span>
                                            </p>
                                            @endif
                                        </div>

                                        <div class="d-grid mt-3">
                                            <a href="{{ route('jobDetail', $job->id) }}" class="btn btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col">No featured jobs found.</div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-3 bg-2 py-5">
    <div class="container">
        <h2>Latest Jobs</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                    @if($latestJobs->isNotEmpty())
                            @foreach($latestJobs as $job)
                            <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4">
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                        <p>{{ Str::words($job->description, 10) }}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker text-primary"></i></span>
                                                <span class="ps-1">{{ $job->location }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o text-primary"></i></span>
                                                <span class="ps-1">{{ $job->job_nature }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-usd text-primary"></i></span>
                                                <span class="ps-1">{{ $job->salary }}</span>
                                            </p>
                                        </div>
                                        <div class="d-grid mt-3">
                                            <a href="{{ route('jobDetail', $job->id) }}" class="btn btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-3">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<x-footer>
    © 2026 xyz company, all right reserved
</x-footer>

