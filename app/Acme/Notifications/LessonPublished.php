<?php namespace Acme\Notifications;

interface LessonPublished {

    /**
     * Notify lesson subscribers
     *
     * @param $title
     * @param $body
     * @return mixed
     */
    public function notify($title, $body);

} 