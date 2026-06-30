<?php
/**
 * The template for displaying the footer
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
     * Footer ORIGINAL (COMENTADO PARA REEMPLAZARLO)
     * 
     * @hooked blossom_spa_footer_start  - 20
     * @hooked blossom_spa_footer_top    - 30
     * @hooked blossom_spa_footer_bottom - 40
     * @hooked blossom_spa_footer_end    - 50
    */
    // do_action( 'blossom_spa_footer' ); // 🔥 COMENTADO PARA OCULTAR EL FOOTER ORIGINAL
    
    /**
     * After Footer
     * 
     * @hooked blossom_spa_page_end    - 20
    */
    do_action( 'blossom_spa_after_footer' );

    wp_footer(); ?>
    
    <!-- ============================================================ -->
    <!-- 🚀 FOOTER PERSONALIZADO CON CI/CD                            -->
    <!-- ============================================================ -->
    
    <style>
        /* ============================================
           ESTILOS DEL NUEVO FOOTER
           ============================================ */
        
        .footer-cicd {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #ffffff;
            padding: 40px 20px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-top: 4px solid #f1c40f;
            margin-top: 0;
        }
        
        .footer-cicd-contenedor {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .footer-cicd-columna h3 {
            color: #f1c40f;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid rgba(241, 196, 15, 0.3);
            padding-bottom: 10px;
        }
        
        .footer-cicd-columna p {
            line-height: 1.8;
            font-size: 14px;
            color: #cccccc;
            margin: 8px 0;
        }
        
        .footer-cicd-columna a {
            color: #f1c40f;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-cicd-columna a:hover {
            color: #ffffff;
        }
        
        .footer-cicd-contacto {
            list-style: none;
            padding: 0;
        }
        
        .footer-cicd-contacto li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .footer-cicd-contacto .icono {
            font-size: 18px;
            width: 30px;
            display: inline-block;
        }
        
        .footer-cicd-redes {
            display: flex;
            gap: 15px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        
        .footer-cicd-redes a {
            background: rgba(255,255,255,0.1);
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            transition: background 0.3s;
            color: white;
            text-decoration: none;
        }
        
        .footer-cicd-redes a:hover {
            background: rgba(241, 196, 15, 0.3);
        }
        
        /* BANNER CI/CD - Parte inferior */
        .footer-cicd-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .footer-cicd-banner .estado {
            background: #2ecc71;
            color: white;
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .footer-cicd-banner .fecha {
            background: rgba(255,255,255,0.2);
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 13px;
        }
        
        .footer-cicd-copyright {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 13px;
            color: #888888;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .footer-cicd-contenedor {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .footer-cicd-redes {
                justify-content: center;
            }
            .footer-cicd-banner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
    
    <!-- ============================================================ -->
    <!-- ESTRUCTURA DEL NUEVO FOOTER                                  -->
    <!-- ============================================================ -->
    
    <footer class="footer-cicd">
        <div class="footer-cicd-contenedor">
            
            <!-- Columna 1: Información del Spa -->
            <div class="footer-cicd-columna">
                <h3>🌿 Zait Sebastián Spa</h3>
                <p>Tratamientos diseñados para promover el bienestar, la relajación y el cuidado personal.</p>
                <p style="margin-top: 10px;">
                    <span style="display:block;">📍 Ambato, Ecuador</span>
                    <span style="display:block;">📞 +593 0995665483</span>
                    <span style="display:block;">✉️ info@zaitsebastianspa.com</span>
                </p>
            </div>
            
            <!-- Columna 2: Horarios -->
            <div class="footer-cicd-columna">
                <h3>🕐 Horarios</h3>
                <p><strong>Lunes a Viernes:</strong> 7:00 AM - 7:00 PM</p>
                <p><strong>Sábado:</strong> 8:00 AM - 5:00 PM</p>
                <p><strong>Domingo:</strong> Cerrado</p>
            </div>
            
            <!-- Columna 3: Redes Sociales -->
            <div class="footer-cicd-columna">
                <h3>📱 Síguenos</h3>
                <p>Conéctate con nosotros en redes sociales:</p>
                <div class="footer-cicd-redes">
                    <a href="#" target="_blank">📘 Facebook</a>
                    <a href="#" target="_blank">📸 Instagram</a>
                    <a href="#" target="_blank">🐦 Twitter</a>
                    <a href="#" target="_blank">▶️ YouTube</a>
                </div>
            </div>
            
        </div>
        
        <!-- BANNER CI/CD - DEMOSTRACIÓN PARA TESIS -->
        <div class="footer-cicd-banner">
            <div>
                🚀 <strong>CI/CD ACTIVO</strong>
                <span class="estado">✅ DESPLIEGUE EXITOSO</span>
            </div>
            <div class="fecha">
                📅 Último despliegue: <?php echo date('Y-m-d H:i:s'); ?>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="footer-cicd-copyright">
            © Copyright <?php echo date('Y'); ?>. Todos los derechos reservados. 
            <span style="color: #667eea;">|</span> 
            Desarrollado con ❤️ y CI/CD
        </div>
        
    </footer>
    
    <!-- ============================================================ -->
    <!-- FIN DEL FOOTER PERSONALIZADO                                 -->
    <!-- ============================================================ -->
    
</body>
</html>