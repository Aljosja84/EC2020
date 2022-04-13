<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TwitterStreamingApi;
use App\Events\Tweets;

class TweetsStream extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweets:stream';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stream the tweets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $tweet
     * @return bool
     */
    public function hasUrl($tweet) {
        $reg_exUrl = "@((https?://)?([-\\w]+\\.[-\\w\\.]+)+\\w(:\\d+)?(/([-\\w/_\\.]*(\\?\\S+)?)?)*)@";

        return preg_match($reg_exUrl, $tweet) ? true : false;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // set the hashtag we're listening to
        $matchHash = "#atmmci";
        // start listening
        TwitterStreamingApi::publicStream()
            ->setLocale('en')
            ->whenHears($matchHash, function(array $tweet) use ($matchHash) {
                // make sure the tweet has text
                if (!empty($tweet['text'])) {
                    // exclude tweets with an url in it
                    if (!$this->hasUrl($tweet['text'])) {
                        // exclude all annoying retweets that are just clogging up the stream
                        if (substr($tweet['text'], 0, 2) != 'RT') {
                            // exclude replies and direct tweets, also just clogging it up
                            if (substr($tweet['text'], 0, 1) != '@') {
                                $tweet_data = [
                                    // remove the hashtag itself from the tweet
                                    'text' => str_ireplace($matchHash, '', $tweet['text']),
                                    'user_name' => $tweet['user']['screen_name'],
                                    'name' => $tweet['user']['name'],
                                    'profile_image_url_https' => $tweet['user']['profile_image_url_https'],
                                    'retweet_count' => $tweet['retweet_count'],
                                    'reply_count' => $tweet['reply_count'],
                                    'favorite_count' => $tweet['favorite_count'],
                                ];
                                if (isset($tweet['extended_tweet'])) {
                                    $tweet_data['text'] = str_ireplace($matchHash, '', $tweet['extended_tweet']['full_text']);
                                }

                                if (isset($tweet['created_at'])) {
                                    $tweet_data['date'] = date("M d", strtotime($tweet['created_at']));
                                }

                                if (isset($tweet['extended_entities']['media'][0]['media_url'])) {
                                    $tweet_data['image'] = $tweet['extended_entities']['media'][0]['media_url'];
                                }
                                event(new Tweets($tweet_data));
                            }
                        }
                    }
                }
            })
            ->startListening();
    }
}
