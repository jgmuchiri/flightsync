<?php

namespace App\Livewire;

use App\Models\NewsPost;
use Livewire\Component;
use Livewire\WithPagination;

class News extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.news',[
            'posts'=>NewsPost::paginate(20)
        ]);
    }
}
