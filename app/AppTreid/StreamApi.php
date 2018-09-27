<?php
/**
 * Created by PhpStorm.
 * User: Seliv
 * Date: 27.08.2018
 * Time: 16:23
 */

namespace App\AppTreid;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait StreamApi
{
    /**
     * @param $streams
     * @return array
     */
    public function getStream($streams){
        $streams_output = [];

        foreach ($streams as $k => $stream){
            $client = new Client([
                'headers' =>
                    [
                        'Client-ID' => Config::get('app.twitch_key'),
                        //'Accept' => 'application/vnd.twitchtv.v5+json'
                    ]
            ]);
            try{

                $stream_data = $client->get('https://api.twitch.tv/helix/streams?user_login=' . trim($stream->name))->getBody();
                $stream_data = json_decode($stream_data);

                if(empty($stream_data->data[0])){
                    $stream_type = null;
                    $stream_views = null;
                } else {
                    $stream_type = $stream_data->data[0]->type;
                    $stream_views = $stream_data->data[0]->viewer_count;
                }
                if($stream_type == 'live'){
                    $streams_output[$k] = [
                        'type' => $stream_type,
                        'link' => trim($stream->link),
                        'views' => $stream_views,
                        'channel_name' => trim($stream->name),
                        'country' => DB::table('countrys')->where('country',$stream->country)->first()
                    ];
                }

                usort($streams_output, function($a,$b){
                    return ($b['views'] - $a['views']);
                });
            }catch (\Exception $e){
                if (Config::get('app.debug')){
                    dump($e->getMessage());
                } else {
                    $streams_output = null;
                }
            }
        }

        return $streams_output;

    }
}