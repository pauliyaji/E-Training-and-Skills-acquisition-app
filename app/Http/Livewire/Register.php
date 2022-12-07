<?php

namespace App\Http\Livewire;

use App\Models\Batch;
use App\Models\Cart;
use App\Models\Course;
use App\Models\Period;
use App\Models\Set;
use App\Models\Subject;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Register extends Component
{

    public $students, $batches, $subjects, $sessions, $courses, $studentInCart;
    public function mount(){
        $this->students = Session::get('students');
        $this->batches = Batch::all();
        $this->sub = Subject::all();
        $this->sessions = Period::all();
        $this->courses = Course::all();
        $this->studentInCart = Cart::all();
    }

    public function presentQty($studentId){
        $carts = Cart::find($studentId);
            $carts->update(['present'=>1, 'absent'=>0]);
        $this->mount();
    }

    public function absentQty($studentId){
        $carts = Cart::find($studentId);
        $carts->update(['present'=>0, 'absent'=>1]);
        $this->mount();
    }
    public function render()
    {
        return view('livewire.register');
    }
}
