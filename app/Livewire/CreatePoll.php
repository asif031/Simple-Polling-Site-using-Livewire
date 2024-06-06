<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];

    protected $rules = [
        'title'=> 'required|min:3|max:255',
        'options' => 'required|min:1|max:10|array',
        'options.*' => 'required|min:1|max:255'
    ];

    protected $messages = [
        'options.*'=> "This field can't be empty!"
    ];
    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption() {
        $this->options[] =  '';
    }

    public function removeOption($index) {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function updated($propertyName) 
    {
        $this->validateOnly($propertyName);
    }

    public function createPoll() {
        //validate by $rules
        $this->validate();

        Poll::create([
            'title'=> $this->title

        ])->options()->createMany(
            collect($this->options)
                        ->map(fn($option) => ['name' => $option])
                        ->all() 
                        //calling all() to get raw array
        );

        // foreach ($this->options as $optionName) {
        //     $poll->options()->create([
        //         'name'=> $optionName
        //     ]);
        // }

        $this->reset(['title', 'options']);

        //$this->emit('pollCreated');
        //in livewire 3 emit has been changed.
        $this->dispatch('pollCreated');
    }

    // public function mount() {
    //     //This is the function which will
    //     // be executed only once unlike render method
    //     //tasks like database query should be handled here.
    // }
}
