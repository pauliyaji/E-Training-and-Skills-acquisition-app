<div class="card shadow mb-4">
    <div class="card-header py-3">

        <div class="row g-4 pt-5">
           {{-- <div class="col-sm-3 m-1">
                <input type="text" name="batch_id" class="form-control" value="{{ $batches->title }}" readonly>
            </div>
            <div class="col-sm-3 m-1">
                <input type="text" name="course_id" class="form-control" value="{{ $courses->title }}" readonly>
            </div>
            <div class="col-sm-3 m-1">
                <input type="text" name="subject_id" class="form-control" value="{{ $sub->title }}" readonly>
            </div>
            <div class="col-sm-2 m-1">
                <input type="text" name="period_id" class="form-control" value="{{ $sessions->period }}" readonly>
            </div>--}}

        </div>

    </div>
    <div class="card-body">
       {{-- <form method="post" action="{{ route('attendance.submit') }}">
            @csrf--}}

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mentee No.</th>
                        <th>Full Name</th>
                        <th>Present/Absent</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach($studentInCart as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="#">{{ $student->student_no }}</a></td>
                                <td>{{ $student->users->name }}</td>
                                <td>
                                    <input type="hidden" name="batch_id[]" value="{{$student->batch_id }}">
                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                    <input type="hidden" name="course_id[]" value="{{ $student->course_id }}">
                                    <input type="hidden" name="subject_id[]" value="{{ $student->subject_id }}">
                                    <input type="hidden" name="period_id[]" value="{{$student->period_id}}">
                                    <input type="hidden" name="user_id[]" value="{{$student->user_id}}">

                                    {{--<input type="checkbox" wire:click.prevent="presentQty({{ $student->id }})">--}}
                                    <button class="btn btn-sm btn-danger" wire:click.prevent="presentQty({{ $student->id }})">-</button>
                                </td>
                                <td>
                                    <input type="checkbox" wire:click.prevent="absentQty({{ $student->id }})" name="absent[]">

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-3 m-1 float-right">
                    <input type="date" name="date" value="" class="form-control float-right">
                </div>
            </div>

            <div class="col-md-3 m-1 float-right">
                <input type="submit" value="Submit Attendance" class=" form-control btn btn-primary btn-sm float-right" />
            </div>
      {{--  </form>--}}
    </div>
</div>
