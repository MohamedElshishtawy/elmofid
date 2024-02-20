<?php

namespace App\Livewire;

use App\Models\Group;
use Livewire\Component;
use PHPUnit\Metadata\Api\Groups;

class ShowGroups extends Component
{
    public $groups = [];
    public $_class ;

    public function mount($url_class)
{
    $this->_class = $url_class;
    $this->get_groups($url_class);
}

public function updated_class($value)
{
    $this->get_groups($value);
}
    public function get_groups($class)
{
    $this->groups = Group::where('class', $class)->get()->toArray();
}

    public function render()
    {
        return view('livewire.show-groups');
    }
}
