<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name'
    ];
    protected $appends = ['color'];
    public function getColorAttribute(){
        $x = "";
        if($this->id == "1"){
            $x = "primary";
        } else if($this->id == "2"){
            $x = "warning";
        } else if($this->id == "3"){
            $x = "danger";
        }
        return $x;
  }
}
