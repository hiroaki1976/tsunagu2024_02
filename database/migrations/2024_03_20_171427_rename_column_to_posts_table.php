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
        Schema::table('posts', function (Blueprint $table) {
            // 既存の 'name' カラムを削除
            $table->dropColumn('name');
            // 'officename' カラムを追加
            $table->string('officename')->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // 'officename' カラムを削除
            $table->dropColumn('officename');
            // 元の 'name' カラムを復元
            $table->string('name')->after('message');
        });
    }
};
