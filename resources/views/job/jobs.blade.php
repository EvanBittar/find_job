<x-header title="Find Dream Jobs"/>
<style>
/* تنسيق أرقام الترقيم (Pagination) */
    #job-pagination .page-link {
        color: #333;
        background-color: #fff;
        border-color: #dee2e6;
        transition: all 0.3s ease;
    }

    #job-pagination .page-link:hover, 
    #job-pagination .page-item.active .page-link {
        color: #fff !important;
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }

    #job-pagination .page-link:focus {
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .sidebar h2 {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
    }
</style>
<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2 class="mb-4">Find Jobs</h2>  
            </div>
        </div>

        <div class="row pt-5">
    <div class="col-md-4 col-lg-3 sidebar mb-4">
        <form action="{{ route('jobs') }}" method="GET" id="searchForm">
            <div class="card border-0 shadow p-4">
                <div class="mb-4">
                    <h2>Keywords</h2>
                    <input type="text" value="{{ request('keyword') }}" name="keyword" placeholder="Keywords" class="form-control">
                </div>

                <div class="mb-4">
                    <h2>Location</h2>
                    <input type="text" value="{{ request('location') }}" name="location" placeholder="Location" class="form-control">
                </div>

                <div class="mb-4">
                    <h2>Category</h2>
                    <select name="category" id="category" class="form-control">
                        <option value="">Select a Category</option>
                        @foreach($categories as $cat)
                            <option {{ (request('category') == $cat->category) ? 'selected' : '' }} value="{{ $cat->category }}">
                                {{ $cat->category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <h2>Job Type</h2>
                   @foreach(['Full Time', 'Part Time', 'Freelance', 'Remote'] as $type)
                    <div class="form-check mb-2"> 
                        <input class="form-check-input" name="job_type[]" type="checkbox" 
                            value="{{ $type }}" 
                            id="type-{{ $loop->index }}"
                            {{ (is_array(request('job_type')) && in_array($type, request('job_type'))) ? 'checked' : '' }}> 
                        <label class="form-check-label" for="type-{{ $loop->index }}">{{ $type }}</label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary w-100">Search</button>
                <a href="{{ route('jobs') }}" class="btn btn-secondary w-100 mt-2">Reset</a>
            </div>
        </form>
    </div>

    <div class="col-md-8 col-lg-9">
        <div class="job_listing_area">                    
            <div class="job_lists">
                <div class="row">
                    @if($jobs->isNotEmpty())
                        @foreach($jobs as $job)
                        <div class="col-md-6 col-lg-4"> {{-- تعديل القياس ليناسب الـ Sidebar --}}
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                        @if($job->status == 1)
                                            <span class="badge bg-success text-white">Active</span>
                                        @else
                                            <span class="badge bg-danger text-white">Expired</span>
                                        @endif
                                    </div>
                                    <p>{{ Str::words($job->description, 8) }}</p>
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

                        {{-- إضافة روابط الترقيم (Pagination) --}}
                        <div class="col-12 mt-4 d-flex justify-content-center" id="job-pagination">
                            {{ $jobs->withQueryString()->links() }}
                        </div>
                        {{-- <div class="col-12 mt-4">
                            {{ $jobs->links('pagination::bootstrap-5') }}
                        </div> --}}
                    @else
                        <div class="col-12 text-center">
                            <p>No jobs found for your search criteria.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</section>
<x-footer>
    © 2026 xyz company, all right reserved
</x-footer>
