<?php

namespace App\Http\Controllers\Person;
use App\Http\Controllers\Controller;
use App\Services\Person\PersonService;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService) {
        $this->personService = $personService;
    }

    public function index(){
        $people = $this->personService->listPeople(10);
        
        return view('index', ['people' => $people]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|string|unique:people',
            'phone_number' => 'required',
            'date_of_birth' => 'required|date',
        ]);

        $this->personService->storePerson($validated);

        if ($request->ajax()) {
            $people = $this->personService->listPeople(10);
            $data = view('index', compact('people'))->render();
            return response()->json(['data' => $data], 200);
        }

        return redirect()->back();
    }
}
