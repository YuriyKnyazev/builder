<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function setLocale()
    {
        $locale = Language::query()->where('id', request()->lang)->value('code');
        app()->setLocale($locale);
        session()->put('lang', $locale);
        return back();
    }
}
