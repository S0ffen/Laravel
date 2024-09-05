<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToNotesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->string('title')->after('id'); // Dodaj kolumnę 'title' po kolumnie 'id'
            $table->string('room')->after('note'); // Dodaj kolumnę 'room' po kolumnie 'note'
            $table->date('date')->nullable()->after('room'); // Dodaj kolumnę 'date' po kolumnie 'room' z możliwością NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('room');
            $table->dropColumn('date');
        });
    }
}

