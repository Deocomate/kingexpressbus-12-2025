<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Support\Client\SearchDataBuilder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $searchDefaults = [
            'origin' => null,
            'destination' => null,
            'departure_date' => Carbon::today()->format('d/m/Y'),
        ];

        $popularRoutes = DB::table('routes')
            ->orderByDesc('priority')
            ->limit(8)
            ->get()
            ->map(function ($route) {
                // Get min price for each route
                $route->min_price = DB::table('bus_routes as br')
                    ->join('company_routes as cr', 'br.company_route_id', '=', 'cr.id')
                    ->where('cr.route_id', $route->id)
                    ->min('br.price');

                // Get company count for each route
                $route->company_count = DB::table('company_routes as cr')
                    ->join('companies as c', 'cr.company_id', '=', 'c.id')
                    ->where('cr.route_id', $route->id)
                    ->distinct()
                    ->count('c.id');

                return $route;
            });

        return view('client.routes.index', [
            'searchData' => SearchDataBuilder::make(['defaults' => $searchDefaults]),
            'popularRoutes' => $popularRoutes,
            'title' => __('client.routes.index.meta_title', ['default' => 'Tìm kiếm tuyến xe']),
            'description' => __('client.routes.index.meta_description', ['default' => 'Đặt vé xe khách trực tuyến dễ dàng, tiện lợi.']),
        ]);
    }
    private function travelTips(): array
    {
        return [
            [
                'icon' => 'fa-solid fa-clock',
                'title' => __('client.route_show.tips.tip_1_title'),
                'content' => __('client.route_show.tips.tip_1_content'),
            ],
            [
                'icon' => 'fa-solid fa-suitcase-rolling',
                'title' => __('client.route_show.tips.tip_2_title'),
                'content' => __('client.route_show.tips.tip_2_content'),
            ],
            [
                'icon' => 'fa-solid fa-mug-hot',
                'title' => __('client.route_show.tips.tip_3_title'),
                'content' => __('client.route_show.tips.tip_3_content'),
            ],
        ];
    }

    private function frequentlyAskedQuestions(): array
    {
        return [
            [
                'question' => __('client.route_show.faq.faq_1_question'),
                'answer' => __('client.route_show.faq.faq_1_answer'),
            ],
            [
                'question' => __('client.route_show.faq.faq_2_question'),
                'answer' => __('client.route_show.faq.faq_2_answer'),
            ],
            [
                'question' => __('client.route_show.faq.faq_3_question'),
                'answer' => __('client.route_show.faq.faq_3_answer'),
            ],
        ];
    }

    public function show($slug, Request $request)
    {
        // 1. Get Route info
        $route = DB::table('routes')
            ->where('slug', $slug)
            ->select(
                'routes.*',
                DB::raw('(SELECT name FROM provinces WHERE id = routes.province_start_id) as start_province_name'),
                DB::raw('(SELECT name FROM provinces WHERE id = routes.province_end_id) as end_province_name')
            )
            ->first();

        if (!$route) {
            abort(404);
        }

        // 2. Get Search Params
        $departureDate = $request->input('departure_date', Carbon::today()->format('d/m/Y'));
        try {
            $parsedDate = Carbon::createFromFormat('d/m/Y', $departureDate)->format('Y-m-d');
        } catch (\Exception $e) {
            $parsedDate = Carbon::today()->format('Y-m-d');
        }

        // 3. Query Trips (Bus Routes)
        $tripsQuery = DB::table('bus_routes as br')
            ->join('company_routes as cr', 'br.company_route_id', '=', 'cr.id')
            ->join('companies as c', 'cr.company_id', '=', 'c.id')
            ->join('buses as b', 'br.bus_id', '=', 'b.id')
            ->where('cr.route_id', $route->id)
            ->where('br.is_active', 1)
            ->select(
                'br.id as bus_route_id',
                'br.company_route_id',
                'br.price as price_value',
                'br.start_time',
                'br.end_time',
                'br.price',
                'b.id as bus_id',
                'b.name as bus_name',
                'b.model_name as bus_category', // Mapping model_name to bus_category
                'b.seat_count',
                'b.services as bus_services',
                'b.thumbnail_url as bus_thumbnail',
                'b.image_list_url as bus_images',
                'c.name as company_name',
                'c.thumbnail_url as company_thumbnail'
            );

        // Apply Filters here if needed (e.g. price range, time range from request)
        // For now, simpler implementation

        $allTrips = $tripsQuery->get();

        // 4. Process Trips (Availability, Points, Services)
        $trips = $allTrips->map(function ($trip) use ($parsedDate) {
            // Duration
            $start = Carbon::parse($trip->start_time);
            $end = Carbon::parse($trip->end_time);
            if ($end->lessThan($start)) {
                $end->addDay();
            }
            $trip->duration_minutes = $start->diffInMinutes($end);

            // Availability
            $bookedSeats = DB::table('bookings')
                ->where('bus_route_id', $trip->bus_route_id)
                ->whereDate('booking_date', $parsedDate)
                ->whereIn('status', ['pending', 'confirmed', 'completed'])
                ->sum('quantity');

            $trip->seats_available = max(0, $trip->seat_count - $bookedSeats);
            $trip->has_price = $trip->price > 0;

            // Pickup/Dropoff Points
            $stops = DB::table('company_route_stops as crs')
                ->join('stops as s', 'crs.stop_id', '=', 's.id')
                ->where('crs.company_route_id', $trip->company_route_id)
                ->select('s.name', 's.address', 'crs.stop_type', 'crs.priority')
                ->orderByDesc('crs.priority')
                ->get();

            $trip->pickup_points = $stops->whereIn('stop_type', ['pickup', 'both'])->values();
            $trip->dropoff_points = $stops->whereIn('stop_type', ['dropoff', 'both'])->values();

            // Services
            $trip->services = json_decode($trip->bus_services, true) ?? [];

            // Images
            $trip->image_gallery = json_decode($trip->bus_images, true) ?? [];
            if ($trip->bus_thumbnail) {
                array_unshift($trip->image_gallery, $trip->bus_thumbnail);
            }
            $trip->primary_bus_image = $trip->image_gallery[0] ?? null;

            return $trip;
        });

        // 5. Prepare Search Data for View
        $searchDefaults = [
            'origin' => null,
            'destination' => null,
            'departure_date' => $departureDate
        ];

        if ($request->has('origin_id')) {
            $originName = 'Unknown';
            if ($request->input('origin_type') == 'province') {
                $originName = DB::table('provinces')->where('id', $request->input('origin_id'))->value('name');
            }
            $searchDefaults['origin'] = [
                'id' => $request->input('origin_id'),
                'type' => $request->input('origin_type'),
                'name' => $originName ?? $route->start_province_name
            ];
        } else {
            $searchDefaults['origin'] = [
                'id' => $route->province_start_id,
                'type' => 'province',
                'name' => $route->start_province_name
            ];
        }

        if ($request->has('destination_id')) {
            $destName = 'Unknown';
            if ($request->input('destination_type') == 'province') {
                $destName = DB::table('provinces')->where('id', $request->input('destination_id'))->value('name');
            }
            $searchDefaults['destination'] = [
                'id' => $request->input('destination_id'),
                'type' => $request->input('destination_type'),
                'name' => $destName ?? $route->end_province_name
            ];
        } else {
            $searchDefaults['destination'] = [
                'id' => $route->province_end_id,
                'type' => 'province',
                'name' => $route->end_province_name
            ];
        }

        // Filters State
        $filterState = [
            'sort' => $request->input('sort', 'recommended'),
            'price_min' => $request->input('price_min'),
            'price_max' => $request->input('price_max'),
            'services' => $request->input('services', []),
            'pickup_points' => $request->input('pickup_points', []),
            'dropoff_points' => $request->input('dropoff_points', []),
            'bus_categories' => $request->input('bus_categories', []),
            'time_ranges' => $request->input('time_ranges', []),
        ];

        // 6. Return View
        return view('client.routes.show', [
            'route' => $route,
            'trips' => $trips,
            'companyRoutes' => DB::table('company_routes')->where('route_id', $route->id)->get(), // minimal for count
            'searchData' => SearchDataBuilder::make(['defaults' => $searchDefaults]),
            'filters' => [], // Populating filters dynamically would require extracting unique values from $trips
            'filterState' => $filterState,
            'tripStats' => ['total' => $trips->count(), 'filtered' => $trips->count()],
            'departureDate' => $departureDate,
            'travelTips' => $this->travelTips(),
            'frequentlyAskedQuestions' => $this->frequentlyAskedQuestions(),
            'title' => $route->title ?? $route->name,
            'description' => $route->description,
        ]);
    }
}

