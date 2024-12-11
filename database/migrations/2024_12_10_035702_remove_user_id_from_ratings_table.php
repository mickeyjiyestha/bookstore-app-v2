<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropColumn('user_id'); // Menghapus kolom user_id
        });
    }
    
    public function down()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->default(1); // Menambahkan kembali kolom user_id jika rollback
        });
    }
    
};