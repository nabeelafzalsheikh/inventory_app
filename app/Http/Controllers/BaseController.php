<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;


abstract class BaseController extends Controller
{
    protected $model;
    protected $viewBasePath;
    protected $routeBaseName;

    public function index()
    {
        $records = $this->model::fetchAll();

        // if ($records->isEmpty()) {
        //     return redirect()->route("{$this->routeBaseName}.index")
        //         ->with('info', 'No records found. Please add a new one.');
        // }

        return view("{$this->viewBasePath}.index", compact('records'));
    }

    public function create()
    {
        return view("{$this->viewBasePath}.create");
    }

    public function storedata(FormRequest  $request)
    {
        $inserted = $this->model::insertRecord($request->validated());

        if ($inserted) {
            return redirect()->route("{$this->routeBaseName}.index")
                ->with('success', "{$this->model} created successfully!");
        } else {
            return back()->withInput()
                ->with('error', "Failed to create {$this->model}. Please try again.");
        }
    }

    public function show($id)
    {
        $record = $this->model::fetchById($id);

        if (!$record) {
            return redirect()->route("{$this->routeBaseName}.index")
                ->with('error', "{$this->model} not found.");
        }

        return view("{$this->viewBasePath}.show", compact('record'));
    }

    public function edit($id)
    {
        $record = $this->model::fetchById($id);

        if (!$record) {
            return redirect()->route("{$this->routeBaseName}.index")
                ->with('error', "{$this->model} not found.");
        }

        return view("{$this->viewBasePath}.edit", compact('record'));
    }

    public function updatedata(FormRequest $request, $id)
    {
        $updated = $this->model::updateRecord($id, $request->validated());

        if ($updated) {
            return redirect()->route("{$this->routeBaseName}.index")
                ->with('success', "{$this->model} updated successfully!");
        } else {
            return back()->withInput()
                ->with('error', "Failed to update {$this->model}. Please try again.");
        }
    }

    public function destroy($id)
    {
        $deleted = $this->model::deleteRecord($id);

        if ($deleted) {
            return redirect()->route("{$this->routeBaseName}.index")
                ->with('success', "{$this->model} deleted successfully!");
        } else {
            return redirect()->route("{$this->routeBaseName}.index")
                ->with('error', "Failed to delete {$this->model}. Please try again.");
        }
    }
}


?>