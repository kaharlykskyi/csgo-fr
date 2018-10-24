<?php
/**
 * Created by PhpStorm.
 * User: Seliv
 * Date: 27.08.2018
 * Time: 16:23
 */

namespace App\AppTreid;


use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
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
            if (stripos($stream->link,'www.twitch.tv') !== false){
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
                            'country' => DB::table('countrys')->where('country',$stream->country)->first(),
                            'service' => 'twitch'
                        ];
                    }

                }catch (\Exception $e){
                    if (Config::get('app.debug')){
                        dump($e->getMessage());
                    }
                }
            } elseif (stripos($stream->link,'www.facebook.com') !== false){
                try {
                    $fb = new Facebook([
                        'app_id' => '{'.Config::get('app.fb_app_key').'}',
                        'app_secret' => '{'.Config::get('app.fb_secret').'}',
                        'default_graph_version' => 'v3.2',
                    ]);

                    $fb_live = explode('/',$stream->link);

                    $response = $fb->get(
                        '/' . end($fb_live) . '?fields=id,embed_html,live_views',
                        Config::get('app.access_token')
                    );

                    $graphNode = $response->getGraphNode();
                    $graphNode = json_decode($graphNode);

                    $streams_output[$k] = [
                        'type' => 'live',
                        'link' => trim($stream->link),
                        'views' => $graphNode->live_views,
                        'channel_name' => trim($stream->name),
                        'country' => DB::table('countrys')->where('country',$stream->country)->first(),
                        'service' => 'facebook'
                    ];

                } catch (FacebookSDKException $e) {
                    if (Config::get('app.debug')){
                       dump($e->getMessage());
                    }
                }
            } elseif (stripos($stream->link,'www.youtube.com') !== false) {
                $client = new Client();
                $channelId = explode('/',$stream->link);

                try{
                    try{
                        $channe_data = $client->get("https://www.googleapis.com/youtube/v3/search?maxResults=1&part=snippet&channelId=".end($channelId)."&eventType=live&type=video&key=AIzaSyAOEkLY_mnud_KVyC-hM6ZmFitLHuyhe8Q")->getBody();
                    } catch (\Exception $e){
                        $channe_data = $client->get("https://www.googleapis.com/youtube/v3/search?maxResults=1&part=snippet&q=".end($channelId)."&eventType=live&type=video&key=AIzaSyAOEkLY_mnud_KVyC-hM6ZmFitLHuyhe8Q")->getBody();
                    }
                    $channe_data = json_decode($channe_data);
                    if ($channe_data->items[0]->snippet->liveBroadcastContent == 'live'){
                        if (isset($channe_data->items[0]->id)){
                            $stream_data = $client->get("https://www.googleapis.com/youtube/v3/videos?id={$channe_data->items[0]->id->videoId}&part=snippet,liveStreamingDetails&fields=items(id,snippet(title,liveBroadcastContent),liveStreamingDetails/concurrentViewers)&key=AIzaSyAOEkLY_mnud_KVyC-hM6ZmFitLHuyhe8Q")->getBody();
                            $stream_data = json_decode($stream_data);
                            if (isset($stream_data->items[0]->id)){
                                $streams_output[$k] = [
                                    'type' => $channe_data->items[0]->snippet->liveBroadcastContent,
                                    'link' => trim($stream->link),
                                    'views' => $stream_data->items[0]->liveStreamingDetails->concurrentViewers,
                                    'channel_name' => trim($stream->name),
                                    'country' => DB::table('countrys')->where('country',$stream->country)->first(),
                                    'service' => 'youtube',
                                    'id' => $stream_data->items[0]->id
                                ];
                            }
                        }
                    }
                } catch (\Exception $e){
                    if (Config::get('app.debug')){
                        dump($e->getMessage());
                    }
                }
            }
        }

        if (count($streams_output) > 1){
            usort($streams_output, function($a,$b){
                return ($b['views'] - $a['views']);
            });
        }

        return $streams_output;
    }
}