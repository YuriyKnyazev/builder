<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\StoreLanguageRequest;
use App\Http\Requests\Languages\UpdateLanguageRequest;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function __construct(
        private readonly LanguageService $service
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $languages = Language::query()
            ->orderBy('sort')
            ->get();

        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request): RedirectResponse
    {
        $language = $this->service->create($request->validated());
        $this->service->insertFieldContents($language);

        return to_route('admin.languages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language): View
    {
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, Language $language): RedirectResponse
    {
        $language->update($request->validated());
        return to_route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language): RedirectResponse
    {
        $language -> delete();
        return to_route('admin.languages.index');
    }
}
