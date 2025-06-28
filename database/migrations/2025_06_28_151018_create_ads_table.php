<?php

use App\Models\Ad;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->enum('position', [Ad::HOME_TOP, Ad::HOME_MIDDLE, Ad::NEWS_PAGE, Ad::VIEW_PAGE, Ad::SIDE_BAR]);
            $table->string('url')->nullable();
            $table->string('image_path');
            $table->enum('status', [Ad::STATUS_ACTIVE, Ad::STATUS_DRAFT])->default(Ad::STATUS_DRAFT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
