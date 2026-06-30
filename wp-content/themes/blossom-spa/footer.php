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
     * Footer ORIGINAL COMENTADO para reemplazarlo
     */
    // do_action( 'blossom_spa_footer' );
    
    /**
     * After Footer
     * 
     * @hooked blossom_spa_page_end    - 20
    */
    do_action( 'blossom_spa_after_footer' );

    wp_footer(); ?>
    
    <!-- ============================================================ -->
    <!-- FOOTER PROFESIONAL - ZAIT SEBASTIÁN SPA                      -->
    <!-- ============================================================ -->
    
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div style="background: #0a0a1a; color: #ffffff; padding: 50px 20px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            
            <!-- Contenedor principal -->
            <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; margin-bottom: 30px;">
                
                <!-- Columna 1: Información del Spa -->
                <div>
                    <h3 style="color: #d4af37; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid rgba(212, 175, 55, 0.3); padding-bottom: 10px;">
                        🌿 Zait Sebastián Spa
                    </h3>
                    <p style="color: #aaaaaa; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        Tratamientos diseñados para promover el bienestar, la relajación y el cuidado personal.
                    </p>
                    <p style="color: #888888; line-height: 1.8; font-size: 13px; margin: 8px 0;">
                        <span style="display: block;">📍 Ambato - Ecuador</span>
                        <span style="display: block;">📞 +593 0995665483</span>
                        <span style="display: block;">✉️ info@zaitsebastianspa.com</span>
                    </p>
                </div>
                
                <!-- Columna 2: Horarios -->
                <div>
                    <h3 style="color: #d4af37; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid rgba(212, 175, 55, 0.3); padding-bottom: 10px;">
                        🕐 Horarios
                    </h3>
                    <p style="color: #aaaaaa; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        <strong style="color: #d4af37;">Lunes a Viernes</strong><br>
                        7:00 AM - 7:00 PM
                    </p>
                    <p style="color: #aaaaaa; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        <strong style="color: #d4af37;">Sábado</strong><br>
                        8:00 AM - 5:00 PM
                    </p>
                    <p style="color: #aaaaaa; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        <strong style="color: #d4af37;">Domingo</strong><br>
                        <span style="color: #666;">Cerrado</span>
                    </p>
                </div>
                
                <!-- Columna 3: Enlaces rápidos -->
                <div>
                    <h3 style="color: #d4af37; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid rgba(212, 175, 55, 0.3); padding-bottom: 10px;">
                        📋 Enlaces
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #aaaaaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Inicio</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #aaaaaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Quiénes Somos</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #aaaaaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Servicios</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #aaaaaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Contacto</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #aaaaaa; text-decoration: none; font-size: 14px; transition: color 0.3s;">Reservar Cita</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Columna 4: Redes Sociales -->
                <div>
                    <h3 style="color: #d4af37; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid rgba(212, 175, 55, 0.3); padding-bottom: 10px;">
                        📱 Síguenos
                    </h3>
                    <p style="color: #aaaaaa; font-size: 14px; margin-bottom: 15px;">
                        Conéctate con nosotros en redes sociales.
                    </p>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="#" style="background: rgba(255,255,255,0.05); color: #aaaaaa; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: all 0.3s;">📘 Facebook</a>
                        <a href="#" style="background: rgba(255,255,255,0.05); color: #aaaaaa; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: all 0.3s;">📸 Instagram</a>
                        <a href="#" style="background: rgba(255,255,255,0.05); color: #aaaaaa; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: all 0.3s;">🐦 Twitter</a>
                    </div>
                </div>
                
            </div>
            
            <!-- Línea divisoria -->
            <div style="max-width: 1200px; margin: 0 auto; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                
                <!-- Fila inferior: Copyright + CI/CD -->
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    
                    <!-- Copyright -->
                    <div style="color: #666666; font-size: 13px;">
                        © Copyright <?php echo date('Y'); ?>. Todos los derechos reservados.
                    </div>
                    
                    <!-- Badge CI/CD -->
                    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <span style="background: #1a1a2e; color: #d4af37; padding: 4px 12px; border-radius: 20px; font-size: 11px; border: 1px solid rgba(212, 175, 55, 0.3);">
                            🚀 CI/CD Activo
                        </span>
                        <span style="color: #555; font-size: 11px;">
                            Último despliegue: <?php echo date('d/m/Y H:i'); ?>
                        </span>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </footer>
    
    <!-- ============================================================ -->
    <!-- FIN DEL FOOTER PROFESIONAL                                    -->
    <!-- ============================================================ -->
    
</body>
</html>