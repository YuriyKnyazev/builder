<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\DeleteEventsByDayRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Event::query()->latest()->with('user')->get();

        $days = $events->chunkWhile(function (Event $value, int $key, Collection $chunk) {
            return $value->created_at->toDateString() === $chunk->last()->created_at->toDateString();
        });

        return view('admin.events.index', compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function deleteByDay(DeleteEventsByDayRequest $request): RedirectResponse
    {
        Event::query()
            ->where('created_at', 'like', $request->date . '%')
            ->delete();

        return to_route('admin.history.index');
    }
}
