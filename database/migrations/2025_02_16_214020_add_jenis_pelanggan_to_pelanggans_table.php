<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->enum('jenis_pelanggan', ['rumah_tangga', 'bisnis', 'industri'])->after('telepon');
        });
    }

    public function down()
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->dropColumn('jenis_pelanggan');
        });
    }
}; 