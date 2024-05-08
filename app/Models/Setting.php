<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public function getImage()
    {
        if (!empty($this->profile_pic) && file_exists('public/images/school_images' . $this->profile_pic)) {
            return url('public/images/school_images' . $this->profile_pic);
        } else {
            return url('public/images/avatar.png');
        }
    }
}
