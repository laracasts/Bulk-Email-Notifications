<?php namespace Acme\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider {

    /**
     * Set binding in IoC container
     */
    public function register()
    {
        $this->app->bind(
            'Acme\Notifications\LessonPublished',
            'Acme\Notifications\Mailchimp\LessonPublished'
        );
    }

}