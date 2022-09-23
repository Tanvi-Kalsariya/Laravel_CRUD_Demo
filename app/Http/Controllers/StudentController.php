<?php

namespace App\Http\Controllers;

use App\Models\student;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $status = "";

    public function index()
    {
        $data['studentRecord'] = student::paginate(2);
        $data['status'] = $this->status;
        Paginator::useBootstrapFive();
        return view('index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' =>  'required|max:255',
            'email' => 'required|unique:students',
            'address' => 'required',
            'photo' => 'required|max:10000|mimes:jpg,png,webp'
        ], [
            'name.required' => 'Student name is mandatory! Please enter name.',
            'name.max' => 'Student name contain max character 255',
            'email.required' => 'Student email is mandatory! Please enter email.',
            'email.unique' => 'This email ID is already registered. Please enter another email ID.',
            'address.required' => 'Student address is mandatory! Please enter address.',
        ]);
        // $data['photo'] = $request->file('photo')->getClientOriginalName();
        // $path = $request->file('photo')->store('public/files');
        $fileNameToStore = null;
        if ($request->hasFile('photo')) {
            $image_name = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($image_name, PATHINFO_FILENAME);
            $image_ext = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename . '-' . time() . '.' . $image_ext;
            $path =  $request->file('photo')->storeAs('public/student', $fileNameToStore); // storage/app/student/

        }
        $data['photo'] = $fileNameToStore;
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['address'] = $request->input('address');
        // Slug add
        $data['slug'] = Str::slug(Str::lower($data['name']),'-');
        student::create($data);

        $this->status = "Inserted";
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $data['record'] = student::find($id);
    //     $data['studentRecord'] = student::paginate(2);
    //     Paginator::useBootstrapFive();
    //     return view('index')->with($data);
    // }
    public function show($student)
    {
        $data['record'] = student::find($student);
        $data['studentRecord'] = student::paginate(2);
        Paginator::useBootstrapFive();
        return view('index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $student = student::find($request->input('id'));
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->slug = Str::slug(Str::lower($student->name),'-');
        $student->save();
        return redirect('/');
        // return redirect()->route('student.show', $student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = student::find($id);
        $task->delete();
        return redirect('/')->with('success', 'Task deleted successfully');
    }

    public function getMoreStudents(Request $request)
    {
        if($request->ajax()){
            return "<div>Aamir</div>";
        }
    }
}
