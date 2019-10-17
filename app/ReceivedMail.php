<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedMail extends Model
{
    protected $guarded = [];

    public function keywords()
    {
    	$newlines = "/\r\n|\n|\r/";

    	return collect(preg_split($newlines, $this->content));
    } 

    public function getKeywordsAttribute()
    {
    	return $this->keywords();
    }
}
