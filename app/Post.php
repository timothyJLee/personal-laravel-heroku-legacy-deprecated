<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;
use App\Presenters\DatePresenter;

class Post extends Model
{

	  use Eloquence;
    use DatePresenter;

  
    // default fields to search
    protected $searchableColumns = ['title', 'body'];
	  protected $dates = ['deleted_at'];

    //
  	// fields can be filled
  	protected $fillable = ['title', 'body', 'user_id'];

  	public function user()
  	{
    	return $this->belongsTo('App\User');
  	}

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }
}
