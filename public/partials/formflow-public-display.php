<?php
/**
 * Render the form on the frontend
 */

$nodes = $form_data['nodes'];
$edges = $form_data['edges'];

// Separate submit buttons and input nodes; exclude non-visual nodes (validation, logic, spam etc.)
$registered_nodes = FormFlow_Node_Registry::get_instance()->get_frontend_nodes();
$submit_nodes = array_filter($nodes, function($n) { return $n['type'] === 'submitButton'; });
$input_nodes  = array_filter($nodes, function($n) use ($registered_nodes) {
    if ( $n['type'] === 'submit' || $n['type'] === 'submitButton' ) return false;
    // Exclude if the node definition marks it as non-visual
    if ( isset( $registered_nodes[ $n['type'] ] ) && isset( $registered_nodes[ $n['type'] ]['is_visual'] ) ) {
        return (bool) $registered_nodes[ $n['type'] ]['is_visual'];
    }
    return true; // default: visual
});

// Filter out disconnected nodes
$connected_ids = array();
foreach ( $edges as $edge ) {
    $connected_ids[] = $edge['from'];
    $connected_ids[] = $edge['to'];
}
$connected_ids = array_unique($connected_ids);
$input_nodes = array_filter($input_nodes, function($n) use ($connected_ids) {
    return in_array($n['id'], $connected_ids);
});

// Topological Sort (Kahn's Algorithm)
$in_degree = array();
$adj_list = array();
$valid_ids = array_map(function($n) { return $n['id']; }, $input_nodes);

foreach ( $input_nodes as $n ) {
    $in_degree[$n['id']] = 0;
    $adj_list[$n['id']] = array();
}

foreach ( $edges as $edge ) {
    if ( in_array($edge['from'], $valid_ids) && in_array($edge['to'], $valid_ids) ) {
        $adj_list[$edge['from']][] = $edge['to'];
        $in_degree[$edge['to']]++;
    }
}

$queue = array_filter($input_nodes, function($n) use ($in_degree) { return $in_degree[$n['id']] === 0; });
$sorted_inputs = array();

while ( ! empty($queue) ) {
    usort($queue, function($a, $b) { return $a['y'] - $b['y']; });
    $current = array_shift($queue);
    $sorted_inputs[] = $current;

    foreach ( $adj_list[$current['id']] as $neighbor_id ) {
        $in_degree[$neighbor_id]--;
        if ( $in_degree[$neighbor_id] === 0 ) {
            $queue[] = array_values(array_filter($input_nodes, function($n) use ($neighbor_id) { return $n['id'] === $neighbor_id; }))[0];
        }
    }
}

if ( count($sorted_inputs) < count($input_nodes) ) {
    $remaining = array_filter($input_nodes, function($n) use ($sorted_inputs) {
        return ! in_array($n, $sorted_inputs);
    });
    usort($remaining, function($a, $b) { return $a['y'] - $b['y']; });
    $sorted_inputs = array_merge($sorted_inputs, $remaining);
}

$inputs = array_merge($sorted_inputs, $submit_nodes);
$nonce = wp_create_nonce( 'formflow_submit_nonce_' . $form_id );
?>

<div class="formflow-form-container" id="formflow-<?php echo esc_attr( $form_id ); ?>">
    <form class="formflow-form formflow-preview-form" action="#" method="POST">
        <input type="hidden" name="action" value="formflow_submit" />
        <input type="hidden" name="form_id" value="<?php echo esc_attr( $form_id ); ?>" />
        <input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>" />

        <!-- Spam Engine Fields (Honeypot) -->
        <?php FormFlow_Spam_Engine::render_honeypot_field(); ?>

        <?php foreach ( $inputs as $index => $node ) : 
            $htmlType = 'text';
            if ($node['type'] === 'emailField') $htmlType = 'email';
            if ($node['type'] === 'numberField') $htmlType = 'number';
            if ($node['type'] === 'passwordField') $htmlType = 'password';
            if ($node['type'] === 'telField') $htmlType = 'tel';
            if ($node['type'] === 'dateField') $htmlType = 'date';
            if ($node['type'] === 'timeField') $htmlType = 'time';
            if ($node['type'] === 'colorPicker') $htmlType = 'color';
            if ($node['type'] === 'fileUpload') $htmlType = 'file';

            $fv = isset($node['fieldValues']) ? $node['fieldValues'] : array();
            $label = isset($fv['label']) ? $fv['label'] : (isset($node['label']) ? $node['label'] : (isset($node['name']) ? $node['name'] : 'Field'));
            $showLabel = isset($fv['showLabel']) ? filter_var($fv['showLabel'], FILTER_VALIDATE_BOOLEAN) : true;
            if ($node['type'] === 'submitButton') $showLabel = false;
            $placeholder = isset($fv['placeholder']) && trim($fv['placeholder']) !== '' ? $fv['placeholder'] : 'Enter ' . strtolower($label) . '...';
            $requiredHtml = !empty($fv['required']) ? ' <span style="color:red;">*</span>' : '';
            $requiredAttr = !empty($fv['required']) ? 'required' : '';
            $delay = $index * 100;
        ?>
            <div class="formflow-preview-field" style="animation-delay: <?php echo esc_attr($delay); ?>ms">
                <?php if ($showLabel) : ?>
                    <label class="formflow-field-label"><?php echo esc_html($label) . $requiredHtml; ?></label>
                <?php endif; ?>

                <?php if ($node['type'] === 'textareaField' || $node['type'] === 'textarea') : ?>
                    <?php $rows = isset($fv['rows']) ? intval($fv['rows']) : 4; ?>
                    <textarea name="<?php echo esc_attr($node['id']); ?>" placeholder="<?php echo esc_attr($placeholder); ?>" rows="<?php echo esc_attr($rows); ?>" class="formflow-input" <?php echo $requiredAttr; ?>></textarea>
                
                <?php elseif ($node['type'] === 'selectField') : ?>
                    <?php 
                        $optionsText = isset($fv['options']) ? $fv['options'] : 'Option 1, Option 2, Option 3';
                        $options = array_filter(array_map('trim', explode(',', $optionsText)));
                    ?>
                    <select name="<?php echo esc_attr($node['id']); ?>" class="formflow-input" <?php echo $requiredAttr; ?>>
                        <option value=""><?php echo esc_html($placeholder); ?></option>
                        <?php foreach($options as $opt) : ?>
                            <option value="<?php echo esc_attr($opt); ?>"><?php echo esc_html($opt); ?></option>
                        <?php endforeach; ?>
                    </select>

                <?php elseif ($node['type'] === 'checkboxField') : ?>
                    <?php $checkboxText = isset($fv['checkboxText']) ? $fv['checkboxText'] : 'Check me'; ?>
                    <div class="formflow-checkbox-wrapper">
                        <input type="checkbox" name="<?php echo esc_attr($node['id']); ?>" value="yes" class="formflow-checkbox" <?php echo $requiredAttr; ?> />
                        <span class="formflow-checkbox-text"><?php echo esc_html($checkboxText); ?></span>
                    </div>

                <?php elseif ($node['type'] === 'radioGroup') : ?>
                    <?php 
                        $optionsText = isset($fv['options']) ? $fv['options'] : 'Option 1, Option 2';
                        $options = array_filter(array_map('trim', explode(',', $optionsText)));
                    ?>
                    <div class="formflow-radio-group">
                        <?php foreach($options as $opt) : ?>
                            <label class="formflow-radio-label">
                                <input type="radio" name="<?php echo esc_attr($node['id']); ?>" value="<?php echo esc_attr($opt); ?>" class="formflow-radio" <?php echo $requiredAttr; ?> />
                                <span><?php echo esc_html($opt); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>

                <?php elseif ($node['type'] === 'rangeSlider') : ?>
                    <input type="range" name="<?php echo esc_attr($node['id']); ?>" class="formflow-range" <?php echo $requiredAttr; ?> />

                <?php elseif ($node['type'] === 'submitButton') : ?>
                    <?php 
                        $btnText = isset($fv['buttonText']) ? $fv['buttonText'] : 'Submit Form';
                        $btnColor = isset($fv['buttonColor']) ? $fv['buttonColor'] : '#2563eb';
                        $txtColor = isset($fv['textColor']) ? $fv['textColor'] : '#ffffff';
                    ?>
                    <button type="submit" class="formflow-submit-btn" style="background-color: <?php echo esc_attr($btnColor); ?>; color: <?php echo esc_attr($txtColor); ?>;"><?php echo esc_html($btnText); ?></button>

                <?php else : ?>
                    <input type="<?php echo esc_attr($htmlType); ?>" name="<?php echo esc_attr($node['id']); ?>" placeholder="<?php echo esc_attr($placeholder); ?>" class="formflow-input" <?php echo $requiredAttr; ?> />
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="formflow-response"></div>
    </form>
</div>

<style>
/* Synchronized with Live Preview Styles */
.formflow-preview-form { width:100%; max-width:28rem; margin:0 auto; background:#fff; border-radius:0.75rem; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); border:1px solid #f3f4f6; padding:2rem; box-sizing:border-box; display:flex; flex-direction:column; gap:1.5rem; }
.formflow-preview-field { opacity: 0; animation: fadeInPreview 0.5s ease-out forwards; }
.formflow-field-label { display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.5rem; }
.formflow-input { width:100%; box-sizing:border-box; padding:0.75rem 1rem; color:#374151; background:#f9fafb; border:1px solid #e5e7eb; border-radius:0.5rem; outline:none; transition:all 0.3s ease-in-out; font-family:inherit; }
.formflow-input:focus { border-color:#3b82f6; box-shadow:0 0 0 2px rgba(59,130,246,0.5); }
.formflow-checkbox-wrapper { display:flex; align-items:center; gap:0.75rem; }
.formflow-checkbox { width:1.25rem; height:1.25rem; border-radius:0.25rem; border:1px solid #d1d5db; }
.formflow-checkbox-text { color:#4b5563; }
.formflow-radio-group { display:flex; flex-direction:column; gap:0.5rem; }
.formflow-radio-label { display:flex; align-items:center; gap:0.75rem; color:#4b5563; }
.formflow-radio { width:1.25rem; height:1.25rem; border:1px solid #d1d5db; }
.formflow-range { width:100%; height:0.5rem; background:#e5e7eb; border-radius:0.5rem; }
.formflow-submit-btn { width:100%; display:flex; justify-content:center; padding:0.75rem 1rem; border:none; border-radius:0.5rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.1); font-size:0.875rem; font-weight:700; cursor:pointer; transition: opacity 0.2s; }
.formflow-submit-btn:hover { opacity: 0.9; }
.formflow-response { padding: 1rem; border-radius: 0.5rem; display: none; font-size: 0.875rem; font-weight: 500; }
.formflow-response.success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; display:block; }
.formflow-response.error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; display:block; }
@keyframes fadeInPreview { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>
