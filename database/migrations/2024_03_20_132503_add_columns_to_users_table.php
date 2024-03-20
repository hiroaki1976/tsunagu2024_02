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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_admin')->after('id');
            $table->string('officename')->after('is_admin');
            $table->string('postcode')->nullable()->after('officename');
            $table->string('prefecture')->nullable()->after('postcode');
            $table->string('city')->nullable()->after('prefecture');
            $table->string('town')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('officename');
            $table->dropColumn('postcode');
            $table->dropColumn('prefecture');
            $table->dropColumn('city');
            $table->dropColumn('town');
        });
    }
};
