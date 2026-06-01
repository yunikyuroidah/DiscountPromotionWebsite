<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        $heroProduct = Product::query()
            ->where('is_active', true)
            ->orderByDesc('discount_percent')
            ->first();

        $featuredProducts = Product::query()
            ->where('is_active', true)
            ->orderByDesc('discount_percent')
            ->take(6)
            ->get();

        $latestProducts = Product::query()
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Product::query()
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->take(6)
            ->pluck('category');

        return view('public.home', [
            'heroProduct' => $heroProduct,
            'featuredProducts' => $featuredProducts,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
        ]);
    }

    public function promo(Request $request): View
    {
        $query = Product::query()->where('is_active', true);

        $search = trim((string) $request->get('q', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $category = trim((string) $request->get('category', ''));
        if ($category !== '') {
            $query->where('category', $category);
        }

        $discountFilter = trim((string) $request->get('discount', ''));
        if ($discountFilter === 'aktif') {
            $query->where('discount_percent', '>', 0)
                ->whereDate('discount_valid_until', '>=', now()->toDateString());
        }

        $products = $query
            ->orderByDesc('discount_percent')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $categories = Product::query()
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('public.promo', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function productImage(Product $product): Response
    {
        if (!$product->image) {
            return response($this->placeholderSvg($product->name))
                ->header('Content-Type', 'image/svg+xml');
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->buffer($product->image) ?: 'image/jpeg';

        return response($product->image)
            ->header('Content-Type', $mime)
            ->header('Cache-Control', 'public, max-age=86400');
    }

    private function placeholderSvg(string $name): string
    {
        $initial = Str::upper(Str::substr(trim($name), 0, 1));

        return '<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" viewBox="0 0 600 450">'
            . '<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1">'
            . '<stop offset="0%" stop-color="#eef1ff"/><stop offset="100%" stop-color="#ffe9d6"/>'
            . '</linearGradient></defs>'
            . '<rect width="600" height="450" rx="32" fill="url(#g)"/>'
            . '<text x="50%" y="52%" text-anchor="middle" font-family="Space Grotesk, Arial" '
            . 'font-size="96" fill="#2f5ff7" font-weight="700">' . $initial . '</text>'
            . '</svg>';
    }
}
