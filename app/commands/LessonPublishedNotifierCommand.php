<?php

use Acme\Notifications\LessonPublished;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class LessonPublishedNotifierCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'laracasts:notify-lesson-subscribers';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Notify all lesson subscribers by email.';

	/**
	 * @var LessonPublished
	 */
	private $lessonPublishedNotifier;

	/**
	 * Create a new command instance.
	 *
	 * @param LessonPublished $lessonPublishedNotifier
	 * @return LessonPublishedNotifierCommand
	 */
	public function __construct(LessonPublished $lessonPublishedNotifier)
	{
		parent::__construct();

		$this->lessonPublishedNotifier = $lessonPublishedNotifier;
	}

	/**
	 * Notify all lesson subscribers
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$lesson = $this->getLesson();

		$this->lessonPublishedNotifier->notify($lesson['title'], $lesson['body']);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['lessonId', InputArgument::REQUIRED, 'Id of lesson to notify subscribers about.']
		];
	}

	/**
	 * @return array
	 */
	private function getLesson()
	{
		return [
			'title' => 'My Lesson Title',
			'body'  => 'The body of my lesson'
		];
	}

}
