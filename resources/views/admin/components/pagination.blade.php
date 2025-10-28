
<select id="pagination" name="pagination" class="form-control text-center">
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
