<?php

namespace App\Listeners;

use App\Models\TodoLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TodoCompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(\App\Events\TodoCompleted $event)
    {
        $todo = $event->todo;

        TodoLog::create([
            'detail' => $todo->toJson(),
            'action' => "?".$todo->name."?" . " başlıklı görev tamamlandı.",
            'user_id' => $todo->user_id,
            'todo_id' => $todo->id
        ]);
    }
}
