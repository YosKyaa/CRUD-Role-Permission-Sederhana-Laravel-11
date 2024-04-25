<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
        } else if($this->id == "4"){
            $x = "info";
        } else if($this->id == "5"){
            $x = "success";
        } else if($this->id == "6"){
            $x = "secondary";
        } else if($this->id == "7"){
            $x = "dark";
        } else if($this->id == "8"){
            $x = "primary";
        // }else if($this->id == "9"){
        //     $x = "info";
        // }else if($this->id == "10"){
        //     $x = "success";
        }
        return $x;
    }
}
