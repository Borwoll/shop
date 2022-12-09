<div class="form-group">
    <form action="{{ route('orders.cancel', $order) }}" method="POST" style="display: none" id="cancel-form">
        @csrf

        <div class="form-group">
            <p><label for="reason">Причина отмены:</label></p>
            <textarea name="reason" id="reason" cols="70" rows="5">{{ old('Причина') }}</textarea>
        </div>

        <button class="btn btn-danger">Отменить</button>
    </form>
</div>