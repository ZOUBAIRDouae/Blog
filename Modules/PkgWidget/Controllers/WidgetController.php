<?php

namespace Modules\PkgWidget\Controllers;

use App\Http\Controllers\Controller;
use Modules\PkgWidget\App\Services\WidgetService;
use Modules\PkgWidget\Models\Widget;
use Illuminate\Http\Request;
use Modules\PkgWidget\Requests\WidgetRequest;



use Illuminate\Support\Facades\Auth;

class WidgetController extends Controller
{
    protected $widgetService;

    
    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    public function test(Request $request)
    {
        $methodName = $request->input('method_name');

        try {
            if (method_exists($this->widgetService, $methodName)) {
                $result = call_user_func([$this->widgetService, $methodName]);
                return view('PkgWidget::test', ['result' => $result]);
            } else {
                throw new \Exception("Méthode non trouvée !");
            }
        } catch (\Exception $e) {
            return view('PkgWidget::test', ['error' => $e->getMessage()]);
        }
    }

    public function index()
    {
        $widgets = Widget::all();
        return view('PkgWidget::table', compact('widgets'))->render;
    }

    public function store(WidgetRequest $request)
    {
        Widget::create($request->validated());
        return response()->json(['success' => 'Widget ajouté avec succès']);
    }

    public function update(WidgetRequest $request, Widget $widget)
    {
        $widget->update($request->validated());
        return response()->json(['success' => 'Widget mis à jour']);
    }

    public function destroy(Widget $widget)
    {
        $widget->delete();
        return response()->json(['success' => 'Widget supprimé']);
    }

    
}
