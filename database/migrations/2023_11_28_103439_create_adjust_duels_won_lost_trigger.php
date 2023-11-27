<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAdjustDuelsWonLostTrigger extends Migration
{
  /**
   * Run the migrations.
   */
    public function up(): void
    {
            DB::unprepared('
                CREATE TRIGGER increment_winner_duels_won
                AFTER INSERT ON duels
                FOR EACH ROW
                BEGIN
                    UPDATE users SET duels_won = duels_won + 1 WHERE id = NEW.winner_id;
                    UPDATE users SET duels_lost = duels_lost + 1 WHERE id = NEW.loser_id;
                END;
            ');

            DB::unprepared('
                CREATE TRIGGER decrement_winner_loser_duels_won_lost
                AFTER DELETE ON duels
                FOR EACH ROW
                BEGIN
                    UPDATE users SET duels_won = duels_won - 1 WHERE id = OLD.winner_id;
                    UPDATE users SET duels_lost = duels_lost - 1 WHERE id = OLD.loser_id;
                END;
            ');

            DB::unprepared('
                CREATE TRIGGER adjust_duels_won_lost
                AFTER UPDATE ON duels
                FOR EACH ROW
                BEGIN
                    UPDATE users SET duels_won = duels_won - 1 WHERE id = OLD.winner_id;
                    UPDATE users SET duels_lost = duels_lost - 1 WHERE id = OLD.loser_id;
                    UPDATE users SET duels_won = duels_won + 1 WHERE id = NEW.winner_id;
                    UPDATE users SET duels_lost = duels_lost + 1 WHERE id = NEW.loser_id;
                END;
            ');

            DB::unprepared('
            CREATE TRIGGER update_wizardry
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                SET NEW.wizardry = GREATEST(0, LEAST(100, CAST(NEW.duels_won AS SIGNED) - CAST(NEW.duels_lost AS SIGNED)));
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS increment_winner_duels_won');
        DB::unprepared('DROP TRIGGER IF EXISTS decrement_winner_loser_duels_won_lost');
        DB::unprepared('DROP TRIGGER IF EXISTS adjust_duels_won_lost');
    }
    
}