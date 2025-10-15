<?php if (isset($trustees) && !empty($trustees)) { ?>
    <div class="form-group">
        <label>Trustee</label>
        <div class="input-group">
            <select name="trustee" class="form-control" onchange="" >
                <option value="">Choose Trustee</option>
                <?php foreach ($trustees as $trustee) { ?>
                    <option 
                        value="{{ Helper::validate_key_value('id', $trustee, 'radio') }}" 
                        <?php echo (isset($selected_item) && !empty($selected_item) && $selected_item == Helper::validate_key_value('id', $trustee, 'radio')) ? 'selected' : ''; ?>
                    >
                        (ID: {{Helper::validate_key_value('id', $trustee, 'radio')}})
                        {{ Helper::validate_key_value('trustee_name', $trustee) }}
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
<?php } ?>