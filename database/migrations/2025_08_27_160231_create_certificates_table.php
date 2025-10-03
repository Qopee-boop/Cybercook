<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('certificates', function (Blueprint $t) {
      $t->id();
      $t->foreignId('user_id')->constrained()->cascadeOnDelete();
      $t->foreignId('module_id')->constrained()->cascadeOnDelete();
      $t->foreignId('quiz_attempt_id')->constrained()->cascadeOnDelete();
      $t->string('serial')->unique();
      $t->timestamp('issued_at');
      $t->string('pdf_path');        // storage path: certificates/xxx.pdf
      $t->boolean('revoked')->default(false);
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('certificates'); }
};
