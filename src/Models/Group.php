<?php

namespace Dlogon\TranslationManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    const DEFAULT_TYPE = "default";
    const MODEL_TYPE = "model";

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
