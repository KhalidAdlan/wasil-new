<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Line extends Model
{
    use SoftDeletes;

    public $table = 'lines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'number',
        'driver_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public static function availableLines()
    {
        return Line::all()->where('status', 0);
    }

    public static function updateAvailability($id)
    {
        $shippedOrdersCount = Order::all()->where('status','تم الشحن')->where('line_id',$id)->count();

        if($shippedOrdersCount > 0)
        {
           $line = Line::find($id);
           $line->status = 1;
           $line->save();
        }
        else
        {
            $line = Line::find($id);
            $line->status = 0;
            $line->save();
        }
    }

    public function status()
    {
        if(!isset($this->status))
        {
          return 'فارغ';
        }

        switch ($this->status) {
             case 0:
                return 'فارغ';
             case 1:
                return 'مشحون';
        }
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
