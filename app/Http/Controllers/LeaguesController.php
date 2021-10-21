<?php


namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class LeaguesController extends Controller
{
    public function getLeagues($league_id = null)
    {
        $client = new Client();

        $response = $client->get(config('test.data-url'))->getBody();
        $data = \json_decode($response, true);

        $collection = collect($data['infos']);

        if ($league_id) {
            $league = $collection->firstWhere('league_id', $league_id);

            return $league ? ['name' => $league['name']] : null;
        }

        if (request()->exists('start_timestamp')) {
            $start_timestamp = intval(request()->start_timestamp);

            if ($start_timestamp <= 0) {
                return response()->json(['message' => 'start_timestamp is not valid'], HttpResponse::HTTP_BAD_REQUEST);
            }

            $collection = $collection->where('start_timestamp', '>=', $start_timestamp);
        }

        $ids = $collection->pluck('league_id');

        return $ids;
    }
}