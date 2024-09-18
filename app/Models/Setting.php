<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable; 

class Setting extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['title', 'content', 'address'];
    protected $fillable = [
        'id', 'logo', 'favicon', 'facebook', 'instagram', 'phone', 'email', 'created_at', 'updated_at', 'deleted_at'
    ]; 


    public static function checkSetting() {

        $settings = Self::all();
       
        if (count($settings) < 1) {
            $data = [
                'id' => 1,
            ]; 

            foreach (config('app.languages') as $key => $lang) {
                $data[$key]['title'] = $lang;
            }

            Self::create($data);
        }

        
        return Self::first();
    }
}
