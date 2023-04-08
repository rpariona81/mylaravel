<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Symfony\Component\HttpFoundation\Session\Session;

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
        //https://laracasts.com/discuss/channels/laravel/find-user-roles
        //https://www.arsys.es/blog/session-laravel#Helper_global_session
        $event->user->logged_in_at = Carbon::now();
        
        $user_id = $event->user->id;
        $user_logged = User::where('id',$user_id)->first();
        session()->put('role', $user_logged->role['rolename']);

        $role_user_logged = Role::where('id',$user_logged->role['id'])->first();
        //$menus = $role_user_logged->menus;
        $menus = $role_user_logged->getMenus();
        //session()->put('menus', $menus);
        foreach ($menus as $key => $value) {
            session()->push('usuario.menu', $value['menu']);
        }
        
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
