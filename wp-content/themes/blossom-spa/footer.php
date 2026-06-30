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
    <!-- FOOTER CON COLORES DEL SITIO - ZAIT SEBASTIÁN SPA            -->
    <!-- ============================================================ -->
    
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div style="background: #f0f8ff; color: #2c3e50; padding: 50px 20px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-top: 3px solid #3498db;">
            
            <!-- Contenedor principal -->
            <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; margin-bottom: 30px;">
                
                <!-- Columna 1: Información del Spa -->
                <div>
                    <h3 style="color: #2c3e50; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid #3498db; padding-bottom: 10px; display: inline-block;">
                        🌿 Zait Sebastián Spa
                    </h3>
                    <p style="color: #555; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        Tratamientos diseñados para promover el bienestar, la relajación y el cuidado personal.
                    </p>
                    <p style="color: #555; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        <span style="display: block;">📍 Ambato - Ecuador</span>
                        <span style="display: block;">📞 +593 0995665483</span>
                        <span style="display: block;">✉️ info@zaitsebastianspa.com</span>
                    </p>
                </div>
                
                <!-- Columna 2: Horarios -->
                <div>
                    <h3 style="color: #2c3e50; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid #3498db; padding-bottom: 10px; display: inline-block;">
                        🕐 Horarios
                    </h3>
                    <p style="color: #555; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        <strong style="color: #2c3e50;">Lunes a Viernes</strong><br>
                        7:00 AM - 7:00 PM
                    </p>
                    <p style="color: #555; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        <strong style="color: #2c3e50;">Sábado</strong><br>
                        8:00 AM - 5:00 PM
                    </p>
                    <p style="color: #555; line-height: 1.8; font-size: 14px; margin: 8px 0;">
                        <strong style="color: #2c3e50;">Domingo</strong><br>
                        <span style="color: #999;">Cerrado</span>
                    </p>
                </div>
                
                <!-- Columna 3: Enlaces rápidos -->
                <div>
                    <h3 style="color: #2c3e50; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid #3498db; padding-bottom: 10px; display: inline-block;">
                        📋 Enlaces
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #555; text-decoration: none; font-size: 14px; transition: color 0.3s; display: inline-block;">🏠 Inicio</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #555; text-decoration: none; font-size: 14px; transition: color 0.3s; display: inline-block;">👤 Quiénes Somos</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #555; text-decoration: none; font-size: 14px; transition: color 0.3s; display: inline-block;">💆 Servicios</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #555; text-decoration: none; font-size: 14px; transition: color 0.3s; display: inline-block;">📞 Contacto</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="#" style="color: #555; text-decoration: none; font-size: 14px; transition: color 0.3s; display: inline-block;">📅 Reservar Cita</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Columna 4: Redes Sociales -->
                <div>
                    <h3 style="color: #2c3e50; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid #3498db; padding-bottom: 10px; display: inline-block;">
                        📱 Síguenos
                    </h3>
                    <p style="color: #555; font-size: 14px; margin-bottom: 15px;">
                        Conéctate con nosotros en redes sociales.
                    </p>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="#" style="background: #e8f4fd; color: #2c3e50; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: all 0.3s; border: 1px solid #d4e9f7;">📘 Facebook</a>
                        <a href="#" style="background: #e8f4fd; color: #2c3e50; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: all 0.3s; border: 1px solid #d4e9f7;">📸 Instagram</a>
                        <a href="#" style="background: #e8f4fd; color: #2c3e50; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: all 0.3s; border: 1px solid #d4e9f7;">🐦 Twitter</a>
                    </div>
                </div>
                
            </div>
            
            <!-- Línea divisoria -->
            <div style="max-width: 1200px; margin: 0 auto; border-top: 1px solid #d4e9f7; padding-top: 20px;">
                
                <!-- Fila inferior: Copyright + CI/CD -->
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    
                    <!-- Copyright -->
                    <div style="color: #888; font-size: 13px;">
                        © Copyright <?php echo date('Y'); ?>. Todos los derechos reservados.
                    </div>
                    
                    <!-- Badge CI/CD -->
                    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <span style="background: #3498db; color: #ffffff; padding: 4px 14px; border-radius: 20px; font-size: 11px; font-weight: bold;">
                            🚀 CI/CD Activo
                        </span>
                        <span style="color: #888; font-size: 11px;">
                            Último despliegue: <?php echo date('d/m/Y H:i'); ?>
                        </span>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </footer>
    
    <!-- ============================================================ -->
    <!-- FIN DEL FOOTER CON COLORES DEL SITIO                          -->
    <!-- ============================================================ -->
    
</body>
</html>