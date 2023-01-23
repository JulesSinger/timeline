<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TimelineResource;
use App\Models\TimelineItem;
use Illuminate\Support\Facades\Validator;

class TimelineController extends Controller
{
    /**
     * Display a listing of the posts
     *
     * @return array
     */
    public function list()
    {
        return TimelineResource::collection(TimelineItem::orderBy('date', 'asc')->get());
    }

    /**
     * Store a new timeline item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData,[
            'title' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $title = $request->input('title');
        $description = $request->input('description');
        $date = $request->input('date');
        
        $timeline_item = new TimelineItem();
        $timeline_item->title = $title;
        $timeline_item->description = $description;
        $timeline_item->date = $date;
        $timeline_item->save();

        return response()->json($timeline_item);
    }

    public function update($id, Request $request)
    {
        $timeline_item = TimelineItem::find($id);

        $payload = $request->only(['title', 'description', 'date']);

        if($payload['title'] != '') {
            $timeline_item->title = $payload['title'];
        }

        if($payload['description'] != '') {
            $timeline_item->description = $payload['description'];
        }

        if(isset($payload['date'])) {
            $timeline_item->date = $payload['date'];
        }
        
        $timeline_item->save();

        return response()->json($timeline_item->toArray());
    }

    public function delete($id)
    {
        $timeline_item = TimelineItem::find($id);

        $timeline_item->delete();

        return response()->json(['message' => 'La catégorie à bien été supprimée']);

    }
}
