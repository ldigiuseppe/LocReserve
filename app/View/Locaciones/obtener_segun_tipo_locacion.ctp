<?php foreach ($locaciones[0] as $key => $value): ?>
    <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
<?php endforeach; ?>