<x-header title="Edit Job"/>

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <x-list/>
            </div>
            <div class="col-lg-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card border-0 shadow mb-4">
                    <form action="{{ route('job.updateJob', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    
                                    <label class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ $job->title }}">
                                    <x-form-error name='title'/>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" class="form-control">
                                        <option value="">Select a Category</option>
                                        <option value="Engineering" {{ (old('category', $job->category) == 'Engineering') ? 'selected' : '' }}>Engineering</option>
                                        <option value="Accountant" {{ (old('category', $job->category) == 'Accountant') ? 'selected' : '' }}>Accountant</option>
                                        <option value="IT" {{ (old('category', $job->category) == 'IT') ? 'selected' : '' }}>Information Technology</option>
                                        <option value="Fashion" {{ (old('category', $job->category) == 'Fashion') ? 'selected' : '' }}>Fashion designing</option>
                                    </select>
                                    <x-form-error name='category'/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="mb-2">Job Nature<span class="req">*</span></label>
                                    <select name="job_nature" class="form-select">
                                        <option value="Full Time" {{ (old('job_nature', $job->job_nature) == 'Full Time') ? 'selected' : '' }}>Full Time</option>
                                        <option value="Part Time" {{ (old('job_nature', $job->job_nature) == 'Part Time') ? 'selected' : '' }}>Part Time</option>
                                        <option value="Remote" {{ (old('job_nature', $job->job_nature) == 'Remote') ? 'selected' : '' }}>Remote</option>
                                        <option value="Freelance" {{ (old('job_nature', $job->job_nature) == 'Freelance') ? 'selected' : '' }}>Freelance</option>
                                    </select>
                                    <x-form-error name='job_nature'/>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" min="1" placeholder="Vacancy" name="vacancy" class="form-control" value="{{ $job->vacancy }}">
                                    <x-form-error name='vacancy'/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label class="mb-2">Salary</label>
                                    <input type="text" placeholder="Salary" name="salary" class="form-control" value="{{ $job->salary }}">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" placeholder="location" name="location" class="form-control" value="{{ $job->location }}">
                                    <x-form-error name='location'/>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="form-control" name="description" rows="5" placeholder="Description">{{ old('description', $job->description) }}</textarea>
                               <x-form-error name ='description'/>
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">Benefits</label>
                                <textarea class="form-control" name="benefits" rows="5" placeholder="Benefits">{{ old('Benefits', $job->benefits) }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">Responsibility</label>
                                <textarea class="form-control" name="responsibility" rows="5" placeholder="Responsibility">{{ old('responsibility', $job->responsibility) }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="mb-2">Qualifications</label>
                                <textarea class="form-control" name="qualifications" rows="5" placeholder="Qualifications">{{ old('qualifications', $job->qualifications) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="mb-2">Keywords<span class="req">*</span></label>
                                <input type="text" placeholder="Keywords" name="keywords" class="form-control" value="{{ old('keywords', $job->keywords) }}">
                                <x-form-error name='keywords' />
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" placeholder="Company Name" name="company_name" class="form-control" value="{{ old('company_name',$job->company_name) }}">
                                    <x-form-error name='company_name' />
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label class="mb-2">Company Location</label>
                                    <input type="text" placeholder="Company Location" name="company_location" class="form-control" value="{{ old('company_location', $job->company_location) }}">
                                    <x-form-error name='company_location' />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="mb-2">Website</label>
                                <input type="text" placeholder="Website" name="website" class="form-control" value="{{ old('website', $job->website) }}">
                                <x-form-error name='website' />
                            </div>
                        </div> 
                        <div class="card-footer p-4 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<x-footer />