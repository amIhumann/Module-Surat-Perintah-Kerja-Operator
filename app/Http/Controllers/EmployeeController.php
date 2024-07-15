<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get employees
        $employees = Employee::all();

        //render view with employees
        return view('employees.index', compact('employees'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required|max:100',
            'rank'     => 'required|max:20',
            'gender'   => 'required|max:1'
        ]);

        //create employee
        Employee::create([
            'nama'     => $request->nama,
            'rank'     => $request->rank,
            'gender'   => $request->gender
        ]);

        //redirect to index
        return redirect()->route('employees.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $employee
     * @return void
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $employee
     * @return void
     */
    public function update(Request $request, Employee $employee)
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required|max:100',
            'rank'     => 'required|max:20',
            'gender'   => 'required|max:1'
        ]);


        //update employee
        $employee->update([
            'nama'     => $request->nama,
            'rank'     => $request->rank,
            'gender'   => $request->gender
        ]);

        //redirect to index
        return redirect()->route('employees.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $employee
     * @return void
     */
    public function destroy(Employee $employee)
    {

        //delete employee
        $employee->delete();

        //redirect to index
        return redirect()->route('employees.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
