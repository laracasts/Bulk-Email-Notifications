<?php

use Acme\Newsletters\NewsletterList;

class UsersController extends \BaseController {

    /**
     * @var Acme\Newsletters\NewsletterList
     */
    private $newsletterList;

    /**
     * @param NewsletterList $newsletterList
     */
    function __construct(NewsletterList $newsletterList)
    {
        $this->beforeFilter('auth');

        $this->newsletterList = $newsletterList;
    }

	/**
	 * Show the form for editing a user's profile.
	 *
	 * @return Response
	 */
	public function edit()
	{
		$user = Auth::user();

        return View::make('users.edit')->withUser($user);
	}

    /**
     * Update the user's profile
     *
     * @return Response
     */
	public function update()
	{
        Auth::user()->updateCredentials(Input::all());

        // Instead, you could fire an event, and then handle this
        // ...potentially using a queue.
        $email = Auth::user()->email;
		$method = Input::get('notify') ? 'subscribeTo' : 'unsubscribeFrom';

        $this->newsletterList->{$method}('lessonSubscribers', $email);

        return Redirect::back();
	}

}