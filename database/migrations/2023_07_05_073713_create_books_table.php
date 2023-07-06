<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * اسم الكتاب: نص يحمل اسم الكتاب.
    اسم المؤلف: نص يحمل اسم المؤلف أو المؤلفين.
    category_id: حقل مفتاح أجنبي يربط جدول الكتب بجدول الفئات.
    تاريخ النشر: تاريخ نشر الكتاب.
    وصف الكتاب: نص يوضح محتوى الكتاب.
     *
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('author_name');
            $table->text('description');
            $table->foreignId('category_id')->constrained('categories');
            $table->date('publication_at');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
