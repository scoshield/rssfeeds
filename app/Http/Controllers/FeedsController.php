<?php

namespace App\Http\Controllers;

use App\Models\Feeds;
use Illuminate\Http\Request;
use Vedmant\FeedReader\Facades\FeedReader;
use Illuminate\Support\Facades\View;
use SimplePie;

class FeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $f = FeedReader::read('https://anchor.fm/s/1874b888/podcast/rss');
        // $f = FeedReader::read('https://www.theringer.com/rss/ringer-fc/index.xml');

        $result = [
            'title' => $f->get_title(),
            'description' => $f->get_description(),
            'permalink' => $f->get_permalink(),
            'link' => $f->get_link(),
            'copyright' => $f->get_copyright(),
            'language' => $f->get_language(),
            'image_url' => $f->get_image_url(),
            'author'=> $f->get_author()
        ];

        foreach($f->get_items(0, $f->get_item_quantity()) as $item)
        {
            $i['title'] = $item->get_title();
            $i['description'] = $item->get_description();
            $i['id'] = $item->get_id();
            $i['content'] = $item->get_content();
            $i['thumbnail'] = $item->get_thumbnail();
            $i['author'] = $item->get_author();
            $i['copyright'] = $item->get_copyright();
            $i['date'] = $item->get_date();
            $i['updated_date'] = $item->get_local_date();
            $i['link'] = $item->get_link();
            $i['audio_link'] = $item->get_enclosure()->get_link();
            $i['audio_length'] = $item->get_enclosure()->get_duration();
            $i['audio_image'] = $item->get_enclosure()->get_thumbnails();
            $i['category'] = $item->get_category();
            $i['enclosure'] = $item->get_enclosure();
            $i['latitude'] = $item->get_latitude();
            $i['source'] = $item->get_source();

            $result['items'][] = $i;
        }

        // return response()->json([
        //     'data' => $result,
        // ], 200);

        return View::make('podcasts', ['feeds'=> $result]);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feeds  $feeds
     * @return \Illuminate\Http\Response
     */
    public function show(Feeds $feeds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feeds  $feeds
     * @return \Illuminate\Http\Response
     */
    public function edit(Feeds $feeds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feeds  $feeds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feeds $feeds)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feeds  $feeds
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feeds $feeds)
    {
        //
    }
}
