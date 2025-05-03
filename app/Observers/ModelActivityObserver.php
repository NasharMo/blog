<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ModelActivityObserver
{
    /**
     * Handle the model "created" event.
     *
     * @param  mixed  $model
     * @return void
     */
    public function created($model)
    {
        $this->log('created', $model);
    }

    /**
     * Handle the model "updated" event.
     *
     * @param  mixed  $model
     * @return void
     */
    public function updated($model)
    {
        $changedFields = array_diff_assoc($model->getChanges(), $model->getOriginal());
        $this->log('updated', $model, $changedFields);
    }

    /**
     * Handle the model "deleted" event.
     *
     * @param  mixed  $model
     * @return void
     */
    public function deleted($model)
    {
        $this->log('deleted', $model);
    }

    protected function log(string $action, Model $model, array $changedFields = []) : void
    {
        ActivityLog::create([
            'entity_type' => get_class($model),
            'entity_id' => $model->id,
            'action_type' => $action,
            'changed_fields' => json_encode($changedFields),
            'performer_ip' => request()->ip(),
        ]);
    }
}
