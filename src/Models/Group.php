<?php

namespace Dlogon\TranslationManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    const DEFAULT_TYPE = "default";
    const MODEL_TYPE = "model";

    protected $fillable = [
        "name",
        "type"
    ];

    public function getTable()
    {
        $routePrefixName = config("translation-manager.db_prefix", "translations");

        return $routePrefixName . "_groups";
    }

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
