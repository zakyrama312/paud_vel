<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->integer('nominalpaud');
            $table->string('haripaud');
            $table->integer('totalpaud');
            $table->integer('nominalpaudsakit')->nullable();
            $table->string('haripaudsakit')->nullable();
            $table->integer('totalpaudsakit')->nullable();
            $table->integer('nominalpaudizin')->nullable();
            $table->string('haripaudizin')->nullable();
            $table->integer('totalpaudizin')->nullable();
            $table->integer('nominaltpq')->nullable();
            $table->string('haritpq')->nullable();
            $table->integer('totaltpq');
            $table->integer('nominaltpqsakit')->nullable();
            $table->string('haritpqsakit')->nullable();
            $table->integer('totaltpqsakit')->nullable();
            $table->integer('nominaltpqizin')->nullable();
            $table->string('haritpqizin')->nullable();
            $table->integer('totaltpqizin')->nullable();
            $table->integer('intensif')->nullable();
            $table->integer('hibah')->nullable();
            $table->integer('totalgaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
