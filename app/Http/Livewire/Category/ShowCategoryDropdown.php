<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class ShowCategoryDropdown extends Component
{
    public $rootCategories;
    public $selectArrays = [];
    public $masterRoot = null;
    public function mount()
    {
        $this->masterRoot = Category::whereNull('parent_id')->get('id');
        $this->fetchCategory();
    }
    public function render()
    {
        return view('livewire.category.show-category-dropdown');
    }

    public function fetchCategory($root = null , $node = null)
    {

        $data = Category::where('parent_id', $root)->get();

        $isMasterRoot = $this->masterRoot->filter(
            fn ($k) =>
            $k->id == $root
        )->first();
        if (!empty($isMasterRoot) && !empty($root)) {
            $this->selectArrays = [];
            $masterData = Category::where('parent_id', null)->get();
            $this->selectArrays[] = $masterData->toArray();
        } else {

            $currentParentIndex = array_search($root , array_column($this->selectArrays , 'id'));
             array_splice($this->selectArrays , $node+1);
        }
        $this->selectArrays[count($this->selectArrays)] = $data->toArray();

    }
}
