<?php

namespace App\Livewire;

use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public $model;
    public $recordId;

    /**
     * Mount the modal with the model and record ID.
     */
    public function mount($model, $recordId): void
    {
        $this->model = $model;
        $this->recordId = $recordId;
    }

    /**
     * Delete the record.
     */
    public function delete(): void
    {
        // Dynamically resolve the model
        $modelClass = 'App\\Models\\' . $this->model;

        if (class_exists($modelClass)) {
            $record = $modelClass::findOrFail($this->recordId);
            $record->delete();

            // Emit an event to refresh any relevant parent components
            $this->dispatch('recordDeleted', $this->recordId);
        }

        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.delete-modal');
    }
}
