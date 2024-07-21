<?php

namespace App\Observers;

use App\Enums\EventTypeEnum;
use App\Models\Event;
use App\Models\Template;
use App\Models\User;

class TemplateObserver
{
    /**
     * Handle the Template "created" event.
     */
    public function created(Template $template): void
    {
        /* @var User $user */
        $user = auth()->user();

        Event::query()->create([
            'title' => 'Template ' . $template->name . ' was created',
            'link' => route('admin.templates.edit', compact('template')),
            'user_id' => $user?->getKey(),
            'new_values' => $template->toArray(),
            'type' => EventTypeEnum::CREATED->value
        ]);
    }

    /**
     * Handle the Template "updated" event.
     */
    public function updated(Template $template): void
    {
        /* @var User $user */
        $user = auth()->user();

        Event::query()->create([
            'title' => 'Template ' . $template->name . ' was updated',
            'link' => route('admin.templates.edit', compact('template')),
            'user_id' => $user?->getKey(),
            'old_values' => $template->getOriginal(),
            'type' => EventTypeEnum::UPDATED->value
        ]);
    }

    /**
     * Handle the Template "deleted" event.
     */
    public function deleted(Template $template): void
    {
        /* @var User $user */
        $user = auth()->user();

        Event::query()->create([
            'title' => 'Template ' . $template->name . ' was deleted',
            'user_id' => $user?->getKey(),
            'old_values' => $template->getOriginal(),
            'type' => EventTypeEnum::DELETED->value
        ]);
    }

    /**
     * Handle the Template "restored" event.
     */
    public function restored(Template $template): void
    {
        //
    }

    /**
     * Handle the Template "force deleted" event.
     */
    public function forceDeleted(Template $template): void
    {
        //
    }
}
