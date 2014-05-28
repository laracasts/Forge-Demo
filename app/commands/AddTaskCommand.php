<?php

use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AddTaskCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'app:add-task';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add a new dummy task.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		Task::create([
            'name' => 'Dummy Task',
            'description' => 'Task added on ' . Carbon::now()
        ]);
	}
    
}
