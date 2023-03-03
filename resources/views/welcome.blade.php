<form action="{{ route('store_dos') }}" method="post">
    @csrf
    <button type="submit" class="btn btn-primary">Place Order</button>
</form>