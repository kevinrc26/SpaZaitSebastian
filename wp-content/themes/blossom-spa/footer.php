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
    
    <!-- ============================================================ -->
    <!-- 🚀 BANNER CI/CD - DEMOSTRACIÓN PARA TESIS                     -->
    <!-- ============================================================ -->
    
    <style>
        .banner-cicd-footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 999999;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.4);
            font-family: 'Arial', sans-serif;
            border-top: 4px solid #f1c40f;
        }
        .banner-cicd-footer .fecha {
            background: rgba(255,255,255,0.2);
            padding: 5px 20px;
            border-radius: 30px;
            font-size: 14px;
            margin-top: 8px;
            display: inline-block;
        }
        .banner-cicd-footer .estado {
            background: #2ecc71;
            color: white;
            padding: 3px 15px;
            border-radius: 20px;
            font-size: 12px;
            margin-left: 10px;
            text-transform: uppercase;
        }
    </style>
    
    <div class="banner-cicd-footer">
        <div>
            🚀 CI/CD ACTIVO - DESPLIEGUE AUTOMÁTICO
            <span class="estado">✅ ÉXITO</span>
        </div>
        <div class="fecha">
            📅 Último despliegue: <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>
    
    <!-- ============================================================ -->
    <!-- FIN DEL BANNER CI/CD                                          -->
    <!-- ============================================================ -->
    
</body>
</html>