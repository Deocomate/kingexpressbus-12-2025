<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Support\Client\SearchDataBuilder;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // 1. Dữ liệu cho thanh tìm kiếm (Dropdown địa điểm)
        $searchData = SearchDataBuilder::make();

        // 2. Tuyến đường phổ biến (Lấy 8 tuyến có độ ưu tiên cao nhất)
        $popularRoutes = DB::table('routes as r')
            ->select([
                'r.id',
                'r.name',
                'r.slug',
                'r.description',
                'r.duration',
                'r.distance_km',
                'r.thumbnail_url',
                // Lấy giá thấp nhất đang hoạt động
                DB::raw('COALESCE((SELECT MIN(br.price) FROM bus_routes br JOIN company_routes cr ON cr.id = br.company_route_id WHERE cr.route_id = r.id AND br.price > 0 AND br.is_active = 1), 0) as min_price'),
                // Đếm số nhà xe khai thác tuyến này
                DB::raw('(SELECT COUNT(DISTINCT cr.id) FROM company_routes cr WHERE cr.route_id = r.id) as company_count'),
            ])
            ->orderByDesc('r.priority')
            ->orderByDesc('r.created_at')
            ->limit(8)
            ->get();

        // 3. Nhà xe nổi bật (Lấy 8 nhà xe uy tín)
        $featuredCompanies = DB::table('companies as c')
            ->select([
                'c.id',
                'c.name',
                'c.slug',
                'c.thumbnail_url',
                'c.description',
                // Đếm số tuyến đường nhà xe đang khai thác
                DB::raw('(SELECT COUNT(DISTINCT cr.id) FROM company_routes cr WHERE cr.company_id = c.id) as route_count'),
            ])
            ->orderByDesc('c.priority')
            ->limit(8)
            ->get();

        return view('client.home.index', compact('searchData', 'popularRoutes', 'featuredCompanies'));
    }
}
