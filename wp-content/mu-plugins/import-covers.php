<?php
/**
 * Script de importación de portadas de libros
 * Se ejecuta UNA VEZ al visitar wp-admin, luego se auto-desactiva.
 *
 * Mapea cada imagen al producto correspondiente por título parcial,
 * registra la imagen en la Media Library y la asigna como Featured Image.
 */

if (!defined('ABSPATH'))
    exit;

add_action('admin_init', function () {
    // Flag de ejecución única
    if (get_option('libros_covers_imported') === '1')
        return;

    // Directorio con las portadas
    $covers_dir = WP_CONTENT_DIR . '/uploads/book-covers/';
    if (!is_dir($covers_dir))
        return;

    // Mapeo: fragmento de nombre de archivo => fragmento del título del producto
    $map = array(
        'adiestramiento_canino' => 'Adiestramiento Canino',
        'adolescentes_manual' => 'Adolescentes: Manual',
        'anti_aging' => 'Anti-Aging',
        'aromaterapia_aceites' => 'Aromaterapia y Aceites',
        'automatizacion_web_ia' => 'Automatización Web',
        'ayuno_intermitente' => 'Ayuno Intermitente',
        'cabello_radiante' => 'Cabello Radiante',
        'cachorros_primeros_meses' => 'Cachorros: Los Primeros',
        'carpinteria_basica' => 'Carpintería Básica',
        'chakras_sanacion' => 'Chakras: Guía Completa',
        'cocina_latinoamericana' => 'Cocina Latinoamericana',
        'cocina_saludable' => 'Cocina Saludable en 30',
        'criptomonedas_inversor' => 'Criptomonedas: De Cero',
        'desactiva_ansiedad' => 'Desactiva Tu Ansiedad',
        'protocolo_exito' => 'El Protocolo del Éxito',
        'mentalidad_elite' => 'Mentalidad de Élite',
        'fotografia_celular' => 'Fotografía con Celular',
        'trading_estrategias' => 'Trading: Estrategias',
    );

    // Necesario para wp_insert_attachment & media handling
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $imported = 0;
    $errors = array();

    foreach ($map as $file_prefix => $title_fragment) {
        // Buscar el archivo que empieza con este prefix
        $files = glob($covers_dir . $file_prefix . '*.png');
        if (empty($files)) {
            $errors[] = "No file found for: $file_prefix";
            continue;
        }

        $image_path = $files[0];

        // Buscar el producto WooCommerce por título
        $products = get_posts(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'numberposts' => 1,
            's' => $title_fragment,
        ));

        if (empty($products)) {
            $errors[] = "No product found for: $title_fragment";
            continue;
        }

        $product_id = $products[0]->ID;

        // Verificar si ya tiene featured image
        // (no sobreescribir si ya tiene una)
        // Comentado: queremos sobreescribir las genéricas
        // if (has_post_thumbnail($product_id)) continue;

        // Copiar imagen al uploads dir estándar de WP
        $upload_dir = wp_upload_dir();
        $filename = sanitize_file_name(basename($image_path));
        $dest_path = $upload_dir['path'] . '/' . $filename;

        if (!copy($image_path, $dest_path)) {
            $errors[] = "Failed to copy: $filename";
            continue;
        }

        // Determinar el tipo MIME
        $filetype = wp_check_filetype($filename, null);

        // Crear el attachment en la media library
        $attachment = array(
            'guid' => $upload_dir['url'] . '/' . $filename,
            'post_mime_type' => $filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
            'post_content' => '',
            'post_status' => 'inherit',
        );

        $attach_id = wp_insert_attachment($attachment, $dest_path, $product_id);

        if (is_wp_error($attach_id)) {
            $errors[] = "Failed to create attachment for: $filename";
            continue;
        }

        // Generar thumbnails
        $attach_data = wp_generate_attachment_metadata($attach_id, $dest_path);
        wp_update_attachment_metadata($attach_id, $attach_data);

        // Asignar como Featured Image del producto
        set_post_thumbnail($product_id, $attach_id);

        $imported++;
    }

    // Marcar como completado
    update_option('libros_covers_imported', '1');

    // Log del resultado
    $log = "Book covers imported: $imported / " . count($map);
    if (!empty($errors)) {
        $log .= "\nErrors: " . implode(', ', $errors);
    }
    update_option('libros_covers_import_log', $log);

    // Mostrar notificación en admin
    add_action('admin_notices', function () use ($imported, $errors) {
        $class = empty($errors) ? 'notice-success' : 'notice-warning';
        echo "<div class='notice $class is-dismissible'>";
        echo "<p><strong>📚 Portadas importadas:</strong> $imported libros actualizados.</p>";
        if (!empty($errors)) {
            echo "<p><small>Errores: " . esc_html(implode(', ', $errors)) . "</small></p>";
        }
        echo "</div>";
    });
});
