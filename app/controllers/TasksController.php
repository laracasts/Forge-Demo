<?php

class TasksController extends BaseController {

	/**
	 * Task Repository
	 *
	 * @var Task
	 */
	protected $task;

	public function __construct(Task $task)
	{
		$this->task = $task;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = $this->task->all();

		return View::make('tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Task::$rules);

		if ($validation->passes())
		{
			$this->task->create($input);

			return Redirect::route('tasks.index');
		}

		return Redirect::route('tasks.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$task = $this->task->findOrFail($id);

		return View::make('tasks.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$task = $this->task->find($id);

		if (is_null($task))
		{
			return Redirect::route('tasks.index');
		}

		return View::make('tasks.edit', compact('task'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Task::$rules);

		if ($validation->passes())
		{
			$task = $this->task->find($id);
			$task->update($input);

			return Redirect::route('tasks.show', $id);
		}

		return Redirect::route('tasks.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->task->find($id)->delete();

		return Redirect::route('tasks.index');
	}

}
