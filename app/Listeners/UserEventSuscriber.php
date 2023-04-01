<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class UserEventSuscriber
{
    /**
     * @var Request
     */
    protected $request;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    /**
     * @param \Illuminate\Auth\Events\Login $event
     */
    public function onUserLogin(Login $event)
    {
        $event->user->logged_in_at = Carbon::now();
        /*if (config('database.default') == 'mysql') {
            $event->user->logged_in_at = (Carbon::now())->format('Y-m-d H:i:s');
        }elseif(config('database.default') == 'sqlsrv'){
            $event->user->logged_in_at = (Carbon::now())->format('Ymd H:i:s');
        }else{
            $event->user->logged_in_at = (Carbon::now())->format('Y-m-d H:i:s');
        }
        */
        $event->user->ip_address = $this->request->getClientIp();
        //dd($event->user);//
        $event->user->save();
    }

    /**
     * @param \Illuminate\Auth\Events\Logout $event
     */
    public function onUserLogout(Logout $event)
    {
        $event->user->logged_out_at = Carbon::now();
        $event->user->save();
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(Login::class, static::class . '@onUserLogin');
        $events->listen(Logout::class, static::class . '@onUserLogout');
    }

}
