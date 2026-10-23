<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SystemModule;
use App\Services\AiSkincareService;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::with(['brand', 'category'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->limit(8)
            ->get();

        $landingProducts = Product::where('is_landing_page_active', true)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        $brands = Brand::where('is_active', true)->limit(6)->get();
        $categories = Category::where('is_active', true)->get();
        $modules = SystemModule::where('is_enabled', true)->get();

        return view('public.home', compact('featuredProducts', 'landingProducts', 'brands', 'categories', 'modules'));
    }

    public function features()
    {
        $modules = SystemModule::all();
        return view('public.features', compact('modules'));
    }

    public function pricing()
    {
        return view('public.pricing');
    }

    public function skinQuiz()
    {
        return view('public.skin-quiz');
    }

    public function shop(Request $request)
    {
        $query = Product::with(['brand', 'category'])->where('is_active', true);

        if ($request->filled('skin_type')) {
            $query->whereJsonContains('skin_types', $request->skin_type);
        }

        if ($request->filled('skin_concern')) {
            $query->whereJsonContains('skin_concerns', $request->skin_concern);
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('bangla_name', 'like', "%{$s}%")
                    ->orWhere('sku', 'like', "%{$s}%");
            });
        }

        $products = $query->paginate(12)->withQueryString();
        $brands = Brand::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();

        return view('public.shop', compact('products', 'brands', 'categories'));
    }

    public function landing(string $slug)
    {
        $product = Product::with(['brand', 'category', 'batches'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.landing', compact('product'));
    }

    public function demo()
    {
        return view('public.demo');
    }

    public function docs()
    {
        return view('public.docs');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function orderSuccess(string $orderNumber)
    {
        $order = Order::with('items.product')->where('order_number', $orderNumber)->firstOrFail();
        return view('public.order-success', compact('order'));
    }
}
