<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixStatusPembayaran extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pertama, ubah panjang kolom
        Schema::table('pemakaians', function (Blueprint $table) {
            $table->string('status_pembayaran', 20)->change();
        });

        // Kemudian update data
        DB::statement("UPDATE pemakaians SET status_pembayaran = 'belum_lunas' WHERE status_pembayaran = 'belum_bayar'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan data
        DB::statement("UPDATE pemakaians SET status_pembayaran = 'belum_bayar' WHERE status_pembayaran = 'belum_lunas'");
    }
}
