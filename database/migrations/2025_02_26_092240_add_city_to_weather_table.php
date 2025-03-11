<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('weather', function (Blueprint $table) {
            $table->string('city')->after('id'); // `city` カラムを追加
            $table->date('date')->after('city'); // `date` カラムを追加
            $table->json('data')->nullable()->after('date'); // `data` カラムを追加
        });
    }

    public function down(): void
    {
        Schema::table('weather', function (Blueprint $table) {
            if (Schema::hasColumn('weather', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('weather', 'date')) {
                $table->dropColumn('date');
            }
            if (Schema::hasColumn('weather', 'data')) {
                $table->dropColumn('data');
            }
        });
    }
};
