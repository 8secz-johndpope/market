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
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>50,
                'query' => [
                    'bool' => [
                        'must_not'=>['term'=>['meta.price'=>-1]],
                        "filter" => [
                            "script" => ["script" => "doc['images'].values.length > 0"]
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        //$products=array_rand($products,50);
        return View('user.profile',['catagories'=>$this->categories,'products'=>$products]);
    }
    public function search($any){
        $id = $this->categories[$any]['id'];
        $min = $id;
        if($id%100000000===0){
            $max = $min + 99999999;
        }
        else if($id%1000000===0){
            $max = $min + 999999;
        }
        else if($id%10000===0){
            $max = $min + 9999;
        }
        else if($id%100===0){
            $max = $min + 99;
        }
        else {
            $max = $min;
        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>50,
                'query' => [
                    'range' => [
                      'category' => [
                          'gte'=>$min,
                          'lte'=>$max
                      ]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $breads = array();
        $start=$any;
        while (isset($this->parents[$start])){
            $start=$this->parents[$start];
            array_unshift($breads,$start);
        }
        return View('market.listing',['catagories'=>$this->categories,'products'=>$products,'breads'=>$breads,'last'=>$any,'children'=>$this->children,'parents'=>$this->parents,'base'=>$this->base]);
    }

}
