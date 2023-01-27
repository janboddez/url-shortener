<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    protected $hashids;

    public function __construct()
    {
        $this->hashids = new Hashids(config('app.name'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function get(string $slug)
    {
        $id = $this->hashids->decode($slug);

        if (! isset($id[0])) {
            abort(404);
        }

        $url = DB::table('urls')
            ->where('id', $id[0])
            ->value('url');

        if (! $url) {
            abort(404);
        }

        return redirect($url, 301);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        if ($request->bearerToken() !== config('allowlist.token')) {
            abort(401);
        }

        $url = $request->input('url');

        if (! is_string($url)) {
            abort(400);
        }

        $url = rawurldecode($url);

        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            abort(400);
        }

        if (! preg_match('~^https?://~', $url)) {
            abort(400);
        }

        // See `config/allowlist.php`.
        if (! in_array(parse_url($url, PHP_URL_HOST), config('allowlist.domains', []), true)) {
            abort(400);
        }

        $id = DB::table('urls')
            ->where('url', $url)
            ->value('id');

        if (! $id) {
            $id = DB::table('urls')
                ->insertGetId([
                    'url' => $url,
                    'created_at' => Carbon::now(),
                ]);
        }

        $shortenedUrl = url($this->hashids->encode($id));

        return response($shortenedUrl, 200)
            ->header('Content-Type', 'text/plain');
    }
}
