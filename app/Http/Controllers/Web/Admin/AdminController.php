<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\SortRequest;
use App\Http\Requests\Common\StatusRequest;
use App\Services\Sort\ModelFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct(
        protected ModelFactory $modelFactory
    )
    {
    }

    public function index(): View
    {
        return view('admin.index');
    }

    public function sort(SortRequest $request): JsonResponse
    {
        $this->modelFactory->getModel($request->model)->sort($request->sort);
        return response()->json(['status' => 'success'] + $request->validated());
    }

    public function changeStatus(StatusRequest $request): JsonResponse
    {
        $this->modelFactory->getModel($request->model)->changeStatus($request->id);
        return response()->json(['status' => 'success'] + $request->validated());
    }
}
