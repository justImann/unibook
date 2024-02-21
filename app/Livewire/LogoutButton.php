<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Mary\Traits\Toast;

class LogoutButton extends Component
{
    use Toast;
    public function logout()
    {
        Auth::logout();

        $this->info('berhasil logout!', position: "toast-bottom");

        $this->redirectRoute('/');

    }
    public function render()
    {
        return view('livewire.logout-button');
    }
}
