<?php
define('WP_CACHE', true);
/**
 * WordPress için taban ayar dosyası.
 *
 * Bu dosya şu ayarları içerir: MySQL ayarları, tablo öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için 
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardım sayfasına göz atabilirsiniz. MySQL ayarlarınızı servis sağlayıcınızdan edinebilirsiniz.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress
 */

// ** MySQL ayarları - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define('DB_NAME', 'ises9801_isese');

/** MySQL veritabanı kullanıcısı */
define('DB_USER', 'ises9801_isese');

/** MySQL veritabanı parolası */
define('DB_PASSWORD', 'N_3m6!18');

/** MySQL sunucusu */
define('DB_HOST', 'localhost');

/** Yaratılacak tablolar için veritabanı karakter seti. */
define('DB_CHARSET', 'utf8mb4');

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define('DB_COLLATE', '');

/**#@+
 * Eşsiz doğrulama anahtarları.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'NbHlq6 j:@V.^i-_$tHPQ)P!8tQ~X-c0+#~D&XmP -a-z=cX/@LocV}aU`s.c}(+');
define('SECURE_AUTH_KEY',  '0^{] w:CKEB6-,,%%ccVaMc<^FC>X) E0UHR@i/2|q]04WE3eVTg5P^A[V&*t;=i');
define('LOGGED_IN_KEY',    'i1/DASvj2FZ%A5.EKq`i#AlaGuyNNpK86/c=8LjKk,*&)V !xR(:`&LVs,bIY2^c');
define('NONCE_KEY',        ' =_=dVpZ9Y%GTH=w5f#Nz^u{r}2ICgg{p%!}S~_!hARA+)U8>F_O!VrTV3NzaOl:');
define('AUTH_SALT',        'sE%bLD-rlw$I[9~hlg.yGXhN(H_e*AaWIJZu 4EYrYXb;8hXanKQ)IpuTO7)ZjOH');
define('SECURE_AUTH_SALT', 'cBunq.%;i;pCr_-F^I3r$CbiO0W MsS|7f{%rNWl)Dr2g;Nj;>|{aPS4O:Ru.R^u');
define('LOGGED_IN_SALT',   'w5],(]9~#v4~w8Dhb|,2vZGC3L7C-OoUh9fVVwAYe<S$=g&>H;gc+X<!|G$:;`lb');
define('NONCE_SALT',       'TDEpH3xmE:cZ@[&%O6b2f1}m 0hePN]Z~BR0.|pnU$mia>~t8x5l2pCAy9xqCI_X');
/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix  = 'wp_';
define('AUTOSAVE_INTERVAL', 300); // seconds
define('WP_POST_REVISIONS', 3);

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri "true" yaparak geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 */
define('WP_DEBUG', false);

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** WordPress değişkenlerini ve yollarını kurar. */
require_once(ABSPATH . 'wp-settings.php');
