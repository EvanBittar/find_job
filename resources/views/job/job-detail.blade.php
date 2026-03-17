<x-header title="Find Dream Jobs" />

<section @class(['section-4', 'bg-2' ])>
    <div @class(['container', 'pt-5' ])>
        <div @class(['row' ])>
            <div @class(['col' ])>
                <nav aria-label="breadcrumb" @class(['rounded-3', 'p-3' ])>
                    <ol @class(['breadcrumb', 'mb-0' ])>
                        <li @class(['breadcrumb-item' ])>
                            <a href="{{ route('job.myJob') }}">
                                <i @class(['fa', 'fa-arrow-left' ])></i> &nbsp;Back to Jobs
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div @class(['container', 'job_details_area' ])>
        <div @class(['row', 'pb-5' ])>
            <div @class(['col-md-8' ])>
                <div @class(['card', 'shadow', 'border-0' ])>
                    <div @class(['job_details_header' ])>
                        <div @class(['single_jobs', 'white-bg' , 'd-flex' , 'justify-content-between' ])>
                            <div @class(['jobs_left', 'd-flex' , 'align-items-center' ])>
                                <div @class(['jobs_conetent' ])>
                                    <h4>{{ $job->title }}</h4>
                                    <div @class(['links_locat', 'd-flex' , 'align-items-center' ])>
                                        <div @class(['location' ])>
                                            <p><i @class(['fa', 'fa-map-marker' ])></i> {{ $job->location }}</p>
                                        </div>
                                        <div @class(['location' ])>
                                            <p><i @class(['fa', 'fa-clock-o' ])></i> {{ $job->job_nature }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div @class(['jobs_right' ])>
                                <div @class(['apply_now' ])>
                                    <a @class(['heart_mark' ]) href="#">
                                        <i @class(['fa', 'fa-heart-o' ]) aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div @class(['descript_wrap', 'white-bg' ])>
                        <div @class(['single_wrap' ])>
                            <h4>Job description</h4>
                            <p>{!! nl2br(e($job->description)) !!}</p>
                        </div>

                        @if($job->responsibility)
                            <div @class(['single_wrap' ])>
                                <h4>Responsibility</h4>
                                <p>{!! nl2br(e($job->responsibility)) !!}</p>
                            </div>
                        @endif

                        @if($job->qualifications)
                            <div @class(['single_wrap' ])>
                                <h4>Qualifications</h4>
                                <p>{!! nl2br(e($job->qualifications)) !!}</p>
                            </div>
                        @endif

                       @if($job->benefits)
                            <div @class(['single_wrap' ])>
                                <h4>Benefits</h4>
                                <p>{!! nl2br(e($job->benefits)) !!}</p>
                            </div>
                        @endif
                        @if(Auth::check() && Auth::user()->id == $job->user_id)
                            <div @class(['border-top', 'mt-4', 'pt-4', 'd-flex', 'gap-2'])>
                                <a href="{{ route('job.editJob', $job->id) }}" @class(['btn', 'btn-primary'])>
                                    <i @class(['fa', 'fa-edit'])></i> Edit Job
                                </a>
                            </div>
                        @else
                            <div @class(['pt-4'])>
                                <a href="#" @class(['btn', 'btn-primary', 'w-100'])>Apply Now</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div @class(['col-md-4' ])>
                <div @class(['card', 'shadow', 'border-0' ])>
                    <div @class(['job_sumary' ])>
                        <div @class(['summery_header', 'pb-1' , 'pt-4' ])>
                            <h3>Job Summery</h3>
                        </div>
                        <div @class(['job_content', 'pt-3' ])>
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

                <div @class(['card', 'shadow', 'border-0' , 'my-4' ])>
                    <div @class(['job_sumary' ])>
                        <div @class(['summery_header', 'pb-1' , 'pt-4' ])>
                            <h3>Company Details</h3>
                        </div>
                        <div @class(['job_content', 'pt-3' ])>
                            <ul>
                                <li>Name: <span>{{ $job->company_name }}</span></li>
                                    <li>Location: <span>{{ $job->company_location }}</span></li>
                                    <li>Website: <span><a href="{{ $job->website }}" target="_blank">Visit Website</a></span></li>
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