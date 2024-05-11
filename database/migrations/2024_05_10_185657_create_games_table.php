<?php

use App\Models\Team;
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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'home_team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignIdFor(Team::class, 'away_team_id')->constrained('teams')->onDelete('cascade');
            $table->unsignedSmallInteger('home_team_score')->nullable();
            $table->unsignedSmallInteger('away_team_score')->nullable();
            $table->unsignedSmallInteger('week');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
