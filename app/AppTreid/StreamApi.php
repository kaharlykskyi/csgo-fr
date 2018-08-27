<?php
/**
 * Created by PhpStorm.
 * User: Seliv
 * Date: 27.08.2018
 * Time: 16:23
 */

namespace App\AppTreid;


use GuzzleHttp\Client;

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
                        'Client-ID' => env('TWITCH_KEY'),
                        'Accept' => 'application/vnd.twitchtv.v5+json'
                    ]
            ]);
            $user_twitch_data = $client->get('https://api.twitch.tv/kraken/users?login=' . trim($stream->name))->getBody();
            $user_twitch_data = json_decode($user_twitch_data);
            $user_id = $user_twitch_data->users[0]->_id;
            $stream_data = $client->get('https://api.twitch.tv/kraken/streams/' . $user_id)->getBody();
            $stream_data = json_decode($stream_data);
            if($stream_data->stream == null){
                $stream_type = null;
                $stream_views = null;
            } else {
                $stream_type = $stream_data->stream->stream_type;
                $stream_views = $stream_data->stream->viewers;
            }
            $streams_output[$k] = [
                'type' => $stream_type,
                'link' => trim($stream->link),
                'views' => $stream_views,
                'channel_name' => trim($stream->name)
            ];
        }

        usort($streams_output, function($a,$b){
            return ($b['views'] - $a['views']);
        });

        return $streams_output;

    }
}