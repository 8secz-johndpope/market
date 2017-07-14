<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:28
 */

namespace App\Http\Controllers;


use Illuminate\View\View;

class MarketController extends BaseController
{
    public function show($id)
    {
        $params = [
            'index' => 'categories',
            'type' => 'category',
            'body' => [
                'size'=>2000,
                'query' => [
                    'match_all' => (object)[]
                ]
            ]
        ];


// Get doc at /my_index/my_type/my_id
        $response = $this->client->search($params);
        $cats = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $catmap = array();
        foreach ($cats as $cat){
            $catmap[$cat['slug']]=$cat;
        }

        $params = [
            'index' => 'relations',
            'type' => 'relation',
            'body' => [
                'size'=>2000,
                'query' => [
                    'match_all' => (object)[]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $rel = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);

        $parents = array();
        $children = array();
        foreach ($rel as $relation){
            $parent=key($relation);
            $child=$relation[$parent];

            $parents[$child]=$parent;
            if(!isset($children[$parent]))
                $children[$parent]=array();
            array_push($children[$parent],$child);

        }
        $base=array();
        foreach ($cats as $cat){
            $slug=$cat['slug'];
            if(!isset($parents[$slug])) {
                array_push($base, $slug);
            }
        }

        return View('user.profile',['catagories'=>$catmap,'main'=>$base]);
    }

}