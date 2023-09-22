<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNoteFoundException;
use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = [
        'statusWasUpdated',
        'ideaWasUpdated',
        'ideaWasMarkedAsNotSpam',
        'ideaWasMarkedAsSpam',
        'commentWasAdded'
    ];

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function statusWasUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaWasUpdated()
    {
        $this->idea->refresh();
    }
    public function ideaWasMarkedAsNotSpam()
    {
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsSpam()
    {
        $this->idea->refresh();
    }

    public function commentWasAdded()
    {
        $this->idea->refresh();
    }

    public function vote()
    {
        if (! auth()->check()) {
            return redirect(route('login'));
        }

        if ($this->hasVoted) {
            try {
                $this->idea->removeVote(auth()->user());
            } catch (VoteNoteFoundException $e) {

            }
            $this->votesCount--;
            $this->hasVoted = false;
        } else {
            try {
                $this->idea->vote(auth()->user());
            } catch (DuplicateVoteException $e) {

            }
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }
    public function render()
    {
        return view('livewire.idea-show');
    }


}
