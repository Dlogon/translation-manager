<?php

namespace Dlogon\TranslationManager\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $appends =
    [
        "languaje"
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
        "related_lang",
        "group"
    ];

    public function getTable()
    {
        $routePrefixName = config("translation-manager.db_prefix", "translations");

        return $routePrefixName . "_translations";
    }

    public function getLanguajeAttribute()
    {
        return $this->related_lang->name ?? null;
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function related_lang()
    {
        return $this->belongsTo(Languaje::class, "languaje_id");
    }
}
