<?php

/**
 * Created by PhpStorm.
 * User: marco
 * Date: 6/02/17
 * Time: 14:07
 */
namespace app\model;

class Game extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'game';
    protected $primaryKey = "id";
    public $timestamps = false;

    const STATUS_CREATED = 0;
    const STATUS_PLAYING = 1;
    const STATUS_FINISHED = 2;


    public function places(){
        return $this->belongsToMany('app\model\Place', 'place_game', 'id_game', 'id_place');
    }

    public function level(){
        return $this->belongsTo('app\model\Level','id_level');
    }

    public function destination(){
        return $this->belongsTo('app\model\Destination','id_destination');
    }
}