<?php namespace Acme\Notifications\Mailchimp;

use Acme\Notifications\LessonPublished as LessonPublishedInterface;
use Mailchimp;

class LessonPublished implements LessonPublishedInterface {

    /**
     * List ID
     */
    const LESSON_SUBSCRIBERS_ID = '56d7c348b1';

    /**
     * @var Mailchimp
     */
    protected $mailchimp;

    /**
     * @param Mailchimp $mailchimp
     */
    function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Notify lesson subscribers through Mailchimp
     *
     * @param $title
     * @param $body
     * @return mixed
     */
    public function notify($title, $body)
    {
        // Can be stored in a config file instead...
        $options = [
            'list_id'    => self::LESSON_SUBSCRIBERS_ID,
            'subject'    => 'New on Laracasts: ' . $title,
            'from_name'  => 'Laracasts',
            'from_email' => 'jeffrey@laracasts.com',
            'to_name'    => 'Laracasts Subscriber'
        ];

        $content = [
            'html' => $body,
            'text' => strip_tags($body)
        ];

        $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);

        $this->mailchimp->campaigns->send($campaign['id']);
    }

}