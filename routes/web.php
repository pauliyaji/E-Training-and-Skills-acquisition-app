<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LgaController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MentorshipController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StarterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SiteController;
use App\Imports\UsersImport;
use App\Models\Assignment;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    /**
     * Home Routes
     */
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
    Route::get('/setup', 'App\Http\Controllers\HomeController@setup')->name('setup');

  //adding our admin details to a new config just run (localhost/public/seedadmin)
   Route::get('/seedadmin', function(){
       $user = User::create([
           'name' => 'Admin',
           'email' => 'admin@admin.com',
           //'username' => 'admin',
           'password' => 'hunter1915',
           'status' => 1,
           'setting_id' => 1,
           'active_status' => 1
       ]);
       return response()->json([
           'IMPORTANT'=> 'Copy this information as you will need it to login',
           'user'=>$user,
           'password'=>'hunter1915',
           'RETURN TO SETUP'=>'http://localhost/skills-acquisition/public/setup']);

   });


    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $users = \App\Models\User::all();
        $mentee = Student::all();
        $all_mentors = Mentor::all();
        $donuts = User::select('usertype_id', \DB::raw("COUNT('id') as count"))
            ->groupBy('usertype_id')->pluck('count', 'usertype_id');
        $labels = $donuts->keys('usertype_id');
        $data = $donuts->values();
        $all_students = Student::orderBy('created_at', 'DESC')->paginate(4);
        $student = \App\Models\StudentAttendance::where('user_id', Auth::user()->id)->first();
        $mentors = \App\Models\Mentor::paginate(3);
        $subjects = \App\Models\SubjectAttendance::where('user_id', Auth::user()->id)->get();
        //mentors
        $mentors_id = Mentor::where('user_id', $id)->first();

            if($mentors_id){
                $mentees = \App\Models\Studentmentor::where('mentor_id', $mentors_id->id)->get();
                $submissions = \App\Models\Submission::where('mentor_id', $id)->get();
                return view('dashboard', compact('all_students','data','labels',
                    'mentee', 'all_mentors', 'users', 'subjects', 'student', 'mentors',
                    'mentees', 'submissions'));
            }
                $studentmentorship = \App\Models\Studentmentor::where('user_id', $id)->first();
                $studentrec = Student::where('user_id', $id)->first();
                if($studentrec){
                    $stuassignments = Assignment::where('student_no', $studentrec->student_no)->get();
                    return view('dashboard', compact('all_students','data','labels',
                        'mentee', 'all_mentors', 'users', 'subjects', 'student', 'mentors', 'studentmentorship',
                        'stuassignments'
                    ));
                }
        return view('dashboard', compact('all_students','data','labels',
            'mentee', 'all_mentors', 'users', 'subjects', 'student', 'mentors', 'studentmentorship'
        ));


    })->middleware(['auth'])->name('dashboard');

    require __DIR__.'/auth.php';

    Route::group(['middleware' => ['auth', 'permission']], function() {

        Route::group(['prefix' => 'users'], function() {

            Route::get('/', 'App\Http\Controllers\UsersController@index')->name('users.index');
            Route::get('/create', 'App\Http\Controllers\UsersController@create')->name('users.create');
            Route::post('/create', 'App\Http\Controllers\UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'App\Http\Controllers\UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'App\Http\Controllers\UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'App\Http\Controllers\UsersController@destroy')->name('users.destroy');
            Route::get('/changeStatus', [App\Http\Controllers\UsersController::class, 'changeUserStatus']);
            Route::get('/profile/{id}', [UsersController::class, 'profile'])->name('users.profile');

        });
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
//Route::resource('settings', SettingController::class);
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('settings/create', [SettingController::class, 'create'])->name('settings.create');
        Route::post('edit-settings', [SettingController::class, 'edit'])->name('edit-settings');
        Route::post('settings-store', [SettingController::class, 'store'])->name('settings-store');
        Route::post('delete-settings', [SettingController::class, 'destroy'])->name('delete-settings');
//LGA/DEPARTMENTS
        Route::get('lgas', [LgaController::class, 'index'])->name('lgas.index');
        Route::get('lgas-create', [LgaController::class, 'create'])->name('lgas-create');
        Route::post('lgas-edit', [LgaController::class, 'edit'])->name('lgas-edit');
        Route::post('lgas-store', [LgaController::class, 'store'])->name('lgas-store');
        Route::post('lgas-delete', [LgaController::class, 'destroy'])->name('lgas-delete');
//Categories
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories-create', [CategoryController::class, 'create'])->name('categories-create');
        Route::post('categories-edit', [CategoryController::class, 'edit'])->name('categories-edit');
        Route::post('categories-store', [CategoryController::class, 'store'])->name('categories-store');
        Route::post('categories-delete', [CategoryController::class, 'destroy'])->name('categories-delete');
//Courses
        Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('courses-create', [CourseController::class, 'create'])->name('courses-create');
        Route::post('courses-edit', [CourseController::class, 'edit'])->name('courses-edit');
        Route::post('courses-store', [CourseController::class, 'store'])->name('courses-store');
        Route::post('courses-delete', [CourseController::class, 'destroy'])->name('courses-delete');
//Subjects
        Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
        Route::get('subjects-create', [SubjectController::class, 'create'])->name('subjects-create');
        Route::post('subjects-edit', [SubjectController::class, 'edit'])->name('subjects-edit');
        Route::post('subjects-store', [SubjectController::class, 'store'])->name('subjects-store');
        Route::post('subjects-delete', [SubjectController::class, 'destroy'])->name('subjects-delete');
        Route::get('subjects/download/{id}', [SubjectController::class, 'downloadFile'])->name('subjects.download');

//Starter packs
        Route::get('starters', [StarterController::class, 'index'])->name('starters.index');
        Route::get('starters-create', [StarterController::class, 'create'])->name('starters-create');
        Route::post('starters-edit', [StarterController::class, 'edit'])->name('starters-edit');
        Route::post('starters-store', [StarterController::class, 'store'])->name('starters-store');
        Route::post('starters-delete', [StarterController::class, 'destroy'])->name('starters-delete');
//Starter packs
        Route::get('locations', [LocationController::class, 'index'])->name('locations.index');
        Route::get('locations-create', [LocationController::class, 'create'])->name('locations-create');
        Route::post('locations-edit', [LocationController::class, 'edit'])->name('locations-edit');
        Route::post('locations-store', [LocationController::class, 'store'])->name('locations-store');
        Route::post('locations-delete', [LocationController::class, 'destroy'])->name('locations-delete');
//Students
        Route::resource('students', StudentController::class);
        Route::get('classes.studentadd/{id}', [ClassController::class, 'studentadd'])->name('classes.studentadd');
        Route::post('classes.storestudent', [ClassController::class, 'storestudent'])->name('classes.storestudent');
        Route::patch('students.profileupdate/{id}', [StudentController::class, 'profileupdate'])->name('students.profileupdate');
        Route::patch('students.passwordupdate/{id}', [StudentController::class, 'passwordupdate'])->name('students.passwordupdate');
        Route::get('students/mycourses/{id}', [StudentController::class, 'mycourses'])->name('students.mycourses');
//Classes
        Route::resource('classes', \App\Http\Controllers\ClassController::class);
        //Route::get('classes.list/{id}', [ClassController::class, 'list'])->name('classes.list');
        Route::get('classes.add-class/{id}', [ClassController::class, 'addclass'])->name('classes.add-class');
        Route::get('classes.summary', [ClassController::class, 'summary'])->name('classes.summary');
//Batches
        Route::get('batches', [BatchController::class, 'index'])->name('batches.index');
        Route::get('batches-create', [BatchController::class, 'create'])->name('batches-create');
        Route::post('batches-edit', [BatchController::class, 'edit'])->name('batches-edit');
        Route::post('batches-store', [BatchController::class, 'store'])->name('batches-store');
        Route::post('batches-delete', [BatchController::class, 'destroy'])->name('batches-delete');
//Attendance Register
        Route::get('attendance.index', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('attendance.create', [\App\Http\Controllers\AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('attendance.mark', [\App\Http\Controllers\AttendanceController::class, 'mark'])->name('attendance.mark');
        Route::post('attendance.submit', [\App\Http\Controllers\AttendanceController::class, 'submit'])->name('attendance.submit');
        Route::get('attendance/markRegister', [\App\Http\Controllers\AttendanceController::class, 'markRegister']);
        Route::get('attendance.register', [\App\Http\Controllers\AttendanceController::class, 'register'])->name('attendance.register');
        Route::get('attendance.summary', [\App\Http\Controllers\AttendanceController::class, 'summary'])->name('attendance.summary');
//Mentors
        Route::resource('mentors', \App\Http\Controllers\MentorController::class);
        Route::patch('mentors.profileupdate/{id}', [App\Http\Controllers\MentorController::class, 'profileupdate'])->name('mentors.profileupdate');
        Route::patch('mentors.passwordupdate/{id}', [App\Http\Controllers\MentorController::class, 'passwordupdate'])->name('mentors.passwordupdate');

//Starter packs
        Route::get('mentorships/mymentees', [MentorshipController::class, 'mymentees'])->name('mentorships.mymentees');
        Route::post('mentorships/update/{id}',[MentorshipController::class, 'update'])->name('mentorships.update');
        Route::resource('mentorships', MentorshipController::class);
        Route::get('mentorships/add/{id}', [MentorshipController::class, 'add'])->name('mentorships.add');
//MESSAGES
        Route::get('messages.index', [MessageController::class, 'index'])->name('messages.index');
    });

    //Assignments
        Route::get('assignments/mine/{id}', [\App\Http\Controllers\AssignmentController::class, 'mine'])->name('assignments.mine');
        Route::get('assignments/mentorsview', [\App\Http\Controllers\AssignmentController::class, 'mentorsview'])->name('assignments.mentorsview');
        Route::resource('assignments', \App\Http\Controllers\AssignmentController::class);

    //submissions
        Route::get('submissions/makesubmission/{id}', [\App\Http\Controllers\SubmissionController::class, 'makesubmission'])->name('submissions.makesubmission');
        Route::get('submissions/download/{id}', [\App\Http\Controllers\SubmissionController::class, 'downloadFile'])->name('submissions.download');

        Route::resource('submissions', \App\Http\Controllers\SubmissionController::class);

    //Feedback
        Route::get('feedbacks/myfeedback', [\App\Http\Controllers\FeedbackController::class, 'myfeedback'])->name('feedbacks.myfeedback');

        Route::get('feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
        Route::get('feedbacks-create', [FeedbackController::class, 'create'])->name('feedbacks-create');
        Route::post('feedbacks-edit', [FeedbackController::class, 'edit'])->name('feedbacks-edit');
        Route::post('feedbacks-store', [FeedbackController::class, 'store'])->name('feedbacks-store');
        Route::post('feedbacks-delete', [FeedbackController::class, 'destroy'])->name('feedbacks-delete');


