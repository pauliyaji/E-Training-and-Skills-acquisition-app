@extends('layouts.layout')

@section('content')
    <style>
        .profile-content-right{
            border-top: 0px;
            border-left: 1px solid #15b519;
        }
        .nav-tabs {
            border-bottom: 1px solid #15b519;
        }

    </style>
    <div class="content m-10">
        <div class="bg-white border rounded m-5">
            <div class="row no-gutters">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h5>All {{ $course->courses->title }} Subjects and Available Files</h5>
                    </div>

                    <div class="card-body p-0" data-simplebar style="height: 100%;">
                        @foreach($subjects as $subject)
                            <div class="accordion m-2" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$subject->id}}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$subject->id}}" aria-expanded="true" aria-controls="collapse{{$subject->id}}">
                                            {{ $subject->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{$subject->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$subject->id}}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p> {{ $subject->description }}
                                                <a href="{{ route('subjects.download', $subject->id) }}" class="float-right btn btn-primary btn-sm">
                                                    <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                            </p>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3"></div>
                </div>
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h5 style="color: green">Completed Subjects</h5>
                    </div>

                    <div class="card-body p-0" data-simplebar style="height: 100%;">
                        @foreach($comps as $comp)
                            <div class="media media-border-bottom py-3 align-items-center justify-content-between border-bottom px-5">
                                <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                </div>
                                <div class="media-body pr-3">
                                    <a class="mt-0 mb-1 font-size-15 text-dark" href="#"></a>
                                    <p style="color: #24c346;">&#10004 {{ $comp->subjects->title }}</p>
                                </div>

                                <span class=" font-size-12 d-inline-block" style="font-style: italic; color: green; font-weight: bold"><i class="mdi mdi-clock-outline"></i> Completed on {{ $comp->date }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@stop
