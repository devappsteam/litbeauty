<?php

namespace DevApps;

// Verifica se o arquivo foi acessado diretamente
if (!defined('ABSPATH')) {
    exit;
}

// Verifica se a classe não existe
if (!class_exists('LitBeauty')) {
    final class LitBeauty
    {
        private $version;

        public function __construct($version = '1.0.0')
        {
            $this->version = $version;

            // Adiciona os suportes ao tema
            add_action('after_setup_theme', array($this, 'setup'));

            // Carrega os scripts do tema
            add_action('wp_enqueue_scripts', array($this, 'scripts'), 99); // Aplica depois que o WooCommerce já carregou
        }


        /**
         * Define os padrões do tema e registra suporte para vários recursos do WordPress.
         *
         * @return void
         */
        public function setup()
        {
            /**
             * Carrega os arquivos de tradução do tema
             */
            load_theme_textdomain('litbeauty', get_template_directory() . '/languages');

            /**
             * Habilite o suporte para postar miniaturas em postagens e páginas.
             *
             * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
             */
            add_theme_support('post-thumbnails');

            /**
             * Habilita suporte a logo
             */
            add_theme_support(
                'custom-logo',
                apply_filters(
                    'litbeauty_custom_logo_args',
                    array(
                        'height' => 512,
                        'width'  => 512,
                        'flex-width'  => true,
                        'flex-height' => true,
                    )
                )
            );

            register_nav_menus([
                'main_menu' => 'Menu Principal',
                'mobile_menu' => 'Menu Mobile',
            ]);

            /**
             * Alterne a marcação de núcleo padrão para formulário de pesquisa, formulário de comentário, comentários, galerias, legendas e widgets para gerar HTML5 válido.
             */
            add_theme_support(
                'html5',
                apply_filters(
                    'litbeauty_html5_args',
                    array(
                        'search-form',
                        'comment-form',
                        'comment-list',
                        'gallery',
                        'caption',
                        'widgets',
                        'style',
                        'script',
                    )
                )
            );

            /**
             * Habilita suporte para o recurso título.
             */
            add_theme_support('title-tag');

            /**
             * Habilita suporte para atualização seletiva de widgets.
             */
            add_theme_support('customize-selective-refresh-widgets');

            /**
             * Habilita suporte para CSS de bloco.
             */
            add_theme_support('wp-block-styles');

            /**
             * Habilita suporte para alinhamento total e amplo.
             */
            add_theme_support('align-wide');

            /**
             * Habilita suporte para conteúdo incorporado responsivo.
             */
            add_theme_support('responsive-embeds');

            /**
             * Habilita suporte com o WooCommerce
             */
            add_theme_support('woocommerce');

            /**
             * Habilita suporte para widgets.
             */
            add_theme_support('widgets');

            /**
             * Habilita o suporte para criar post types
             */
            add_theme_support('create_post_types');

            /**
             * Crop Image
             */
            add_image_size('showcase', 300, 540, ['center', 'top']);
            update_option('medium_crop', 1);
        }

        /**
         * Efetua o registro e carregamento dos scripts
         *
         * @return void
         */
        public function scripts()
        {
            /**
             * Reset CSS
             */
            wp_enqueue_style('litbeauty-reset',get_template_directory_uri() . "/assets/css/normalize.css" , array(), '8.0.1');

            /**
             * Fonts
             */
            wp_enqueue_style('litbeauty-nexa', get_template_directory_uri() . '/assets/fonts/nexa/nexa.css', array('litbeauty-reset'), $this->version);


            /**
             * Bootstrap
             */
            //wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', array('litbeaty-nexa'), '4.6.2');

            /**
             * Styles
             */
            wp_enqueue_style('litbeauty-style', get_template_directory_uri() . '/assets/css/app.css', array('litbeauty-nexa'), time());

            /**
             * Bootstrap
             */
            //wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '4.6.2', true);

            /**
             * Scripts
             */
            wp_enqueue_script('litbeauty-script', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), $this->version, true);

            /**
             * AJAX
             */
            wp_localize_script('litbeauty-ajax', 'LitBeauty', array(
                'ajax_url' => admin_url('admin-ajax.php')
            ));
        }

        public function logo()
        {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

            if (has_custom_logo()) {
                echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="da-logo" loading="lazy">';
            } else {
                echo '<img src="' . get_template_directory_uri() . "/assets/images/logo.svg" . '" alt="' . get_bloginfo('name') . '" class="da-logo" loading="lazy">';
            }
        }
    }
}
