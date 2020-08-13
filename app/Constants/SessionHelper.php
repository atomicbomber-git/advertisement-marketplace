<?php


namespace App\Constants;


class SessionHelper
{
    const MESSAGES_KEY = "messages";

    public static function flashMessage($content, $state)
    {
        session()->flash("messages", array_merge(session('messages') ?? [], [
            [
                "content" => $content,
                "state" => $state
            ]
        ]));
    }
}