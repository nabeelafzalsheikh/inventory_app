<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public static function fetchAll()
    {
        return self::all();
    }

    public static function fetchById($id)
    {
        return self::find($id);
    }

    public static function insertRecord($data)
    {
        try {
            return (bool) self::create($data);
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function updateRecord($id, $data)
    {
        $record = self::find($id);
        if ($record) {
            try {
                return (bool) $record->update($data);
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }

    public static function deleteRecord($id)
    {
        $record = self::find($id);
        if ($record) {
            try {
                return (bool) $record->delete();
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }
}