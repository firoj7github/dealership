<!-- resources/views/payment-form.blade.php -->
<form action="{{ route('payment.process') }}" method="post">
    @csrf
    <label for="card_number">Card Number:</label>
    <input type="text" id="card_number" name="card_number"><br><br>

    <label for="expiry_date">Expiry Date:</label>
    <input type="text" id="expiry_date" name="expiry_date" placeholder="MMYY"><br><br>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv"><br><br>

    <button type="submit">Pay Now</button>
</form>
