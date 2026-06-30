<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Spa
 */
    
    /**
     * After Content
     * 
     * @hooked blossom_spa_content_end - 20
    */
    do_action( 'blossom_spa_before_footer' );
    
    /**
     * Before footer
     * 
     * @hooked blossom_spa_instagram - 10
    */
    do_action( 'blossom_spa_before_footer_start' );

    /**
     * Footer
     * 
     * @hooked blossom_spa_footer_start  - 20
     * @hooked blossom_spa_footer_top    - 30
     * @hooked blossom_spa_footer_bottom - 40
     * @hooked blossom_spa_footer_end    - 50
    */
    do_action( 'blossom_spa_footer' );
    
    /**
     * After Footer
     * 
     * @hooked blossom_spa_page_end    - 20
    */
    do_action( 'blossom_spa_after_footer' );

    wp_footer(); ?>
    
    <!-- ========================================================= -->
    <!-- 🚀 MODIFICACIÓN DEL FOOTER CON CI/CD                      -->
    <!-- ========================================================= -->
    
    <style>
        /* Cambiar el texto del footer original */
        .site-info {
            background: #2c3e50 !important;
            color: #f1c40f !important;
            padding: 20px !important;
            font-size: 18px !important;
            text-align: center !important;
        }
        
        .site-info a {
            color: #2ecc71 !important;
            font-weight: bold !important;
        }
        
        .site-info .copyright {
            color: #ecf0f1 !important;
        }
        
        /* Ocultar el texto original y mostrar el nuevo */
        .site-info .copyright {
            display: none !important;
        }
    </style>
    
    <div class="site-info" style="background: #1a1a2e; color: #f1c40f; padding: 25px; text-align: center; border-top: 4px solid #e74c3c;">
        <div style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">
            🔥 ZAIT SEBASTIÁN SPA - MODIFICADO CON CI/CD
        </div>
        <div style="font-size: 14px; color: #ecf0f1; margin-bottom: 10px;">
            Este footer fue modificado automáticamente mediante CI/CD
        </div>
        <div style="font-size: 13px; color: #888888; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
            📅 Última modificación: <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>
    
    <!-- ========================================================= -->
    <!-- FIN DE LA MODIFICACIÓN                                    -->
    <!-- ========================================================= -->
    
</body>
</html>