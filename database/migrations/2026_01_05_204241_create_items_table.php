<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('propertyno')->nullable();
            $table->string('item')->nullable();
            $table->string('unit')->nullable();
            $table->text('descrip')->nullable();

            $table->unsignedInteger('classid')->nullable();
            $table->unsignedInteger('yrlife')->nullable();

            $table->integer('reorderpt')->nullable();
            $table->integer('reorderqty')->nullable();

            $table->date('edate')->nullable();

            $table->unsignedInteger('itemtypeid')->nullable();
            $table->string('status')->nullable();

            $table->integer('criticalqty')->nullable();
            $table->boolean('allow')->default(false);

            $table->string('propertycard')->nullable();

            // optional but recommended
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
