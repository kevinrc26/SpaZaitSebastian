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
     * Footer ORIGINAL COMENTADO para reemplazarlo
     */
    // do_action( 'blossom_spa_footer' ); // ❌ COMENTADO para ocultar el footer original
    
    /**
     * After Footer
     * 
     * @hooked blossom_spa_page_end    - 20
    */
    do_action( 'blossom_spa_after_footer' );

    wp_footer(); ?>
    
    <!-- ========================================================= -->
    <!-- 🚀 NUEVO FOOTER - REEMPLAZA AL ORIGINAL                   -->
    <!-- ========================================================= -->
    
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div style="background: #1a1a2e; color: #f1c40f; padding: 30px 20px; text-align: center;">
            
            <div style="font-size: 22px; font-weight: bold; margin-bottom: 10px; color: #ffffff;">
                🔥 ZAIT SEBASTIÁN SPA - MODIFICADO CON CI/CD
            </div>
            
            <div style="font-size: 15px; color: #ecf0f1; margin-bottom: 15px;">
                Este footer fue modificado automáticamente mediante CI/CD
            </div>
            
            <div style="font-size: 14px; color: #888888; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
                📅 Última modificación: <?php echo date('Y-m-d H:i:s'); ?>
            </div>
            
            <div style="font-size: 12px; color: #666666; margin-top: 10px;">
                © Copyright <?php echo date('Y'); ?>. Todos los derechos reservados.
            </div>
            
        </div>
    </footer>
    
    <!-- ========================================================= -->
    <!-- FIN DEL NUEVO FOOTER                                      -->
    <!-- ========================================================= -->
    
</body>
</html>