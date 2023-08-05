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
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('author_name_en');
            $table->string('author_name_ar');
            $table->text('description_ar');
            $table->text('description_en');
//            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->cascadeOnDelete();
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
