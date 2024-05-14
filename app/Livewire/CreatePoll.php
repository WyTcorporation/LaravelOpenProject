<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title = '';
    public $options = [''];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1',
        'options.*' => 'required|string|min:1|max:255',
    ];

    protected $messages = [
        'options.*' => 'The option can`t be empty.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules);
    }

    public function createPoll()
    {

        Poll::create(
            $this->validate(
                $this->rules
            )
        )->options()->createMany(
            collect($this->options)->map(
//                function ($option) {
//                    return ['option' => $option];
//                }
                fn($option)=>['option' => $option] // Стрілковою фунцією, різниці немає, так коротше
            )->all()
        );

//        $poll = Poll::create([
//            'title' => $this->title
//        ]);
//
//        foreach ($this->options as $option)
//            $poll->options()->create(['option' => $option]);

        $this->reset(['title', 'options']);
        $this->dispatch('pollCreated');
        //return redirect()->to('/');
    }

    public function addOption(): void
    {
        $this->options[] = '';
    }

    public function removeOption($index): void
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function render()
    {
        return view('livewire.create-poll')->extends('components.livewire-layout');
    }
}
