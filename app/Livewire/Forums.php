<?php

namespace App\Livewire;

use App\Models\Forum;
use Livewire\Component;

class Forums extends Component
{
    public function render()
    {
        return view('livewire.forums', [
            'forums' => Forum::isPrivate()->get()
        ]);
    }
}
