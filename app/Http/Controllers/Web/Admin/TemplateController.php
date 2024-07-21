<?php

namespace App\Http\Controllers\Web\Admin;

use App\Enums\TemplateTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Template\StoreTemplateRequest;
use App\Http\Requests\Template\UpdateTemplateRequest;
use App\Models\FieldType;
use App\Models\Template;
use App\Services\FieldService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function __construct(
        private readonly FieldService $fieldService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $templates = Template::query()->whereNull('template_id')->orderBy('sort')->get();
        $types = [
            TemplateTypeEnum::Page->name => $templates->where('template_type', TemplateTypeEnum::Page->value),
            TemplateTypeEnum::Menu->name => $templates->where('template_type', TemplateTypeEnum::Menu->value)
        ];

        return view('admin.templates.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemplateRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        $fields['sort'] = Template::query()->count();

        if ($image = $request->file('image')) {
            $filename = rand(111111, 999999) . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('templates', $image, $filename);
            $fields['image'] = 'storage/templates/' . $filename;
        }
        $template = Template::query()->create($fields);

        if ((int)$request->level === 2 || (int)$request->level === 3) {
            $secondTemplate = Template::query()->create([
                'template_id' => $template->getKey()
            ]);
        }
        if ((int)$request->level === 3) {
            Template::query()->create([
                'template_id' => $secondTemplate->getKey()
            ]);
        }
        return to_route('admin.templates.edit', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template): View
    {
        $fieldTypes = FieldType::all();
        $template->load('fields.fieldType', 'template.template');

        return view('admin.templates.edit', compact(['template', 'fieldTypes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemplateRequest $request, Template $template): RedirectResponse
    {
        DB::transaction(function () use ($request, $template) {
            $template->update(['name' => $request->name]);
            $this->fieldService->update($request->fields ?? [], $request->templateIds ?? []);
        });

        return to_route('admin.templates.edit', compact('template'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template): RedirectResponse
    {
        $template->delete();
        return to_route('admin.templates.index');
    }
}
