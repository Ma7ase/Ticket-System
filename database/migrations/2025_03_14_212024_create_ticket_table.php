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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (id)
            $table->text('priority'); // Priority column (text)
            $table->text('title'); // Title column (text)
            $table->text('issue_type'); // Issue type column (text)
            $table->text('date'); // Date column (text)
            $table->text('issue_description'); // Issue description column (text)
            $table->text('documents'); // Documents column (text)
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
