<?php

namespace App\Observers;

use App\Enums\EventTypeEnum;
use App\Models\Event;
use App\Models\Language;
use App\Models\User;

class LanguageObserver
{
    /**
     * Handle the Language "created" event.
     */
    public function created(Language $language): void
    {
        /* @var User $user */
        $user = auth()->user();

        Event::query()->create([
            'title' => 'Language ' . $language->name . ' was created',
            'link' => route('admin.languages.edit', compact('language')),
            'user_id' => $user?->getKey(),
            'new_values' => $language->toArray(),
            'type' => EventTypeEnum::CREATED->value
        ]);
    }

    /**
     * Handle the Language "updated" event.
     */
    public function updated(Language $language): void
    {
        /* @var User $user */
        $user = auth()->user();

        Event::query()->create([
            'title' => 'Language was updated',
            'link' => route('admin.languages.edit', compact('language')),
            'user_id' => $user?->getKey(),
            'new_values' => $language->toArray(),
            'old_values' => $language->getOriginal(),
            'type' => EventTypeEnum::UPDATED->value
        ]);
    }

    /**
     * Handle the Language "deleted" event.
     */
    public function deleted(Language $language): void
    {
        /* @var User $user */
        $user = auth()->user();

        Event::query()->create([
            'title' => 'Language ' . $language->name . ' was deleted',
            'user_id' => $user?->getKey(),
            'old_values' => $language->getOriginal(),
            'type' => EventTypeEnum::DELETED->value
        ]);
    }
}
