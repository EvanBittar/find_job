<x-header title="Find Dream Jobs"/>
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Saved Jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="s-body text-center mt-3">
                        <img src="{{ (!empty($user->image)) ? asset('uploads/profile/'.$user->image) : asset('assets/images/avatar7.png') }}" 
                        class="rounded-circle img-fluid" 
                        style="width: 150px; height: 150px; object-fit: cover;">
                        <h5 class="mt-3 pb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-1 fs-6">{{ $user->designation }}</p>
                    </div>
                </div>
                <x-list/>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <h3 class="fs-4 mb-1">Saved Jobs</h3>
                        
                        {{-- عرض رسائل النجاح --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($favorites->isNotEmpty())
                                        @foreach($favorites as $favorite)
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{ $favorite->job->title }}</div>
                                                <div class="info1">{{ $favorite->job->job_nature }} . {{ $favorite->job->location }}</div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($favorite->job->created_at)->format('d M, Y') }}</td>
                                            
                                            <td>{{ $favorite->job->applicants->count() }} Applications</td>
                                            
                                            <td>
                                                <div class="action-dots float-end">
                                                    <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ route('jobDetail', $favorite->job_id) }}"> 
                                                            <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('removeFavorite') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $favorite->id }}">
                                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">You haven't saved any jobs yet.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $favorites->links() }}
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