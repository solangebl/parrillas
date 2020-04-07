<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(true);
            $table->text('description');
            $table->string('thumbnail');
            $table->integer('provider_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->integer('deposit_id')->unsigned();
            $table->decimal('buy_price', 10, 2)->unsigned();
            $table->decimal('sale_price', 10, 2)->unsigned();
            $table->decimal('sale_price_ml', 10, 2)->unsigned();
            $table->integer('amount')->unsigned();
            $table->text('other');
			$table->timestamps();
			
		});
		
		Schema::table('products', function($table) {
			$table->foreign('provider_id')
				->references('id')->on('providers')
                ->onDelete('cascade');
			$table->foreign('category_id')
				->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('subcategory_id')
				->references('id')->on('subcategories')
				->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
