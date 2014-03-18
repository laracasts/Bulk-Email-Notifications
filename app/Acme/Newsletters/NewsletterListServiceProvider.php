<?php namespace Acme\Newsletters;

use Illuminate\Support\ServiceProvider;

class NewsletterListServiceProvider extends ServiceProvider {

    /**
     * Register binding in IoC container
     */
    public function register()
    {
        $this->app->bind(
            'Acme\Newsletters\NewsletterList',
            'Acme\Newsletters\Mailchimp\NewsletterList'
        );
    }

}