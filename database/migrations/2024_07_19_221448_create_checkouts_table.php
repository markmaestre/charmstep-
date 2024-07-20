<?

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id('checkout_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // Reference to the cart
            $table->string('address');
            $table->string('phone_number');
            $table->string('payment_method');
            $table->decimal('total_amount', 8, 2); // Total amount for the checkout
            $table->string('status')->default('processing'); // Status of the checkout
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
