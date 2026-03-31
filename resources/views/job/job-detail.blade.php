<x-header title="Find Dream Jobs" />
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<section class="section-4 bg-2">
    <div class="container pt-5">
        @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('jobs') }}">
                                <i class="fa fa-arrow-left"></i> &nbsp;Back to Jobs
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="jobs_conetent">
                                    <h4>{{ $job->title }}</h4>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p><i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p><i class="fa fa-clock-o"></i> {{ $job->job_nature }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    @if (Auth::check())
                                        {{-- لا تظهر القلب إذا كان المستخدم هو صاحب الوظيفة --}}
                                        @if (Auth::user()->id != $job->user_id)
                                            <form action="{{ route('addToFavorite') }}" method="POST" id="favorite-form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $job->id }}">
                                                <button type="submit" class="heart_mark border-0 bg-transparent">
                                                    @if($isFavorite)
                                                        <i class="fa fa-heart text-danger" style="font-size: 24px;"></i>
                                                    @else
                                                        <i class="fa fa-heart-o" style="font-size: 24px;"></i>
                                                    @endif
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a class="heart_mark" href="{{ route('login') }}">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>{!! nl2br(e($job->description)) !!}</p>
                        </div>

                        @if($job->responsibility)
                            <div class="single_wrap">
                                <h4>Responsibility</h4>
                                <p>{!! nl2br(e($job->responsibility)) !!}</p>
                            </div>
                        @endif

                        @if($job->qualifications)
                            <div class="single_wrap">
                                <h4>Qualifications</h4>
                                <p>{!! nl2br(e($job->qualifications)) !!}</p>
                            </div>
                        @endif

                        @if($job->benefits)
                            <div class="single_wrap">
                                <h4>Benefits</h4>
                                <p>{!! nl2br(e($job->benefits)) !!}</p>
                            </div>
                        @endif

                        <div class="border-top mt-4 pt-4">
                            @if (Auth::check())
                                @if (Auth::user()->id == $job->user_id)
                                    {{-- إذا كان المستخدم هو صاحب الوظيفة --}}
                                    <div class="alert alert-info">
                                        You are the creator of this job post. You can manage applications in your dashboard.
                                    </div>
                                    <a href="{{ route('job.myJob') }}" class="btn btn-secondary btn-lg w-100">Manage this Job</a>
                                @elseif ($count > 0)
                                    <button class="btn btn-secondary btn-lg w-100" disabled>Already Applied</button>
                                @else
                                    <form action="{{ route('applyJob') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $job->id }}">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">Apply Now</button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100">Login to Apply</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{ $job->created_at->format('d M, Y') }}</span></li>
                                <li>Vacancy: <span>{{ $job->vacancy }} Position</span></li>
                                @if($job->salary)
                                    <li>Salary: <span>{{ $job->salary }}</span></li>
                                @endif
                                <li>Location: <span>{{ $job->location }}</span></li>
                                <li>Job Nature: <span>{{ $job->job_nature }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{ $job->company_name }}</span></li>
                                <li>Location: <span>{{ $job->location }}</span></li>
                                @if($job->company_website)
                                    <li>Website: <span><a href="{{ $job->company_website }}" target="_blank">Visit Website</a></span></li>
                                @endif
                            </ul>
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