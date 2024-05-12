<?php

use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function(Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'home_team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignIdFor(Team::class, 'away_team_id')->constrained('teams')->onDelete('cascade');
            $table->unsignedSmallInteger('home_team_score')->nullable();
            $table->unsignedSmallInteger('away_team_score')->nullable();
            $table->unsignedSmallInteger('week');

            $table->boolean('is_draws')->virtualAs("home_team_score = away_team_score")->nullable();
            $table->unsignedBigInteger('winner_id')
                ->virtualAs("CASE WHEN home_team_score > away_team_score THEN home_team_id WHEN home_team_score < away_team_score THEN away_team_id ELSE null END")
                ->virtualAs($this->createVirtualColumnQuery('home_team_id', 'away_team_id'))
                ->nullable();
            $table->unsignedBigInteger('loser_id')
                ->virtualAs("CASE WHEN home_team_score > away_team_score THEN away_team_id WHEN home_team_score < away_team_score THEN home_team_id ELSE null END")
                ->virtualAs($this->createVirtualColumnQuery('away_team_id', 'home_team_id'))
                ->nullable();
            $table->smallInteger('winner_score')
                ->virtualAs($this->createVirtualColumnQuery('home_team_score', 'away_team_score'))
                ->nullable();
            $table->smallInteger('loser_score')
                ->virtualAs($this->createVirtualColumnQuery('away_team_score', 'home_team_score'))
                ->nullable();

            $table->boolean('played')->default(false);
            $table->timestamps();
        });
    }

    public function createVirtualColumnQuery($col1, $col2): string
    {
        return "CASE WHEN home_team_score > away_team_score THEN $col1 WHEN home_team_score < away_team_score THEN $col2 ELSE null END";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
