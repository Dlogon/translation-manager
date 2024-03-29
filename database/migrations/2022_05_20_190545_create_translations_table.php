<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $routePrefixName = config("translation-manager.db_prefix", "translations");
        Schema::create($routePrefixName.'_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("languaje_id");
            $table->bigInteger("group_id")->nullable();
            $table->string("key");
            $table->string("value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
};
