<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAutor extends Migration
{
    private $tableName = 'autors';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('autor', 255)->unique();
        });

        DB::table($this->tableName)->insert(
            [
                [
                    'id' => 1,
                    'autor' => 'Fred Brooks'
                ],
                [
                    'id' => 2,
                    'autor' => 'Paulo Coelho'
                ]

            ]
        
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
